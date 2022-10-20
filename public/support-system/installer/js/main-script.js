/**
 * 
 */
isDisableFAnimation = false;
phoneFormat = "999 999 9999";
var MyAjaxChange = false;
var isWaitAdded = false;
var showlog = true;
var lboxOnCloseMethods = new Array();
var pageResizeMethod = new Array();
var addonLoadPopup = new Array();
var addonGridDataLoad = new Array();
var addOnInitialize = new Array();
var addonPageClose = [];

var csrf_ajax_cookie_name = 'app_token_ajax';
var csrf_ajax_input_name = 'app_form_ajax';


if (typeof(console) == "undefined") {
    console = { log: function() {} };
}

function gcl(msg, checkenable) {
	if(checkenable==undefined){
		checkenable=true;
	}
    if (checkenable && !showlog) {
        return;
    }
    if (typeof(console.log) != "undefined") {
        console.log(msg);
    }
}
String.prototype.hashCode = function() {
    var hash = 0,
        i, chr, len;
    if (this.length === 0) return hash;
    for (i = 0, len = this.length; i < len; i++) {
        chr = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + chr;
        hash |= 0; // Convert to 32bit integer
    }
    return hash;
};

function setServiceWorker() {
    return;   
}

function set_csrf_param(param) {
    var postValue = getCookie(csrf_ajax_cookie_name);
    if (postValue && postValue != "") {
        if (typeof param == "string") {
            if (param != "") {
                param += "&";
            }
            param += csrf_ajax_input_name + "=" + postValue;
        } else if (typeof param == "object") {
            try {
                if (typeof param.append === 'function') {
                    param.append(csrf_ajax_input_name, postValue);
                } else {
                    param
                    $.extend(param, {
                        [csrf_ajax_input_name]: postValue
                    });
                }
            } catch (e) {}

        }
    }
    return param;

}

function DownloadFile(url) {
    if (jQuery("#difrm").length == 0) {
        jQuery("body").append("<iframe id='difrm' style='border:none;height:0;width:0'></iframe>");
    }
    jQuery("#difrm").attr("src", url);
}

function setFileDownloader() {
    $(".app-file-downloader").click(function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        DownloadFile(url);
    });
}

$(function() {
    try {
        $.extend($.gritter.options, {
            position: 'top-right' // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)

        });
    } catch (e) { gcl(e.message, true); }

    //$("body").prepend('<div id="MainLoader"><div class="msgText"></div></div>');
    try { $.gritter.options.position = "bottom-right"; } catch (e) {}
    try {
        //$('.lightbox-body').resize(function(){$.colorbox.resize();});
        $('body').on("resize", ".lightbox-body", function() { $.colorbox.resize(); });
    } catch (e) {}
    $('body').on('sidebarChanged', function(e) {
        if ($(this).hasClass('sidebar-collapse')) {
            //isSidebarCollapse
            setCookie("isSBC", 1);

        } else {
            setCookie("isSBC", 0);
        }
        ResizeMainMenu();
        ResizeAll();
    });
    $(window).resize(function() {
        ResizeMainMenu();
    });

    $("body").on("click", ".close-pop-up", function(e) {
        try {
            $.magnificPopup.instance.close();
        } catch (e) {}
    });

    AddOnLoadPopupMethod(SetBootstrapSelect);
    AddOnLoadPopupMethod(SetTextDigit);
    AddOnLoadPopupMethod(setNiceScroll);
    //AddOnGridLoadComplete(function(){alert("ok")});
    Initialize();
    try {
        setServiceWorker();
    } catch (e) {}

    try {
        SetDefaultColorButton();
    } catch (e) {}
    try {
        SetImageInput();
    } catch (e) {}
    setPageCloseMethod();
    try {
    set_dependable_fields();
    } catch (e) {}
});

function Initialize() {
    try {

        SetTable();
        HideMe();
        FromOnSubmit();
        SetLightBox();
        Legend();
        SetConfirm();
        SetSlider();
        
    } catch (e) { gcl(e.message, true); }

    SetSelectBox();
    SetAjaxForm();
    $(document).on("click", ".hideme", function() {
        $(this).parent().hide('slow');
    });
    setToolTipNalert();
    SetDatePicker();
    SetColorPicker();
    SetFromValidation();
    SetAjaxPopover();
    SetPrintButton();
    ResizeMainMenu();
    SetTag();
    setSelect2();
    //setPopUpAjax();
    setFileDownloader();
    setSwitchButton();
    SetBootstrapSelect();
    SetTextDigit();
    SetNormalFormAjax();
    try {
        for (i in addOnInitialize) {
            try {
                addOnInitialize[i]();
            } catch (e) {}
        }
    } catch (e) {
        console.log(e);
    }
    setNiceScroll();
}

function setToolTipNalert() {
    try {
    	$('.tooltip2:not(.added-tooltip2)').each(function(e){
    		var position=$(this).data("tooltip-position");    	
    		if(!position){
    			position="bottom";
    		}
    		var delayint=$(this).data("tooltip-delay");
    		var delay=[300,300];
    		if(delayint){
    			delay=[delayint,300];
    		}
    		var sides={
    				'top':['top', 'bottom', 'right', 'left'],
    				'bottom':	['bottom', 'top', 'right', 'left'],
    				'right':	['right', 'left', 'top', 'bottom'],
    				'left':	['left', 'right', 'top', 'bottom']
    		};
    		$(this).tooltipster({
    	            maxWidth: 500,
    	            side: sides[position],
    	            animation: "grow",
    	            delay:delay,
    	            theme: "tooltipster-borderless",
    	            contentCloning: true
    	        }).addClass("added-tooltip2");
    	});
        
    } catch (e) { gcl(e.message, true); }
    $('.GSTooltip,.app-tooltip').tooltip();
    $('.GSPopover,.app-popover').popover();
    $('.GSPopoverHtml,.app-popover-html').popover({
        html: true,
        content: function() {
            var content = $(this).data("custom-content");
            console.log($(content));
            content = $(content).html();
            return content;
        }
    });

    $(".alert").alert();
}

function SetTag() {
	return;
    try {
        $(".app-tags").selectize({
            plugins: ['remove_button'],
            persist: false,
            create: true,
            render: {
                item: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            },
            onDelete: function(values) {
                return true;
                //return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
            }
        });
    } catch (e) {
        gcl(e);
    }
}

function ResizeMainMenu() {    
    return;

}

function LoadAjaxContent(id, url) {
    var urlHash = url.hashCode();
    if (typeof window.loadedurl == "undefined") {
        window.loadedurl = [];
    }
    if (typeof window.loadedurl[urlHash] != "undefined") {
        setTimeout(function() {
            $("#" + id).html(window.loadedurl[urlHash]);
        }, 50);
        return;
    }
    $.get(url, function(data) {
        window.loadedurl[urlHash] = data;
        $("#" + id).html(data);

    });

}

