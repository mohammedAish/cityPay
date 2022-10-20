<?php 
/** 
 * @since: 27/May/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Chat_canned_msg_data extends APP_GridDataController{
    
    
	   
	   function chat_canned_msg_list(){	
    		if(!ACL::HasPermission("admin/chat-canned-msg/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("chat-canned-msg-list");    
        	$mainobj=new Mcanned_msg();
            $mainobj->canned_type("C");
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //canned_msg:id,user_id,title,canned_msg,entry_date,added_by,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/chat-canned-msg/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/chat-canned-msg-confirm/chat-canned-msg-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/chat-canned-msg-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	                	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/chat-canned-msg/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/chat-canned-msg-confirm/chat-canned-msg-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/chat-canned-msg-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
						
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>