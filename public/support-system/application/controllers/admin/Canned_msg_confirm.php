<?php 
/**
 * Version 1.0.0
 * Creation date: 21/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Canned_msg_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function canned_msg_delete($param=""){
          
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mcanned_msg();           
            $mr->id($param);
            $mr->canned_type("T");
            if($mr->Select()){
                //$ur=new Mcanned_msg();
                if(Mcanned_msg::DeleteById($param)){
                    AddLog("D","id={$param}", "l003","Canned_msg_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
        
        function status_change($param=""){
           if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }            
            $mr=new Mcanned_msg();  
            $statusChange=$mr->GetPropertyOptionsTag("status");
		         
            $mr->id($param);
            $mr->canned_type("T");
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Mcanned_msg();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("id",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Canned_msg");
                    $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
                }else{
                    $this->SetConfirmResponse(false, __("Update failed try again"));
                }   
                
            }
            
        }
                
    
}
?>