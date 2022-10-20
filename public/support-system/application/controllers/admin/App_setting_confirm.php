<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class App_setting_confirm extends APP_ConfirmController{
        function __construct(){
            parent::__construct();
            $this->CheckPageAccess();
        }	           
	    function app_setting_delete($param=""){
            //temporary
            $this->SetConfirmResponse(false, "Check Model First");
            return;
            if(empty($param)){
                 $this->SetConfirmResponse(false, "Invalid Request");
                 return;
            }           
            $mr=new Mapp_setting();           
            $mr->s_key($param);
            if($mr->Select()){
                $ur=new Mapp_setting();
                if($ur->DeleteByKeyValue("s_key",$param)){
                    AddLog("D",$ur->settedPropertyforLog(), "l003","App_setting_confirm", $param);
                    $this->SetConfirmResponse(true, "Successfully deleted");
                }else{
                    $this->SetConfirmResponse(false, "Delete failed try again");
                }
            }
        }
        
        function s_auto_load_change($param=""){
           if(empty($param)){
                 $this->SetConfirmResponse(false, "Invalid Request");
                 return;
            } 
            $s_auto_loadChange=array("N"=>"No","Y"=>"Yes");

            $mr=new Mapp_setting();           
            $mr->s_key($param);
            if($mr->Select("s_auto_load")){
                $newStatus=$mr->s_auto_load=="N"?"Y":"N";
                $uo=new Mapp_setting();
                $uo->s_auto_load($newStatus);
                $uo->SetWhereUpdate("s_key",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->s_auto_load, $s_auto_loadChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","App_setting", "s_auto_load");
                    $this->SetConfirmResponse(true, "Successfully Updated", $status_text);
                }else{
                    $this->SetConfirmResponse(false, "Update failed try again");
                }   
                
            }
            
        }
                
    
}
?>