function SetAjaxPopover() {
    try {
        var popajaxid = 0;
        $('.app-popover-ajax:not(.added-popover)').popover({
            html: true,
            trigger: 'hover',
            container: 'body',
            delay: 500,
            placement: 'bottom',
            template: '<div class="popover popover2" role="tooltip"><div class="arrow arrow-dynamic"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
            content: function() {
                var url = $(this).data("content-url");
                var id = "popover" + popajaxid++;
                var html = '<div id="' + id + '" class="ajax-popover-container"><i class="ajax-popover-loader fa fa-spin fa-refresh"/></div>';
                LoadAjaxContent(id, url);
                return html;
            }
        });
        $('.app-popover-ajax:not(.added-popover)').addClass('added-popover');

    } catch (e) {
        console.log(e);
    }
}

function AppGridPopDropdown() {
    try {
        $(".grid-dropdown").on('click', function(e) {

            var dropMenuId = $(this).data("content-id");
            var thisobj = $(this);
            var isOpened = $(this).attr('aria-expanded');
            var parentWindow = $(this).closest('table');
            var parentWindowViewPort = $(this).closest('.ui-jqgrid-bdiv');

            if (true || typeof isOpened == 'undefined' || isOpened == "") {
                //console.log(thisobj);
                var menuElement = thisobj.parent().find(">.dropdown-menu");
                //console.log(menuElement);
                menuElement.css({
                    visibility: "hidden",
                    display: "block"
                });

                //gcl(parentWindowViewPort.height());
                // Necessary to remove class each time so we don't unwantedly use dropup's offset top
                menuElement.parent().removeClass("dropup");
                // Determine whether bottom of menu will be below window at current scroll position
                if (menuElement.offset().top + menuElement.outerHeight() > parentWindowViewPort.offset().top + parentWindowViewPort.height() + parentWindow.scrollTop()) {
                    menuElement.parent().addClass("dropup");
                }
                var buttonRightPos = thisobj.position().left + thisobj.width() + 14;
                //gcl(thisobj.parent()); 
                //gcl(thisobj.parent().width());
                buttonRightPos = thisobj.parent().width() - buttonRightPos;
                // Return dropdown menu to fully hidden state
                menuElement.removeAttr("style");
                menuElement.css({
                    left: "auto",
                    right: buttonRightPos
                });
                //gcl("from AppGridPopDropdown : 301 line :Position"); 
                //console.log(dropMenuId);
                //console.log(menuElement);
                //console.log(buttonRightPos);
                //gcl("offset");
                //console.log(thisobj.offset());
            }
        });
    } catch (e) {
        gcl(e);
    }
}

function AppGridDataLoaded() {
    SetAjaxPopover();
    AppGridPopDropdown();
}

function SetSlider() {
    try {
        $(".slider").slider();
    } catch (e) {}
}

function SetDatePicker() {
    try {
        /*$(".app-date-picker:not(.added-picker)").datetimepicker({
        	pickTime: false,
        	useStrict:true,
        	format:"m-d-Y",
        	onSelectDate:function(ct,$i){					
        		$i.trigger( "input" );
        		$i.trigger( "keyup" );
        		alert("ok")
        	}
        });	*/
        $(".app-date-picker:not(.added-picker)").datetimepicker({
            pickTime: false,
            timepicker: false,
            useStrict: true,
            format: "d-m-Y",
            scrollInput: false,
            onSelectDate: function(ct, $i) {
                $i.trigger("input");
                $i.trigger("keyup");
            },
            onShow: function(ct, elem) {
                var thisval = elem.val();
                var dv = new Date(thisval.replace(/-/g, "/"));
                var md = dv.getMonth() + 1;
                if (md < 10) {
                    md = "0" + md;
                }
                thisval = dv.getFullYear() + "/" + md + "/" + dv.getDate();

                var data_min_date = elem.data('min-date');
                var data_min_elem = elem.data('min-elem');
                var data_min_elem_data = $(data_min_elem).val();
                if (data_min_elem_data) {
                    var dt = new Date(data_min_elem_data.replace(/-/g, "/"));
                    var m = dt.getMonth() + 1;
                    if (m < 10) {
                        m = "0" + m;
                    }
                    data_min_elem_data = dt.getFullYear() + "/" + m + "/" + dt.getDate();
                }

                var data_max_date = elem.data('max-date');
                var data_max_elem = elem.data('max-elem');
                var data_max_elem_val = $(data_max_elem).val();
                if (data_max_elem_val) {
                    var d = new Date(data_max_elem_val.replace(/-/g, "/"));
                    var m = d.getMonth() + 1;
                    if (m < 10) {
                        m = "0" + m;
                    }
                    data_max_elem_val = d.getFullYear() + "/" + m + "/" + d.getDate();
                }
                var opt_min_date = false;
                if (data_min_elem && data_min_elem_data != "") {
                    opt_min_date = data_min_elem_data;
                    if (thisval == opt_min_date && opt_min_date != data_min_date) {
                        opt_min_date = data_min_date;
                    }
                } else if (data_min_date && data_min_date != "") {
                    opt_min_date = data_min_date;
                }

                var opt_max_date = false;
                if (data_max_elem && data_max_elem_val != "") {
                    opt_max_date = data_max_elem_val;
                    if (thisval == opt_max_date && opt_max_date != data_max_date) {
                        opt_max_date = data_max_date;
                    }
                } else if (data_max_date && data_max_date != "") {
                    opt_max_date = data_max_date;
                }

                if (opt_min_date) {
                    opt_min_date = opt_min_date.replace(/-/g, "/");
                }
                if (opt_max_date) {
                    opt_max_date = opt_max_date.replace(/-/g, "/");
                }
                //console.log(opt_min_date+" "+opt_max_date);
                this.setOptions({
                    minDate: opt_min_date,
                    maxDate: opt_max_date

                });
            }
        });
        $(".app-date-picker:not(.added-picker)").addClass("added-picker");
    } catch (e) {}
    SetDateTimePicker();
}

function SetDateTimePicker() {
    try {
        $(".app-datetime-picker:not(.added-picker)").datetimepicker({
            pickTime: false,
            useStrict: true,
            step: 15,
            format: "d-m-Y H:i",
            onSelectDate: function(ct, $i) {
                $i.trigger("input");
                $i.trigger("keyup");
            },
            onSelectTime: function(ct, $i) {
                $i.trigger("input");
                $i.trigger("keyup");
            }
        });
        $(".app-date-picker:not(.added-picker)").addClass("added-picker");
    } catch (e) {}
    try {
        $(".app-time-picker:not(.added-picker)").datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 15,
            //mask:'23:59',disabled for some problem
            useStrict: true,
            onSelectDate: function(ct, $i) {
                $i.trigger("input");
                $i.trigger("keyup");
            },
            onSelectTime: function(ct, $i) {
                $i.trigger("input");
                $i.trigger("keyup");
            }
        });
        $(".app-time-picker:not(.added-picker)").addClass("added-picker");
    } catch (e) {}
}

