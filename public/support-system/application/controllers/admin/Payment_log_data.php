<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Payment_log_data extends APP_GridDataController{
    
    
	   
	   function payment_log_list(){	
    		if(!ACL::HasPermission("admin/payment-log/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("payment-log-list");    
        	$mainobj=new Mpayment_log();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        		$this->setOrderByIfEmpty("process_time","DESC");
        	    //payment_log:payment_id,ticket_payment_id,amount_cr,amount_dr,first_2_digit,last_4_digit,transaction_id,process_time,transaction_time,update_time,result,result_msg,note,response_reason,status,transation_type,paid_by,pp_payer_email,name_on_card,country,approval_code,ref_transaction_id		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/payment-log/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/payment-log-confirm/payment_log-delete");
            	    
            	    
            	    $paid_by_options=$mainobj->GetPropertyOptionsTag("paid_by");
					            	    
        			foreach ($result as &$data){
        				$data->action="";	        			   
						$data->paid_by=getTextByKey($data->paid_by,$paid_by_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>