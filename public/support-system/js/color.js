
var Dimension = function(value, unit) {
    this.value = parseFloat(value);
    this.unit = (unit && unit instanceof Unit) ? unit :
        new Unit(unit ? [unit] : undefined);
};
Dimension.prototype.type = "Dimension";
Dimension.prototype.accept = function(visitor) {
    this.unit = visitor.visit(this.unit);
};
Dimension.prototype.eval = function(context) {
    return this;
};
Dimension.prototype.toColor = function() {
    return new Color([this.value, this.value, this.value]);
};
Dimension.prototype.genCSS = function(context, output) {
    if ((context && context.strictUnits) && !this.unit.isSingular()) {
        throw new Error("Multiple units in dimension. Correct the units or use the unit function. Bad unit: " + this.unit.toString());
    }

    var value = this.fround(context, this.value),
        strValue = String(value);

    if (value !== 0 && value < 0.000001 && value > -0.000001) {
        // would be output 1e-6 etc.
        strValue = value.toFixed(20).replace(/0+$/, "");
    }

    if (context && context.compress) {
        // Zero values doesn't need a unit
        if (value === 0 && this.unit.isLength()) {
            output.add(strValue);
            return;
        }

        // Float values doesn't need a leading zero
        if (value > 0 && value < 1) {
            strValue = (strValue).substr(1);
        }
    }

    output.add(strValue);
    this.unit.genCSS(context, output);
};

// In an operation between two Dimensions,
// we default to the first Dimension's unit,
// so `1px + 2` will yield `3px`.
Dimension.prototype.operate = function(context, op, other) {
    /*jshint noempty:false */
    var value = this._operate(context, op, this.value, other.value),
        unit = this.unit.clone();

    if (op === '+' || op === '-') {
        if (unit.numerator.length === 0 && unit.denominator.length === 0) {
            unit = other.unit.clone();
            if (this.unit.backupUnit) {
                unit.backupUnit = this.unit.backupUnit;
            }
        } else if (other.unit.numerator.length === 0 && unit.denominator.length === 0) {
            // do nothing
        } else {
            other = other.convertTo(this.unit.usedUnits());

            if (context.strictUnits && other.unit.toString() !== unit.toString()) {
                throw new Error("Incompatible units. Change the units or use the unit function. Bad units: '" + unit.toString() +
                    "' and '" + other.unit.toString() + "'.");
            }

            value = this._operate(context, op, this.value, other.value);
        }
    } else if (op === '*') {
        unit.numerator = unit.numerator.concat(other.unit.numerator).sort();
        unit.denominator = unit.denominator.concat(other.unit.denominator).sort();
        unit.cancel();
    } else if (op === '/') {
        unit.numerator = unit.numerator.concat(other.unit.denominator).sort();
        unit.denominator = unit.denominator.concat(other.unit.numerator).sort();
        unit.cancel();
    }
    return new Dimension(value, unit);
};
Dimension.prototype.compare = function(other) {
    var a, b;

    if (!(other instanceof Dimension)) {
        return undefined;
    }

    if (this.unit.isEmpty() || other.unit.isEmpty()) {
        a = this;
        b = other;
    } else {
        a = this.unify();
        b = other.unify();
        if (a.unit.compare(b.unit) !== 0) {
            return undefined;
        }
    }

    return Node.numericCompare(a.value, b.value);
};
Dimension.prototype.unify = function() {
    return this.convertTo({ length: 'px', duration: 's', angle: 'rad' });
};
Dimension.prototype.convertTo = function(conversions) {
    var value = this.value,
        unit = this.unit.clone(),
        i, groupName, group, targetUnit, derivedConversions = {},
        applyUnit;

    if (typeof conversions === 'string') {
        for (i in unitConversions) {
            if (unitConversions[i].hasOwnProperty(conversions)) {
                derivedConversions = {};
                derivedConversions[i] = conversions;
            }
        }
        conversions = derivedConversions;
    }
    applyUnit = function(atomicUnit, denominator) {
        /* jshint loopfunc:true */
        if (group.hasOwnProperty(atomicUnit)) {
            if (denominator) {
                value = value / (group[atomicUnit] / group[targetUnit]);
            } else {
                value = value * (group[atomicUnit] / group[targetUnit]);
            }

            return targetUnit;
        }

        return atomicUnit;
    };

    for (groupName in conversions) {
        if (conversions.hasOwnProperty(groupName)) {
            targetUnit = conversions[groupName];
            group = unitConversions[groupName];

            unit.map(applyUnit);
        }
    }

    unit.cancel();

    return new Dimension(value, unit);
};