function SetColorPicker() {
    try {
        $(".app-color-picker:not(.added-color-picker)").each(function(e) {
            try {
                var target = $(this).data("target");

                if (target && target != "") {
                    var inputtarget = $(target);
                    $(this).colorpicker({
                        input: inputtarget
                    });
                } else {
                    var inputobject = $(this);
                    var defaultColor = inputobject.val();
                    if (defaultColor == "") {
                        defaultColor = "transparent";
                    }
                    var colorobj = inputobject.colorpicker({ format: 'hex' });
                    var iconviwer = inputobject.parent().find(">.input-group-addon >i.c-preview");
                    if (iconviwer) {
                        colorobj.on('changeColor', function(e) {
                            //iconviwer.css("color",e.color.toString( 'rgba')) ;
                            inputobject.trigger("input");
                        });
                        inputobject.on("input", function() {
                            var color = $(this).val();
                            if (color == "") {
                                color = "transparent";
                            }
                            //console.log(color);
                            iconviwer.css("color", color);
                        });
                        iconviwer.css("color", defaultColor);
                    }
                }
                $(this).addClass("added-color-picker");
            } catch (e) {
                gcl(e);
            }
        });
    } catch (e) {}
}

function SetDateGridPicker() {
    try {
        $(".gs-date-picker-grid-options").each(function(e) {
            if (!$(this).hasClass("addedDate")) {
                $(this).addClass("addedDate");
                var pickerObj = $(this).find(">input");
                var type = $(this).attr("data-type");
                var config = { pickTime: true, timepicker: false, useStrict: true, format: "Y-m-d", onChangeDateTime: function(ct, $i) { pickerObj.val(ct.dateFormat('Y-m-d')); } };
                if (type == "date" || type == "daterange") {
                    config.pickTime = false;
                    config.timepicker = false;
                    config.format = "Y-m-d";

                } else if (type == "time" || type == "timerange") {
                    config.pickTime = true;
                    config.timepicker = true;
                    config.datepicker = false;
                    config.format = "H:i";
                    config.onChangeDateTime = function(ct, $i) { pickerObj.val(ct.dateFormat('H:i')); }
                } else if (type == "datetimerange") {
                    config.pickTime = true;
                    config.timepicker = true;
                    config.onChangeDateTime = function(ct, $i) { pickerObj.val(ct.dateFormat('Y-m-d H:i')); }
                }
                //console.log(config);
                $(this).datetimepicker(config);
            }
        });

    } catch (e) { gsl(e); }
}

function UnsetDateGridPicker() {
    try {
        $(".gs-date-picker-grid-options.addedDate").each(function(e) {
            $(this).removeClass("addedDate").datetimepicker('destroy');
        });

    } catch (e) { gsl(e); }
}

function SetSelectBox() {
    try {
        //$("select").chosen();
    } catch (e) { gcl(e.message, true); }
}

function ShowWait(isShow, msg, callback) {
    if (typeof(isShow) == "undefined") {
        isShow = true;
    }
    if (typeof(callback) == "undefined") {
        callback = function() {};
    }
    if (typeof(msg) == "undefined") {
        msg = 'Please Wait';
    }
    if (isShow) {
    	if(msg!=""){
    		msg = '<i class="fa fa-spinner fa-spin"></i>' + msg;    	
    		$("#MainLoader .msgText").html(msg);
        }
        $("#MainLoader").fadeIn(400, callback);
    } else {
        $("#MainLoader").fadeOut(400, callback);
    }

}

function ShowFormWait(isShow, msg, callback) {
    if (typeof(isShow) == "undefined") {
        isShow = true;
    }
    if (typeof(callback) == "undefined") {
        callback = function() {};
    }
    if (typeof(msg) == "undefined") {
        msg = 'Please Wait';
    }
    if (isShow) {
        msg = '<i class="fa fa-spinner fa-spin"></i>' + msg;
        $("#MainFormLoader .msgText").html(msg);
        $("#MainFormLoader").fadeIn(400, callback);
    } else {
        $("#MainFormLoader").fadeOut(400, callback);
    }

}

function ShowSideBarLoaderWait(selector, isShow, msg) {
    var element = $(selector);
    if (typeof(isShow) == "undefined") {
        isShow = true;
    }
    if (typeof(msg) == "undefined") {
        msg = "Please Wait";
    }
    if (isShow) {
        element.find(".msgText").html(msg);
        element.fadeIn();
    } else {
        element.fadeOut();
    }

}

function ShowGritterMsg(msg, IsSuccess, IsSticky, title, icon) {
    try {
        if (typeof(IsSuccess) == 'undefined') {
            IsSuccess = true;
        }

        if (typeof(IsSticky) == 'undefined') {
            IsSticky = false;
        }
        if (typeof(title) == 'undefined') {
            title = "Notification";
        }
        if (typeof(icon) == 'undefined') {
            icon = "";
        }
        try {
            var options = {
                title: title,
                style: IsSuccess ? 'success' : 'error',
                theme: 'right-bottom.css',
                timeout: 5000,
                message: msg,
                icon: icon
            };
            if (IsSticky) {
                options.timeout = null;
            }
            var n = new notify(options);
            n.show();
        } catch (e) {
            $.gritter.add({
                position: 'bottom-left',
                // (string | mandatory) the heading of the notification
                //title: 'This is a regular notice!',
                // (string | mandatory) the text inside the notification
                text: msg,
                /*// (string | optional) the image to display on the left*/
                image: IsSuccess ? base_url + 'images/statusOk.png' : base_url + 'images/statuserror.png',

                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: IsSticky,
                // (int | optional) the time you want it to be alive for before fading out
                time: 5000
            });
        }
    } catch (e) { gcl(e); }

}

function SetConfirm() {
    $("body").on("click", ".Confirm", function(e) {
        var msg = $(this).attr('msg');
        if (confirm(msg) == false) {
            e.stopPropagation();
            e.preventDefault();
        }
    });

    $("body").on("click", ".ConfirmAjaxWR", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var msg = $(this).data('msg');
        var $thisObj = $(this);

        var callAfterProcess = $(this).attr('oncompleted');
        if (!callAfterProcess || callAfterProcess == "") {
            callAfterProcess = $(this).data('on-complete');
        }
        var thisobj = $(this);
        var url = thisobj.attr("href");
        if (typeof(url) == "undefined" || url == "") {
            alert("Target url is empty");
            return;
        }
        if (typeof(swal) == "function") {
            swal({
                title: "",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    process_confirm_ajax(thisobj, url, callAfterProcess);
                }
            });
        } else {
            if (msg != "") {
                if (confirm(msg) == false) {
                    return;
                }
            }
            process_confirm_ajax(thisobj, url, callAfterProcess);
        }

    });

}

function process_confirm_ajax(thisobj, url, callAfterProcess) {
    var lastHtml = "";
    $.ajax({
        url: url,
        type: "GET",
        scriptCharset: "utf-8",
        dataType: "json",
        beforeSend: function() {
            //ShowWait();
            lastHtml = thisobj.html();
            thisobj.html('<i class="conf-loader fa fa-spinner fa-spin"></i> ');
        },
        success: function(rdata) {
            try {
                if (callAfterProcess) {
                    var com = eval(callAfterProcess);
                    if (typeof com == 'function') {
                        setTimeout(function() {
                            com(rdata, thisobj);
                        }, 50);
                        return;
                    }

                }
            } catch (e) { cl(e); }

            try {
                if (typeof(swal) == "function") {
                    swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
                } else {
                    ShowGritterMsg(rdata.msg, rdata.status, rdata.is_sticky, rdata.title, rdata.icon);
                }

            } catch (e) { gcl(e.message, true); }
            if (rdata.status) {
                ReloadAll();
            }


        },
        complete: function(jqXHR, textStatus) {
            thisobj.html(lastHtml);
        }
    });
}

