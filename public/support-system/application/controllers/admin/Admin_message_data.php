<?php 
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Admin_message_data extends APP_GridDataController{
    
    
	   
	   function admin_message_list(){	
    		if(!ACL::HasPermission("admin/admin-message/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$adminData=GetAdminData();
    		$this->setDownloadFileName("admin-message-list");    
        	$mainobj=new Madmin_message();
        	$mainobj->to_user($adminData->id);	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        	    $users=Mapp_user::FetchAllKeyValue("id", "title");
        		$this->SetGridRecords($records);
        		if(empty($this->orderBy)){
        		    $this->orderBy="entry_time";
        		    $this->order="DESC";
        		}
        	    //admin_message:id,subject,entry_time,body,to_user,from_user,last_replied,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/admin-message/edit");
            	    $has_details_permission=ACL::HasPermission("admin/admin-message/details");
            	    $has_delete_permission=ACL::HasPermission("admin/admin-message-confirm/admin_message-delete");
            	    
            	    
            	    $status_options=$mainobj->GetPropertyOptionsTag("status");
            	    $users=Mapp_user::FetchAllKeyValue("id", "title");
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/admin-message/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        				if($has_details_permission){
        					$data->action.="<a  class='btn btn-info btn-xs' href='" . site_url ("admin/admin-message/details/".$data->id) ."'><i class='fa fa-envelope'></i> ".__("Details")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/admin-message-confirm/admin_message-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        				if(!empty($data->last_replied)){
        				    $data->last_replied=getTextByKey($data->last_replied,$users);
        				}
        				$data->from_user=getTextByKey($data->from_user,$users);
        			   $data->entry_time=get_user_datetime_default_format( $data->entry_time);
					   $data->status=getTextByKey($data->status,$status_options);						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
	   function admin_message_sent(){
	       if(!ACL::HasPermission("admin/admin-message/sent")){
	           $this->DisplayGridPermissionDenied();
	           return;
	       }
	       if(empty($this->orderBy)){
	           $this->orderBy="entry_time";
	           $this->order="DESC";
	       }
	       $adminData=GetAdminData();
	       $this->setDownloadFileName("admin-message-list");
	       $mainobj=new Madmin_message();
	       $mainobj->from_user($adminData->id);
	       $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
	       if($records>0){
	           $users=Mapp_user::FetchAllKeyValue("id", "title");
	           $this->SetGridRecords($records);
	           //admin_message:id,subject,entry_time,body,to_user,from_user,last_replied,status
	           $result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
	           if($result){
	               $has_edit_permission=ACL::HasPermission("admin/admin-message/edit");
	               $has_delete_permission=ACL::HasPermission("admin/admin-message-confirm/admin_message-delete");
	                
	                
	               $status_options=$mainobj->GetPropertyOptionsTag("status");
	   
	               foreach ($result as &$data){
	                   $data->action="";
	                   /*if($has_edit_permission){
	                       $data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/admin-message/edit/".$data->id) ."'>".__("Edit")."</a>";
	                   }
	                   if($has_delete_permission){
	                       $data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/admin-message-confirm/admin_message-delete/".$data->id) ."'>".__("Delete")."</a>";
	                   }*/
	                   
	                   $data->action.="<a  class='btn btn-info btn-xs' href='" . site_url ("admin/admin-message/details/".$data->id) ."'><i class='fa fa-envelope'></i> ".__("Details")."</a>";
	                   
	                   $data->to_user=getTextByKey($data->to_user,$users);
	                   if(!empty($data->last_replied)){
        				    $data->last_replied=getTextByKey($data->last_replied,$users);
        				}
	                   $data->entry_time=get_user_datetime_default_format( $data->entry_time);
	                   $data->status=getTextByKey($data->status,$status_options);
	               }
	           }
	           $this->SetGridData($result);
	       }
	       $this->DisplayGridResponse();
	   }
    
}
?>