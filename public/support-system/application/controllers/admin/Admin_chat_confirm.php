<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Admin_chat_confirm extends APP_ConfirmController
{
    function __construct()
    {
        parent::__construct();
    }

    function user_answer($id = "", $answer = "")
    {
        $answer=strtoupper($answer);
        if($answer=="Y"){
            $chat=Mchat::FindBy("id",$id);
            if(empty($chat->current_admin_user)){
                if(Mchat::setAssignMe($id)){
                    $this->SetConfirmResponse(true, "Successfully assigned you",null,false,"Chat Receive Status"," fa fa-thumbs-o-up faa-vertical animated ");
                }else{
                    $this->SetConfirmResponse(false, "Failed to assigning you on this chat",null,false,"Chat Receive Status"," fa fa-thumbs-o-up faa-vertical animated ");
                }
                return;
            }else{
                $userdata=Mapp_user::FindBy("id",$chat->current_admin_user);
                $this->SetConfirmResponseTranslated(true,__("This chat request has been accepted by %s",$userdata->title) ,null,false,__("Chat Receive Status")," fa fa-thumbs-o-up faa-vertical animated ");
                return;
            }
        }else{
            Mchat_denied::setDeniedByMe($id);
        }
        $this->SetConfirmResponse(true, "Successfully updated",null,false,"Chat Receive Status"," fa fa-thumbs-o-up faa-vertical animated ");
    }
    function user_chat_close()
    {
        $id=GetValue("chat_id");
        if(empty($id)){
            $this->SetConfirmResponse(false, "Missing chat id", $id, false, "Closed Failed", " fa fa-thumbs-o-down faa-vertical animated ");
        }else{
            if(Mchat::closeChat($id)){
                $this->session->UnsetSession("chatses".$id);
                $this->SetConfirmResponse(true, "Successfully closed",null,false,"Close Chat Status"," fa fa-thumbs-o-up faa-vertical animated ");
            }else{
                $this->SetConfirmResponse(false, "Failed to close chat",null,false,"Close Chat Status"," fa fa-thumbs-o-down faa-vertical animated ");
            }
        }
    }

}
?>