function SetAjaxForm() {
    if ($("form.app-ajax-form").each(function() {
            var Ajaxbostrapvalidator = $(this).bootstrapValidator({
                excluded: ':disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    cc_exp_date: {
                        validators: {
                            callback: {
                                message: 'Invalid MMYY',
                                callback: function(value, validator) {
                                    var m = new moment(value, 'MMYY', true);
                                    if (!m.isValid()) {
                                        return false;
                                    }
                                    var m2 = moment();
                                    // US independence day is July 4
                                    return m > m2;
                                }
                            }
                        }
                    }
                },
                submitHandler: function(validator, form, submitButton) {
                    var rtype = form.attr("request-type");
                    var htmlBeforeLoading = "";
                    if (!rtype) { rtype = "json"; }

                    if (form.data("multipart")) {
                        var formData = new FormData(form[0]);
                        formData = set_csrf_param(formData);
                        var contentType = false;
                        var processData = false;
                        var async = true;

                    } else {
                        var formData = set_csrf_param(form.serialize());
                        var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                        var processData = true;
                        var async = true;
                    }
                    var method = form.attr("method");
                    $.ajax({
                        type: method,
                        url: form.attr('action'),
                        data: formData,
                        processData: processData,
                        dataType: rtype,
                        contentType: contentType,
                        cache: false,
                        async: async,
                        beforeSend: function() {
                            //	ShowWait();
                            htmlBeforeLoading = form.find("[type=submit]").html();
                            form.find("[type=submit]").html('<i class="fa fa-spinner fa-spin"></i>');
                            form.find("[type=submit]").addClass("Loading");
                            form.find("[type=submit]").attr("disabled", "disabled");
                            try {
                                var beforesend = form.data("beforesend");
                                if (beforesend) {
                                    eval(beforesend + "(form);");
                                    return;
                                }
                                beforesend = form.attr("beforesend")
                                if (beforesend) {
                                    eval(beforesend + "(form);");
                                    return;
                                }
                                beforesend = form.data("on-beforesend")
                                if (beforesend) {
                                    eval(beforesend + "(form);");
                                    return;
                                }
                            } catch (e) {

                            }
                        },
                        success: function(rdata) {
                            try {
                                var oncomplete = form.data("oncomplete");
                                if (oncomplete) {
                                    eval(oncomplete + "(rdata,form);");
                                    return;
                                }
                                oncomplete = form.attr("oncomplete")
                                if (oncomplete) {
                                    eval(oncomplete + "(rdata,form);");
                                    return;
                                }
                                oncomplete = form.data("on-complete")
                                if (oncomplete) {
                                    eval(oncomplete + "(rdata,form);");
                                    return;
                                }
                            } catch (e) {

                            }
                            if (rtype != "json") return;
                            //ShowWait(false);

                            if (rdata.status) {
                                ReloadAll();
                            }
                            //ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);	
                        },
                        complete: function(jqXHR, textStatus) {
                            form.find("[type=submit]").removeClass("Loading");
                            form.find("[type=submit]").removeAttr("disabled");
                            form.find("[type=submit]").html(htmlBeforeLoading);
                            //console.log(textStatus);
                            if (jqXHR.status == "500" || jqXHR.status == "403" || textStatus == "error") {
                                form.find(".state-loading").removeClass("state-loading");
                                try {
                                    ShowGritterMsg(jqXHR.responseJSON.msg, jqXHR.responseJSON.status, jqXHR.responseJSON.is_sticky, jqXHR.responseJSON.title, jqXHR.responseJSON.icon);
                                } catch (e) {
                                    ShowGritterMsg("Unwanted Error", false, false, "Error !!", "times-circle-o");
                                }
                            }


                        }
                    });
                }
            });
            // Init iCheck elements
            try {
                Ajaxbostrapvalidator.find('.cbox-control').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    })
                    // Called when the radios/checkboxes are changed
                    .on('ifChanged', function(e) {
                        // Get the field name
                        try {
                            var field = $(this).attr('name');
                            var fromobj = $(this).closest("form");
                            fromobj
                            // Mark the field as not validated
                                .bootstrapValidator('updateStatus', field, 'NOT_VALIDATED')
                                // Validate field
                                .bootstrapValidator('validateField', field);
                        } catch (e) {}
                    });
            } catch (e) {}
        }));


}

function HideMe() {
    $(".HideME").click(function() {
        $(this).parent().hide('slow');
    });
}

function AddOnPageCloseMethod(method) {
	addonPageClose.push(method);
}
function AddOnCloseMethod(method) {
    lboxOnCloseMethods.push(method);
}

function AddOnLoadPopupMethod(method) {
    addonLoadPopup.push(method);
}

function AddOnInitialized(method) {
    addOnInitialize.push(method);
}

function AddOnGridLoadComplete(method) {
    addonGridDataLoad.push(method);
}

function AddOnPageResize(method) {
    pageResizeMethod.push(method);
}

function OnCloseError() {
    $(".formError").hide();
}

function ReloadAll() {
    try {
        for (i in lboxOnCloseMethods) {
            lboxOnCloseMethods[i]();
        }
    } catch (e) {
        console.log(e);
    }
}

function ResizeAll() {
    try {
        for (i in pageResizeMethod) {
            pageResizeMethod[i]();
        }
    } catch (e) {
        console.log(e);
    }
}
function setPageCloseMethod(){
	window.onbeforeunload = function(e) {
		if(addonPageClose.length>0){
			var rt=null;
			 try {
		        for (i in addonPageClose) {
		        	var at=addonPageClose[i](e);			        	
		        	if(at!=""){
		        		rt=at;
		        	}			        	
		        }		       
			    } catch (e) {
			        console.log(e);
			    }
		    return rt;
		}else{
			return null;
		}
		
	};
}
function clearSelectWindow() {
    try {
        $(".select2-container--open").remove();
    } catch (e) {}
}

function OnClosed() {
    try {
        clearSelectWindow();
    } catch (e) {}
    var onclosemainevent = $(this).attr('onclose');
    if (onclosemainevent) {
        eval(onclosemainevent + "()");
        return;
    }

    if (MyAjaxChange) {
        var data = "";
        try {
            for (i in lboxOnCloseMethods) {
                lboxOnCloseMethods[i]();
            }
            data = onRefresh();
        } catch (e) {
            data = "";
        }
        MyAjaxChange = false;
    }
    /*
     * $.ajax({ type: "POST", url: document.URL, cache:false, data:data,
     * beforeSend:beforeSend, success: function(data){ Loading(false);
     * $('body').html(data); } });
     */
    // window.location.reload(true);
    OnCloseError();
}

