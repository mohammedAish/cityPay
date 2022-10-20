<?php
class Notification extends APP_Controller{
    
    function __construct(){
        parent::__construct();
        $this->CheckPageAccess();
       
    }
    function show($id){
        $adminData=GetAdminData();
        if($adminData){
            $noti=Mapp_notificaiton::FindBy("id", $id);
            Mapp_notificaiton::ViewedByID($id);
            redirect($noti->entry_link);
            return;
        }
    }
    function show_list($type='N'){
        if($type=="M"){
            $this->SetTitle("Message List");
        }else{
            $this->SetTitle("Notification List");
        }
        $this->SetSubtitle("");
        $this->AddBreadCrumb("home", base_url());
        $this->load->library("jQGrid");
        $this->AddViewData("grid_url", site_url("admin/notification-data/notification-list/{$type}"));
        $this->Display();
    }
    function seen_all() {
	    $this->SetTitle("Mark as Seen All");
	    $user_id=GetAdminData();
	    if(Mapp_notificaiton::Viewed('N',$user_id->id)) {
	    	AddInfo("Successfully seen all notification");
	    }else{
		    AddError("Failed to seen all notification, may be already seen all");
	    }
	    $this->DisplayPOPUPMsg();
    }
    function viewed($type="N"){
       /* $adminData=GetAdminData();
        if($adminData){
            Mapp_notificaiton::Viewed($type, $adminData->id);
        }*/
    }
    
    
}