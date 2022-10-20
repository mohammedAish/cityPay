<?php
class App_permission extends APP_Controller{
	function __construct(){
		parent::__construct();
		/*if(!Mapp_user::IsSuperUser()){
			redirect("Dashboard");
		}*/	
		$this->CheckPageAccess();
	}	
	function index(){
		$this->output->unset_template();
		redirect("app-permission/role-access");
	}
	/*protected function AddIntoPageList(){
		// to avoid in page list
	}*/	
	
	function page_list(){
		
	}
	function change_page_title($res_id){
	    $this->SetTitle("Resource");
		$mainobj=new Mpage_list();
		$mainobj->res_id($res_id);
		if(empty($res_id) ||! $mainobj->Select()){
			AddInfo("Page not found. Please try again");	
			$this->DisplayPOPUPMsg();
			return;
		}	
		if(IsPostBack){
			$uobject=new Mpage_list();
			if($uobject->SetFromPostData(false)){
				$uobject->SetWhereUpdate("res_id",$res_id);
				if($uobject->Update()){
					AddLog('A',$uobject->settedPropertyforLog(),"l002","Page List");
					AddInfo("Successfully updated");
					$this->DisplayPOPUPMsg();
					return;
				}
			}
		}
		$this->AddViewData("isUpdate", true);
		$this->AddViewData("mainobj", $mainobj);		
		$this->SetPopUpWidth(600);
		$this->DisplayPOPUP();		
	}
	function user_list(){
        add_css("plugins/dropmenu/css/dropmenu.css");
        add_js("plugins/dropmenu/js/dropmenu.js");
		$this->SetTitle("User List");
		//$this->SetSubtitle("");
		$this->AddBreadCrumb("home", admin_url('dashboard'));
		$this->load->library("jQGrid");
		$this->AddViewData("grid_url", admin_url("app-permission-data-center/user-list"));
		//$this->output->set_template("test");
		$this->Display();
	}
	function add_edit_appuser($editcode=""){	
		$admindata=Mapp_user::GetAdminData();
		if(!empty($editcode)){		   
		    $this->SetTitle("Update User");
		}else{
		    $this->SetTitle("New User");
		    
		}		
		$this->SetPOPUPColClass ( 'col-md-9 ' );
		$this->SetPOPUPIconClass ( "fa fa-user" );
		if(IsPostBack){
			if(empty($editcode)){ //new 
				$nobject=new Mapp_user();
				if($nobject->SetFromPostData()){	
				    if(Mapp_user::check_grade($admindata->role, $nobject->role)){				
    					if($nobject->Save()){
    					    Mapp_user::upload_user_profile_path("user_img",$editcode);
    						AddInfo("Successfully added");
    						AddLog('A',$nobject->settedPropertyforLog(),"l001","APP User");
    						$this->DisplayPOPUPMsg();
    						return;
    					}
				    }else{
				        AddError("You can't create this role's user");
				    }
				}
			}else{ //edit
			    $mainobj=new Mapp_user();			   
		        $mainobj->id($editcode);
		        $mainobj->Select();
		        $isImageUpload=Mapp_user::upload_user_profile_path("user_img",$editcode);
			  
				$uobject=new Mapp_user();
				if($uobject->SetFromPostData(false)){
					$uobject->SetWhereUpdate("id",$editcode);
					if($admindata->id==$editcode){
					    $uobject->UnsetPrperty("role");
					    $uobject->UnsetPrperty("status");
					}
					if(!$uobject->IsSetPrperty("role") || ($uobject->IsSetPrperty("role") && Mapp_user::check_grade($admindata->role, $mainobj->role))){
    					if($uobject->Update()){						
    					    
    					    AddLog('A',$uobject->settedPropertyforLog(),"l002","APP User");
    					    if($isImageUpload){
    					        AddInfo("Successfully updated with profile image");
    					    }else{
    					        AddInfo("Successfully updated");
    					    }
    						
    						$this->DisplayPOPUPMsg();
    						return;
    					}else{
    					    if($isImageUpload){
    					        AddInfo("Only profile image updated");
    					    }
    					}
					}else{
					    AddError("You are not authorise to change this user's role");
					}
				}
			}
			
		}
		$mainobj=new Mapp_user();
		
		if(!empty($editcode)){
			$mainobj->id($editcode);
			if(!$mainobj->Select()){
				AddError("invalid information");
				$this->DisplayPOPUPMsg();
				return;				
			}elseif(!Mapp_user::check_grade($admindata->role ,$mainobj->role)){
			    AddError("You are not authorise to edit this user");
			    
			    $this->DisplayPOPUPMsg();
			    return;
			}
		}else{
		   $ip_data=APPIPdata::get();
		   $mainobj->city($ip_data->city);		    
		   $mainobj->tzone($ip_data->time_zone);
		   $mainobj->zip ( $ip_data->zip_code );
		   $mainobj->country ( $ip_data->country_code );		   
		}
		$this->AddViewData("isRoleDisable", false);
		if(!empty($editcode)){
    		if($admindata->id==$editcode){
    		    $this->AddViewData("isRoleDisable", true);
    		}
		}
		OldFields($mainobj, 'title,email,pass,role,panel,status');
		$this->SetPopupFromMutipart();
		$this->AddViewData("isUpdate", !empty($editcode));
		$this->AddViewData("mainobj", $mainobj);		
		//$this->SetPopUpWidth(600);
		$this->DisplayPOPUP();
	}
	function set_user_pass($id=''){
        $this->SetTitle("Set User Password");
        $this->SetPOPUPColClass ( "col-md-4 col-sm-6" );
        $adminData=GetAdminData();
        if(!$adminData->IsSuperUser()){
            AddError("Only super user can set password");
            $this->DisplayPOPUPMsg();
            return;
        }
        if(empty($id)){
            AddError("User parameter information missing");
            $this->DisplayPOPUPMsg();
            return;
        }
        $mainobj=Mapp_user::FindBy("id",$id);
        if(empty($mainobj)){
            AddError("User information missing");
            $this->DisplayPOPUPMsg();
            return;
        }
        $role=Mrole_list::FindBy("role_id",$mainobj->role);
        if(empty($role) || $role->grade==0){
            AddError("You can't set super user's password");
            $this->DisplayPOPUPMsg();
            return;
        }
        if(IsPostBack){
            $newpassword=PostValue("pass","");
            if(!empty($newpassword)){
                $dbpass=$mainobj->id.$newpassword;
                $isUpdated=false;
                if($mainobj->pass==md5($dbpass)){
                    $isUpdated=true;
                }else{
                   $uobj=new Mapp_user();
                   $uobj->pass($dbpass);
                   $uobj->SetWhereCondition("id",$mainobj->id);
                   if($uobj->Update()){
                       $isUpdated=true;
                       AddLog("U","User ({$mainobj->title}) Password","l002","User Password");
                   }
                }
                if($isUpdated){
                    AddInfo("Password Successfully Updated");
                    $this->DisplayPOPUPMsg();
                    return;
                }
            }else{
                AddError("Please enter password first");
            }
        }
        //$mainobj=new Mapp_user();
        //$this->SetPopupFromMutipart();
        $this->AddViewData("mainobj", $mainobj);
        $this->AddViewData("role", $role);
        $this->AddViewData("isUpdate", true);
        $this->DisplayPOPUP();
    }
	private function upload_user_profile($id){
	    /* $userpath=Mapp_user::get_user_profile_path($id);
	     return move_upload_file_if_ok("user_img", $userpath);*/
	}
	function add_edit_resource($editcode=""){
	    $this->SetTitle("Resource");
		if(IsPostBack){
			if(empty($editcode)){ //new 
				$nobject=new Mpage_list();
				if($nobject->SetFromPostData()){					
					if($nobject->Save()){
						AddInfo("Successfully added");
						$this->DisplayPOPUPMsg();
						return;
					}
				}
			}else{ //edit
				$uobject=new Mpage_list();
				if($uobject->SetFromPostData(false)){
					$uobject->SetWhereUpdate("res_id",$editcode);
					if($uobject->Update()){
						AddInfo("Successfully updated");	
						$this->DisplayPOPUPMsg();
						return;
					}
				}
			}
			
		}
		$mainobj=new Mpage_list();
		
		if(!empty($editcode)){		   
			$mainobj->res_id($editcode);
			if(!$mainobj->Select()){
				AddError("invalid information");
				$this->DisplayPOPUPMsg();
				return;				
			}			
		}
		OldFields($mainobj, 'title,controller,method');
		$this->AddViewData("isUpdate", !empty($editcode));
		$this->AddViewData("mainobj", $mainobj);		
		$this->SetPopUpWidth(600);
		$this->DisplayPOPUP();
	}
	function role_access(){
		$this->SetTitle("Role Access");
		$this->SetSubtitle("Permission");
		$this->AddBreadCrumb("home", admin_url('dashboard'));
		$this->load->library("jQGrid");
		$this->AddViewData("grid_url", admin_url("app-permission-data-center/role-access-list"));
		//$this->output->set_template("test");
		$this->Display();
	}
	
