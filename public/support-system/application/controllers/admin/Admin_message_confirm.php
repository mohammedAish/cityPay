<?php 
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Admin_message_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function admin_message_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Madmin_message();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Madmin_message();
                if(Madmin_message::DeleteByKeyValue("id",$param)){
                    AddLog("D","id={$param}", "l003","Admin_message_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
        function reply($id=''){
            $this->output->unset_template();
            $adminData=GetAdminData();
           
            if(!empty($id)){ 
                $message=Madmin_message::FindBy("id", $id);
                if($message->to_user==$adminData->id  || $message->from_user==$adminData->id){
                    $notito_user="";
                    if($message->to_user==$adminData->id ){
                        $notito_user=$message->from_user;
                    }else{
                        $notito_user=$message->to_user;
                    }
                    
                    $reply_text=PostValue("replytext");
                    if(!empty($reply_text)){  
                        $reply_text=nl2br($reply_text);
                        $nreply=new Madmin_message_reply();
                        $nreply->msg_id($id);
                        $nreply->reply_text($reply_text);
                        $nreply->replied_by($adminData->id);
                        $nreply->status("N");
                        if($nreply->Save()){
                            $msg=new Madmin_message();
                            $msg->last_replied($adminData->id);
                            $msg->SetWhereCondition("id", $id);
                            $msg->Update();
                            $replyhtml=get_message_reply_html($nreply);
                            Mapp_notificaiton::AddMessage($notito_user, __("%s replied a message",$adminData->title), _("Subject")." : ".$message->subject, site_url("admin/admin-message/details/{$message->id}"),false,true);
                            $this->SetConfirmResponse(true,"Replied Successfully",$replyhtml,false,"Message","envelope");
                        }else{
                            $this->SetConfirmResponse(false, GetMsgForAPI(),null,false,"Message","envelope");
                        }                        
                        return;
                    }else{
                        $this->SetConfirmResponse(false, "Reply text is empty",null,false,"Message","envelope");
                    }
                }else{
                    $this->SetConfirmResponse(false, "You are not permited to reply on this message",null,false,"Message","envelope");
                }
                
               
            }else{
                $this->SetConfirmResponse(false, "Ticket information is wrong",null,false,"Ticket Replay","ticket");
            }
        }
                        
    
}
?>