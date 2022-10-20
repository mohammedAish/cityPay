<?php 
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Iplist_data extends APP_GridDataController{
    
    
	   
	   function iplist_list(){	
    		if(!ACL::HasPermission("admin/iplist/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("iplist-list");    
        	$mainobj=new Miplist();	
        	//$mainobj->status("<>'N' OR (entry_type='M')",true);
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //iplist:ip,added_on,start_count_time,req_counter,entry_type,status	
        		$this->setOrderByIfEmpty("added_on","DESC");
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
        		   
            	    $has_edit_permission=ACL::HasPermission("admin/iplist/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/iplist-confirm/iplist-delete");
            	    $has_reset_permission=ACL::HasPermission("admin/iplist-confirm/iplist-reset");
            	    $entry_type_options=$mainobj->GetPropertyOptionsTag("entry_type");
            	    $status_options=$mainobj->GetPropertyOptionsTag("status");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/iplist/edit/".$data->ip) ."'>".__("Edit")."</a>";
        				}
        				$status_btn="";
        				if($data->status=="L" || $data->status=="C" || $data->status=="H"){
            				if($has_reset_permission){
            				    $status_btn=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to reset?")."' href='" . site_url ("admin/iplist-confirm/iplist-reset/".$data->ip) ."'> <i class='fa fa-repeat'></i> ".__("Reset IP")."</a>";
            				}
        				}
        			   /*if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/iplist-confirm/iplist-delete/".$data->ip) ."'>".__("Delete")."</a>";
        				}*/
        				if($data->ip!="::1"){
        				    $data->ip="<a data-effect='mfp-move-from-top' class='popupformWR' href='" . admin_url("iplist/detials/".$data->ip) ."'>".$data->ip."</a>";
        				}
        				$data->added_on=get_user_datetime_default_format($data->added_on);
        			    $data->entry_type=getTextByKey($data->entry_type,$entry_type_options);
						$data->status=getTextByKey($data->status,$status_options).$status_btn;
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>