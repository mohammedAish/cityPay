(function($) {

    $.fn.appsbdAdminChat = function( options ) {

        // Establish our default settings
        var settings = $.extend({
            text: 'Hello, World!',
            url: "",
            color: null,
            userImage: "",
            userId:"",
            ajaxSender:null,
            checkInterval:3000,
            loadText:"Loading Please Wait..",
            cancelText:"Are you sure to close chat?",
            cancelUrl:"",
            audioPath:"",
            cannedMessages:[],
            maxFileSize:"2",
            maxFileErrorMsgTitle:"Large File Error",
            maxFileErrorMsg:"Max file size is  %s MB",
            unsupportedFileMsgTitle:"File Error",
            unsupportedFileMsg:"Uploaded file is not  supported",
            loadMoreText:"Load More",
            onNewChatOrMsg:function (obj,type) {

            },
            onDataBind:function (data) {

            },
            onInit: function ($this) {
            },
            onResize:function ($this) {
                
            }


        }, options);
        var msgItem={
            id:"",
            temp_id:"",
            msg_html:"",
            msg_time:"",
            chatId:"",
            senderType:"",
            senderImg:""
        };

        return this.each( function() {
            // We'll get back to this in a moment
            function apcClone(obj){
                var ab=JSON.stringify(obj);

                return JSON.parse(ab);
            }
            //variables
            var $this=$(this);
            var plugin=$this;
            var ChatListWindow=$this.find(".apc-user-list .apc-pnl-content");
            var ChatListPanel=$this.find("ul.apc-chat-list");
            var ChatEndListPanel=$this.find("ul.apc-chat-end-list");
            var currentChatId="";
            var currentChatBoxElem=null;
            if(currentChatId!=""){
                currentChatBoxElem=$this.find("#"+currentChatId);
            }
            var isFirstLoad=true;

            var dragElem=$this.find(".apc-chat-item-msg-divider");
            var inputPanel=$this.find(".apc-chat-msg-type-panel");
            var inputBox=$this.find(".apc-chat-msg-type-panel  textarea.apc-admin-chat-input");
            var inputHeight=inputPanel.height()+30;
            var updateInputHeight=inputHeight;
            var minHeight=inputHeight;
            var maxHeight=minHeight+300;
            var isMeTyping=false;
            var msgContainer=$this.find(".apc-chat-item-content");
            var intTimer;
            var clientTyping=inputPanel.find(".apc-msg-typing");
            var chatData=[];
            var chatUserInfoPanel= $this.find(".apc-chat-user-info");
            var cannedMsgSelect= $this.find("#chat-canned-msg");
            var cannedMsgButton= $this.find("#chat-canned-msg-btn");
            var attachBtn=$this.find('.apc-attach-btn');
            var fileStatusViewer=$this.find(".apc-file-up-status");
            // methods
            $this.find(".apc-open-user-list").on("click",function(e){
                e.preventDefault();
                $this.find(".apc-user-list").addClass("apc-show");
                $this.find(".apc-chat-user-info").removeClass("apc-show");
            });
            $this.find(".apc-open-chatinfo").on("click",function(e){
                e.preventDefault();
                $this.find(".apc-user-list").removeClass("apc-show");
                $this.find(".apc-chat-user-info").addClass("apc-show");
            });
            $this.find(".apc-user-list .apc-close-btn").on("click",function(e){
                e.preventDefault();
                $this.find(".apc-user-list").removeClass("apc-show");
            });
            $this.find(".apc-chat-user-info .apc-close-btn").on("click",function(e){
                e.preventDefault();
                $this.find(".apc-chat-user-info").removeClass("apc-show");
            });
            $this.resize=function(){
                var elemOffset=$this.offset();
                var windowHeight=$(window).height();
                var windoHeight=windowHeight-16-elemOffset.top;
                if(windoHeight<250){
                    windoHeight=250;
                }
                //gcl(windoHeight);
                $this.height(windoHeight);
                inputHeight=inputPanel.height()+30;
                var height=ChatListWindow.height()-20;
                ChatListWindow.find("div.apc-diver").height("20px");
                ChatListPanel.height(height/2);
                ChatEndListPanel.height(height-((height/2)+20));
                if($.isFunction(settings.onResize)){
                    settings.onResize($this);
                }


            }
            $this.AddChatWindow=function(chatId){
                var cht= $this.find(".apc-chat-item-content").find('#chat_id_'+chatId);
                if(cht.length==0){
                    cht=$('<div id="chat_id_'+chatId+'" style="display: none;" class="apc-msgs"><div class="apc-load-move text-center" data-chat-id="'+chatId+'" ><button class="btn btn-xs btn-info"><i class="fa fa-arrow-circle-o-down"></i> '+settings.loadMoreText+'</button></div></div>');
                    $this.find(".apc-chat-item-content").append(cht);
                }
                return cht;
            }
            $this.SetChatLiEvent=function (elem) {
                elem.on("click",function (e) {
                    e.preventDefault();

                    chatId=$(this).data("chatid");
                    $this.SetCurrentChatId(chatId);
                })
            }
            $this.setLoadMore=function(){
                try{
                    if(currentChatBoxElem.find(".apc-item").length>0){
                        var firstItem=currentChatBoxElem.find(".apc-item:first").data("msg-id");
                        if(firstItem!="AAAA"){
                            currentChatBoxElem.find(".apc-load-move").show();
                        }else{
                            currentChatBoxElem.find(".apc-load-move").hide();
                        }
                    }

                }catch (e){//gcl(e);
                    }
                //gcl(currentChatBoxElem);
            }
            $this.AddNewChat=function(chatobj){
                var chli=ChatListPanel.find('#btn-chat-'+chatobj.id);
                if(chli.length==0){
                    if(typeof settings.onNewChatOrMsg =="function"){
                        try{
                            settings.onNewChatOrMsg(chatobj,"C");
                        }catch (e){}
                    }
                    chli=$('<li id="btn-chat-'+chatobj.id+'" data-istyping="'+chatobj.is_user_typing+'" data-chatid="'+chatobj.id+'"><span class="name">'+chatobj.open_user_title+'</span><span class="apc-rtc-c badge"><span class="apc-btn-rc">0</span></span></li>');
                    ChatListPanel.append(chli);
                    $this.SetChatLiEvent(chli);
                    chatData[chatobj.id]={};
                }else{
                    chli.find(".name").text(chatobj.open_user_title);
                }
                chatData[chatobj.id]=chatobj;
                $('#btn-chat-'+chatobj.id).data("istyping",chatobj.is_user_typing);

                return $this.AddChatWindow(chatobj.id);
            }
            $this.AddEndChat=function(chatobj){
                var chli=ChatEndListPanel.find('#btn-chat-'+chatobj.id);
                try{
                    var inChatPanel=ChatListPanel.find('#btn-chat-'+chatobj.id);
                    if(inChatPanel.length>0){
                        if(inChatPanel.hasClass("apc-active")){
                            $this.SetCurrentChatId("");
                        }
                        msgContainer.find("#chat_id_"+chatobj.id).hide();
                        ChatListPanel.find('#btn-chat-'+chatobj.id).remove();
                    }
                }catch (e){};
                if(chli.length==0){

                    chli=$('<li id="btn-chat-'+chatobj.id+'" data-istyping="'+chatobj.is_user_typing+'" data-chatid="'+chatobj.id+'"><span class="name">'+chatobj.open_user_title+'</span> <span class="apc-rtc-c badge"><span class="apc-btn-rc">0</span></span></li>');
                    ChatEndListPanel.prepend(chli);
                    $this.SetChatLiEvent(chli);
                    chatData[chatobj.id]={};
                }else{
                    chli.find(".name").text(chatobj.open_user_title);
                }

                chatData[chatobj.id]=chatobj;
                $('#btn-chat-'+chatobj.id).data("istyping",chatobj.is_user_typing);

                return $this.AddChatWindow(chatobj.id);
            }
            $this.SetCurrentChatId=function(chatId) {
                currentChatId = chatId;
                if(currentChatId=="") {
                    $this.find(".apc-chat-title").html("");
                    $this.find(".apc-chat-desi").html("");
                    chatUserInfoPanel.find("#dd-name").text("");
                    chatUserInfoPanel.find("#dd-ip").text("");
                    chatUserInfoPanel.find("#dd-start-time").text("");
                    chatUserInfoPanel.find("#dd-country").text("");
                    chatUserInfoPanel.find("#dd-browser").text("");
                    chatUserInfoPanel.find("#dd-end-time .chat-end-button").hide();
                    chatUserInfoPanel.find("#dd-end-time .endtimestr").text("").show();
                    $this.ResetTyping();
                    return;
                }
                currentChatBoxElem = $this.find("#chat_id_" + currentChatId);
                if (currentChatBoxElem.length == 0) {
                    currentChatBoxElem = $this.AddChatWindow(chatId);
                }
                currentChatBoxElem.show();
                ChatListPanel.find("> li:not(#btn-chat-" + currentChatId + ")").removeClass("apc-active");
                ChatEndListPanel.find("> li:not(#btn-chat-" + currentChatId + ")").removeClass("apc-active");
                var btnli = $("#btn-chat-" + currentChatId);
                btnli.removeClass("has-msg").addClass("apc-active");
                var counter = btnli.find(".apc-btn-rc");
                if (counter!==undefined) {
                    counter.text("0");
                }
                $this.find(".apc-msgs:not(#chat_id_" + currentChatId + ")").hide();
                $this.checkCurrentTyping();
                try {
                    $this.find(".apc-chat-title").html(chatData[currentChatId].open_user_title);
                    $this.find(".apc-chat-desi").html("IP:" + chatData[currentChatId].ip);
                    chatUserInfoPanel.find("#dd-name").text(chatData[currentChatId].open_user_title);
                    chatUserInfoPanel.find("#dd-ip").text(chatData[currentChatId].ip);
                    chatUserInfoPanel.find("#dd-start-time").text(chatData[currentChatId].start_time);
                    chatUserInfoPanel.find("#dd-country").text(chatData[currentChatId].country);
                    chatUserInfoPanel.find("#dd-browser").text(chatData[currentChatId].bw_name);

                    if(chatData[currentChatId].status=="C"){
                        chatUserInfoPanel.find("#dd-end-time .chat-end-button").hide();
                        chatUserInfoPanel.find("#dd-end-time .endtimestr").text(chatData[currentChatId].end_time).show();
                    }else{
                        chatUserInfoPanel.find("#dd-end-time .chat-end-button").data("chat_id",currentChatId).show();
                        chatUserInfoPanel.find("#dd-end-time .endtimestr").hide().text("");
                    }
                    if(chatData[currentChatId].status=="C"){
                        inputBox.prop("disabled",true);
                    }else{
                        inputBox.prop("disabled",false);
                    }
                    $this.ResetTyping();
                } catch (e) {

                }
                plugin.setLoadMore();

            }
            $this.ShowLoading=function (status,msg) {
               if(typeof msg =="undefined"){
                   msg=settings.loadText;
               }
               var loader=$this.find(".apc-loading");
                if(status){
                    loader.find(".apc-loading-msg").html(msg);
                    loader.fadeIn();
                }else{
                    loader.fadeOut();
                }
            }
            $this.ScrollToDown=function(chatBoxElem){
                if(typeof chatBoxElem =="undefined"){
                    chatBoxElem=currentChatBoxElem;
                }
                var scrollHeight=chatBoxElem.prop('scrollHeight');
                chatBoxElem.scrollTop(scrollHeight);
            }
            $this.SendMsg=function(msg,isMe){
                //msgContainer.append("<p>"+msg+"</p>");
                if(msg==""){
                    return;
                }
                var newMsgItem=apcClone(msgItem);
                var d=new Date();
                newMsgItem.temp_id=settings.userId+d.getTime();
                newMsgItem.id="";
                newMsgItem.msg_html=msg.replace(/[\u00A0-\u9999<>\'\"\&\\]/gim, function(i) {
                    return '&#'+i.charCodeAt(0)+';';
                });;
                newMsgItem.senderType=isMe?"A":"C";
                newMsgItem.senderImg=settings.userImage;
                $this.AppendMessage(newMsgItem, newMsgItem.senderType);

                $this.PostAdmin({topic:"newentry",newEntry:newMsgItem,isFirstLoad:false},function (responseData,requestData) {
                    //success
                    //console.log(responseData);
                    $this.processData(responseData);
                    //isFirstLoad=false;
                },function (requestData) {
                    //before
                    //gcl("Called Before");
                },function (requestData) {
                    //complete
                   // gcl("Called Complete");
                });
            }
            $this.processData=function(responseData){
                var isNeedToSetCurrent=currentChatId=="";
                try{
                    if(responseData.currentItem){
                        var item=$("#"+responseData.currentItem.temp_id);
                        if(item.length>0){
                            item.find(".apc-sending").html(responseData.currentItem.msg_time);
                        }
                    }
                }catch (e){}
                try{
                    if(responseData.chatEndlist && responseData.chatEndlist.length>0){
                        for(var i in responseData.chatEndlist){
                            var chatwindow=$this.AddEndChat(responseData.chatEndlist[i]);

                            if(responseData.chatEndlist[i].msgs && responseData.chatEndlist[i].msgs.length>0) {
                                for (var j=responseData.chatEndlist[i].msgs.length-1;j>=0;j--) {
                                    $this.AppendNewMessage(responseData.chatEndlist[i].msgs[j], responseData.chatEndlist[i].msgs[j].senderType, true, chatwindow);
                                }
                            }

                        }
                    }
                }catch (e){}

                try{
                    if(responseData.chatlist && responseData.chatlist.length>0){
                        for(var i in responseData.chatlist){
                            var chatwindow=$this.AddNewChat(responseData.chatlist[i]);
                            if(currentChatId==""){
                                currentChatId=responseData.chatlist[i].id;
                            }

                            if(responseData.chatlist[i].msgs && responseData.chatlist[i].msgs.length>0) {
                                for (var j=responseData.chatlist[i].msgs.length-1;j>=0;j--) {
                                    $this.AppendNewMessage(responseData.chatlist[i].msgs[j], responseData.chatlist[i].msgs[j].senderType, true, chatwindow);


                                }
                            }
                        }
                    }


                    if(isNeedToSetCurrent){
                        $this.SetCurrentChatId(currentChatId);
                    }
                    if(isFirstLoad){
                        isFirstLoad=false;
                        $this.ShowLoading(false);
                        $this.StartChecking();
                    }
                    $this.checkCurrentTyping();
                    plugin.setLoadMore();
                }catch (ex){
                  gcl(ex);
                }


            }
            $this.checkCurrentTyping=function(){

                   if($('#btn-chat-'+currentChatId).data("istyping")=="Y"){
                       clientTyping.show();
                   }else{
                       clientTyping.hide();
                   }
            }
            $this.LoadChatData=function () {
                if(settings.url==""){
                    return;
                }
                $this.PostAdmin({topic:"checking",isFirstLoad:isFirstLoad},function (responseData,requestData) {
                    //success
                    $this.processData(responseData);
                    isFirstLoad=false;
                },function (requestData) {
                    //before
                    //gcl("Called Before");
                },function (requestData) {
                   //complete
                    //gcl("Called Complete");
                });


            }
            $this.SetMeTyping=function (status) {
                isMeTyping=status;
            }
            $this.StopChecking=function () {
                try{
                    clearInterval(intTimer);
                }catch (e){}
            }
            $this.StartChecking=function () {
                $this.StopChecking();
                intTimer=setInterval($this.LoadChatData,settings.checkInterval);
            }

            $this.SaveLastRequestTime=function () {

            }
            plugin.SendFile=function (url,inputObj,beforeSend,onComplete,onProgress,onSuccess) {
                var nform=$("<form>");
                nform.append(inputObj.clone());
                nform.append('<input value="attach" type="hidden" name="topic">');
                nform.append('<input value="'+currentChatId+'" type="hidden" name="chatId">');
                var data=new FormData(nform[0]);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    dataType: "json",
                    beforeSend:function(){
                        if(beforeSend!==undefined && typeof beforeSend=="function"){
                            beforeSend();
                        }
                    },
                    success: function (rdata) {
                        if(onSuccess!==undefined && typeof onSuccess=="function"){
                            onSuccess(rdata);
                        }
                    },
                    xhr: function(){
                        // get the native XmlHttpRequest object
                        var xhr = $.ajaxSettings.xhr() ;
                        // set the onprogress event handler
                        xhr.upload.onprogress = function(evt){
                            var perc=(evt.loaded/evt.total*100);
                            if(onProgress!==undefined && typeof onProgress=="function"){
                                onProgress(perc,evt.loaded,evt.total);
                            }
                        } ;
                        // set the onload event handler
                        xhr.upload.onload = function(){
                            if(onComplete!==undefined && typeof onComplete=="function") {
                                onComplete();
                            }
                        }
                        // return the customized object
                        return xhr ;
                    },
                    //cache: false,
                    // async: false,
                    processData: false,
                    contentType: false
                });
            }
            $this.PostAdmin=function(msgData,successCallback,beforeSendCallback,completeCallback){
                msgData=$.extend({currentChatId:currentChatId,userId:settings.userId,isUserTyping:isMeTyping},msgData);
                settings.onDataBind(msgData);
                if(settings.ajaxSender && typeof(settings.ajaxSender)=="function"){
                    settings.ajaxSender(msgData,successCallback,beforeSendCallback,completeCallback);
                    return;

                }
                if(settings.url==""){
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: settings.url,
                    data: msgData,
                    dataType: "json",
                    cache: false,
                    async: true,
                    beforeSend: function() {
                        $this.StopChecking();
                        $this.SaveLastRequestTime();
                        if(typeof beforeSendCallback=="function"){
                            beforeSendCallback(msgData);
                        }
                    },success: function(data) {
                        $this.StartChecking();
                        if(typeof successCallback=="function"){

                            successCallback(data,msgData);
                            return;
                        }
                    },complete: function() {
                        $this.StartChecking();
                        if(typeof completeCallback=="function"){
                            completeCallback(msgData);
                            return;
                        }
                    }
                });

            }

            $this.ResetTyping=function(){
                inputBox.val('');
                inputBox.trigger('keyup');
                inputBox.focus();
                $this.SetMeTyping(false);
            }

            $this.AppendMessage=function(newMsgItem,isMe,hasTime){
                var senderType="S"
                if(isMe){
                    senderType="A"
                }
                $this.AppendNewMessage(newMsgItem,senderType,hasTime,currentChatBoxElem);

            };
            $this.GetNewMessageHtml=function(newMsgItem,senderType,hasTime){
                if(typeof (senderType) =="undefined") {
                    senderType="S";
                }
                if(hasTime ===undefined){
                    hasTime=true;
                }
                var cm = senderType=="A" ? "apc-me" : "";
                var mainItemClass,img;
                if(senderType=="S") {
                    img="";
                    mainItemClass="apc-msg-sys-item";
                }else{
                    mainItemClass="apc-msg-item";
                    img= '<div class="apc-umg"><img src="'+newMsgItem.senderImg+'" alt="Chatimg"></div>';

                }
                if(newMsgItem.msg_html.match(/</) && newMsgItem.msg_html.match(/>/)){
                    var msg_html=newMsgItem.msg_html.replace(/\-\-sessionkey\-\-/gim,"admin");
                }else{
                    var msg_html=$this.linkify(newMsgItem.msg_html+"");
                    msg_html=msg_html.replace("\n", "<br />");
                }

                var timespan='<span class="apc-sending">'+(senderType=="A" && !hasTime?'<i class="fa fa-spin fa-circle-o-notch"></i></span>':newMsgItem.msg_time);
                var html = ' <div id="' + newMsgItem.temp_id + '" data-msg-id="'+newMsgItem.id+'" class="apc-item animated fadeIn '+mainItemClass+" "+ cm +'">' +
                    img+
                    '                        <div class="apc-msg">' + msg_html +
                    '                        </div>' +
                    '<div class="apc-msg-time"> '+timespan+'</div>' +
                    '                    </div>';
                return html;
            }
            $this.AppendNewMessage=function(newMsgItem,senderType,hasTime,chatBoxElem,isPlaySound){

                if(isPlaySound==undefined){
                    isPlaySound=true;
                }

                if($("#"+newMsgItem.temp_id).length>0){
                    //$("#"+newMsgItem.temp_id).find(".apc-msg").html(itemmsg.msg_html);
                }else {

                    chatBoxElem.append($this.GetNewMessageHtml(newMsgItem,senderType,hasTime));
                    if(typeof settings.onNewChatOrMsg =="function"){
                        try{
                            settings.onNewChatOrMsg(newMsgItem,"M");
                        }catch (e){}
                    }
                    if(!isFirstLoad){
                        var btnli=$("li#btn-chat-"+newMsgItem.chatId);
                        if(!btnli.hasClass("apc-active")){
                            var counter=btnli.find(".apc-btn-rc");
                            if(!btnli.hasClass("has-msg")){
                                btnli.addClass("has-msg");
                            }
                            if(counter!==undefined){
                                var currentValue=parseInt(counter.text());
                                counter.text(currentValue+1);
                            }
                        }
                    }
                    $this.ScrollToDown(chatBoxElem);
                    if (senderType=="A") {
                        $this.ResetTyping();
                    }else {
                        if(!isFirstLoad && isPlaySound && settings.audioPath!=""){
                            var audio = new Audio(settings.audioPath);
                            audio.play();
                        }
                    }
                    $this.SetContentEvent();

                }

            };
            $this.linkify = function(str) {

                // http://, https://, ftp://
                var urlPattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;

                // www. sans http:// or https://
                var pseudoUrlPattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

                // Email addresses
                var emailAddressPattern = /[\w.]+@[a-zA-Z_-]+?(?:\.[a-zA-Z]{2,6})+/gim;

                return str
                    .replace(urlPattern, '<a target="_blank" href="$&">$&</a>')
                    .replace(pseudoUrlPattern, '$1<a target="_blank" href="http://$2">$2</a>')
                    .replace(emailAddressPattern, '<a target="_blank" href="mailto:$&">$&</a>');
            }
            $this.SetContentEvent=function(){
                try{
                    $(".apc-chat-img:not(.added-p)").magnificPopup({
                        type:'image',
                        mainClass: 'mfp-with-zoom',
                        zoom: {
                            enabled: true,
                            duration: 300,
                            easing: 'ease-in-out',
                            opener: function(openerElement) {
                                return openerElement.is('img') ? openerElement : openerElement.find('img');
                            }
                        }
                    }).addClass("added-p");
                }catch(e) {
                    console.log(e);
                }
            }
            $this.AddloadMoreMessageData=function(data,container){
                var loadmorebtn=container.find(".apc-load-move");
                for (var i in data) {
                    var html=$this.GetNewMessageHtml(data[i],data[i].senderType,true);
                    if(html !=""){
                        loadmorebtn.after(html);
                    }
                }
                plugin.SetContentEvent();
                plugin.setLoadMore();
            }
            $this.FileStatusViewer=function(msg,status) {
                if(status==undefined){
                    status=msg!="";
                }
                if (status) {
                    fileStatusViewer.html(msg).show();
                } else {
                    fileStatusViewer.html(msg).hide();
                }
            }
            $this.init=function(){
                $this.resize();
                $(window).on("resize",function(e){
                    $this.resize();
                });
                try{
                    ChatListPanel.slimScroll();
                    ChatEndListPanel.slimScroll();
                }catch (e){}

                function handle_mousedown(e){
                    var my_dragging = {};
                    my_dragging.pageX0 = e.pageX;
                    my_dragging.pageY0 = e.pageY;
                    my_dragging.elem = this;
                    my_dragging.offset0 = $(this).offset();
                    function handle_dragging(e){
                        updateInputHeight = inputHeight+((my_dragging.pageY0-e.pageY)*1.5)+30;
                        if(updateInputHeight<minHeight){
                            updateInputHeight=minHeight;
                        }else if(updateInputHeight>maxHeight){
                            updateInputHeight=maxHeight;
                        }
                        inputPanel.height(updateInputHeight);
                    }
                    function handle_mouseup(e){
                        inputHeight=updateInputHeight;
                        $('body')
                            .off('mousemove', handle_dragging)
                            .off('mouseup', handle_mouseup);
                    }
                    $('body')
                        .on('mouseup', handle_mouseup)
                        .on('mousemove', handle_dragging);
                }

                //dragElem.mousedown(handle_mousedown);
                inputBox.on("keypress",function(e){

                    var code = e.which; // recommended to use e.which, it's normalized across browsers
                    if(!e.shiftKey && code==13){
                        e.preventDefault();
                        var msg=inputBox.val();
                        $this.SendMsg(msg,true);
                        inputBox.val('');
                    } // missing closing if brace

                });
                inputBox.on("keyup",function(e){
                    var msg=inputBox.val();
                    if(msg.length>0){
                        $this.SetMeTyping(true);
                        //isMeTyping=true;
                        attachBtn.hide();
                    }else{
                        attachBtn.show();
                        //isMeTyping=false;
                        $this.SetMeTyping(false);
                    }
                });
                $this.AlertMessageViewer=function(msg, IsSuccess, IsSticky, title, icon,timeouttime) {
                    ShowGritterMsg(msg,IsSuccess,IsSticky,title,icon);
                }
                $this.sprintf=function (format )
                {
                    for( var i=1; i < arguments.length; i++ ) {
                        format = format.replace( /%s/i, arguments[i] );
                    }
                    return format;
                }
                $this.find(".apc-send-btn").on("click",function(e){
                    e.preventDefault();
                    var msg=inputBox.val();
                    $this.SendMsg(msg);
                    inputBox.val('');
                });

                $this.on("click",".apc-load-move",function(e) {
                    try {
                        var thisbtn=$(this);
                        var chatLContainer=thisbtn.closest(".apc-msgs");
                        var firstItem = chatLContainer.find(".apc-item:first").data("msg-id");
                        var chat_id=thisbtn.data("chat-id");
                        var btni=thisbtn.find("> button i");
                        var bkclass=btni.attr("class");
                        plugin.PostAdmin({
                            topic:"loadmore",
                            currentChatId:chat_id,
                            last_msg_id:firstItem
                        },function(data,preData){
                            plugin.AddloadMoreMessageData(data,chatLContainer);
                        },function(preData){
                            thisbtn.find("> button i").attr("class","fa fa-spin fa-refresh");
                        },function(){
                            thisbtn.find("> button i").attr("class",bkclass);
                        });
                    } catch (e) {
                    }
                    //plugin.setLoadMore();
                });
                attachBtn.on("click",function(e){
                    e.preventDefault();
                    if(!settings.isDisableFileUpload &&  settings.url != ""){
                        $('<input type="file" name="attach_file" accept="'+settings.fileAccepts+'">').on("change",function (e) {

                            var maxfilezone=settings.maxFileSize*1024*1024;
                            var fileExtension=this.files[0].name.substr(-4);
                            var fileAccepts=$(this).attr("accept");
                            var isExtensionOk=fileAccepts.indexOf(fileExtension)!=-1;
                            if(maxfilezone<this.files[0].size){
                                plugin.AlertMessageViewer(plugin.sprintf(settings.maxFileErrorMsg,settings.maxFileSize),false,false,settings.maxFileErrorMsgTitle,'times-circle-o');
                            }else if(!isExtensionOk){
                                plugin.AlertMessageViewer(settings.unsupportedFileMsg,false,false,settings.unsupportedFileMsgTitle,'times-circle-o');

                            }else{
                                var fileNameStr=this.files[0].name;
                                if(fileNameStr.length>10){
                                    fileNameStr=fileNameStr.substr(0,5)+".."+fileNameStr.substr(-5);
                                }
                                plugin.SendFile(settings.url,$(this),
                                    function() {
                                        //before send
                                        plugin.FileStatusViewer(fileNameStr+" uploading(0%)");
                                    },function() {
                                        //finish on Complete
                                        plugin.FileStatusViewer(fileNameStr+" processing..");
                                    },function(per,uploaded,total) {
                                        //onProgress
                                        plugin.FileStatusViewer(fileNameStr+" uploading("+per.toFixed(0)+"%)");
                                    },
                                    function(rdata) {
                                        if(!rdata.attach_status){
                                            plugin.AlertMessageViewer(rdata.attach_msg,false);
                                        }
                                        plugin.FileStatusViewer("",false);
                                        plugin.processData(rdata);
                                        setTimeout(plugin.ScrollToDown(),500);

                                    });
                            }
                        }).trigger('click');
                    }

                });
                //$this.SetCurrentChatId("user2");
                $this.LoadChatData();
                chatUserInfoPanel.find("#dd-end-time .chat-end-button").on("click",function (e) {
                    e.preventDefault();
                    var chat_id=$(this).data("chat_id");
                    var thisobj=$(this);
                    if(settings.cancelUrl==""){
                        alert("Cancel url is empty");
                        return;
                    }
                    if(confirm(settings.cancelText)){
                        $.getJSON(settings.cancelUrl,{chat_id:chat_id},function (rdata) {
                            if(rdata.status){
                                thisobj.hide();
                            }
                            ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
                        });
                    }

                });
                if( settings.cannedMessages.length > 0){
                    for(var i in settings.cannedMessages){
                            cannedMsgSelect.append('<option value="'+i+'">'+settings.cannedMessages[i].title+'</option>');
                    }
                }
                cannedMsgButton.on("click",function (e) {
                    e.preventDefault();
                    var d=cannedMsgSelect.val();
                    if(d==""){
                        alert("Please choose canned message first");
                        return;
                    }
                    try{
                        $this.SendMsg(settings.cannedMessages[d].canned_msg,true);
                        cannedMsgSelect.val("");
                    }catch (e){
                        console.log(e);
                    }


                })

                if($.isFunction(settings.onInit)){
                    settings.onInit($this);
                }

                return $this;
            }
            return $this.init();

        });

    }

}(jQuery));

