<?php 
/**
 * Version 1.0.0
 * Creation date: 07/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Debug_log_data extends APP_GridDataController{
    
    
	   
	   function debug_log_list(){	
    		if(!ACL::HasPermission("admin/debug-log/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("debug-log-list");    
        	$mainobj=new Mdebug_log();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        	    if(empty($this->orderBy)){
        	        $this->orderBy="entry_time";
        	        $this->order="DESC";
        	    };
        		$this->SetGridRecords($records);
        	    //debug_log:id,entry_type,log_type,title,log_data,status,entry_time		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_view_details_permission=ACL::HasPermission("admin/debug-log/view-dtls");
            	    $has_delete_permission=ACL::HasPermission("admin/debug-log-confirm/debug_log-delete");
            	    
            	    
            	    $entry_type_options=$mainobj->GetPropertyOptionsTag("entry_type");
					$log_type_options=$mainobj->GetPropertyOptionsTag("log_type");
					$status_options=$mainobj->GetPropertyOptionsTag("status");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_view_details_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/debug-log/view-dtls/".$data->id) ."'><i class='fa fa-eye'></i> ".__("View Details")."</a>";
        				}
        			  
        			   
        			   
						$data->entry_type=getTextByKey($data->entry_type,$entry_type_options);
						$data->log_type=getTextByKey($data->log_type,$log_type_options);
						$data->status=getTextByKey($data->status,$status_options);
						$data->entry_time=get_user_datetime_default_format($data->entry_time);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>