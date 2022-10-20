<?php 
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Notice_data extends APP_GridDataController{
    
    
	   
	   function notice_list(){	
    		if(!ACL::HasPermission("admin/notice/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("notice-list"); 
    		   
        	$mainobj=new Mnotice();	
    	   
	        if($this->srcItem=="start_date" || $this->srcItem=="end_date"){        	            
	            $mainobj->{$this->srcItem}("BETWEEN '{$this->fromDate}' AND '{$this->toDate}'",true);
	            $this->srcItem="";
	        }
        	    
        	/*if(!empty($this->multiparam)){
        	    foreach ($this->multiparam as $key=>$value){
        	        if($key=="start_date" || $key=="end_date"){        	            
        	            $mainobj->$key("BETWEEN '{$value['form']} AND {$value['to']}'",true);
        	        }else{
        	            if(property_exists($mainobj, $key)){
        	               $mainobj->$key($value); 	
        	            }
        	        }
        	    }
        	} */   
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
            $users=Mapp_user::FetchAllKeyValue("id", "title");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //notice:id,msg,start_date,end_date,msg_for,added_by,status		
        	    
        		$result=$mainobj->SelectAllGridData("id,title,start_date,end_date,msg_for,added_by,added_on,status", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, [],"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/notice/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/notice-confirm/notice-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/notice-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	    $msg_for_options=$mainobj->GetPropertyOptionsTag("msg_for");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/notice/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/notice-confirm/notice-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/notice-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
					   $data->added_on=get_user_datetime_default_format($data->added_on);
        			   $data->added_by=getTextByKey($data->added_by,$users);
					   $data->msg_for=getTextByKey($data->msg_for,$msg_for_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>