	//Role
	function role_list(){
	    $this->SetTitle("Role  List");
	    $this->SetSubtitle("");
	    $this->AddBreadCrumb("home", base_url());
	    $this->load->library("jQGrid");
	    $this->AddViewData("grid_url", admin_url("app-permission-data-center/role-list"));
	    $this->Display();
	}
	 
	function role_add(){
	    $this->SetTitle("New Role ");
	    $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
	    $this->SetPOPUPIconClass ( "fa fa fa-star " );
	     
	    if(IsPostBack){
	        $nobject=new Mrole_list();
	        if($nobject->SetFromPostData()){
	            if($nobject->Save()){
	                AddInfo("Successfully added");
	                AddLog("A",$nobject->settedPropertyforLog(),"l001","App_permission");
	                $this->DisplayPOPUPMsg();
	                return;
	            }
	        }
	    }
	    $mainobj=new Mrole_list();
	    //$this->SetPopupFromMutipart();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->AddViewData("isUpdate", false);
	    $this->DisplayPOPUP();
	}
	function copy_access(){
	    $this->SetTitle("Copy Role Access");
	    $this->SetPOPUPColClass ( "col-md-4 col-sm-8" );
	    $this->SetPOPUPIconClass ( "fa fa fa-star " );
	     
	    if(IsPostBack){	        
	        $fromRole=PostValue("from_role");
	        $toRole=PostValue("to_role");
	        $total=0;
	        $count=0;
	        if (Mrole_access::CopyAccess($fromRole, $toRole, $total, $count)) {
                if ($total == $count) {
                    AddInfo("Successfully copied");
                } else {
                    AddInfo("{$count} of {$total} copied");
                }
                $this->DisplayPOPUPMsg();
                return;
            }else{
                AddError("{$count} of {$total} failed");
            }
	    }
	    $mainobj=new Mrole_list();
	    //$this->SetPopupFromMutipart();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->AddViewData("isUpdate", false);
	    $this->DisplayPOPUP();
	}
	function reset_access(){
	    $this->SetTitle("Reset Role Access");
	    $this->SetPOPUPColClass ( "col-md-4 col-sm-8" );
	    $this->SetPOPUPIconClass ( "fa fa fa-star " );
	
	    if(IsPostBack){	        
	        $toRole=PostValue("to_role");	       
	        if (Mrole_access::ClearAccessByRole($toRole)) {
	            AddInfo("Successfully resetted");	            
	            $this->DisplayPOPUPMsg();
	            return;
	        }else{
	            AddError("Failed to reset");
	        }
	    }
	    $mainobj=new Mrole_list();
	    //$this->SetPopupFromMutipart();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->AddViewData("isUpdate", false);
	    $this->DisplayPOPUP();
	}
	function role_edit($param_id=""){
	     
	    if(empty($param_id)){
	        AddError("Invalid request");
	        $this->DisplayMSGOnly();
	        return;
	    }
	    $adminData=GetAdminData();
	    $this->SetTitle("Edit Role ");
	    $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
	    $this->SetPOPUPIconClass ( "fa fa fa-star " );
	    if(IsPostBack){
	        $uobject=new Mrole_list();
	        if($uobject->SetFromPostData(false)){
	            if($uobject->IsSetPrperty("status")){
	                if($uobject->status=="D"){
	                   if($adminData->grade!=0){
	                       AddError("A user can be archive by only super user groups");
	                       $uobject->UnsetPrperty("status");
                       }
                    }
                }
	            $uobject->SetWhereUpdate("role_id",$param_id);
	            if($uobject->Update()){
	                AddLog("U",$uobject->settedPropertyforLog(),"l002","App_permission","App_permission");
	                AddInfo("Successfully updated");
	                $this->DisplayPOPUPMsg();
	                return;
	            }
	        }
	    }
	    $mainobj=new Mrole_list();
	    $mainobj->role_id($param_id);
	    if(!$mainobj->Select()){
	        AddError("Invalid request");
	        $this->DisplayMSGOnly();
	        return;
	    }
	    OldFields($mainobj, "pv_id,title,grade");
	    //$this->SetPopupFromMutipart();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->AddViewData("isUpdate", true);
	    $this->DisplayPOPUP("admin/app_permission/role_add");
	}
	private function addController(&$controller,&$specController,&$confirmcontroller,$title,$url){
	    $url=str_replace(base_url(), "", $url);
	    $url=str_replace(array("admin/",".html"), "", $url);
	
	    if(!empty($url)){
	        $obj=explode("/", $url);
	        if(empty($obj[1])){
	            $obj[1]="index";
	        }
	        if(!empty($obj[0]) && !in_array($obj[0],$controller[$title])){
	
	            $controller[$title][]=$obj[0];
	        }
	        if(!empty($obj[0]) && !isset($specController[$title][$obj[0]."-".$obj[1]])){
	            $pageinfo=new stdClass();
	            $pageinfo->controller=$obj[0];
	            $pageinfo->method=$obj[1];
	            $specController[$title][$obj[0]."-".$obj[1]]=$pageinfo;
	        }
	        if(!empty($obj[0]) && !isset($confirmcontroller[$obj[0]."-confirm"])){
	            $confirmcontroller[$obj[0]."-confirm"]=$title;
	        }
	    }
	}
	function sort_controller_title(){
	    $this->output->unset_template();
	    $this->SetTitle("Sort Menu");
	    $this->load->view("admin/menus");
	    $menus=AppMenu::GetMenus(false);
	    $i="01";
	     
	    $controller=[];
	    $specController=[];
	    $confirmcontroller=[];
	    foreach ($menus as $menu){
	        if($menu->type=="L" || empty($menu->url)){
	            continue;
	        }
	        $title=str_pad($i, 2,0,STR_PAD_LEFT).". ".$menu->title;
	        $controller[$title]=[];
	        $this->addController($controller,$specController, $confirmcontroller,$title, $menu->url);
	        if(count($menu->submenus)>0){
	            foreach ($menu->submenus as $smenu){
	                if($smenu->type=="L" || empty($smenu->url)){
	                    continue;
	                }
	                $this->addController($controller,$specController,$confirmcontroller, $title, $smenu->url);
	            }
	        }
	        $i++;
	    }
	    echo "<pre>";
	    //print_r($controller);
	    //print_r($confirmcontroller);
	    foreach ($controller as $key=>$ct){
	        if(empty($ct)){continue;}
	        $in="'".implode("','", $ct)."'";
	        $query="UPDATE page_list set controller_title='{$key}'  where controller in ($in) and panel='A'";
	        $response=0;
	        $obj=new Mpage_list();
	        $response= $obj->SelectQuery2($query);
	        echo "Updated($response): {$query}\n";
	    }
	    foreach ($confirmcontroller as $ct=>$key){
	    if(empty($ct)){continue;}
	    $query="UPDATE page_list set controller_title='{$key}'  where controller='{$ct}' and panel='A'";
	    $response=0;
	    $obj=new Mpage_list();
	    $response= $obj->SelectQuery2($query);
	    echo "Updated($response): {$query}\n";
	    }
	    foreach ( $specController as $key=>$ct){
	    if(empty($ct)){continue;}
	    foreach ($ct as $sub){
	        $query="UPDATE page_list set controller_title='{$key}'  where controller='{$sub->controller}' and method='{$sub->method}' and panel='A'";
	        $response=0;
	        $obj=new Mpage_list();
	        $response= $obj->SelectQuery2($query);
	        echo "Updated($response): {$query}\n";
	        }
	        }
	         
	        echo "</pre>";
	        }
	
}