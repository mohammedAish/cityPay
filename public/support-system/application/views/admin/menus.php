<?php
AppMenu::Clear();
$isDisableAdminMenu=false;
$adminLabel=AppMenu::AddMenuLabel("Admin Menu");
$adminReport=AppMenu::AddMenu("ALL", "Admin Report","", "fa fa-bar-chart-o");
if($adminReport){
    $adminReport->AddSubMenu("AD","Admin Dashboard", "admin/admin-report","fa fa-th");
}
$adminMenu=AppMenu::AddMenu("ALL", "Admin Setting","", "ap ap-admin-settings");
if($adminMenu){
	$adminMenu->AddSubMenu("AD","App Settings", "admin/admin-setting/general","fa fa-gears","");
    $adminMenu->AddSubMenu("AD", "Ticket Assign Rule","admin/ticket-assign-rule", "ap ap-users-check");
	$adminMenu->AddSubMenu("AD", "Email Templates","admin/email-templates", "fa fa-envelope");
	$adminMenu->AddSubMenu("AD","Custom Fields","admin/custom-field","fa fa-wpforms");
	$adminMenu->AddSubMenu("AD", "Site Menu","admin/menu", "fa fa-bars");
	$adminMenu->AddSubMenu("AD", "Topbar Icon","admin/topbar-icon", "fa fa-ellipsis-h");
	$adminMenu->AddSubMenu("AD", "IP List","admin/iplist", "ap ap-ip");
	$adminMenu->AddSubMenu("AD", "Locked User","admin/locked-user", "ap ap-locked-user2");
	$adminMenu->AddSubMenu("AD", "Pages","admin/page", "fa fa-file-o");
	$adminMenu->AddSubMenu("AD", "Add-Ons","admin/addons", "fa fa-puzzle-piece");

}

$api_list=APP_API::get_loaded_api_list();
$api_list_icon=APP_API::get_loaded_api_list_icon();
$apimenu=AppMenu::AddMenu("ALL", "API Setting","", "ap ap-api");
if($apimenu){
    $apimenu->AddSubMenu("AD","Social Login Setting", "admin/api-setting/social-setting", "fa fa-share-alt");
    $apimenu->AddSubMenu("AD","Remote Server Login", "admin/remote-server", "ap ap-remote-login");

	if(count($api_list)>0){
		foreach ($api_list as $api){
			$apimenu->AddSubMenu("AD",$api->get_menu_title(), "admin/api-setting/api/{$api->get_name()}",getTextByKey($api->get_name(),$api_list_icon));
		}
	}	
}
$paymentList=AppMenu::AddMenu("ALL", "Payment Settings","", "ap ap-api");
if($paymentList) {
    $paymentList->AddSubMenu("AD","Payment Basic Settings", "admin/api-setting/payment-basic", "fa fa-gear");
    AddOnManager::DoFilter("admin-menu-payment-list",$paymentList);
}
$access_controll=AppMenu::AddMenu("AD", "User Settings", '', "fa fa-user");
if($access_controll){
    $access_controll->AddSubMenu("AD","User List", "admin/app-permission/user-list","fa fa-list");
    $access_controll->AddSubMenu("AD","Role List", "admin/app-permission/role-list");
    $access_controll->AddSubMenu("AD","Role Access", "admin/app-permission/role-access");
}


$app_settings=AppMenu::AddMenu("ALL", "App Information","", "fa fa-info-circle");
if($app_settings){
    if(!ISDEMOMODE){
        $app_settings->AddSubMenu("AD","Debug Log","admin/debug-log","fa fa-bug text-warning");
        $app_settings->AddSubMenu("AD","License","admin/license","fa fa-bug text-warning","",["admin/license/update"]);
    }

    $up_counter="";

    /*$ci=get_instance();
     $current_version=$ci->config->item("app_version");
     $json=Mapp_setting_api::GetSettingsValue("SYSTEM", "update_json");
     if(!empty($json)){
     $json=json_decode($json);
     if(!empty($json->new_version)){
     if(version_compare($json->new_version, $current_version,">")){
     $up_counter='<span class="pull-right-container"><span class="label label-danger pull-right">1</span></span>';
     }
     }
     }*/



    $app_settings->AddSubMenu("AD", 'App Update'.$up_counter,"admin/system-update", "fa fa-arrow-circle-o-up");

}
$paid_transactions=AppMenu::AddMenu("ALL", "Payment List","admin/ticket-payment", "fa fa-money");