function _colorboxLoadComplted() {
    LoadAfterContentLoad();
    try {
        PageLoadComplete();
    } catch (e) {}
    try {
        $('#LightBoxBody').resize(function() { $.colorbox.resize(); });
    } catch (e) {}
}

function LegendIn() {
    $(this).animate({
        width: "+=16"
    }, 200, function() {
        $min = $(this).attr("minimize");
        if ($min) {
            $(this).find(".maximize").fadeIn();
            $(this).find(".minimize").fadeOut();
        } else {
            $(this).find(".maximize").fadeOut();
            $(this).find(".minimize").fadeIn();
        }
    });
}

function LegendOut() {
    console.log("out");
    $(this).find(".maximize,.minimize").hide();
    $(this).animate({
        width: "-=16"
    }, 200);
}

function Legend() {
    //$(".Dashboard .GSFieldset legend").append("<span class='minimize'> </span><span class='maximize'> </span>")
    //$(".Dashboard .GSFieldset legend").attr("minimize",false);
    //$(".Dashboard .GSFieldset legend").hover(LegendIn,LegendOut);

}

function FromOnSubmit() {

    $("form input[type=submit]").click(function(e) {
        var isOk = true;
        try {
            isOk = $(".mainForm").validationEngine('validate');
        } catch (e) {
            isOk = true;
        }
        if (isOk) {
            if (!$(".mainForm").hasClass("NoLoading")) {
                $(this).addClass("Loading");
            }
        }
        //return false;
    });


}

function SetFromValidation() {
    try {
        $('.bv-form:not(.app-lb-ajax-form)').each(function() {
            var submitHandler = $(this).data("submit-handler");
            if (submitHandler) {
                submitHandler = eval(submitHandler);
            }else{
            	submitHandler=default_submit_handler;
            }
            $(this).bootstrapValidator({
                submitHandler: submitHandler,
                excluded: ':disabled,:hidden:not(.force-bv)',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                }
            });           

        });
    } catch (e) {}
}
function default_submit_handler(validator, form, submitButton){	
	form.find("[type=submit]").prop("disabled",true);
	ShowWait(true,"",function(){		
		validator.defaultSubmit();
	});
	
}

function SetValidation(selector, option) {
    
}

function HideAllError() {
    /*jQuery(".mainForm").validationEngine('hideAll');*/
    $(".formError").fadeOut(500, function() {
        // remove prompt once invisible
        $(this).parent('.formErrorOuter').remove();
        $(this).remove();
    });
}

function SetLightBox() {
    try {
        setPopUpAjax();
    } catch (e) {}
    SetTable();
    SetValidation();
}

function cl(str) {
    try {
        console.log(str);
    } catch (e) {
        alert(str);
    }
}

function SetTable() {
    
}

function ReloadSiteUrl() {
    window.location = window.location.href;
}

function RedirectUrl(url) {
    window.location = url;
}

function CallMyAjax(url, data, beforeSend, Success, JSONData, Complete, IsMsgBox, MsgContainer) {
    if (!beforeSend) {
        beforeSend = function() {};
    }
    if (!Success) {
        Success = function() {};
    }
    if (typeof(JSONData) == "undefined") {
        JSONData = true;
    }
    if (typeof(IsMsgBox) == "undefined") {
        IsMsgBox = false;
    }
    if (typeof(MsgContainer) == "undefined") {
        MsgContainer = null;
    }

    $.ajax({
        url: url,
        data: set_csrf_param(data),
        type: "POST",
        scriptCharset: "utf-8",
        dataType: JSONData ? "json" : "html",
        beforeSend: function() {
            beforeSend();
        },
        success: function(rdata) {
            if (JSONData) {

                //RequestCompleted(rdata,IsMsgBox,MsgContainer);

            };
            Success(rdata);
        },
        complete: function(jqXHR, textStatus) {
            if (typeof(Complete) != "undefined") {
                Complete(jqXHR, textStatus);
            }
            if (textStatus == "error") {
                if (jqXHR.status == "404") {
                    console.log("Error: Page does not found");
                } else if (jqXHR.status == "408") {
                    console.log("Error: Sarver does not active.");
                } else {
                    console.log("Error: May be connection lost.");
                }
            }
        }
    });
}
//converts number to (xxx)xxx-xxxx or xxx-xxx-xxxx
function formatPhoneNumber(cellvalue, options, rowObject) {
    try {
        var re = new RegExp("([0-9]{3})([0-9]{3})([0-9]{3,6})", "g");
        cellvalue = cellvalue.replace(re, "($1) $2-$3");
    } catch (e) { gcl(e.message, true); }
    return cellvalue;
}

function formatFullPhoneNumber(cellvalue, options, rowObject) {
    try {
        var re = new RegExp("[1-9]([0-9]{3})([0-9]{3})([0-9]{3,6})", "g");
        cellvalue = cellvalue.replace(re, "($1) $2-$3");
    } catch (e) { gcl(e.message, true); }
    return cellvalue;
}

function GetData() {

}

$(function() {
    $(document).on("click", ".showhidebtn", function() {
        if ($(".DMHeader").hasClass("hide")) {
            $.removeCookie("headerhide");
            $(".showhidebtn").removeClass("clickedt");
            $(".DMBody").animate({ marginTop: 0 }, 300, function() {
                $(".DMHeader").slideDown("slow", function() {
                    $(".DMHeader").removeClass("hide");
                    $(".onHideHeader").fadeOut('show');
                });
            });
        } else {
            $(".showhidebtn").addClass("clickedt");
            $(".DMBody").animate({ marginTop: 20 }, 300, function() {
                $(".DMHeader").slideUp("slow", function() {
                    $.cookie("headerhide", 1);
                    $(".onHideHeader").fadeIn('show');
                    $(".DMHeader").addClass("hide");
                });
            });

        }
    });
    $(document).on("click", ".showhideleftbtn", function() {
        if ($(".DMContainer .DMBody .LeftMenu").hasClass("hide")) {
            $(".showhideleftbtn").removeClass("clickedl");
            $.removeCookie("lefthide");
            $(".DMContainer .DMBody .ContentBody").animate({ marginLeft: 200 }, 500, function() {

            });
            $(".DMContainer .DMBody .LeftMenu").animate({ marginLeft: 0 }, 500, function() {
                $(this).removeClass("hide");
                ResizeAll();
            });
        } else {
            $(".showhideleftbtn").addClass("clickedl");
            $(".DMContainer .DMBody .LeftMenu").animate({ marginLeft: -200 }, 500, function() {
                $.cookie("lefthide", 1);
                ResizeAll();
                $(this).addClass("hide");
            });
            $(".DMContainer .DMBody .ContentBody").animate({ marginLeft: 20 }, 500, function() {

            });

        }
    });



    $(".clps .menulist").css("display", "none");
    $(document).on("click", ".MenuGroup .title", function() {
        var title = $(this);
        var menugroup = $(this).parent();
        var menulist = $(this).parent().find('.menulist');
        if (menugroup.hasClass("clps")) {
            menugroup.removeClass("clps");
            menulist.slideDown('slow', function() {
                $.removeCookie(menugroup.attr("id"));
            });

        } else {
            menulist.slideUp('slow', function() {
                menugroup.addClass("clps");
                $.cookie(menugroup.attr("id"), 1);
            });
        }
    });

    SetFullScreen();

    $("body").on("click", ".remove-parents", function(e) {
        e.preventDefault();
        var thisobj = $(this);
        var con = confirm("Are you sure?");
        if (con) {
            $(this).parent().animate({
                opacity: 0
            }, 500, function() {
                $(this).remove();
            });
        }
    });

});

