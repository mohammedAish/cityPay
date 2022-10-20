<?php
$file_extensions=Mapp_setting::GetSettingsValue('allowed_file_type');
if(!empty($file_extensions)){
    $file_extensions=".".str_replace("|", ",.", $file_extensions);
}
?>
<script type="text/javascript" >
    <?php
    $_c_utype=GetCurrentUserType();
    if(ISDEMOMODE || $_c_utype !="AD"){
    if($_c_utype=="CU"){
        $_c_ud=GetUserData();
        if($_c_ud){
            $userImage=GetUserData()->user_img;
        }else{
            $userImage=image_url("images/no-image.png");
        }
    }else{
        $userImage=image_url("images/no-image.png");
    }
    ?>
    var chatbox=null;
    $(function () {
        chatbox=$.appsbdChat({
            url:"<?php echo base_url("chat"); ?>",
            chatKey:"<?php echo ChatLib::getChatKey(); ?>",
            chatTitle:"<?php echo Mapp_setting_api::GetSettingsValue("webchat","app_chat_title"); ?>",
            chatSubTitle:"<?php echo Mapp_setting_api::GetSettingsValue("webchat","app_chat_tagline"); ?>",
            chatLogo:"<?php echo Mchat::getChatLogoUrl(); ?>",
            preMsg:"<?php echo str_replace(["\r","\n"],"",nl2br(Mapp_setting_api::GetSettingsValue("webchat","open_text"))); ?>",
            startBtnText:'Start Conversation',
            audioPath:"<?php echo base_url("images/chatnoti.ogg"); ?>",
            userImg:"<?php echo $userImage ?>",
            fileUrl:"<?php echo base_url("chat"); ?>",
            fileAccepts:"<?php echo $file_extensions; ?>",
            maxFileSize:<?php echo Mapp_setting::GetSettingsValue("max_file_upload_size",1); ?>,
            loadMoreText:"<?php echo _e("Load More"); ?>",
            buttonIcon:"<?php echo Mapp_setting_api::GetSettingsValue("webchat","chat_btn_icon","ap ap-chat2"); ?>",
            onInit:function (plugin) {
            }
        });
        //chatbox.Resize();
    });
    <?php }else{ ?>
    try {
        localStorage.removeItem("apbd_chat_config");
        localStorage.removeItem("apbd_chat_data");
        localStorage.removeItem("apc_last_request");
    }catch(e){}
    <?php } ?>

</script>