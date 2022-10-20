<?php 
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Locked_user_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function locked_user_delete($param=""){           
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mhistory_misslogin();           
            $mr->user_id($param);
            if($mr->Select()){
                //$ur=new Mhistory_misslogin();
                if(Mhistory_misslogin::clear_history_by($param)){
                    AddLog("D","={$param}", "l003","Locked_user_confirm");
                    $this->SetConfirmResponse(true, __("Successfully unlocked"));
                }else{
                    $this->SetConfirmResponse(false,__("Unlock failed try again"));
                }
            }
        }
                        
    
}
?>