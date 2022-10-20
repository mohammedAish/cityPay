<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Ticket_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function ticket_delete($param=""){
            //temporary
            //$this->SetConfirmResponse(false, "Delete is temporary disabled");
           // return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, "Invalid Request");
                 return;
            }           
            $mr=new Mticket();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mticket();
                if(Mticket::DeleteByID($param)){
                    AddLog("D","id={$param}", "l003","Ticket_confirm");
                    $this->SetConfirmResponse(true, "Successfully deleted");
                }else{
                    $this->SetConfirmResponse(false, "Delete failed try again");
                }
            }
        }
        
        function ticket_reply($ticket_id=''){
        	$this->output->unset_template();
        	$adminData=GetAdminData();
        	if(!empty($ticket_id)){        		
        			$reply_user_id="";
        			$reply_user_Type="";
        			$ticketObj=Mticket::FindBy("id", $ticket_id);         			
        			$reply_user_id=$adminData->id;
        			$reply_user_Type="A";  
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
        				$hasPayment=false;
        				$is_enable_payment=Mticket_payment::has_enable_payment();
        				if($is_enable_payment){
            				$hasPayment=PostValue("has_payment","N")=="Y";
            				if($hasPayment){
            				    $amount=PostValue("amount",0);
            				    $des=PostValue("payment_des","");
            				    if($amount<1 && $amount>999.99){
            				        $this->SetConfirmResponse(false, "Invalid amount.","",false,"Ticket Replay","ticket");
            				        return;
            				    }
            				    if(empty($des)){
            				        $this->SetConfirmResponse(false, "Payment description is required.","",false,"Ticket Replay","ticket");
            				        return;
            				    }
            				    
            				}
        				}
        				
        				$objReplay=Mticket_reply::add($ticket_id, $reply_user_id, $reply_user_Type, $reply_text, $ticket_status, $is_private, $ticketObj->assigned_on);
        				if($objReplay){
        				    if($hasPayment){
        				        $currency=PostValue("payment_currency","USD");
        				        $paymentObj=Mticket_payment::add($ticket_id, $objReplay->reply_id, $reply_user_id, $amount, $des,$currency);
        				        if($paymentObj){        				            
        				            if(Mticket_reply::update_payment_id($ticket_id, $objReplay->reply_id, $paymentObj->id)){
        				                Mticket_log::AddTicketLog($ticket_id, $reply_user_id, $reply_user_Type, "Payment added", $ticket_status);
        				            }
        				        }
        				    }
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
                            Mticket_reply::SendAdminNotification($ticketObj, $objReplay);
        					Mticket::SetSeenStatus($ticket_id, false);
        					$this->SetConfirmResponse(true, "Successfully added",$replies,false,"Ticket Reply","ticket");
        					return;
        				}else{
        					$msg=GetMsgForAPI();
        					$this->SetConfirmResponse(false, "Ticket reply saved error",$msg,false,"Ticket Reply","ticket");
        					return;
        				}
        					
        			}
        
        			$this->SetConfirmResponse(false, "Ticket reply save failed",null,false,"Ticket Reply","ticket");
        			return;
        
        		
        	}else{
        		$this->SetConfirmResponse(false, "Ticket information is wrong",null,false,"Ticket Reply","ticket");
        	}
        }
         function assign_me($ticket_id=''){
             $this->output->unset_template();
             $adminData=GetAdminData();
             if(!empty($ticket_id)){                
                 if(Mticket::AssignUser($ticket_id, $adminData->id, $adminData->id,true)){
                    $this->SetConfirmResponse(true, "Successfully assign",null,false,"Assign Me","paperclip ");
                    return;
                 }else{
                     $msg=GetMsgForAPI();
                    $this->SetConfirmResponse(false, $msg,null,false,"Assign Me","paperclip ");
                    return;
                 }
             }
             $this->SetConfirmResponse(false, "Failed assign",null,false,"Assign Me","paperclip ");
             return;
         } 
                        
    
}
?>