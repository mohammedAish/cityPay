<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends APP_Controller {
	public $current_user_type=null;
	public $current_user_session=null;
	function __construct(){
		parent::__construct();
		$this->CheckPageAccess();
		$this->current_user_type=GetCurrentUserType();
		$this->current_user_session=GetAppBaseUserData();		
	}
	public function change_password(){
		$mainobj=null;
		$is_skip_old=false;
		if($this->current_user_type=="AD"){			
			$mainobj=new Mapp_user();
		}elseif($this->current_user_type=="CU"){			
			$mainobj=new Msite_user();
			$userdata=GetUserData();
			if($userdata->is_skip_old_pass){
				$is_skip_old=true;
				
			}
		}	
		$this->SetTitle("Change password of %s",$this->current_user_session->title." ");
		$this->SetPOPUPColClass ( "col-md-4 col-sm-6" );
		$this->SetPOPUPIconClass ( "fa fa-hashtag  " );
		if(IsPostBack){			
			$oldPassword=PostValue("old_password");
			$newpasswordPassword=PostValue("password");
			$confimpassword=PostValue("cpass");
			if($oldPassword==$newpasswordPassword){
			    AddError("Old password and new password is same");
			    $this->DisplayPOPUPMsg();			    
			}else{
    			if($mainobj){
    				if($mainobj->ChangePassoword($this->current_user_session->id, $oldPassword, $newpasswordPassword, $confimpassword)){
    					$this->DisplayPOPUPMsg();
    					return;
    				}
    			}else{
    				AddError("Something went wrong. Please try again later");
    				$this->DisplayPOPUPMsg();
    				return;
    			}
			}
		}
		$this->AddViewData("is_skip_old_pass", $is_skip_old);
		$this->DisplayPOPUP();
	}	
	function online(){
	    $this->output->unset_template();
	    $response=new AjaxConfirmResponse();
	    Muser_online_log::CheckOnlineStatus();
	    $response->DisplayResponse(false, "updated");	   
	}
	protected function AddIntoPageList(){
		// to avoid in page list
	}
	
	
	
	
}
