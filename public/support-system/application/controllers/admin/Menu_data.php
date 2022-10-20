<?php 
/**
 * Version 1.0.0
 * Creation date: 28/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Menu_data extends APP_GridDataController{
    
    
	   
	   function menu_list(){	
    		if(!ACL::HasPermission("admin/menu/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("menu-list");    
        	$mainobj=new Mmenu();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //menu:id,parent_id,title,href,view_counter,is_new_window,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/menu/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/menu-confirm/menu-delete");
            	    
					$has_is_new_window_change_permission=ACL::HasPermission("admin/menu-confirm/is-new-window-change");
					$has_status_change_permission=ACL::HasPermission("admin/menu-confirm/status-change");
            	    
					$is_new_window_change=$mainobj->GetPropertyOptionsTag("is_new_window");  
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	                	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/menu/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/menu-confirm/menu-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_is_new_window_change_permission){
	                       $data->is_new_window=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/menu-confirm/is-new-window-change/".$data->id) ."'>".__(getTextByKey($data->is_new_window,$is_new_window_change))."</a>";
	                   }else{
	                       $data->is_new_window=getTextByKey($data->is_new_window,$is_new_window_change);
	                   }
						if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/menu-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   
	                   $data->title="<i class='fa ".$data->text_icon."'></i> ".$data->title;
						
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>