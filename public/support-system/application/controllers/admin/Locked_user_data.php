<?php 
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Locked_user_data extends APP_GridDataController{
    
    
	   
	   function locked_user_list(){	
    		if(!ACL::HasPermission("admin/locked-user/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("locked-user-list");   
    		$interval_min=30;
    		$start_time=date('Y-m-d H:i:s',strtotime("-{$interval_min} MINUTES"));
    		$end_time=date('Y-m-d H:i:s');
    		
        	$mainobj=new Mhistory_misslogin();	
        	$mainobj->hit_date("BETWEEN '{$start_time}' and '{$end_time}'",true);
        	$mainobj->AddGroupBy("user_id");
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after"); 
        	if($records>0){
        	    $user_datas=Mapp_user::FetchAllKeyValue("id", "user");
        		$this->SetGridRecords($records);        	   
        		$result=$mainobj->SelectAllGridData("user_id, count(*) as total", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after",false);
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/locked-user/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/locked-user-confirm/locked_user-delete");            	                	    
        			foreach ($result as &$data){
        				$data->action="";				
        				
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to unlock?")."' href='" . site_url ("admin/locked-user-confirm/locked-user-delete/".$data->user_id) ."'><i class='fa fa-unlock'></i> ".__("Unlock")."</a>";
        				}
        				
        				$data->user_id=getTextByKey($data->user_id,$user_datas);
        			   
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>