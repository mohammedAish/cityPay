/**
 * app specific javascript
 */

 var mynotifications=[];
AddOnLoadPopupMethod(setRecaptcha);
AddOnLoadPopupMethod(set_dependable_fields);
AddOnLoadPopupMethod(SetTag);
AddOnGridLoadComplete(gridsubmenu);
AddOnLoadPopupMethod(setMultiSelect);
var addOnNewnotification=[];
var addOnNewCheckerResponse=[];
var addOnNewInterval=[];
function AddMethodOnNewNotification(method) {
    addOnNewnotification.push(method);
}
function AddMethodOnCheckerResponse(method) {
    addOnNewCheckerResponse.push(method);
}
function AddMethodOnInterval(method) {
    addOnNewInterval.push(method);
}

$(function() {
    setLikeDislike();
    add_cloner_button();
    set_dependable_fields();
    setMultiSelect();
    AddMethodOnCheckerResponse(checkChatMessage);

    try{
        if(appGlobalLang.current_user_type=="AD"){
            try{setTimeout(CheckOnlineNotification,2000);}catch(e){}
        }
    }catch(e){}    
    
    set_app_noti_click();
    setKnowledgeDetailsImg();
    if(appGlobalLang.isAdminLoggedIn){
        update_basic_conf(appGlobalLang.isAdminChatEnable);
        AddMethodOnInterval(app_check_param);
        AddMethodOnInterval(app_hide_notification);
    }

    setInterval(function (){
        try {
            for (i in addOnNewInterval) {
                addOnNewInterval[i]();
            }
        } catch (e) { }
    },1000);


});
function update_basic_conf(isChatEnable){
    try{
        var d = new Date();
        localStorage.setItem("_basic_param",JSON.stringify({updateTime:d.getTime(),isChatEnabled:isChatEnable}));
        window.lastBasicParamCheckTime=d.getTime();
        if(isChatEnable){
            $("#chatstatus").prop("checked",true);
        }else{
            $("#chatstatus").prop("checked",false);
        }
        appGlobalLang.isAdminChatEnable=isChatEnable;
    }catch (e){}
}
function app_check_param(){
    try{
        var bparam=localStorage.getItem("_basic_param");
        if(bparam){
            var basicConfigObj=JSON.parse(bparam);
            if(typeof basicConfigObj =="object"){
                if(window.lastBasicParamCheckTime ===undefined){
                    window.lastBasicParamCheckTime=0;
                }
                var d = new Date();
                if(basicConfigObj.updateTime > window.lastBasicParamCheckTime){
                    if(basicConfigObj.isChatEnabled){
                        $("#chatstatus").prop("checked",true);
                    }else{
                        $("#chatstatus").prop("checked",false);
                    }
                    window.lastBasicParamCheckTime=basicConfigObj.updateTime;
                }

            }
        }

    }catch (e){}
}
function gridsubmenu(){
    try{
        $(".app-grid-submenu-box").remove();
    }catch(e){}
    $(".app-grid-dropdown").appdropdown({submenuClass:"app-grid-submenu-box"});
}
function ShowPopupForm(url,isIframe){
    if(typeof isIframe =="undefined"){
        isIframe=false;
    }
    var obj=$('<a data-effect="mfp-move-from-top">').attr("href",url);
    var loadingText="Loading";
    try{
        loadingText=appGlobalLang.Loading;
    }catch (e){
        loadingText="Loading";    }
    obj.magnificPopup({
        type: 'ajax',
        preloader: true,
        removalDelay: 500,
        closeBtnInside: true,
        overflowY: 'auto',
        closeOnBgClick: false,
        fixedBgPos: false,
        zoom: { enabled: false },
        tLoading: '<i class="fa fa-circle-o faa-burst animated"></i> &nbsp;'+loadingText+'..',
        callbacks: {
            beforeOpen: function() { this.st.mainClass = this.st.el.attr('data-effect'); },
            open: function() {},
            close: OnClosed,
            updateStatus: function(data) {
                if (data.status === 'ready') {
                    _popupajaxLoadComplted();
                }
            }
        }
    }).click();
}
function recaptchaCall(){
	$(".g-recaptcha").each(function() {
        var id = $(this).attr("id");
        
        var site_key = $(this).data("sitekey");
        $(this).addClass("added-recpatcha");
       // alert("ok");
        grecaptcha.render(id, {
            sitekey: site_key,
            callback: function() {
              //$("#ip-form").submit();
            }
        });
    });
}
function setKnowledgeDetailsImg(){
	$(".kn-details-container img:not(.popupimg,.Popupimg)").magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        callbacks: {
            resize: function() {
                var img = this.content.find('img');
                img.css('max-height', $(window).height() - 50);
                img.css('width', 'auto');
                img.css('max-width', 'auto');
            }
            ,
            elementParse: function(qw) {
               try {
                   if (qw.el.context.tagName.toUpperCase() == "IMG") {
                       qw.src = qw.el.attr('src');
                   }
               }catch(e){
                  try {
                      if (qw.el[0].nodeName == "IMG") {
                          qw.src = qw.el[0].src;
                      }
                  }catch (eg){
                  }
               }
            }
        }
    });
}
function system_msg_dismiss(rdata,obj){
	swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
	if(rdata.status){	
		obj.parent(".system-msg").fadeOut();
	}	
}

