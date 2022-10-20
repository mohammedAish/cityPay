<?php
$chatCannedMessage=Mcanned_msg::FindAllBy("canned_type","C",["status"=>"A"]);
?>
<div class="box box-solid  m-b-0">
    <div class="box-body border-radius-none p-0">
        <div id="apbd-cht-admin-container">
            <div class="apc-main-container">
                <div class="apc-loading">
                    <div class="apc-loading-msg">
                        <?php _e("Loading Chat Data Please wait..") ; ?>
                    </div>
                </div>
                <div class="apc-user-list ">
                    <div class="apc-pnl-header">
                       <?php _e("User List") ; ?>
                        <i class="apc-close-btn fa fa-angle-left"></i>
                    </div>
                    <div class="apc-pnl-content">
                        <ul class="apc-chat-list"></ul>
                        <div class="apc-diver bg-red"><?php _e("Last 5 Closed Chat") ; ?></div>
                        <ul class="apc-chat-end-list"></ul>
                    </div>
                </div>
                <div class="apc-chat-container">
                    <div class="apc-pnl-header">
                        <i class="apc-open-user-list fa fa-bars"></i>
                        <div class="apc-chat-title"></div>
                        <div class="apc-chat-desi"></div>
                        <i class="apc-open-chatinfo fa fa-bars"></i>
                    </div>
                    <div class="apc-pnl-content">
                        <div class="apc-chat-item-content"> </div>
                        <?php /*<div class="apc-chat-item-msg-divider">&ctdot;</div>*/?>
                        <div class="apc-chat-msg-type-panel">
                            <div class="apc-msg-typing">
                                <div class="apc-spinner">
                                    <div class="apc-bounce1"></div>
                                    <div class="apc-bounce2"></div>
                                    <div class="apc-bounce3"></div>
                                </div>
                                <?php _e("typing") ; ?>
                            </div>
                            <div class="apc-file-up-status"></div>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                  <div class="chat-canned-msg form-inline ">
                                      <div class="form-group form-group-sm">
                                          <label class="control-label" for=""><?php _e("Canned Message"); ?></label>
                                          <select type="text" class="form-control" id="chat-canned-msg">
                                              <option value=""><?php _e("Select") ; ?></option>
                                          </select>
                                          <button id="chat-canned-msg-btn" class="btn btn-success btn-xs"><?php _e("Send") ; ?></button>
                                      </div>
                                  </div>
                              </div>
                              <div class="panel-body">
                                  <textarea class="apc-admin-chat-input" name="" id="" placeholder="Write" ></textarea>
                                  <div class="apc-send-ctrl">
                                      <i class="apc-attach-btn fa fa-paperclip"></i>
                                      <i class="apc-send-btn fa fa-send"></i>
                                  </div>
                              </div>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="apc-chat-user-info">
                    <div class="apc-pnl-header">
                        <i class="apc-close-btn fa fa-angle-right"></i>
                       <?php _e("User Info") ; ?>
                    </div>
                    <div class="apc-pnl-content">
                            <dl class="dl-horizontal">
                                <dt><?php _e("Name") ; ?></dt>
                                <dd id="dd-name"></dd>
                                <dt><?php _e("Browser") ; ?></dt>
                                <dd id="dd-browser"></dd>
                                <dt><?php _e("Country") ; ?></dt>
                                <dd id="dd-country"></dd>
                                <dt><?php _e("IP") ; ?></dt>
                                <dd id="dd-ip"></dd>
                                <dt><?php _e("Start Time") ; ?></dt>
                                <dd id="dd-start-time"></dd>
                                <dt><?php _e("End Time") ; ?></dt>
                                <dd id="dd-end-time">
                                    <button style="display: none;" class="chat-end-button btn btn-xs btn-danger"><i class="fa fa-times"></i> Close Chat</button>
                                    <span class="endtimestr"></span>
                                </dd>
                            </dl>
                            <div class="apc-diver apc-kn-search-divder bg-green"><input id="apc-kn-search" type="text" placeholder="<?php _e("Knowledge Search") ; ?>"> <i id="apc-kn-search-loader" class=" fa fa-spin fa-spinner"></i></div>
                            <div id="apc-kn-container">
                            <ul id="chat-knowledge" class="list-group">
                                <?php
                                $knowledges=Mknowledge::FindAllBy("status", "P",[],'v_count',"DESC",4);
                                foreach ($knowledges as $kn) {
                                    ?>
                                    <li class="list-group-item apc-kn-li">
                                        <a class="apc-kn-title popupform " data-effect="mfp-move-from-top " target="_blank"
                                           href="<?php echo site_url("knowledge/details/".$kn->id);?>">
                                            <?php echo $kn->title; ?></a>
                                        <small><?php echo Mcategory::getParentStr($kn->cat_id);?></small>
                                        <button data-id="#dt-0" class="kn-send-btn btn btn-xs btn-success">Send</button>
                                        <div id="dt-0" class="hidden"><?php echo $kn->title; ?>
                                            <?php echo site_url("knowledge/details/".$kn->id);?>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<?php
$file_extensions=Mapp_setting::GetSettingsValue('allowed_file_type');
if(!empty($file_extensions)) {
    $file_extensions = "." . str_replace("|", ",.", $file_extensions);
}
?>
<style type="text/css">
    #apc-kn-container{
        padding: 0 !important;
    }
    #apc-kn-container ul li{
        padding: 10px;
    }
    #apc-kn-search-loader {
        position: absolute;
        right: 8px;
        top: 9px;
        color: #999999;
        display: none;
    }
    .apc-kn-search-divder{
       border:  none !important;

    }
    .apc-kn-search-divder input{
       margin-top: 0px !important;
    }
    #chat-knowledge{
        width: calc( 100% + 30px);
        border: none;
    }
    #chat-knowledge,#chat-knowledge li{
        -webkit-border-radius: 0 !important;
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
        border-left: none;
        border-right: none;
    }
    .apc-kn-title{
        white-space: nowrap;
        width: 100%;
        text-overflow: ellipsis;
        overflow: hidden;
        display: block;
    }
    .apc-kn-li small{display: block; font-style: italic; white-space: nowrap; width: 100%; text-overflow: ellipsis;overflow: hidden;}
    @media all and (max-width: 768px) {
        .content-header {
            display: none;
        }
        #apc-kn-container{
            display: none;
        }
        .apc-kn-search-divder{
            display: none;
        }
    }


