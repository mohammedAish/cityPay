<?php
class Common_script extends CI_Controller{
	function js(){
        $this->output->clearModules();
		header('Content-Type: text/javascript; charset=utf-8');
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		$vObj=new stdClass();
		$vObj->on_sec_noti=Mapp_setting::GetSettingsValue("is_nstkt_open")=="Y" || Mapp_setting::GetSettingsValue("is_nstktu_reply")=="Y" || Mapp_setting::GetSettingsValue("is_nstkta_reply")=="Y";
		$vObj->on_sec_noti_url=site_url("admin/dashboard/notification");
		$vObj->on_sec_noti_interval=15000;
		$vObj->is_noti_audio=Mapp_setting::GetSettingsValue("is_nstone","Y")=="Y";
		$vObj->noti_audio_path=base_url("images/notificaiton.ogg");
        $vObj->chattone_audio_path=base_url("images/chattone.ogg");
		$vObj->current_user_type=GetCurrentUserType();
		$vObj->user_id="";
		$userData=GetAppBaseUserData();
		if(!empty($userData->id)){
		  $vObj->user_id=$userData->id;
		}		
		$vObj->Loading=__("Loading");
		$vObj->Like=__("Helpfull");
		$vObj->Liked=__("You think it is helpfull");
		$vObj->Dislike=__("Not Helpfull");
		$vObj->Disliked=__("You think it is not helpfull");
		
		$vObj->is_online_check=Mapp_setting::GetSettingsValue("is_check_online")=="Y";
		$vObj->user_online_url=site_url("alluser/user/online");
		$vObj->base_cookie_name=Mapp_setting::get_cookie_prefix();
		$vObj->online_cookie_name=Mapp_setting::get_online_cookie_name();	
		$vObj->online_cookie_interval=90000;
		$vObj->src_url=site_url("site/search");
        $vObj->app_rate_url=site_url("admin/system-update/rate-it");
        $vObj->isAdminLoggedIn=false;
        $vObj->isAdminChatEnable=false;
        if(GetCurrentUserType()=="AD"){
            $vObj->isAdminLoggedIn=true;
            $vObj->isAdminChatEnable=$userData->isChatEnable;
            if($userData->isChatEnable){
                $vObj->on_sec_noti=true;
            }
        }
        $vObj->chat_base_url=base_url("admin/admin-chat-confirm/user-answer");
        $vObj->chat_windo_url=site_url("admin/admin-chat");
        $vObj->chat_new_chat_text=__("New Chat Request");
        $vObj->chat_take_msg_text=__("Do you want to take?");
        $vObj->chat_take_btn_text=__("Yes");
        $vObj->chat_cancel_btn_text=__("No");
        $vObj->update_notification_try=site_url("admin/dashboard/update-notification-trey");
		$vObj->yesText=__("Yes");
		$vObj->noText=__("No");
		$vObj->closeText=__("Close");
		echo "var appGlobalLang=".json_encode($vObj);

	}
	function chatjs(){

    }
}