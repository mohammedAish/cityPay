<?php 
/** 
 * @since: 21/Feb/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Remote_server_data extends APP_GridDataController{
    
    
	   
	   function remote_server_list(){	
    		if(!ACL::HasPermission("admin/remote-server/index")){
    			$this->DisplayGridPermissionDenied();
    			return;
    		}	
    		$this->setDownloadFileName("remote-server-list");    
        	$mainobj=new Mremote_server();	    
            $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
        	if($records>0){
        		$this->SetGridRecords($records);
        	    //remote_server:id,name,login_url,valid_url,button_color,button_txt,server_type,status		
        		$result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
        		if($result){
            	    $has_edit_permission=ACL::HasPermission("admin/remote-server/edit");
            	    $has_delete_permission=ACL::HasPermission("admin/remote-server-confirm/remote_server-delete");
            	    
					$has_status_change_permission=ACL::HasPermission("admin/remote-server-confirm/status-change");
            	    
					$status_change=$mainobj->GetPropertyOptionsTag("status");  
            	    $server_type_options=$mainobj->GetPropertyOptionsTag("server_type");
					            	    
        			foreach ($result as &$data){
        				$data->action="";				
        				if($has_edit_permission){
        					$data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . site_url ("admin/remote-server/edit/".$data->id) ."'>".__("Edit")."</a>";
        				}
        			   if($has_delete_permission){
        					$data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/remote-server-confirm/remote_server-delete/".$data->id) ."'>".__("Delete")."</a>";
        				}
        			   if($has_status_change_permission){
	                       $data->status=" <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='".__("Are you sure to change?")."' href='" . site_url ("admin/remote-server-confirm/status-change/".$data->id) ."'>".__(getTextByKey($data->status,$status_change))."</a>";
	                   }else{
	                       $data->status=getTextByKey($data->status,$status_change);
	                   }
	                   $hasImg=false;
	                   $imageTag="";
					   if($mainobj->hasImageFile($data->id)){
					       $hasImg=true;
					       $imageTag="<img src='".$mainobj->getImageUrl(true,$data->id)."' alt='button-img' class='btn-img' style=' max-height: 13px;margin-right:2px; margin-top:-2px;'>";
					   }
	                   $data->button_txt="<button style='margin:5px;background: ".$data->button_color."; color: ".$data->button_text_color.";' class='btn btn-sm'>".$imageTag.$data->button_txt."</button>";
					   $data->server_type=getTextByKey($data->server_type,$server_type_options);
						  		    
        			}
        		}
        		$this->SetGridData($result);
    		}
    		$this->DisplayGridResponse();	    
	   }
    
}
?>