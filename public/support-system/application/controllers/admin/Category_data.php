<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Category_data extends APP_GridDataController{
    
    
	   
	   function category_list(){	
    		if(!ACL::HasPermission("admin/category/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("category-list");    
        	$mainobj=new Mcategory();
		    //$mainobj->title("GG");
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
		   
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //category:id,title,parent_category,parent_category_path,status	
        	    if(empty($this->orderBy)){
        	    	$this->orderBy='p_sort';
        	    	$this->order='ASC';
        	    }
		       
        		$result=$mainobj->SelectAllGridData("*,(CASE parent_category WHEN 0 THEN id ELSE parent_category_path END) as p_sort ", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after",false);
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/category/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/category-confirm/category-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/category-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");
					$show_on_change=$mainobj->GetPropertyOptionsTag("show_on");
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/category/edit/".$data->id) ."'>Edit</a>";
        				}
        			   if($has_delete_permission){
        					//$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='Are you sure to delete?' href='" . site_url ("admin/category-confirm/category-delete/".$data->id) ."'>Delete</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='Are you sure to change?' href='" . site_url ("admin/category-confirm/status-change/".$data->id) ."'>".getTextByKey($data->status,$status_change)."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   $data->show_on=getTextByKey($data->show_on,$show_on_change);
	                   $data->parent_category=Mcategory::getParentStr($data->parent_category);
						
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>