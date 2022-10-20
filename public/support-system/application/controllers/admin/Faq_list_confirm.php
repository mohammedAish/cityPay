<?php 
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Faq_list_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            
        }
    
	           
	    function faq_list_delete($param=""){


            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mfaq_list();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mfaq_list();
                if(Mfaq_list::DeleteByID($param)){
                    AddLog("D","id={$param}", "l003","Faq_list_confirm");
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
            $mr=new Mfaq_list();  
            $statusChange=$mr->GetPropertyOptionsTag("status");
		         
            $mr->id($param);
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Mfaq_list();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("id",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Faq_list");
                    $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
                }else{
                    $this->SetConfirmResponse(false, __("Update failed try again"));
                }   
                
            }
            
        }
                
    
}
?>