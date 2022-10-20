<?php 
/**
 * Version 1.0.0
 * Creation date: 19/Jun/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Email_templates_data extends APP_GridDataController{
    
    
	   
	   function email_templates_list(){	
    		if(!ACL::HasPermission("admin/email-templates/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("email-templates-list");    
        	$mainobj=new Memail_templates();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        		$this->setOrderByIfEmpty("grp");
        	    //email_templates:k_word,grp,title,type,subject,content
        		$result=$mainobj->SelectAllGridData("k_word,grp,type,subject,title,status", ["grp"=>"ASC","title"=>"ASC"], "ASC", $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/email-templates/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/email-templates-confirm/email_templates-delete");
            	    
            	    $has_status_change_permission=ACL::HasPermission("admin/email-templates-confirm/status-change");
            	    $status_change=$mainobj->GetPropertyOptionsTag("status");
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' target='_blank' class='btn btn-info btn-xs' href='" . site_url ("admin/email-templates/edit/".$data->k_word) ."'>Edit</a>";
        				}
        			  /* if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='Are you sure to delete?' href='" . site_url ("admin/email-templates-confirm/email_templates-delete/".$data->k_word) ."'>Delete</a>";
        				}*/
        				if($has_status_change_permission){
        				    $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/email-templates-confirm/status-change/".$data->k_word) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
        				}else{
        				    $data->status=getTextByKey($data->status,$status_change);
        				}
        			   
        			     		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>