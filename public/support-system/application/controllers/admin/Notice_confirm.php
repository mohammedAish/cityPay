<?php 
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Notice_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function notice_delete($param=""){
            //temporary
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mnotice();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mnotice();
                if(Mnotice::DeleteById($param)){
                    AddLog("D","id={$param}", "l003","Notice_confirm");
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
            $mr=new Mnotice();  
            $statusChange=$mr->GetPropertyOptionsTag("status");
		         
            $mr->id($param);
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Mnotice();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("id",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Notice");
                    $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
                }else{
                    $this->SetConfirmResponse(false, __("Update failed try again"));
                }   
                
            }
            
        }
                
    
}
?>