var Color = function(rgb, a, originalForm) {
    //
    // The end goal here, is to parse the arguments
    // into an integer triplet, such as `128, 255, 0`
    //
    // This facilitates operations and conversions.
    //
    if (Array.isArray(rgb)) {
        this.rgb = rgb;
    } else if (rgb.length == 6) {
        this.rgb = rgb.match(/.{2}/g).map(function(c) {
            return parseInt(c, 16);
        });
    } else {
        this.rgb = rgb.split('').map(function(c) {
            return parseInt(c + c, 16);
        });
    }
    this.alpha = typeof a === 'number' ? a : 1;
    if (typeof originalForm !== 'undefined') {
        this.value = originalForm;
    }
};
var colorNumber = function(n) {
    if (n instanceof Dimension) {
        return parseFloat(n.unit.is('%') ? n.value / 100 : n.value);
    } else if (typeof n === 'number') {
        return n;
    } else {
        throw {
            type: "Argument",
            message: "color functions take numbers as parameters"
        };
    }
}
var Colorscaled = function(n, size) {
    if (n instanceof Dimension && n.unit.is('%')) {
        return parseFloat(n.value * size / 100);
    } else {
        return colorNumber(n);
    }
}


//
// Operations have to be done per-channel, if not,
// channels will spill onto each other. Once we have
// our result, in the form of an integer triplet,
// we create a new Color node to hold the result.
//
Color.prototype.operate = function(context, op, other) {
    var rgb = [];
    var alpha = this.alpha * (1 - other.alpha) + other.alpha;
    for (var c = 0; c < 3; c++) {
        rgb[c] = this._operate(context, op, this.rgb[c], other.rgb[c]);
    }
    return new Color(rgb, alpha);
};
Color.prototype.toRGB = function() {
    return toHex(this.rgb);
};


Color.prototype.toHSL = function() {
    var r = this.rgb[0] / 255,
        g = this.rgb[1] / 255,
        b = this.rgb[2] / 255,
        a = this.alpha;

    var max = Math.max(r, g, b),
        min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2,
        d = max - min;

    if (max === min) {
        h = s = 0;
    } else {
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

        switch (max) {
            case r:
                h = (g - b) / d + (g < b ? 6 : 0);
                break;
            case g:
                h = (b - r) / d + 2;
                break;
            case b:
                h = (r - g) / d + 4;
                break;
        }
        h /= 6;
    }
    return { h: h * 360, s: s, l: l, a: a };
};
Color.prototype.clamp = function(val) {
    return Math.min(1, Math.max(0, val));
}
Color.prototype.componentToHex = function(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
Color.prototype.toHex2 = function(v) {
    return "#" + this.componentToHex(v.rgb[0]) + this.componentToHex(v.rgb[1]) + this.componentToHex(v.rgb[2]);
}
Color.prototype.toHex = function(v) {
    var r = parseInt(v.rgb[0], 10);
    var g = parseInt(v.rgb[1], 10);
    var b = parseInt(v.rgb[2], 10);
    return '#' + r.toString(16).padStart(2, "0") + g.toString(16).padStart(2, "0") + b.toString(16).padStart(2, "0");
}
Color.prototype.rgb = function(r, g, b) {
    return this.rgba(r, g, b, 1.0);
}
Color.prototype.rgba = function(r, g, b, a) {
    var rgb = [r, g, b].map(function(c) { return Colorscaled(c, 255); });
    a = colorNumber(a);
    return new Color(rgb, a);
}
Color.prototype.hsla = function(h, s, l, a) {

    var m1, m2;

    function hue(h) {
        h = h < 0 ? h + 1 : (h > 1 ? h - 1 : h);
        if (h * 6 < 1) {
            return m1 + (m2 - m1) * h * 6;
        } else if (h * 2 < 1) {
            return m2;
        } else if (h * 3 < 2) {
            return m1 + (m2 - m1) * (2 / 3 - h) * 6;
        } else {
            return m1;
        }
    }

    h = (colorNumber(h) % 360) / 360;
    s = this.clamp(colorNumber(s));
    l = this.clamp(colorNumber(l));
    a = this.clamp(colorNumber(a));

    m2 = l <= 0.5 ? l * (s + 1) : l + s - l * s;
    m1 = l * 2 - m2;

    return this.rgba(hue(h + 1 / 3) * 255,
        hue(h) * 255,
        hue(h - 1 / 3) * 255,
        a);
}
Color.prototype.lighten = function(amount, method) {
    var hsl = this.toHSL();

    if (typeof method !== "undefined" && method.value === "relative") {
        hsl.l += hsl.l * amount / 100;
    } else {
        hsl.l += amount / 100;
    }
    hsl.l = this.clamp(hsl.l);
    return this.toHex(this.hsla(hsl.h, hsl.s, hsl.l, hsl.a));
};
Color.prototype.darken = function(amount, method) {
    var hsl = this.toHSL();

    if (typeof method !== "undefined" && method.value === "relative") {
        hsl.l -= hsl.l * amount / 100;
    } else {
        hsl.l -= amount / 100;
    }
    hsl.l = this.clamp(hsl.l);
    return this.toHex(this.hsla(hsl.h, hsl.s, hsl.l, hsl.a));
}

var a = new Color("c616b8");
console.log(a.darken(25));
console.log(a.lighten(90));
//dbps:pRloq4d4P&I)