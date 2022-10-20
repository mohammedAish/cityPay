<?php 
/** 
 * @since: 21/Feb/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Remote_server_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function remote_server_delete($param=""){
            
            if(empty($param)){
                 $this->SetConfirmResponse(false, __("Invalid Request"));
                 return;
            }           
            $mr=new Mremote_server();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mremote_server();
                if(Mremote_server::DeleteById($param)){
                    AddLog("D","id={$param}", "l003","Remote_server_confirm");
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
            $mr=new Mremote_server();  
            $statusChange=$mr->GetPropertyOptionsTag("status");
		         
            $mr->id($param);
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Mremote_server();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("id",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Remote_server");
                    $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
                }else{
                    $this->SetConfirmResponse(false, __("Update failed try again"));
                }   
                
            }
            
        }
                
    
}
?>