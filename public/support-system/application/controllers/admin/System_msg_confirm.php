<?php 
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class System_msg_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess("system_msg_dismiss");
        }
    
	           
	    function system_msg_dismiss($param=""){           
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Msystem_msg();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Msystem_msg();
                if(Msystem_msg::Dismiss($param)){
                    AddLog("D","id={$param}", "l003","System_msg_confirm");
                    $this->SetConfirmResponse(true, __("Successfully Dismissed"));
                }else{
                    $msg=GetMsgForAPI();
                    if(empty($msg)){
                        $msg="Failed dismiss, try again";
                    }
                    $this->SetConfirmResponse(false,__($msg));
                }
            }
        }
}
?>