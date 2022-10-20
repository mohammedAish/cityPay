<?php 
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Admin_note_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function admin_note_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Madmin_note();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Madmin_note();
                if(Madmin_note::DeleteByKeyValue("id",$param)){
                    AddLog("D","id={$param}", "l003","Admin_note_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
                        
    
}
?>