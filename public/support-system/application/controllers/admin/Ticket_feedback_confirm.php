<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Ticket_feedback_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function ticket_feedback_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mticket_feedback();           
            $mr->ticket_id($param);
            if($mr->Select()){
                //$ur=new Mticket_feedback();
                if(Mticket_feedback::DeleteByKeyValue("ticket_id",$param)){
                    AddLog("D","ticket_id={$param}", "l003","Ticket_feedback_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
                        
    
}
?>