<?php 
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Faq_category_data extends APP_GridDataController{
    
    
	   
	   function faq_category_list(){	
    		if(!ACL::HasPermission("admin/faq-category/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("faq-category-list");    
        	$mainobj=new Mfaq_category();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //faq_category:id,name,entry_date,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/faq-category/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/faq-category-confirm/faq_category-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/faq-category-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	                	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/faq-category/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/faq-category-confirm/faq_category-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/faq-category-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
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