<?php 
/**
 * Version 1.0.0
 * Creation date: 21/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Canned_msg_data extends APP_GridDataController{
    
    
	   
	   function canned_msg_list(){	
    		if(!ACL::HasPermission("admin/canned-msg/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("canned-msg-list");    
        	$mainobj=new Mcanned_msg();
            $mainobj->canned_type("T");
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
            $users=Mapp_user::FetchAllKeyValue("id", "title");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //canned_msg:id,user_id,title,canned_msg,entry_date,added_by,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/canned-msg/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/canned-msg-confirm/canned_msg-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/canned-msg-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	                	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/canned-msg/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/canned-msg-confirm/canned_msg-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/canned-msg-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   
	                   $data->added_by=getTextByKey($data->added_by,$users);						
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>