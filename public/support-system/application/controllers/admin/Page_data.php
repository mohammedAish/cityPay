<?php 
/** 
 * @since: 19/Sep/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Page_data extends APP_GridDataController{
    
    
	   
	   function page_list(){	
    		if(!ACL::HasPermission("admin/page/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("page-list");    
        	$mainobj=new Mcustom_page();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //custom_page:id,slag_title,title,page-body,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/page/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/page-confirm/page-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/page-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	                	    
        			foreach ($result as &$data){
        				$data->action="";
				        $data->action.=" <button class='btn btn-warning btn-xs app-copy-btn' data-clipboard-text='" . site_url ("site/page/{$data->id}/{$data->slag_title}") ."'>".__("Copy Link")."</button>";
				        $data->action.=" <a class='btn btn-success btn-xs' target='_blank' href='" . site_url ("site/page/{$data->id}/{$data->slag_title}") ."'>".__("View")."</a>";
        				if($has_edit_permission){
        					$data->action.=" <a target='_blank' class='btn btn-info btn-xs' href='" . site_url ("admin/page/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/page-confirm/page-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
				        
					        
				        
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/page-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   $data->added_on=get_user_datetime_default_format($data->added_on);
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>