

/**********************************/
const format = (item) => {
    if (!item.id) {
        return item.text;
    }

    // var url = 'assets/media/' + item.element.getAttribute('data-kt-select2-country');
    var url = item.element.getAttribute('data-kt-select2-country');
    var img = $("<img>", {
        class: "rounded-circle me-2",
        width: 26,
        src: url
    });
    var span = $("<span>", {
        text: " " + item.text
    });
    span.prepend(img);
    return span;
}

// Init Select2 --- more info: https://select2.org/
$('#kt_docs_select2_country_Currency_exchange_Form').select2({
    templateResult: function (item) {
        return format(item);
    }
});

$('#kt_docs_select2_country_Currency_exchange_To').select2({
    templateResult: function (item) {
        return format(item);
    }
});

$('#kt_docs_select2_country_Profile').select2({
    templateResult: function (item) {
        return format(item);
    }
});

/******************************************/
// Select elements
const target = document.getElementById('kt_clipboard_1');
const button = document.getElementById('Btn_Copy');

// Init clipboard -- for more info, please read the offical documentation: https://clipboardjs.com/
var clipboard = new ClipboardJS(button, {
    target: target,
    text: function () {
        return target.value;
    }
});

// Success action handler
clipboard.on('success', function (e) {
    const currentLabel = button.innerHTML;

    // Exit label update when already in progress
    if (button.innerHTML === 'تم النسخ !') {
        return;
    }

    // Update button label
    button.innerHTML = 'تم النسخ!';

    // Revert button label after 3 seconds
    setTimeout(function () {
        button.innerHTML = currentLabel;
    }, 3000)
});


/****************************************************/
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    toastr.success('تم نسخ الرابط')
    $temp.remove();
}

function copyToClipboardNumberWallent(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    toastr.success('تم نسخ رقم المحفظة بنجاح')
    $temp.remove();
}



/******************************************/





/****************************************************/

