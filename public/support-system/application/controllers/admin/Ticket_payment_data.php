<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Ticket_payment_data extends APP_GridDataController{
    
    
	   
	   function ticket_payment_list(){	
    		if(!ACL::HasPermission("admin/ticket-payment/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("ticket-payment-list");    
        	$mainobj=new Mticket_payment();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        	    $this->setOrderByIfEmpty("create_date","DESC");
        		$this->SetGridRecords($records);
        	    //ticket_payment:id,ticket_id,reply_id,amount,payment_currency,payment_des,payment_id,created_by,refund_msg,payment_method,create_date,process_date,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/ticket-payment/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/ticket-payment-confirm/ticket_payment-delete");
            	    
            	    $appusers=Mapp_user::FetchAllKeyValue("id", "title");
            	    $payment_method_options=$mainobj->GetPropertyOptionsTag("payment_method");

					$status_options=$mainobj->GetPropertyOptionsTag("status");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				$data->amount.=" ".$data->payment_currency;
        			    //if($data->status=="A"){
        			       $data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . admin_url ("ticket-payment/details/".$data->id) ."'><i class='fa fa-eye'></i> ".__("Details")."</a>";
        			    //}        			   
						$data->payment_method=getTextByKey($data->payment_method,$payment_method_options);
						$data->status=getTextByKey($data->status,$status_options);
						$data->created_by=getTextByKey($data->created_by,$appusers);
						$data->create_date=get_user_datetime_default_format($data->create_date);
						if($data->process_date!="0000-00-00 00:00:00"){
						  $data->process_date=get_user_datetime_default_format($data->process_date);
						}else{
						  $data->process_date="-";
						}
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>