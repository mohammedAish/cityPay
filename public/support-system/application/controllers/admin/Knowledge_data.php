<?php 
/**
 * Version 1.0.0
 * Creation date: 04/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Knowledge_data extends APP_GridDataController{
    
    
	   
	   function knowledge_list(){	
    		if(!ACL::HasPermission("admin/knowledge/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("knowledge-list");    
        	$mainobj=new Mknowledge();
        		
        	if($this->srcItem=="cat_id"){         	   
        	    if($this->srcText!="0"){
        	        $mainobj->cat_id($this->srcText);
        	    }
        	    $this->srcItem="";
        	    $this->srcText="";
        	}    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //knowledge:id,cat_id,title,k_body,v_count,l_count,d_count,is_stickey,added_by,k_tag,k_soundex,entry_time,last_update_time,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/knowledge/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/knowledge-confirm/knowledge-delete");
            	    
					$has_is_stickey_change_permission=ACL::HasPermission("admin/knowledge-confirm/is-stickey-change");
					$has_status_change_permission=ACL::HasPermission("admin/knowledge-confirm/status-change");
            	    
					$is_stickey_change=$mainobj->GetPropertyOptionsTag("is_stickey");
					$status_change=$mainobj->GetPropertyOptionsTag("status");
					$options_category=Mcategory::getKnowledgeCategoryListHtmlOptionArray('A');
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a  class='btn btn-info btn-xs' href='" . site_url ("admin/knowledge/edit/".$data->id) ."'>Edit</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='Are you sure to delete?' href='" . site_url ("admin/knowledge-confirm/knowledge-delete/".$data->id) ."'>Delete</a>";
        				}
        			   if($has_is_stickey_change_permission){
	                       $data->is_stickey=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='Are you sure to change article pinned status?' href='" . site_url ("admin/knowledge-confirm/is-stickey-change/".$data->id) ."'>".getTextByKey($data->is_stickey,$is_stickey_change)."</a>";
	                   }else{
	                       $data->is_stickey=getTextByKey($data->is_stickey,$is_stickey_change);
	                   }
						if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='Are you sure to change article status?' href='" . site_url ("admin/knowledge-confirm/status-change/".$data->id) ."'>".getTextByKey($data->status,$status_change)."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   if(!empty($data->cat_id)){
						 $data->cat_id=getTextByKey($data->cat_id,$options_category);
	                   }else{
	                       $data->cat_id="-";
	                   }
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>