function set_app_noti_click(){
	
}

function insert_edittor_text(id,text){
	try{
		$('#'+id).summernote('editor.insertText', text);
		return;
	}catch(e){}

	try{
		CKEDITOR.instances[id].insertHtml(text);
		return;
	}catch(e){}
	
	try{
		$('#'+id).froalaEditor('html.insert', text,true);		
		return;
	}catch(e){}
	
	try{
		insertAtCursor(id, text);
	}catch(e){}
}
function set_edittor_text(id,text){
	try{		
		$('#'+id).summernote('code', text);
		return;
	}catch(e){}

	try{
		CKEDITOR.instances[id].setData(text);
		return;
	}catch(e){}
	
	try{
		$('#'+id).froalaEditor('html.set', text);		
		return;
	}catch(e){}
	
	try{
		$('#'+id).html(text);
	}catch(e){}
}


function insertAtCursor(myField, myValue) {
    //IE support
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    //MOZILLA and others
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
            + myValue
            + myField.value.substring(endPos, myField.value.length);
    } else {
        myField.value += myValue;
    }
}


function set_dependable_fields() {
    var in_added_event_list = [];
    $(".has_depend_fld:not(.added-dpnds)").each(function() {
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
    $(".has_depend_fld2:not(.added-dpnds)").each(function() {
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
                    hiddenFlields.find("input,select,textarea").prop("disabled", true);
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
    var activeFlields = $("." + class_prefix + "-" + selectedAction).removeClass("hidden");
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

function setMultiSelect() {
    $(".app-multi-select:not(.ev-added)").addClass('ev-added').each(function () {
        var thisobj = $(this);
        var name = thisobj.data("name");
        var input=$('<input type="hidden" name="'+name+'">');
        thisobj.prepend(input);
        thisobj.find("> .apm-option").on("click", function (e) {
            e.preventDefault();
            var val=$(this).data('value');
            input.val(val);
        });
    })
}

function add_cloner_button() {
    var counter = 0;
    $(".add-cloner-button").each(function(e) {
        var targetContent = $(this).data("target");
        var targetContenter = $(this).data("container");
        var cloneFileData = $("#" + targetContent).clone();
        $(this).click(function(e) {
            e.preventDefault();

            if (targetContent) {
                if ($(this).data("clone-inc")) {
                    var newclone = cloneFileData.clone();
                    var id = newclone.attr("id");
                    newclone.attr("id", id + "-" + counter);
                    newclone.find("input,select").each(function() {
                        var cid = $(this).attr("id");
                        $(this).attr("id", cid + "-" + counter);
                    });
                    counter++
                }
                if (targetContenter) {
                    $(targetContenter).append(newclone);
                } else {
                    $(this).before(newclone);
                }
            }
        });
    });
}

function setRecaptcha() {
    $(".g-recaptcha:not(.added-recpatcha)").each(function() {
        var id = $(this).attr("id");
        var site_key = $(this).data("sitekey");
        $(this).addClass(".added-recpatcha");
        grecaptcha.render(id, {
            sitekey: site_key,
            /*callback: function() {
              console.log('recaptcha callback');
            }*/
        });
    });
}

function setLikeDislike() {
    $('body').on("click", ".kn-like-btn", function(e) {
        e.preventDefault();

        var mainobj = $(this);
        if (mainobj.hasClass("kn-liked")) {
            return;
        }
        var id = mainobj.data("kid");
        if (id) {
            CallMyAjax(base_url + "knowledge/counter/like/" + id, {}, function() {
                //before send
                console.log("called");
                mainobj.find("> i").addClass("app-fa-loading");
            }, function(rdata) {
                //success
                //AppAlert(rdata.status,rdata.msg,);
                if (rdata.status) {
                    mainobj.addClass("kn-liked");
                    mainobj.find("> i").removeClass("app-fa-loading");
                    //mainobj.html('<i class="fa fa-check"></i> '+appGlobalLang.Liked);	
                    $("a.kn-dislike-btn[data-kid=" + id + "]").fadeOut();
                    $("#ld-msg-" + id).html(appGlobalLang.Liked);
                    $(".kn-like-counter-" + id).each(function() {
                        var counter = $(this).text();
                        counter = parseInt(counter);
                        counter++;
                        $(this).text(counter);

                    });
                } else {
                    mainobj.find("> i").removeClass("app-fa-loading");
                }
            });
        }
    });
    $('body').on("click", ".kn-dislike-btn", function(e) {
        e.preventDefault();

        var mainobj = $(this);
        if (mainobj.hasClass("kn-disliked")) {
            return;
        }
        var id = mainobj.data("kid");
        if (id) {
            CallMyAjax(base_url + "knowledge/counter/dislike/" + id, {}, function() {
                //before send
                console.log("called");
                mainobj.find("> i").addClass("app-fa-loading");
            }, function(rdata) {
                //success
                //AppAlert(rdata.status,rdata.msg,);
                if (rdata.status) {
                    mainobj.addClass("kn-disliked");
                    mainobj.find("> i").removeClass("app-fa-loading");
                    //mainobj.html('<i class="fa fa-check"></i> '+appGlobalLang.Disliked);	
                    $("a.kn-like-btn[data-kid=" + id + "]").fadeOut();
                    $("#ld-msg-" + id).html(appGlobalLang.Disliked);
                    $(".kn-dislike-counter-" + id).each(function() {
                        var counter = $(this).text();
                        counter = parseInt(counter);
                        counter++;
                        $(this).text(counter);

                    });
                } else {
                    mainobj.find("> i").removeClass("app-fa-loading");
                }
            });
        }
    });
}

function AppAlert(status, msg, title) {
    if (typeof(title) == "undefined") {
        title = status ? "Success" : "Failed";
    }
    if (typeof(swal) == "function") {
        swal(title, msg, status ? "success" : "error");
    } else {
        alert(msg);
    }
}
function SetOnlineUpdate(){	
	if(appGlobalLang.is_online_check){
		var is_enabled=getCookie(appGlobalLang.online_cookie_name);
		if(is_enabled=="Y"){		
			$.getJSON(appGlobalLang.user_online_url,function(rdata){
				//console.log(rdata);
				if(rdata.status){
					setTimeout(SetOnlineUpdate,appGlobalLang.online_cookie_interval);
				}
			});			
		}
	}
}
function is_ok_noti_id(id) {
    if(mynotifications.indexOf(id) > -1){
        return false;
    }else{
        mynotifications.push(id);
        return true;
    }
}
function app_process_online_notification(rdata){
    try {
        for (i in addOnNewCheckerResponse) {
            addOnNewCheckerResponse[i](rdata);
        }
    } catch (e) { }
    try{
        if(rdata.data.length>0){
            var isAdded=false;
            var isShowedNoti=false;
            for(var i in rdata.data){
                if(is_ok_noti_id(rdata.data[i].id)){
                    isAdded=true;
                    isShowedNoti=false;
                    try {
                        for (i in addOnNewnotification) {
                            var ireturn=addOnNewnotification[i](rdata.data[i]);
                            if(!isShowedNoti && ireturn){
                                isShowedNoti=ireturn;
                            }
                        }
                    } catch (e) { }
                    if(!isShowedNoti) {
                        ShowGritterMsg(rdata.data[i].body, true, false, rdata.data[i].title, rdata.data[i].icon, 30000);
                    }
                }
            }
            if(isAdded && appGlobalLang.is_noti_audio){
                try{
                    var audio = new Audio(appGlobalLang.noti_audio_path);
                    audio.play();
                }catch(e){
                    gcl(e);
                }
            }
            if(isAdded){
                try{
                    update_notificationTry();
                }catch(e){}
            }

            ReloadShowNotificationAll();
        }
    }catch(e){

    }
}
function LoadNotiDatafromCache(){
    var gdata=localStorage.getItem("_notilastdata");
    if(gdata){
        var nitiConfigObj=JSON.parse(gdata);
        if(typeof nitiConfigObj =="object"){
            return nitiConfigObj;
        }
    }
    return null;
}
function CheckOnlineNotification(){     
	try{
		if(appGlobalLang.on_sec_noti && appGlobalLang.current_user_type=="AD"){
		    var isLoadedData=false;
            var lastTime=localStorage.getItem("_notilastcall");
            var d=new Date();
            var timestamp=d.getTime()-lastTime;
            if(timestamp+3000 < appGlobalLang.on_sec_noti_interval){
               var rdata=LoadNotiDatafromCache();
                if(rdata){
                    app_process_online_notification(rdata);
                    //gcl("Notification: Loaded from cache");
                    isLoadedData=true;
                }
            }
            if(!isLoadedData){
                $.getJSON(appGlobalLang.on_sec_noti_url,function(rdata){
                    var d = new Date();
                    localStorage.setItem("_notilastcall",d.getTime());
                    localStorage.setItem("_notilastdata",JSON.stringify(rdata));
                    app_process_online_notification(rdata);
                });
            }
            setTimeout(CheckOnlineNotification,appGlobalLang.on_sec_noti_interval+2);
		}		
	}catch(e){
		//gcl(e);
	}
}


function checkChatMessage(rdata) {
    if (window.chatData === undefined) {
        window.chatData = [];
    }
    var chatData = rdata.chat_data;
    if (chatData.length > 0) {
        for (var i in chatData) {
            if (window.chatData[chatData[i].id] === undefined && !isExistUserResponse(chatData[i].id)) {
                showMessage(chatData[i]);
            }
        }
    }
}
function open_chat_page(){
    gcl("Called open chat page");
    try{
        var hasOpened=localStorage.getItem("adchatwindow");
        if(hasOpened==null && appGlobalLang.chat_windo_url !==undefined){
            var win = window.open(appGlobalLang.chat_windo_url, '_blank');
            win.focus();
        }
    }catch(e){
        gcl(e);
    }

}
function showMessage(chatObj){
    try {//chat_take_msg_text
        var buttonYes=$('<button data-cht-id="'+chatObj.id+'" class="noti-btn btn btn-sm btn-white">'+appGlobalLang.chat_take_btn_text+'</button>');
        var buttonNo=$('<button  data-cht-id="'+chatObj.id+'" class="noti-btn btn btn-sm btn-danger">'+appGlobalLang.chat_cancel_btn_text+'</button>');
        buttonYes.on("click",function (e) {
            e.preventDefault();
            e.stopPropagation();
            var bkText=$(this).html();
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $.getJSON(appGlobalLang.chat_base_url+"/"+chatObj.id+"/Y",function (rdata) {
                if(rdata.status){
                    buttonYes.appNotiElem.hide(function(){
                        ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
                    });

                }else{
                    buttonYes.html(bkText);
                }
            });
            open_chat_page();
            AddToChatResponse(chatObj.id);
        });
        buttonNo.on("click",function (e) {
            e.preventDefault();
            e.stopPropagation();
            var bkText=$(this).html();
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $.getJSON(appGlobalLang.chat_base_url+"/"+chatObj.id+"/N",function (rdata) {
                if(rdata.status){
                    buttonNo.appNotiElem.hide();
                }else{
                    buttonNo.html(bkText);
                    ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
                }
            });
            AddToChatResponse(chatObj.id);
        });

        var btnGroups=$("<div>").append(buttonYes).append(buttonNo);
        var intro=$('<strong>'+appGlobalLang.chat_take_msg_text+'</strong>');
        var mainMsg=$('<div>').append(intro).append(btnGroups);
        var options = {
            id:"cht-"+chatObj.id,
            title: appGlobalLang.chat_new_chat_text,
            style: 'info',
            theme: 'right-bottom.css',
            timeout: null,
            message: mainMsg,
            icon: ' ap ap-chat3  faa-ring animated'
        };
        var n = new notify(options);
        n.show();
        buttonYes.appNotiElem=n;
        buttonNo.appNotiElem=n;

        window.chatData[chatObj.id] = {id:chatObj.id,elem:n};

        try{
            PlayChatAudio(chatObj.id);
        }catch(e){
            gcl(e);
        }
    } catch (e) {
        gcl(e);
    }
}

function PlayChatAudio(id){
    if(window.playingid ===undefined){
        window.playingid=[];
    }
   // window.playingid[id]=
    if(window.chatData[id] !== undefined && !isExistUserResponse(id)) {
        try {
            if(window.playingid[id] !== undefined || !isExistPlayedResponse(id)){

                var audio = new Audio(appGlobalLang.chattone_audio_path);
                audio.play();
                AddToChatRingPlayingId(id);
                window.playingid[id]=id;
                setTimeout(function () {
                    PlayChatAudio(id);
                }, 10000);
            }

        } catch (e) {
            gcl(e);
        }
    }
}
function isExistUserResponse(id){
    var data=getChatResponse();
    if(!data){
        return false;
    }
    return data.indexOf(id) > -1;
}
function AddToChatResponse(id){
    if(!id){
        return;
    }

    if(isExistUserResponse(id)){
        return;
    }
   var data=getChatResponse();
   if(!data){
       data=[];
   }
   if(data.length>10){
       data=data.slice(-9);
   }
   data.push(id);
   localStorage.setItem("_cht_user_res",JSON.stringify(data));
}

function getChatResponse(){
    var gdata=localStorage.getItem("_cht_user_res");
    if(gdata){
        var nitiConfigObj=JSON.parse(gdata);
        if(typeof nitiConfigObj =="object"){
            return nitiConfigObj;
        }
    }
    return null;
}
function getPlayedResponse(){
    var gdata=localStorage.getItem("_cht_played");
    if(gdata){
        var nitiConfigObj=JSON.parse(gdata);
        if(typeof nitiConfigObj =="object"){
            return nitiConfigObj;
        }
    }
    return null;
}
function AddToChatRingPlayingId(id){
    if(!id){
        return;
    }
    if(isExistPlayedResponse(id)){
        return;
    }
    var data=getPlayedResponse();
    if(!data){
        data=[];
    }
    if(data.length>10){
        data=data.slice(-9);
    }
    data.push(id);
    localStorage.setItem("_cht_played",JSON.stringify(data));
}
function isExistPlayedResponse(id){

    var data=getPlayedResponse();
    if(!data){
        return false;
    }
    return data.indexOf(id) > -1;
}
function app_hide_notification(){
    for(var i in window.chatData){
        try {
            if (isExistUserResponse(window.chatData[i].id)) {
                window.chatData[i].elem.hide();
                window.chatData.splice(i, 1);
            }
        }catch(e){

        }
    }
}
function update_notificationTry(){
    $.get(appGlobalLang.update_notification_try,function( data ) {
        $( "#app_noti_container" ).html( data );
        try{
            setPopUpAjax();
        }catch (e){}

    });
}
