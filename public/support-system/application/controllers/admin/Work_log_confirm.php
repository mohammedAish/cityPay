<?php 
/** 
 * @since: 10/Aug/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Work_log_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            
        }
    
	           
	    function work_log_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mwork_log();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mwork_log();
                if(Mwork_log::DeleteByKeyValue("id",$param)){
                    AddLog("D","id={$param}", "l003","Work_log_confirm");
                    $this->SetConfirmResponse(true, __("Successfully deleted"));
                }else{
                    $this->SetConfirmResponse(false,__("Delete failed try again"));
                }
            }
        }
                        
    
}
?>