function SetiCheckBox(selector) {
    try {
        $(selector).iCheck({
            checkboxClass: 'icheckbox_square-greed',
            radioClass: 'iradio_square-green'
        });
    } catch (e) {

    }
}

function printPDF(pdfUrl) {
    var w = window.open(pdfUrl);
    w.print();
    w.close();
}

function ReloadIfAjaxWindowChanged() {
    if (MyAjaxChange) {
        ReloadSiteUrl();
        MyAjaxChange = false;
    }
}

function SetFullScreen() {
    try {
        $(".full-screen").prepend('<a type="button" href="#" class="full-screen-btn btn-xs btn"><i class="fa"></i></a>');
        $("body").on("click", ".full-screen-btn", function(e) {
            e.preventDefault();
            $("body").toggleClass("full-screen-body");

        });
    } catch (e) {
        gcl(e);
    }
}

function GetTimeSpendDate(date1, date2) {
    var diff = Math.floor(date1.getTime() - date2.getTime());
    var secs = Math.floor(diff / 1000);
    var mins = Math.floor(secs / 60);
    var hours = Math.floor(mins / 60);
    var days = Math.floor(hours / 24);
    var months = Math.floor(days / 31);
    var years = Math.floor(months / 12);
    months = Math.floor(months % 12);
    days = Math.floor(days % 31);
    hours = Math.floor(hours % 24);
    mins = Math.floor(mins % 60);
    secs = Math.floor(secs % 60);
    var message = "";
    if (days <= 0) {
        message += secs + " sec ";
        message += mins + " min ";
        message += hours + " hours ";
    } else {
        message += days + " days ";
        if (months > 0 || years > 0) {
            message += months + " months ";
        }
        if (years > 0) {
            message += years + " years ago";
        }
    }
    return message
}

function getCookie(w) {
    cName = "";
    pCOOKIES = new Array();
    pCOOKIES = document.cookie.split('; ');
    for (bb = 0; bb < pCOOKIES.length; bb++) {
        NmeVal = new Array();
        NmeVal = pCOOKIES[bb].split('=');
        if (NmeVal[0] == w) {
            cName = unescape(NmeVal[1]);
        }
    }
    return cName;
}

function printCookies(w) {
    cStr = "";
    pCOOKIES = new Array();
    pCOOKIES = document.cookie.split('; ');
    for (bb = 0; bb < pCOOKIES.length; bb++) {
        NmeVal = new Array();
        NmeVal = pCOOKIES[bb].split('=');
        if (NmeVal[0]) {
            cStr += NmeVal[0] + '=' + unescape(NmeVal[1]) + '; ';
        }
    }
    return cStr;
}
function deleteCookie(name) {
	try{
	 //jQuery.removeCookie(name);
    //document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    //document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	 document.cookie = name+'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT';
	}catch(e){}
};
function setCookie(name, value, expires, path, domain, secure) {
    cookieStr = name + "=" + escape(value) + "; ";

    if (expires) {
        expires = setExpiration(expires);
        cookieStr += "expires=" + expires + "; ";
    }
    if (path) {
        cookieStr += "path=" + path + "; ";
    }
    if (domain) {
        cookieStr += "domain=" + domain + "; ";
    }
    if (secure) {
        cookieStr += "secure; ";
    }

    document.cookie = cookieStr;
}

function setExpiration(cookieLife) {
    var today = new Date();
    var expr = new Date(today.getTime() + cookieLife * 24 * 60 * 60 * 1000);
    return expr.toGMTString();
}

function loadedCallback() {
    console.log("Called From Gsscript after colorbox loaded");
}
var AppLightboxValidatorObject = null;

function SetLightBoxAjax() {
    try {
        var Ajaxbostrapvalidator = $("form.app-lb-ajax-form").bootstrapValidator({
            excluded: ':disabled,:hidden',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                exp_date: {
                    validators: {
                        callback: {
                            message: 'Invalid MMYY',
                            callback: function(value, validator) {
                                var m = new moment(value, 'MMYY', true);
                                if (!m.isValid()) {
                                    return false;
                                }
                                var m2 = moment();
                                // US independence day is July 4
                                return m > m2;
                            }
                        }
                    }
                }
            },
            onChangeStatus: function(validator, form) {
                try {
                    $.colorbox.resize({ preloading: true });
                } catch (e) {}

            },
            submitHandler: function(validator, form, submitButton) {
                if (form.data("multipart")) {
                    $(".lightboxWraper").fadeIn();
                    var formData = new FormData(form[0]);
                    formData = set_csrf_param(formData);
                    var contentType = false;
                    var processData = false;
                    var async = false;

                } else {
                    var formData = set_csrf_param(form.serialize());
                    var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                    var processData = true;
                    var async = true;
                }
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: formData,
                    processData: processData,
                    contentType: contentType,
                    cache: false,
                    async: async,
                    beforeSend: function() { ShowWaitinglight(true); },
                    success: function(data) {
                        var rData = $('<div/>');
                        rData.html(data);
                        var LightboxB = rData.find('#LightBoxBody');

                        $("#popup-container").attr("class", rData.find('#popup-container').attr("class"));

                        $('#LightBoxBody').html(LightboxB.html());
                        LoadAfterContentLoad();
                        try {
                            _popupajaxLoadComplted();
                        } catch (e) {}
                        try {
                            PageLoadComplete();
                        } catch (e) {}
                        MyAjaxChange = true;
                        try {
                            $.colorbox.resize({ preloading: true });
                        } catch (e) {}
                        SetLightBox();



                    },
                    complete: function() {
                        ShowWaitinglight(false);
                    }
                });
            }
        });
        try {
            // Init iCheck elements
            Ajaxbostrapvalidator.find('.cbox-control').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                })
                // Called when the radios/checkboxes are changed
                .on('ifChanged', function(e) {
                    // Get the field name
                    try {
                        var field = $(this).attr('name');
                        var fromobj = $(this).closest("form");
                        fromobj
                        // Mark the field as not validated
                            .bootstrapValidator('updateStatus', field, 'NOT_VALIDATED')
                            // Validate field
                            .bootstrapValidator('validateField', field);
                    } catch (e) {}
                });
        } catch (e) {}
        AppLightboxValidatorObject = Ajaxbostrapvalidator;
    } catch (e) { cl(e); }

}

