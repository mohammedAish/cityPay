<?php
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();
class App_permission_data_center extends APP_GridDataController {	
	function __construct(){
		parent::__construct();
		//$this->output->set_template('login');
		$this->output->unset_template();
		
	}	
	function role_access_list(){	
		if(!ACL::HasPermission("admin/app-permission/role-access")){
			$this->DisplayGridPermissionDenied();
			return ;
		}
		$contoller_title='';
		if($this->srcItem=="controller_title"){
			$contoller_title=$this->srcText;
		}
		if(!empty($contoller_title)){
			$this->SetGridRecords(Mpage_list::FetchCountAll('controller_title',$contoller_title,["status"=>"A"]));
		}else{
			$this->SetGridRecords(Mpage_list::FetchCountAll('','',["status"=>"A"]));
		}	
		$roles=null;
		
		$result=Mrole_access::getAllRoleAccess($this->rows, $this->limitStart,$roles,"controller_title",$contoller_title,'A','A');
		
		if($result){
		    $rowid=$this->limitStart+1;	
		    $hasChangeAccess=false;
		    if(ACL::HasPermission("admin/app-permission-confirm/change-role-access")){
		        $hasChangeAccess=true;
		    }	    
			foreach ($result as &$data){	
			    $data->id=$rowid++;
				foreach ($roles as $role){
					$key=$role->role_id;
					if($role->grade==0){
						$data->$key="Y";
						$data->$key="<i class='grid-icon  fa fa-".($data->$key=="Y"?"check text-success":"times text-danger")."'></i>";						
					}else{
					    if($hasChangeAccess){
						  $data->$key="<a oncompleted='response_process' class='ConfirmAjaxWR' data-msg='Are you sure?' href='" . admin_url ("app-permission-confirm/change-role-access/pid/".$data->res_id."/rid/".$role->role_id) ."'><i class='grid-icon  fa fa-".($data->$key=="Y"?"check text-success":"times text-danger")."'></i></a>";
					    }else{
					        $data->$key="<i class='grid-icon  fa fa-".($data->$key=="Y"?"check text-success":"times text-danger")."'></i>";
					    }
					}
					
				}
				if(ENVIRONMENT=="development"){
				    $data->title="<a data-effect='mfp-move-from-top' class='popupformWR ' href='" . admin_url ("app-permission/change-page-title/".$data->res_id) ."'>{$data->title}</a>";
				}
			}
		}
		//$this->SetGridRecords(500);
		//$result=array_merge($result,$result,$result,$result,$result,$result);
		$this->SetGridData($result);
		$this->DisplayGridResponse();
	}
	function user_list(){
	    if(!ACL::HasPermission("admin/app-permission/user-list")){
			$this->DisplayGridPermissionDenied();
			return ;
		}		
		$mainobj=new Mapp_user();
		if(empty($this->orderBy)){
			$this->orderBy="ID";
			$this->order="ASC";
		}
        $mainobj->status("!='D'",true);
		$admindata=GetAdminData();
		$records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
		$roleobj=new Mrole_list();
		if($admindata->grade!=0){
		$roleobj->grade(">={$admindata->grade}",true);
		}
		$mainobj->Join($roleobj, "role_id", "role","left");
		$this->SetGridRecords($records);
		//$ro=new Mrole_list();
		//$mainobj->Join($ro, "role_id", "role");
		$result=$mainobj->SelectAll("id,user,title,email,role,panel,status,grade", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
		$roles=Mrole_list::FetchAllKeyValue("role_id", "title");	
		$status=$mainobj->GetPropertyOptionsTag('status');
		$panels=array("A"=>"Admin","U"=>"User","C"=>"Call Center");
		if($result){
			foreach ($result as &$data){
				$data->action="";
				$data->pass="";
                $bkstatus=$data->status;
                if($bkstatus!="D" || $admindata->grade==0) {
                    if ($bkstatus!="D" &&  ACL::HasPermission("admin/app-permission/add-edit-appuser")) {

                        $data->action .= "<li><a data-effect='mfp-move-from-top' class='popupformWR' href='" . admin_url("app-permission/add-edit-appuser/" . $data->id) . "'><i class='fa fa-edit'></i>" . __("Edit") . "</a></li>";
                        if ($data->id != $admindata->id) {
                            $data->action .= "<li role='separator' class='divider'></li>";
                            $data->action .= "<li><a data-effect='mfp-move-from-top' class='popupformWR' data-msg='Are you sure?' href='" . admin_url("app-permission/set-user-pass/" . $data->id) . "'><i class='fa fa-circle'></i> " . __("Set Password") . "</a></li>";
                            $data->action .= "<li><a class='ConfirmAjaxWR' data-msg='Are you sure?' href='" . admin_url("app-permission-confirm/reset-user-pass/uid/" . $data->id) . "'><i class='fa fa-envelope-o'></i>" . __("Email Password Reset Link") . "</a></li>";
                            $data->action .= "<li role='separator' class='divider'></li>";
                        }
                    }
                    if($data->id!=$admindata->id && $admindata->grade==0 && $bkstatus!="D" && ACL::HasPermission("admin/app-permission-confirm/archive-user")){
                        $data->action .= "<li><a class='ConfirmAjaxWR text-danger' data-msg='".__("Are you sure to delete? If you delete then you can not revert")."' href='" . admin_url("app-permission-confirm/archive-user/" . $data->id) . "'><i class='fa fa-trash '></i> ".__("Delete")."</a></li>";
                    }
                    if (!empty($data->action)) {
                        $data->action = "<button class='btn btn-xs btn-default app-grid-dropdown' data-content='#dpdown_" . $data->id . "' type='button' id='d" . $data->id . "'>					   
					   <i class='fa fa-chevron-circle-down'></i> <span class='hidden-sm'>&nbsp; ".__("Menu")."</span>
					   </button>
					   <ul id='dpdown_" . $data->id . "' class='app-dropdownmenu'>
					   " . $data->action . " </ul>";
                        clean_grid_text($data->action);
                    }
                }
				$data->role=!empty($roles[$data->role])?$roles[$data->role]:$data->role;
				$data->status=!empty($status[$data->status])?$status[$data->status]:$data->status;
				if($bkstatus!="D" && $data->id!=$admindata->id && ACL::HasPermission("admin/app-permission-confirm/change-user-status")){
                    $data->status = "<a class='ConfirmAjaxWR' data-msg='Are you sure?' href='" . admin_url("app-permission-confirm/change-user-status/uid/" . $data->id) . "'>" . $data->status . "</a>";
                }
				$data->panel=!empty($panels[$data->panel])?$panels[$data->panel]:$data->panel;
			}
		}
		$this->SetGridData($result);
		$this->DisplayGridResponse();
	}
	//Role
	function role_list(){
	    if(!ACL::HasPermission("admin/app-permission/role-list")){
	        $this->DisplayGridPermissionDenied();
	        return;
	    }
	    $admindata=GetAdminData();
	    $mainobj=new Mrole_list();
	    $mainobj->grade(">=".$admindata->grade,true);
	    $records=$mainobj->CountALL($this->srcItem, $this->srcText,$this->multiparam,"after");
	    if($records>0){
	        $this->SetGridRecords($records);
	        //role_list:pv_id,role_id,title,grade
	        $result=$mainobj->SelectAllGridData("", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam,"after");
	        if($result){
	            $hasEditPermission=ACL::HasPermission("admin/app-permission/role-edit");
	            $hasDeletePermission=ACL::HasPermission("admin/app-permission-confirm/role-delete");
	             
	             
	            foreach ($result as &$data){
	            	$data->grade=$data->grade==0?"<i class='text-success fa fa-2x fa-check-circle-o'></i>":"<i class='text-danger fa fa-2x fa-times-circle-o'></i>";
	            	$data->action="";
	            	if($data->role_id!="R1"){	                
		                if($hasEditPermission){
		                    $data->action.="<a data-effect='mfp-move-from-top' class='popupformWR btn btn-info btn-xs' href='" . admin_url ("app-permission/role-edit/".$data->role_id) ."'>Edit</a>";
		                }
		                if($hasDeletePermission){
		                    $data->action.=" <a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='Are you sure to delete?' href='" . admin_url ("app-permission-confirm/role-delete/".$data->role_id) ."'>Delete</a>";
		                }
	            	}
	
	            }
	        }
	        $this->SetGridData($result);
	    }
	    $this->DisplayGridResponse();
	}
}