AppMenu::SetInternalMenuByType("ADA");

if(empty($adminMenu->isGroupViewable) && empty($apimenu->isGroupViewable) && empty($app_settings->isGroupViewable) && empty($adminReport->isGroupViewable)&& !$paid_transactions){
	$adminLabel->Disable();
}



if($adminLabel->isDisabled){
	AppMenu::AddMenuLabel("Menu");
}else{
	AppMenu::AddMenuLabel("Staff Menu");
}
AppMenu::AddMenu("AD", "My Dashboard", 'admin/dashboard/index', "ap ap-dashboard");

$Ticket=AppMenu::AddMenu("AD", "Ticket","", "fa fa-ticket",["admin/ticket/details"]);
if($Ticket){
    $Ticket->AddSubMenu("AD","Create Ticket","admin/ticket/open","fa-pencil-square-o");
    $Ticket->AddSubMenu("AD","All Active Tickets","admin/ticket");
    $Ticket->AddSubMenu("AD","My Active Tickets","admin/ticket/my-ticket");
    $Ticket->AddSubMenu("AD","My Active Paid Tickets","admin/ticket/my-paid-ticket");
    $Ticket->AddSubMenu("AD","My Closed Tickets","admin/ticket/my-closed");
    $Ticket->AddSubMenu("AD","My Assigned Tickets","admin/ticket/my-assigned-ticket");
    
	
	$Ticket->AddSubMenu("AD","All Unassigned Tickets","admin/ticket/unassigned-ticket");
	$Ticket->AddSubMenu("AD","All Paid Tickets","admin/ticket/all-paid-ticket");
	$Ticket->AddSubMenu("AD","All Closed Tickets","admin/ticket/closed-ticket");
	
}
$chat=AppMenu::AddMenu("AD", "Web Chat","", "ap ap-chat3");
if($chat){
    $chat->AddSubMenu("AD","Chat Panel","admin/admin-chat","ap ap-chat");
    $chat->AddSubMenu("AD","Chat Canned Message","admin/chat-canned-msg");
}
$Ticket_feedback=AppMenu::AddMenu("ALL", "Ticket Feedback","admin/ticket-feedback", "fa fa-ticket");
$Notice=AppMenu::AddMenu("ALL", "Announcements","admin/notice", "fa fa-bullhorn");
$Knowledge=AppMenu::AddMenu("AD", "Knowledge","admin/knowledge", "fa fa-graduation-cap");

$faq=AppMenu::AddMenu("AD", "FAQ","", "fa fa-question-circle-o");
if($faq) {
	$faq->AddSubMenu( "AD", "Faq List", "admin/faq-list", "fa fa-question-circle-o" );
	$faq->AddSubMenu( "AD", "Faq Category", "admin/faq-category", "fa fa-question-circle-o" );
}
$Testimonial=AppMenu::AddMenu("ALL", "Testimonial","admin/testimonial", "fa fa-thumbs-up");
$Category=AppMenu::AddMenu("AD", "Category","admin/category", "fa fa-table");
$Canned_msg=AppMenu::AddMenu("ALL", "Canned Msg","admin/canned-msg", "fa fa-stack-exchange");
$Client=AppMenu::AddMenu("AD", "Client","admin/client", "ap ap-client");
$message=AppMenu::AddMenu("AD", "Message","admin/admin-message", "fa  fa-envelope");
if($message){
    $message->AddSubMenu("AD","My Message","admin/admin-message","fa fa-envelope-open");
    $message->AddSubMenu("AD","Sent Message","admin/admin-message/sent","fa fa-envelope");
}
AppMenu::SetInternalMenuByType("ADS");

//$App_setting=AppMenu::AddMenu("ALL", "Setting","admin/app-setting", "fa fa-gears");