function ShowWaitinglight(isShow) {
    if (typeof(isShow) == "undefined") {
        isShow = true;
    }
    if (isShow) {
        //$("#waiting").fadeIn();
        $(".lightboxWraper").fadeIn();
    } else {
        //$("#waiting").fadeOut();
        $(".lightboxWraper").fadeOut();
    }
}

function LoadAfterContentLoad() {
    try {
        SetLightBox();
        setSelect2();
    } catch (e) {}
    try {
        SetDatePicker();
        SetColorPicker();
    } catch (e) {}
    $(".CloseBox").click(function() {
        try {
            $.colorbox.close();
        } catch (e) {}
    });
    try {
        SetLightBoxAjax();
        HideMe();
    } catch (e) {}

   
    try {
        AfterLiboxLoad();
    } catch (e) {}

    try {
        for (i in addonLoadPopup) {
            try {
                addonLoadPopup[i]();
            } catch (e) {}
        }
    } catch (e) {
        console.log(e);
    }
}

function SetPrintWindowTab() {

    $('body').on("click", ".app-print-tab", function(e) {
        e.preventDefault();
        try {
            var w = window.open($(this).attr('href'));
            //w.print();
            //w.close();
        } catch (e) {
            gcl(e);
        }

    });

}

function SetPrintButton() {
    SetPrintWindowTab();
    if (jQuery("#app-print-iframe").length == 0) {
        jQuery("body").append("<iframe id='app-print-iframe' style='border:none;height:0;width:0'></iframe>");
    }

    $('body').on("click", ".app-print", function(e) {
        e.preventDefault();
        try {
            jQuery("#app-print-iframe").attr("src", $(this).attr('href'));
        } catch (e) {
            gcl(e);
        }

    });

}

function arraysEqual(a, b) {
    if (a === b) return true;
    if (a == null || b == null) return false;
    if (a.length != b.length) return false;

    // If you don't care about the order of the elements inside
    // the array, you should sort both arrays here.

    for (var i = 0; i < a.length; ++i) {
        if (a[i] !== b[i]) return false;
    }
    return true;
}

function setSelect2() {

    try {
        try {
            $(".select2:not(.a-select2)").closest(".mfp-wrap").removeAttr("tabindex");
        } catch (e) {

        }
        $(".select2:not(.a-select2)").each(function() {
            try {
                var isParent = $(this).closest(".mfp-wrap,.modal");
                //console.log(jQuery.isEmptyObject(isParent));
                //console.log($(this).closest(".mfp-wrape,.modale"));
                if (jQuery.isEmptyObject(isParent) || $(this).closest(".mfp-wrap,.modal").length > 0) {
                    $(this).select2({ theme: "bootstrap", dropdownParent: isParent });
                } else {
                    $(this).select2({ theme: "bootstrap" });

                }
            } catch (e) {
                $(this).select2({ theme: "bootstrap" });
            }
        });
        $(".select2:not(.a-select2)").addClass("a-select2");

    } catch (e) {

    }
}

function _popupajaxLoadComplted() {
    LoadAfterContentLoad();
    try {
        PageLoadComplete();
    } catch (e) {}
    try {
        setPopUpText();
    } catch (e) {}
    try {
        setPopUpAjax();
    } catch (e) {}
    try {
        setSwitchButton();
    } catch (e) {}
    try {
        $(".mfp-wrap").scrollTop(0);
    } catch (e) {}
}

function setSwitchButton() {
    try {
        $("input.app-switch-btn").each(function() {
            var btngroup = $(this).data('btn-group');
            var options = { baseGroupCls: "btn-group" };
            if (btngroup) {
                options.baseGroupCls += " " + btngroup;
            }
            $(this).checkboxpicker(options).on('change', function() {
                $(this).trigger("input");
            });
        });

    } catch (e) {

    }
}

function setPopUpAjax() {}

function set_options_to_select(jquery_selector, array_options, selected) {
    if (typeof(selected) == "undefined") {
        selected = null;
    }
    var elem = jQuery(jquery_selector);
    elem.find("option").remove();
    var newoption = $("<option>");
    newoption.val("");
    newoption.text("select");
    elem.append(newoption);
    if (array_options) {
        for (var i in array_options) {
            var newoption = $("<option>");
            newoption.val(i);
            newoption.text(array_options[i]);
            elem.append(newoption);
        }
    } else {

    }
}

function confirm_wr_change(rdata, element) {
    if (typeof(swal) == "function") {
        swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
    } else {
        ShowGritterMsg(rdata.msg, rdata.status, rdata.is_sticky, rdata.title, rdata.icon);
    }
    if (rdata.status) {
        element.html(rdata.data);
    }
}

function SetBootstrapSelect() {
    try {
        //$('select.selectpicker').selectpicker();
    } catch (e) {};
}

function SetTextDigit() {
    $(function() {
        $(".text-degit-field").on("keyup", function(e) {
            try {
                var currentNumber = $(this).val();
                var currentNumberText = number2text(currentNumber);
                var parent = $(this).parent();
                if (parent.find(".text-digit").length > 0) {
                    if (currentNumber > 0) {
                        parent.find(".text-digit").text(currentNumberText);
                        parent.find(".text-digit").show();
                    } else {
                        parent.find(".text-digit").hide();
                    }
                } else {
                    var span = $('<span class="text-digit">' + currentNumberText + '</span>');
                    parent.append(span);
                    span.show();
                }
            } catch (e) { gcl(e); };
        });
    });
}
var AppFromValidatorObject = null;

function SetNormalFormAjax() {
    try {
        $("#main-content").prepend('<div id="MainFormLoader" class="MainLoader"><div class="msgText"></div></div>');
        var formValidator = $("form.app-nm-ajax-form").bootstrapValidator({
            excluded: ':disabled,:hidden',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            onChangeStatus: function(validator, form) {


            },
            submitHandler: function(validator, form, submitButton) {
            	var rtype = form.attr("request-type");
                var htmlBeforeLoading = "";
                if (!rtype) { rtype = "json"; }

                if (form.data("multipart")) {
                    var formData = new FormData(form[0]);
                    formData = set_csrf_param(formData);
                    var contentType = false;
                    var processData = false;
                    var async = true;

                } else {
                    var formData = set_csrf_param(form.serialize());
                    var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                    var processData = true;
                    var async = true;
                }
                var method = form.attr("method");
                $.ajax({
                    type: method,
                    url: form.attr('action'),
                    data: formData,
                    processData: processData,
                    dataType: rtype,
                    contentType: contentType,
                    cache: false,
                    async: async,
                    beforeSend: function() { ShowFormWait(true,"Processing..");},
                   success: function(data) {
    				   ShowFormWait(true,"Processing..");
    			   },	  
    			   success: function(data,textStatus,jqXHR){
    				   ShowFormWait(false,"",function(){
    					   if(jqXHR.status=="200"){
    						   $("#main-content").html(data.html);
    						   Initialize();
    						   if(data.urrent_url!=window.location){
    							   if(data.title!=""){
    								   $("title").html(data.title);
    							   }							  
    							   history.pushState(data.title, data.title, data.current_url);
    						   }
    						  
    					   }
    					   
    				   });
    				   form.find("button[type=submit]").prop("disabled",false);
    				  
    				 				 				   
    			   },
    			   complete:function(xhr,textstatus,settings){
    				   form.find("button[type=submit]").prop("disabled",false);
    				   //history.pushState('data to be passed', 'Title of the page', this.url);
    				
    			   }
                });
            }
        });
        AppLightboxValidatorObject = formValidator;
    } catch (e) {
        alert(e);
        cl(e);
    }

}

