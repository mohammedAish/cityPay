<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Notification_data extends APP_GridDataController{
    
    
	   
	   function notification_list($type='N'){	
    		if(!ACL::HasPermission("admin/notification/show-list")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$adminData=GetAdminData();
    		if(!$adminData){
    		    $this->DisplayGridPermissionDenied();
    		    return;
    		}
    		$this->setDownloadFileName("notification-list");    
        	$mainobj=new Mapp_notificaiton();	
        	$mainobj->user_id($adminData->id);
        	$mainobj->entry_type($type);
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){        	    
        	    $this->setOrderByIfEmpty("entry_time", "DESC");
        		$this->SetGridRecords($records);
        	    //app_notificaiton:id,user_id,title,msg,entry_type,entry_link,n_counter,is_popup_link,view_time,entry_time,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/notification/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/notification-confirm/notification-delete");
            	    
					$has_is_popup_link_change_permission=ACL::HasPermission("admin/notification-confirm/is-popup-link-change");
            	    
					$is_popup_link_change=$mainobj->GetPropertyOptionsTag("is_popup_link");  
            	    $entry_type_options=$mainobj->GetPropertyOptionsTag("entry_type");
					$status_options=$mainobj->GetPropertyOptionsTag("status");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				
        				$data->action.="<a data-effect='mfp-move-from-top' class='".($data->is_popup_link=="Y"?"popupformWR":"")." btn btn-info btn-xs' href='" . admin_url ("notification/show/".$data->id) ."'>".__("Details")."</a>";
        			    $data->entry_time=app_time_elapsed_string( $data->entry_time);
						$data->entry_type=getTextByKey($data->entry_type,$entry_type_options);
				        $data->main_status=$data->status;
						$data->status=getTextByKey($data->status,$status_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>