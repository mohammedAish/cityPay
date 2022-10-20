<?php 
/**
 * Version 1.0.0
 * Creation date: 19/Jun/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Email_templates_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
        function email_templates_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Memail_templates();           
            $mr->k_word($param);
            if($mr->Select()){
                //$ur=new Memail_templates();
                if(Memail_templates::DeleteByKeyValue("k_word",$param)){
                    AddLog("D","k_word={$param}", "l003","Email_templates_confirm");
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
            $mr=new Memail_templates();  
            $statusChange=$mr->GetPropertyOptionsTag("status");
		         
            $mr->k_word($param);
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Memail_templates();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("k_word",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Email_templates");
                    $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
                }else{
                    $this->SetConfirmResponse(false, __("Update failed try again"));
                }   
                
            }            
        }
                        
    
}
?>