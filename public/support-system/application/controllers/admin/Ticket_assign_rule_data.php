<?php 
/** 
 * @since: 14/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Ticket_assign_rule_data extends APP_GridDataController{
    
    
	   
	   function ticket_assign_rule_list(){	
    		if(!ACL::HasPermission("admin/ticket-assign-rule/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("ticket-assign-rule-list");    
        	$mainobj=new Mticket_assign_rule();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //ticket_assign_rule:id,cat_ids,rule_type,rule_id,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
        		    $app_users=Mapp_user::FetchAllKeyValue("id","title");
        		    $role_titles=Mrole_list::FetchAllKeyValue("role_id","title");
            	    $has_edit_permission=ACL::HasPermission("admin/ticket-assign-rule/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/ticket-assign-rule-confirm/ticket_assign_rule-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/ticket-assign-rule-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	    $rule_type_options=$mainobj->GetPropertyOptionsTag("rule_type","span","faa-parent animated-hover text-");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/ticket-assign-rule/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/ticket-assign-rule-confirm/ticket_assign_rule-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/ticket-assign-rule-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   $categories_str="-";
	                   if(trim($data->cat_ids)=="*"){
                           $categories_str="<div><span>&#x25CD;</span>".__("All Categories")."</div>";
                       }else{
	                       $categories_str="";
                           $categories=explode(",",$data->cat_ids);
                           foreach ($categories as $ct){
                               $categories_str.="<div><span>&#x25CE;</span> ".Mcategory::getParentStr(trim($ct))."</div>";
                           }
                           
                       }
                       if($data->rule_type=="N"){
                           $data->rule_id="(".__("User").") ".getTextByKey($data->rule_id,$app_users);
                       }elseif($data->rule_type=="A"){
                           $data->rule_id="(".__("Role").") ".getTextByKey($data->rule_id,$role_titles);
                        }
                        $data->cat_ids="<div class=\"text-left rule-cats\"><div>".$categories_str."</div></div>";
						$data->rule_type="<div class=\"rule-js rule-cats\"><div>".getTextByKey($data->rule_type,$rule_type_options)."</div></div>";
						
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>