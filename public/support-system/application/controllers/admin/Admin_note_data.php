<?php 
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Admin_note_data extends APP_GridDataController{
    
    
	   
	   function admin_note_list(){	
    		if(!ACL::HasPermission("admin/admin-note/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("admin-note-list");    
        	$mainobj=new Madmin_note();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //admin_note:id,ref_id,ref_type,user_id,note,entry_date		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/admin-note/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/admin-note-confirm/admin_note-delete");
            	    
            	    
            	    $ref_type_options=$mainobj->GetPropertyOptionsTag("ref_type");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/admin-note/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/admin-note-confirm/admin_note-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   
        			   
						$data->ref_type=getTextByKey($data->ref_type,$ref_type_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>