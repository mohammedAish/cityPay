<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class App_setting_data extends APP_GridDataController{
    
	   
	   function app_setting_list(){	
    		if(!ACL::HasPermission("admin/app-setting/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("app-setting-list");
        	$mainobj=new Mapp_setting();
        	$mainobj->s_key("  not like '\_%'",true);
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //app_setting:s_key,s_title,s_val,s_type,s_option,s_auto_load		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $hasEditPermission=ACL::HasPermission("admin/app-setting/edit");
            	    $hasDeletePermission=ACL::HasPermission("admin/app-setting-confirm/app_setting-delete");
            	    $hasS_auto_loadChangePermission=ACL::HasPermission("admin/app-setting-confirm/s-auto-load-change");

            	    $s_auto_loadChange=array("N"=>"No","Y"=>"Yes");
                    
        			foreach ($result as &$data){
        			    if(in_array($data->s_type, array('R','D')) && !empty($data->s_option)){
        			        $data->s_val=getTextByKey($data->s_val,Mapp_setting::decoded_options($data->s_option));
        			    }
        				$data->action="";				
        				if($hasEditPermission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . admin_url ("app-setting/edit/".$data->s_key) ."'>Edit</a>";
        				}
        			  /* if($hasDeletePermission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='Are you sure to delete?' href='" . site_url ("app-setting-confirm/app_setting-delete/".$data->s_key) ."'>Delete</a>";
        				}*/
        			   if($hasS_auto_loadChangePermission){
	                       $data->s_auto_load=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='Are you sure to change?' href='" . admin_url("app-setting-confirm/s-auto-load-change/".$data->s_key) ."'>".getTextByKey($data->s_auto_load,$s_auto_loadChange)."</a>";
	                   }else{
	                       $data->s_auto_load=getTextByKey($data->s_auto_load,$s_auto_loadChange);
	                   }
		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>