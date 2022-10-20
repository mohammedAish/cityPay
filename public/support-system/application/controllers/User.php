<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends APP_Controller {

	function __construct(){
		parent::__construct();
		$this->output->set_template('login');
		
	}
	
	public function index()
	{		
		/*$this->SetViewName("login");
		$this->Login();	*/
		redirect('user/login');	
	}	
	protected function AddIntoPageList(){
		// to avoid in page list
	}
	/*function login(){	
		if(IsPostBack){
			$username=$this->input->post('username',TRUE);
			$password=$this->input->post('password',TRUE);
			if(Msite_user::CheckLogin($username, $password)){
				redirect('member/dashboard');
			}			
		}
		add_css("css/fade-bg.css");
		/*$this->load->library("APP_Google_API");
		APP_Google_API::$gClient->setRedirectUri(site_url("user/response-from-google"));
		if(!APP_Google_API::$hasAccessToken){
			$authUrl = APP_Google_API::$gClient->createAuthUrl();
		}else{
			$authUrl=site_url("user/login-with-google");
		}
		$this->AddViewData("google_url", $authUrl);		
		$this->Display();		
	}*/
	public function login($redirect_token=''){
	   
	    $rurl=GetValue("rurl");
		//$this->output->clearModules();
		$redirect_url=get_redirect_url_by_token($redirect_token);
		$customer_registered = false;
		$isEnableDefaultLogin=Mapp_setting::GetSettingsValue("dlogin_enable","N")=="N";
		if($isEnableDefaultLogin){
		  $this->SetTitle ( "User Login" );
		}else{
		  $this->SetTitle ( "User Login Using" );
		}
		$this->SetPOPUPColClass ( 'col-sm-4' );
		$this->SetPOPUPIconClass ( "fa fa-unlock-alt  faa-pulse animated-hover " );
		if(!$this->input->is_ajax_request()){
		    $this->Display('user/login_shower');
		    return;
		}
		
		// $this->SetSubtitle("Ready to get best offers? Let's get started!");
		$mainobj = new Msite_user() ;
		if (IsPostBack) {
		    if(!$isEnableDefaultLogin){		      
		        AddError("Default login disabled by admin");
		        $this->DisplayPOPUPMsg();
		        return;
		    }
			$is_captcha_enable=Mapp_setting::GetSettingsValue("is_cptcha_client_login","N")=="Y";
			$is_captcha_ok=true;
			$username=$this->input->post('email',TRUE);
			$password=$this->input->post('pass',TRUE);
			if (!filter_var ( $username, FILTER_VALIDATE_EMAIL )) {
				$is_captcha_enable=false;
				$is_captcha_ok=false;
				AddError("Not a valid email address");
			}
			if($is_captcha_enable){
				$is_captcha_ok=AppCaptcha::is_valid_captcha();
			}
			if($is_captcha_ok){
				//AddInfo ( "Registration successful" );
				
				if(Msite_user::CheckLogin($username, $password,$redirect_url)){
				    if(!empty($rurl)){
				        $redirect_url=$rurl;
				    }elseif(empty($redirect_url)){
						$redirect_url=site_url("client/panel/dashboard");
					}
					$this->AddViewData("redirect_url", $redirect_url);
					$this->DisplayPOPUP('user/login_success');				
					return;
				}
			}
		}
		
		$this->load->library('hybridauth');
		// Build a list of enabled providers.
		$providers = array();
		foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
		{
			$providers[$provider_id] = "social/login/{$provider_id}";
		}
		/*if(count($providers)>4){
		    $this->SetPOPUPColClass ( 'col-md-4' );
		}*/
		
		$this->AddViewData ( "mainobj", $mainobj );
		$this->AddViewData ( "providers", $providers );
		$this->AddViewData ( "redirect_token", $redirect_token );
		$this->AddViewData ( "isEnableDefaultLogin", $isEnableDefaultLogin );
		$this->DisplayPOPUP ();
		 
	}
	public function login_register($redirect_url=''){
		//$this->output->clearModules();
	
		$customer_registered = false;
		$this->SetTitle ( "Open Ticket" );
		$this->SetPOPUPColClass ( 'col-md-10 col-lg-7' );
		$this->SetPOPUPIconClass ( "fa fa-ticket  faa-pulse animated-hover " );
	
	
		// $this->SetSubtitle("Ready to get best offers? Let's get started!");
		
	
		$this->load->library('hybridauth');
		// Build a list of enabled providers.
		$providers = array();
		foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
		{
			$providers[$provider_id] = "social/login/{$provider_id}";
		}		
		$this->AddViewData ( "providers", $providers );		
		$this->DisplayPOPUP ();
			
	}
	public function register($redirect_url=''){
		//$this->output->clearModules();
	    $isEnableDefaultRegi=Mapp_setting::GetSettingsValue("regi_enable","N")=="N";
	   
		$customer_registered = false;
		$this->SetTitle ( "User Registration" );
		if(!$isEnableDefaultRegi){
		     AddError("Default Registration disabled by admin");
		     $this->DisplayPOPUPMsg();
		     return;
		}
		$this->SetPOPUPColClass ( 'col-md-5' );
		$this->SetPOPUPIconClass ( "fa fa-wpforms  faa-pulse animated-hover " );
		if(!$this->input->is_ajax_request()){
		    $this->Display('user/register_shower');
		    return;
		}	
		// $this->SetSubtitle("Ready to get best offers? Let's get started!");
		$custom_fields=Mcustom_field::getCustomFieldsByCategory('R');
		
		$mainobj = new Msite_user() ;
		if (IsPostBack) {
			//AddInfo ( "Registration successful" );
		    $nobject=new Msite_user();
		    $isCaptchaOk=true;
			if(Mapp_setting::GetSettingsValue("is_cptcha_client_regi","N")=="Y"){
				$isCaptchaOk=AppCaptcha::is_valid_captcha();
			}
			if($isCaptchaOk && $nobject->SetFromPostData(true)){
			    $isOk=true;
			    $isUpdate=false;
			    $oobj=new Msite_user();
			    $oobj->email($nobject->email);
			    if($oobj->Select()){
			        if($oobj->user_type!="G"){
			            $isOk=false;
			            AddError("User already creaded.");
			        }else{
			            $nobject->user_type("U");
			            $nobject->SetWhereCondition("id", $oobj->id);
			            $isUpdate=true;
			        }
			    }
				$customFieldsNeedToBeSave=[];
			    foreach ($custom_fields as $cf){
			    	if(!Mcustom_field::is_ok_custom_value($cf,$customFieldsNeedToBeSave,false)){
					    $isOk=false;
				    }
			    }
				if($isOk && ($isUpdate && $nobject->Update()|| (!$isUpdate && $nobject->Save()))){
					$is_saved_all_ok=true;
					foreach ($customFieldsNeedToBeSave as $customTicketObj){
						//$customTicketObj=new Msite_user_custom_field();
						$customTicketObj->user_id($nobject->id);
						if(!$customTicketObj->Save()){
							$is_saved_all_ok=false;
						}
					}
					AddInfo("Successfully added");
					AddLog("A",$nobject->settedPropertyforLog(),"l001","");
					Msite_user::SetUserSessionById($nobject->id,true);	
					$redirect_url=get_redirect_url_by_token($redirect_url);
					$this->AddViewData("redirect_url", $redirect_url);
					$this->DisplayPOPUP('user/registration_success');
					return;
				}
			}
		}	
		$this->load->library('hybridauth');
		$providers = array();
		foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
		{
		    $providers[$provider_id] = "social/login/{$provider_id}";
		}
		
		$this->AddViewData ( "providers", $providers );
		$this->AddViewData ( "mainobj", $mainobj );
		$this->AddViewData("custom_fields", $custom_fields);
		$this->AddViewData ( "redirect_token", $redirect_url );
		$this->DisplayPOPUP ();
			
	}
	public function forget($redirect_url=''){
		//$this->output->clearModules();
		
		$customer_registered = false;
		$this->SetTitle ( "Forgot Password" );
		$this->SetPOPUPColClass ( 'col-md-4' );
		$this->SetPOPUPIconClass ( "fa fa-circle-o " );
			
		// $this->SetSubtitle("Ready to get best offers? Let's get started!");
		$mainobj = new Msite_user() ;
		if (IsPostBack) {
			//AddInfo ( "Registration successful" );
			$email=PostValue("email","");
			if(!empty($email)){
			    $suser=Msite_user::FindBy("email", $email);
			    if($suser){
        			if(Msite_user::sendResetEmailByObj($suser)){        					
        				AddInfo("A reset link has been sent to your email address. Please check that");        					
        				$this->DisplayPOPUPMsg();
        				return;        				
        			}
			    }else{
			        AddError("No user found with this email address");
			    }
			}else{
			    AddError("Email address is empty");
			}
		}		
		$this->AddViewData ( "mainobj", $mainobj );	
		$this->DisplayPOPUP ();
			
	}
	function email_check($token='',$param='email'){
		 //sleep(5);
		// ^[A-Za-z0-9_]+$
		if(!empty($token)){
			$token="/$token";
		}
		$this->output->unset_template ();
		$emailaddress = PostValue ( $param );
		$isAvailable = false;
		$msg="Email already exists";
		// $emailaddress=CleanPhoneNumber($emailaddress);
		if (! empty ( $emailaddress ) && filter_var ( $emailaddress, FILTER_VALIDATE_EMAIL )) {
			// Check its existence (for example, execute a query from the database) ...
			
			$isAvailable = ! Msite_user::isEmailExists ( $emailaddress );
			if(!$isAvailable){				
				$msg=__("The email address is already registered. To login ").' <a href="'.site_url("user/login{$token}").'" class="popupformWR">'.__("Click here").'</a>';
			}
		}else{
		    $msg=__("The value is not a valid %s",__("email address"));
		}
		// Finally, return a JSON
		die ( json_encode ( array (
				'valid' => $isAvailable,
				'message'=>$msg
		) ) );
	}
	function recover(){
	    $this->SetTitle("Recover Password");
	    $encrypt=RequestValue("k");
	    //$encrypt=urldecode($encrypt);
	    add_css("css/fade-bg.css");
	     
	    $this->load->library("APPEncryptionLib");
	    $appencp=new APPEncryptionLib();
	    $encryptedObj=$appencp->decryptObj($encrypt);
	    if(!empty($encryptedObj->id)){
    	    if(IsPostBack){
    	        $pass=PostValue("pass");
    	        $cpass=PostValue("cpass");
    	        if(Msite_user::ChangePassowordById($encryptedObj->id, $pass, $cpass)){
    	           AddInfo("Password changed successfully");
    	           redirect("user/recover-succcess");
    	        }
    	    }
    	     
    	    $this->AddViewData("recover_obj", $encryptedObj);
    	    $this->Display();
    	    return ;
	    }else{
	        $this->DisplayMSGOnly("Invalid link");
	    }
	}
	function recover_succcess(){
	    $this->SetTitle("Recover Password");
	    $this->Display();	    
	}
	function logout($rurl=''){
		AddLog("A", "", "l001","Logout");
		$userdata=GetAdminData();
		$this->session->UnsetAllUserData();
		if(!empty($userdata)){
		    Muser_online_log::DeleteFromOnline($userdata->id,"A");
        }
		if(empty($rurl)){
			redirect(base_url());
		}
		redirect($rurl);
	}
	function test(){
		error_reporting(E_ALL);
		$this->output->unset_template();
		/*$this->load->sys_model("Mappemail");
		$this->Mappemail->initializeEmail('P1');
		$this->Mappemail->SendTestEmail();*/
		$this->load->library("APP_Google_API");
		APP_Google_API::$gClient->setRedirectUri(site_url("user/response-from-google"));		
		
		$authUrl = APP_Google_API::$gClient->createAuthUrl();		
		if(isset($authUrl)) {
			echo '<a href="'.$authUrl.'"><img src="'.custom_url("images/glogin.png").'" alt=""/></a>';
		} else {
			echo '<a href="logout.php?logout">Logout</a>';
		}
		
	}	
	
	function app_user_details($app_user_id=""){
	    if(empty($app_user_id)){
	        AddError("Something went wrong. Please try again later");
	        $this->DisplayPOPUPMsg();
	    }
	    $app_user=Mapp_user::FindBy("id", $app_user_id);
	    $this->SetTitle("User Details");
	    $this->AddViewData("app_user", $app_user);
	    $this->SetPOPUPColClass("col-md-6 col-sm-10");
	    $this->DisplayPOPUP();
	}
	
	function remote_login($api_id=''){
	    $this->output->unset_template();
	    $token=RequestValue("token");
	    $response=Mremote_server::login_by_token($api_id, $token);
	    if($response->status){
	        if($response->type=="C"){
	            redirect("client/panel/dashboard");
	        }elseif($response->type=="A"){
		        redirect("admin/dashboard");
	        }
	    }else{
	       $this->session->UnsetAllUserData();
	       redirect("user/remote-error-msg"); 
	    }
	    $this->Display();
	        
	}
	public function remote_error_msg($api_id=""){
	    $this->SetTitle("Remote Login Error");
	    $this->Display();
	}
}