</style>
<script type="text/javascript">
    var chatAdminbox=null;
    var original = document.title;
    var timeout;

    window.coders = function (newMsg, howManyTimes) {
        function step() {
            document.title = (document.title == original) ? newMsg : original;

            if (--howManyTimes > 0) {
                timeout = setTimeout(step, 1000);
            };
        };

        howManyTimes = parseInt(howManyTimes);

        if (isNaN(howManyTimes)) {
            howManyTimes = 5;
        };

        cancelcoders(timeout);
        step();
    };

    window.cancelcoders = function () {
        clearTimeout(timeout);
        document.title = original;
    };
    window.is_chat_remove=false;
    function ApcShowSrcLoader(status){
        if(status ===undefined ){
            status =true;
        }
        if(status){
            $("#apc-kn-search-loader").fadeIn();
        }else{
            $("#apc-kn-search-loader").fadeOut();
        }

    }
    function setSearchPanel() {


        $("#apc-kn-search").keyup(function (e) {
            var va = $(this).val();
            //console.log(va);
            if (va.length > 2) {
                var data = {src: va};
                ApcShowSrcLoader(true);
                apc_search_delay(function () {
                    $.ajax({
                        url: appGlobalLang.src_url,
                        data: set_csrf_param(data),
                        type: "POST",
                        scriptCharset: "utf-8",
                        dataType: "json",
                        beforeSend: function () {

                        },
                        success: function (rdata) {
                            app_set_src_list(rdata);
                        },
                        complete: function (jqXHR, textStatus) {
                            ApcShowSrcLoader(false);
                        }
                    });
                }, 600);
            } else {
                //close_src_panel();
            }
        });
    }

    var apc_search_delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
    function app_set_src_list(items){
        //gcl(items.length);
        $("#chat-knowledge").html("");
        if(items.total>0){
            for(var i=0; i<items.data.length;i++){
                var li='<li class="list-group-item" ><a class="apc-kn-title popupform " data-effect="mfp-move-from-top " target="_blank" href="'+items.data[i].href+'">'+items.data[i].title+'</a>' +
                    '<small>'+$(items.data[i].cat_link).text()+'</small><br/>' +
                    '<button data-id="#dt-'+i+'" class="kn-send-btn btn btn-xs btn-success">Send</button>' +
                    '<div id="dt-'+i+'" class="hidden">' +
                    items.data[i].title+'\n ' +items.data[i].href
                    '</div>' +
                    '</li>';
                $("#chat-knowledge").append(li);
            }
            setPopUpAjax();
        }else{
            $("#chat-knowledge").html('<li class="list-group-item text-red"><?php _e("No result found");?></li>');
        }
    }
    function knresize(thisobj){
        try {
            var height = thisobj.height() - $("#apc-kn-container").offset().top+thisobj.offset().top;
            $("#apc-kn-container").height(height).find(".slimScrollDiv").height(height);
            $("#chat-knowledge").height(height);

        }catch(e){
            gcl(e);
        }
    }

    $(function () {
        var TitleMsgStatus="";
        localStorage.setItem("adchatwindow","o");
        chatbox= $("#apbd-cht-admin-container").appsbdAdminChat({
            url:"<?php echo admin_url("admin-chat/chat-response"); ?>",
            userId:"<?php echo GetAdminData()->id; ?>",
            userImage:"<?php echo GetAdminData()->user_img; ?>",
            audioPath:"<?php echo base_url("images/chatnoti.ogg"); ?>",
            cancelUrl:"<?php echo base_url("admin/admin-chat-confirm/user-chat-close"); ?>",
            cannedMessages:<?php echo json_encode($chatCannedMessage); ?>,
            fileAccepts:"<?php echo $file_extensions; ?>",
            maxFileSize:<?php echo Mapp_setting::GetSettingsValue("max_file_upload_size",1); ?>,
            loadMoreText:"<?php echo _e("Load More"); ?>",
            onInit:function(thisobj){
                setSearchPanel();
                $("#chat-knowledge").slimScroll();
                $("#chat-knowledge").on("click",".kn-send-btn",function(e){
                    e.preventDefault();
                    try{
                        var dataid=$(this).data("id");
                        thisobj.SendMsg($(dataid).text(),true);
                    }catch(e){}
                });
                knresize(thisobj);
            },
            onResize:function(thisobj){
                knresize(thisobj);
            },
            onNewChatOrMsg:function(obj,type){
                if(localStorage.getItem("adchatwindow")=="b"){
                    coders("<?php _e("New message or chat");?>",100);
                }
            }
        });

       // chatbox
        //chatbox.Resize();
        $(window).on("beforeunload", function() {
            window.is_chat_remove=true;
            localStorage.removeItem("adchatwindow");
            return true;
        });
        $(window).on("blur", function() {
            if(!window.is_chat_remove){
                localStorage.setItem("adchatwindow","b");
            }

        });
        $(window).on("focus", function() {
            if(!window.is_chat_remove) {
                localStorage.setItem("adchatwindow","f");
            }
            cancelcoders(timeout);
        })
    });



</script>
