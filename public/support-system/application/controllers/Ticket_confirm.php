<?php
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadConfirmController();
class Ticket_confirm extends APP_ConfirmController{
	
	function ticket_reply($ticket_id=''){
		$this->output->unset_template();
		$userdata=GetUserData();
		if(!empty($ticket_id)){
			if(($userdata || HasTicketSession($ticket_id))){
				$reply_user_id="";
				$reply_user_Type="";
				$ticketObj=null;
				if(!empty($userdata)){
					$reply_user_id=$userdata->id;
					$reply_user_Type="U";	
					$ticketObj=Mticket::FindBy("id", $ticket_id);
					if($ticketObj){
						if($ticketObj->ticket_user!=$userdata->id && $ticketObj->is_public!="Y"){
							$this->SetConfirmResponse(false, "You can't reply on this ticket",null,false,"Ticket Replay","ticket");
							return;
						}
					}
				}else{
					$ticketObj=GetTicketSessionObj($ticket_id);
					$reply_user_id=$ticketObj->ticket_user;
					$reply_user_Type=$ticketObj->user_type;;
				}
				if(!empty($ticketObj) && !empty($reply_user_id) && !empty($reply_user_Type)){
					$reply_text=PostValue("ticket_body","",false,true);
					$ticket_status=PostValue("status","");
					$is_private=PostValue("is_private","Y");
					if(empty($ticket_status)){
						$ticket_status=$ticketObj->status;
					}else{
						//need to update ticket status
						Mticket::UpdateStatus($ticket_id, $ticket_status, $reply_user_id, $reply_user_Type);
					}
					if($ticketObj->is_public!="Y"){
						$is_private="Y";
					}
					$objReplay=Mticket_reply::add($ticket_id, $reply_user_id, $reply_user_Type, $reply_text, $ticket_status, $is_private, $ticketObj->assigned_on);
					if($objReplay){
						$file_upload_list=[];
						$path=Mticket::get_ticket_file_path($ticketObj->ticket_user, $ticket_id,false,$objReplay->reply_id);
						if(app_make_dir($path,755,true)){
							app_uploaded_files_ok($file_upload_list,$path,"");
						}
						
						$logs=Mticket_log::FindAllBy("ticket_id", $ticket_id,[],"entry_time","DESC",1);
						$replies=new stdClass();
						$replies->reply=GetTicketReplyHTMLBy($objReplay->ticket_id, $objReplay->reply_id);
						$log_single=!empty($logs[0])?$logs[0]:null;;
						$log_user="";
						if($log_single){
							$log_user=Mticket_log::get_log_user_name($log_single);
						}
						$replies->log=GetTicketLog($log_single,$log_user);						
						$replies->current_status=$ticket_status;
						$replies->current_status_str=getTextByKey($ticket_status,$ticketObj->GetPropertyOptionsTag("status"));
                        Mticket::SetSeenStatus($ticket_id, true);
						Mticket_reply::SendAdminNotification($ticketObj, $objReplay);
						$this->SetConfirmResponse(true, "Successfully added",$replies,false,"Ticket Replay","ticket");
						return;
					}else {
                        $msg = GetMsgForAPI();
                        $this->SetConfirmResponse(false, "Ticket reply saved error", $msg, false, "Ticket Replay", "ticket");
                        return;
                    }
					
				}
				
				$this->SetConfirmResponse(false, "Ticket reply save failed",null,false,"Ticket Replay","ticket");
				return;
				
			}else{
				$this->SetConfirmResponse(false, "You are not authorise to do this action",null,false,"Ticket Replay","ticket");
			}				
		}else{
			$this->SetConfirmResponse(false, "Ticket information is wrong",null,false,"Ticket Replay","ticket");
		}
	}
}