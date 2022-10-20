<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Ticket_feedback_data extends APP_GridDataController{
    
    
	   
	   function ticket_feedback_list(){	
    		if(!ACL::HasPermission("admin/ticket-feedback/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("ticket-feedback-list");    
        	$mainobj=new Mticket_feedback();
        	$ticketObj=new Mticket();
        	$mainobj->Join($ticketObj, "id", "ticket_id");	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //ticket_feedback:ticket_id,f_type,f_msg		
        		$result=$mainobj->SelectAllGridData("f_type,f_msg,ticket_id,title,cat_id,assigned_on,opened_time,last_reply_time,status", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/ticket-feedback/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/ticket-feedback-confirm/ticket_feedback-delete");
            	    
            	    $ticketStatus=$ticketObj->GetPropertyOptionsTag("status");
            	    $f_type_options=$mainobj->GetPropertyOptionsTag("f_type");
            	    $appusers=Mapp_user::FetchAllKeyValue("id", "title");
        			foreach ($result as &$data){
        				$data->action="";				
        				/*if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/ticket-feedback/edit/".$data->ticket_id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/ticket-feedback-confirm/ticket_feedback-delete/".$data->ticket_id) ."'>".__("Delete")."</a>";
        				}*/
        				$data->assigned_on=getTextByKey($data->assigned_on,$appusers);
        				$data->opened_time=get_user_datetime_default_format($data->opened_time);
        			    $data->last_reply_time=get_user_datetime_default_format($data->last_reply_time);
						$data->f_type=getTextByKey($data->f_type,$f_type_options);
						$data->status=getTextByKey($data->status,$ticketStatus);
						$data->f_msg=$data->f_type." ".$data->f_msg;
						$data->title="<a class='' target='_blank' href='" . site_url ("admin/ticket/details/".$data->ticket_id) ."'>".$data->title."</a>";
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>