function SetImageInput() {
    var fileCounter = 0;
    $(".app-image-input").each(function() {
        try {
            fileCounter++;
            var mainObj = $(this);
            var imgObj = null
            var imgObjstr = mainObj.data("img-id");
            if (imgObjstr) {
                imgObj = $(imgObjstr);
            } else {
                imgObj = mainObj;
            }
            var inputname = mainObj.data("name");
            if (!inputname || inputname == "") {
                inputname = "file_" + fileCounter;
            }
            var inputObj = $('<input type="file" name="' + inputname + '" style="display:none;" accept="image/*">');


            mainObj.on("click", function() {
                inputObj.trigger('click');
            });
            inputObj.on("change", function(e) {
                var fr = new FileReader();
                // when image is loaded, set the src of the image where you want to display it
                fr.onload = function(e) {
                    imgObj.attr("src", this.result);
                    mainObj.after(inputObj);
                };
                fr.readAsDataURL(this.files[0]);
            });
        } catch (e) {
            gcl(e.message);
        }
    });
}

function SetDefaultColorButton() {
    $("body").on("click", ".app-default-color", function(e) {
        e.preventDefault();
        var targetElem = $($(this).data("target"));
        var defaultData = $(this).data("color");
        targetElem.val(defaultData);
        targetElem.trigger("input");
        targetElem.trigger("change");
    });
}

function CallOnAjaxComplete(url, callback) {
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings.url === url) {
            if (typeof(callback) == "function") {
                callback(event, xhr, settings);
            }
        }
    });
}

function setNiceScroll(){
	try{
		$(".app-nice-scroll:not(.a-nice-scroll)").addClass("a-nice-scroll").niceScroll({
			cursorcolor:"rgba(0, 0, 0, 0.31)",
			cursorwidth: "7px",
			background:"rgba(0, 0, 0, 0.03)",
			autohidemode:"leave"
			});
		
	}catch(e){
		
	}
}
function set_dependable_fields() {
    var in_added_event_list = [];
    $(".has_depend_fld:not(.added-dpnds").each(function() {
        var thisObj = $(this);
        var inputtype = thisObj.attr("type");
        var class_prefix = thisObj.data("class-prefix");
        var name = thisObj.attr("name");
        if (!class_prefix) {
            class_prefix = "fld-" + name.replace(/[\[\]\_]/g, "-").replace(/\-$/g, "");
        }
        thisObj.addClass("added-dpnds");
        //console.log(class_prefix);//<"fld">-<field_name>
        if (in_added_event_list.indexOf("[name=" + name + "]") == -1) {
            in_added_event_list.push("[name=" + name + "]");
            $("[name='" + name + "']").on("change", function(e) {            	
                setDependableSettings(thisObj, class_prefix);
            });
            setDependableSettings(thisObj, class_prefix);
        }
    });
    $(".has_depend_fld2:not(.added-dpnds").each(function() {
        var thisObj = $(this);
        var inputtype = thisObj.attr("type");
        var class_prefix = thisObj.data("class-prefix");
        var name = thisObj.attr("name");
        if (!class_prefix) {
            class_prefix = "fld-" + name.replace(/[\[\]\_]/g, "-").replace(/\-$/g, "");
        }
        thisObj.addClass("added-dpnds");
        //console.log(class_prefix);//<"fld">-<field_name>
        if (in_added_event_list.indexOf("[name=" + name + "]") == -1) {
            in_added_event_list.push("[name=" + name + "]");
            $("[name='" + name + "']").on("change", function(e) {
            	setDependableSettings2(thisObj, class_prefix);
            });
            setDependableSettings2(thisObj, class_prefix,true);
        }
    });
}

function setDependableSettings(elem, class_prefix) {
	
    try {
        var name = elem.attr("name");
        var type = elem.attr("type");
        if (type == "checkbox" || type == "radio") {
            var selectedAction = $("[name='" + name + "']:checked").val();
            if (selectedAction == undefined) {
                selectedAction = $("[name='" + name + "'][type=hidden]").val();
            }
        } else {
            var selectedAction = $("[name='" + name + "']").val();
        }
        if (selectedAction) {
            selectedAction = selectedAction.toLowerCase();
            //console.log(selectedAction); 
            //console.log("." + class_prefix);//fld-config-is-enable_paypal
            var hiddenFlields = $("." + class_prefix + ":not(." + class_prefix + "-" + selectedAction + ")");
            if (hiddenFlields.length > 0) {
                hiddenFlields.fadeOut('fast', function() {
                    hiddenFlields.find("input,select").prop("disabled", true);
                    showDependableSettings(class_prefix, selectedAction);
                });
            } else {
                showDependableSettings(class_prefix, selectedAction);
            }
            elem.closest("form").find("[type=submit]").prop("disabled", false);
        }
    } catch (e) {
        // gcl(e.message);
    }
}
function setDependableSettings2(elem, class_prefix,is_first_load) {

    try {
        var name = elem.attr("name");
        var type = elem.attr("type");
        if (type == "checkbox" || type == "radio") {
            var selectedAction = $("[name='" + name + "']:checked").val();
            if (selectedAction == undefined) {
                selectedAction = $("[name='" + name + "'][type=hidden]").val();
            }
        } else {
            var selectedAction = $("[name='" + name + "']").val();
        }
        if (selectedAction) {
            selectedAction = selectedAction.toLowerCase();
            //console.log(selectedAction); 
            //console.log("." + class_prefix);//fld-config-is-enable_paypal
            var hiddenFlields = $("." + class_prefix + ":not(." + class_prefix + "-" + selectedAction + ")");           
            if (hiddenFlields.length > 0) {
            	hiddenFlields.find("input,select,textarea").prop("disabled", true);
            	showDependableSettings2(class_prefix, selectedAction,is_first_load);              
            } else {
            	showDependableSettings2(class_prefix, selectedAction,is_first_load);
            }
            elem.closest("form").find("[type=submit]").prop("disabled", false);
        }
    } catch (e) {
        // gcl(e.message);
    }
}

function showDependableSettings(class_prefix, selectedAction) {
	//gcl("." + class_prefix + "-" + selectedAction);
    var activeFlields = $("." + class_prefix + "-" + selectedAction).removeClass("hidden").removeClass("grp-hidden");
    activeFlields.fadeIn();
    activeFlields.find("input,select,textarea").prop("disabled", false);
}
function showDependableSettings2(class_prefix, selectedAction,is_first_load) {
	var activeFlields = $("." + class_prefix + "-" + selectedAction);
	var acFlds=activeFlields.find("input,select,textarea").prop("disabled", false);
	if(!is_first_load){
		acFlds.first().focus();
	}
}