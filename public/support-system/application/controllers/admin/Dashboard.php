<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends APP_Controller {
	function __construct(){
		parent::__construct();		
		//$this->output->set_template('login');
		$this->CheckPageAccess();

	}
	public function index()
	{
	   	
		$adminData=Mapp_user::GetAdminData();		
		$this->SetTitle("My Dashboard");		
		$this->load->library("chart/APPChartJS");
		$totalTicketInfo=Mticket::getTicketStat("","",$adminData->id);		
		$monthTicketInfo=Mticket::getTicketStat(date("Y-m-d"),date("Y-m-d"),$adminData->id);
		
		$myinfo=Mapp_user::FindBy("id", $adminData->id);
		$this->AddViewData("myprof", $myinfo);
		$this->AddViewData("totalTicketInfo", $totalTicketInfo);
		$this->AddViewData("monthTicketInfo", $monthTicketInfo);
		$this->Display();
	}
	public function set_timezone(){
	    $this->SetPOPUPColClass("col-md-4");
	    $this->SetPOPUPIconClass("fa fa-map");
	    $this->SetTitle("Change Timezone");
	    $adminData=GetAdminData();
	    
	    $mainobj=new Mapp_user();
	    
	    if(IsPostBack){
	        $tzone=PostValue("tzone");
	        if(!empty($tzone)){
	            $uob=new Mapp_user();
	            $uob->tzone($tzone);
	            $uob->SetWhereCondition("id", $adminData->id);
	            if($uob->Update()){
	                $adminData->timezone=$tzone;
	                $this->session->SetAdminData($adminData);
	                AddInfo("Timezone updated successfully");
	                $this->DisplayPOPUPMsg();
	                return;
	            }else{
	                AddError("No change found for update");
	            }
	        }else{
	            AddError("Please select a valid timezone");
	        }
	    }
	    
	    $mainobj->id($adminData->id);
	    $mainobj->Select('tzone');
	    $this->AddViewData("mainobj", $mainobj);
	    $this->DisplayPOPUP();
	}
    function notification(){
        $this->output->unset_template();
	    $adminUserData=GetAdminData();
        $previous=$this->session->GetSession("admin_noti_time");
        if(empty($previous)){
            $previous=time();
        }
        $previous=strtotime("-10 SECONDS",$previous);
        $requestTimeStr = date('Y-m-d H:i:s', $previous);
        $result=Mapp_notificaiton::GetItemTypeBy($adminUserData->id,"T_",$requestTimeStr,"entry_time","asc","A");
        $returnObj = new stdClass();
        $returnObj->status = true;
        $returnObj->data=[];
        if($result) {
            foreach ($result as $noti) {
                $extraParam=json_decode(base64_decode($noti->extra_param));
                if(!empty($extraParam->id)) {
                    $newNotificaiton = new stdClass();
                    $newNotificaiton->id = $noti->id;
                    $newNotificaiton->ticket_id = $extraParam->id;
                    $newNotificaiton->title = $noti->title;
                    $newNotificaiton->icon = $noti->item_type=="TA"?"ticket":"comment";
                    $newNotificaiton->body = $noti->title . '<br/><a target="_blank" href="'.admin_url("notification/show/{$noti->id}").'" class="btn btn-xs btn-primary">' . __("View Details") . '</a>';
                    $returnObj->data[]=$newNotificaiton;
                }
            }
        }
        $returnObj->chat_data = [];
        if($adminUserData->isChatEnable){
            if(Mchat::hasLimit($adminUserData->id)){
                $chatobjs=new Mchat();
                $query="SELECT chat.id,chat.open_user_id,chat.start_time,chat.end_time,chat_denied.app_user_id
                        FROM chat LEFT JOIN chat_denied ON chat.id = chat_denied.chat_id AND app_user_id='{$adminUserData->id}'
                        WHERE chat.`status`='Q' AND app_user_id  is null";
                $returnObj->chat_data=$chatobjs->SelectQuery($query);
            }
        }
        $this->session->SetSession("admin_noti_time", time());
        echo json_encode($returnObj);
        
    }
    function update_notification_trey(){
        $this->output->unset_template();
        echo AppNotification::getNotificationHTML();
        die;
    }
	function notification2(){
	    //TODO: need to update
	    $this->output->unset_template();
	    $onScreenOpenTicket=Mapp_setting::GetSettingsValue("is_nstkt_open","N")=="Y";
	    $onScreenTicketUserTicket=Mapp_setting::GetSettingsValue("is_nstktu_reply","N")=="Y";
	    $onScreenAdminReplyTicket=Mapp_setting::GetSettingsValue("is_nstkta_reply","N")=="Y";
	    //echo date('Y-m-d H:i:s',time());
        $adminUserData=GetAdminData();
	    $previous=$this->session->GetSession("admin_noti_time");
	    $alreadyNoti=$this->session->GetSession("already_notified");
	    if(empty($alreadyNoti)){
	        $alreadyNoti=[];
	    }
	    //$previous=strtotime("2018-02-19 16:15:50");
	    $previous=strtotime("-20 SECONDS",$previous);
	    if(!empty($previous)) {
            $requestTimeStr = date('Y-m-d H:i:s', $previous);
            $mticket = new Mticket();
            $isSetOk = false;
            if ($onScreenOpenTicket) {
                if ($onScreenTicketUserTicket && $onScreenAdminReplyTicket) {
                    $mticket->opened_time(">= '$requestTimeStr' OR re_open_time >='$requestTimeStr' OR last_reply_time >='$requestTimeStr'", true);
                    $isSetOk = true;
                } elseif ($onScreenTicketUserTicket) {
                    $mticket->opened_time(">= '$requestTimeStr' OR re_open_time >='$requestTimeStr' OR ( last_replied_by_type in ('U','G') AND last_reply_time >='$requestTimeStr') ", true);
                    $isSetOk = true;
                } elseif ($onScreenAdminReplyTicket) {
                    $mticket->opened_time(">= '$requestTimeStr' OR re_open_time >='$requestTimeStr' OR ( last_replied_by_type ='A' AND last_reply_time >='$requestTimeStr') ", true);
                    $isSetOk = true;
                } else {
                    $mticket->opened_time(">= '$requestTimeStr' OR re_open_time >='$requestTimeStr'", true);
                    $isSetOk = true;
                }

            } else {
                if ($onScreenTicketUserTicket || $onScreenAdminReplyTicket) {
                    //only replay

                    if ($onScreenTicketUserTicket) {
                        $mticket->last_replied_by_type(" in ('U','G') AND last_reply_time >='$requestTimeStr'", true);
                        $isSetOk = true;
                    } elseif ($onScreenAdminReplyTicket) {
                        $mticket->last_replied_by_type("='A' AND last_reply_time >='$requestTimeStr'", true);
                        $isSetOk = true;
                    }
                }
            }
            $response = [];
            $returnObj = new stdClass();
            $returnObj->status = Mapp_setting::GetSettingsValue("is_nstkt_open") == "Y" || Mapp_setting::GetSettingsValue("is_nstktu_reply") == "Y" || Mapp_setting::GetSettingsValue("is_nstkta_reply") == "Y"||$adminUserData->isChatEnable;

            if ($returnObj->status && $isSetOk) {
                $newTicketFounds = $mticket->SelectAllGridData('id,ticket_track_id,opened_time,re_open_time,title,ticket_user,user_type,status,assigned_on,last_replied_by_type,last_replied_by,last_reply_time');
                $adminUser = Mapp_user::FetchAllKeyValue("id", "title");
                foreach ($newTicketFounds as $ticket) {
                    $newNotificaiton = new stdClass();
                    $newNotificaiton->id = md5($ticket->id . $ticket->opened_time . $ticket->re_open_time . $ticket->last_reply_time);
                    /*if(in_array($newNotificaiton->id, $alreadyNoti)){
                        continue;
                    }else{
                        $alreadyNoti[]=$newNotificaiton->id;
                    }*/
                    $newNotificaiton->ticket_id = $ticket->id;
                    $newNotificaiton->title = "";
                    $newNotificaiton->icon = "";
                    $newNotificaiton->body = $ticket->title . '<br/><a target="_blank" href="' . site_url("admin/ticket/details/{$ticket->id}") . '" class="btn btn-xs btn-primary">' . __("View Details") . '</a>';

                    if (strtotime($ticket->opened_time) >= $previous) {
                        $newNotificaiton->title = __("New Ticket Opened");
                        $newNotificaiton->icon = "ticket";
                    } elseif (strtotime($ticket->re_open_time) >= $previous) {
                        $newNotificaiton->title = __("Ticket Re-Opened");
                        $newNotificaiton->icon = "ticket";
                    } elseif (strtotime($ticket->last_reply_time) >= $previous) {
                        if ($ticket->last_replied_by_type == "A") {
                            $newNotificaiton->title = __("Ticket Replied by : %s", getTextByKey($ticket->last_replied_by, $adminUser));
                            $newNotificaiton->icon = "comment";
                        } else {
                            $newNotificaiton->title = __("Ticket Replied by : %s", 'Ticket User');
                            $newNotificaiton->icon = "comment";
                        }
                    } else {
                        continue;
                    }
                    $response[] = $newNotificaiton;
                }
            }
            $returnObj->data = $response;
            $returnObj->chat_data = [];
            if($adminUserData->isChatEnable){
                $chatobjs=new Mchat();
                $query="SELECT chat.id,chat.open_user_id,chat.start_time,chat.end_time,chat_denied.app_user_id 
                        FROM chat LEFT JOIN chat_denied ON chat.id = chat_denied.chat_id AND app_user_id='{$adminUserData->id}'
                        WHERE chat.`status`='Q' AND app_user_id  is null";
                $returnObj->chat_data=$chatobjs->SelectQuery($query);

            }
            $this->session->SetSession("admin_noti_time", time());
            $this->session->SetSession("already_notified", $alreadyNoti);
            echo json_encode($returnObj);
            die;
        }
	    
	     
	}
	public function update_chat_status(){
        $status=GetValue("status");
	    $response=new AjaxConfirmResponse();
	    $bstatus=$status=="Y";
        $adminData=GetAdminData();
        $obj=new stdClass();
        $obj->status=$adminData->isChatEnable;
        if(!empty($status) && Mapp_user::UpdateCurrentUserChatStatus($bstatus)){
            $obj->status=$bstatus;
            $response->DisplayResponse(true,"Updated successfully",$obj);
        }else{
            $response->DisplayResponse(false,"Failed to update",$obj);
        }
    }
	public function test(){
		
	}
}