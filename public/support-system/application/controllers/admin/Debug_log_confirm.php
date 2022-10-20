<?php 
/**
 * Version 1.0.0
 * Creation date: 07/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Debug_log_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function debug_log_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mdebug_log();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mdebug_log();
                if(Mdebug_log::DeleteByKeyValue("id",$param)){
                    AddLog("D","id={$param}", "l003","Debug_log_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
        function clean_data() {
	        if ( Mdebug_log::ClearAll()) {
		        AddLog( "D", "clear all", "l003", "Debug_log_confirm" );
		        $this->SetConfirmResponse( true, __( "Successfully Cleared" ) );
	        } else {
		        $this->SetConfirmResponse( false, __( "Clear failed try again" ) );
	        }
        }
                        
    
}
?>