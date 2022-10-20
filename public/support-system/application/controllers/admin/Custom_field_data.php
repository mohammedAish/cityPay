<?php 
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Custom_field_data extends APP_GridDataController{
    
    
	   
	   function custom_field_list(){	
    		if(!ACL::HasPermission("admin/custom-field/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("custom-field-list");    
        	$mainobj=new Mcustom_field();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //custom_field:id,cat_id,title,help_text,type,opt_json_base,is_required,default_value,is_api_based,api_name,on_submit_api_check,status
		        $this->setOrderByIfEmpty("fld_order","ASC");
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/custom-field/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/custom-field-confirm/custom_field-delete");
            	    
					$has_is_required_change_permission=ACL::HasPermission("admin/custom-field-confirm/is-required-change");
					$has_is_api_based_change_permission=ACL::HasPermission("admin/custom-field-confirm/is-api-based-change");
					$has_on_submit_api_check_change_permission=ACL::HasPermission("admin/custom-field-confirm/on-submit-api-check-change");
					$has_status_change_permission=ACL::HasPermission("admin/custom-field-confirm/status-change");
            	    
					$is_required_change=$mainobj->GetPropertyOptionsTag("is_required");  
					$is_api_based_change=$mainobj->GetPropertyOptionsTag("is_api_based");  
					$on_submit_api_check_change=$mainobj->GetPropertyOptionsTag("on_submit_api_check");  
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	    $type_options=$mainobj->GetPropertyOptionsTag("type");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/custom-field/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/custom-field-confirm/custom_field-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_is_required_change_permission){
	                       $data->is_required=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/custom-field-confirm/is-required-change/".$data->id) ."'>".__(getTextByKey($data->is_required,$is_required_change))."</a>";
	                   }else{
	                       $data->is_required=getTextByKey($data->is_required,$is_required_change);
	                   }
						if($has_is_api_based_change_permission){
	                       $data->is_api_based=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/custom-field-confirm/is-api-based-change/".$data->id) ."'>".__(getTextByKey($data->is_api_based,$is_api_based_change))."</a>";
	                   }else{
	                       $data->is_api_based=getTextByKey($data->is_api_based,$is_api_based_change);
	                   }
						if($has_on_submit_api_check_change_permission){
	                       $data->on_submit_api_check=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/custom-field-confirm/on-submit-api-check-change/".$data->id) ."'>".__(getTextByKey($data->on_submit_api_check,$on_submit_api_check_change))."</a>";
	                   }else{
	                       $data->on_submit_api_check=getTextByKey($data->on_submit_api_check,$on_submit_api_check_change);
	                   }
						if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/custom-field-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
						if($data->type=="L"){
							$data->opt_json_base="";
						}
						$data->fld_order=" <a class='ConfirmAjaxWR' data-msg='".__("Are you sure to change order?")."' href='" . site_url ("admin/custom-field-confirm/order-change/u/".$data->id) ."'><i class='text-green fa fa-2x fa-caret-up'></i> </a> ".$data->fld_order;
						$data->fld_order.=" <a class='ConfirmAjaxWR' data-msg='".__("Are you sure to change order?")."' href='" . site_url ("admin/custom-field-confirm/order-change/d/".$data->id) ."'><i class='text-red fa fa-2x fa-caret-down'></i> </a>";
				        $cats=explode(",",$data->cat_id);
				        $data->cat_id="";
				        $i=0;
						foreach ($cats as $cat) {
							if($i>0){$data->cat_id.="<br/>";}
							if ( $cat == "R" ) {
								$data->cat_id.="<i class='fa fa-wpforms text-success'></i> ";
								$data->cat_id.= "Register From";
							} else {
								$data->cat_id.="<i class='fa fa-dot-circle-o text-success'></i> ";
								if ( $cat == "0" ) {
									$data->cat_id .= "All Category";
								} else {
									$data->cat_id .= Mcategory::getParentStr( $cat );
								}
							}
							$i++;
						}
				        $data->cat_id=rtrim($data->cat_id,', ');
						if(empty($data->opt_json_base)){
							//$data->opt_json_base="-";
						}      			   
						$data->type=getTextByKey($data->type,$type_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>