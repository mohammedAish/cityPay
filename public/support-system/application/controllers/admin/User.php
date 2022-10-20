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
		redirect('admin/user/login');	
	}	
	protected function AddIntoPageList(){
		// to avoid in page list
	}
	function login(){	
		if(IsPostBack){
		    
		    $is_captcha_enable=Mapp_setting::GetSettingsValue("is_cptcha_admin_login","N")=="Y";
		    $is_captcha_ok=true;		   
		    if($is_captcha_enable){
		        $is_captcha_ok=AppCaptcha::is_valid_captcha();
		    }
			$username=$this->input->post('username',TRUE);
			$password=$this->input->post('password',TRUE);
			if($is_captcha_ok){
    			if(Mapp_user::CheckLogin($username, $password)){
    				$this->redirectIfPossible('admin/dashboard');
    				//redirect('admin/dashboard');
    			}	
			}		
		}
		add_css("css/fade-bg.css");
		/*$this->load->library("APP_Google_API");
		APP_Google_API::$gClient->setRedirectUri(admin_url("user/response-from-google"));
		if(!APP_Google_API::$hasAccessToken){
			$authUrl = APP_Google_API::$gClient->createAuthUrl();
		}else{
			$authUrl=site_url("user/login-with-google");
		}
		$this->AddViewData("google_url", $authUrl);	*/	
		$this->Display();		
	}
	function logout(){
		AddLog("A", "", "l001","Logout");
		Mapp_setting::SetOnlineStatus(false);
		Muser_online_log::DeleteMeFromOnline();
		$this->session->UnsetAllUserData();
		redirect('admin/user/login');
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
	
	/**
	 * @param Google_Client $gClient
	 * @param Google_Oauth2Service $google_oauthV2
	 */
	function google_success_logged_in(&$gClient,&$google_oauthV2){
			$userProfile = $google_oauthV2->userinfo->get();		
			//$gClient->revokeToken();
			if(Mapp_user::LoggedInByEmail($userProfile['email'],$userProfile['picture'],"Google",$userProfile)){			
				redirect('dashboard');
			}else{
				redirect('user/login');
			}	
		
	}
	function login_with_google(){		
		$this->load->library("APP_Google_API");	
		if(APP_Google_API::$hasAccessToken){
			$this->google_success_logged_in(APP_Google_API::$gClient,APP_Google_API::$google_oauthV2);				
		}else{
			APP_Google_API::$gClient->setRedirectUri(site_url("user/response-from-google"));
			$authUrl = APP_Google_API::$gClient->createAuthUrl();
			redirect($authUrl);
		}
	}
	function response_from_google(){
		$this->output->unset_template();
		if(true|| isset($_REQUEST['code'])){			
			$this->load->library("APP_Google_API");		
			APP_Google_API::$gClient->setRedirectUri(site_url("user/response-from-google"));
			if(APP_Google_API::$gClient->authenticate()){
				$token=APP_Google_API::$gClient->getAccessToken();
				APP_Google_API::SetAccessTokenSession($token);
				if($token){
					//APP_Google_API::$gClient->refreshToken($refreshToken)
					$this->google_success_logged_in(APP_Google_API::$gClient,APP_Google_API::$google_oauthV2);
					return;
				}else{
					AddError("Token empty",true);
				}
			}else{
				AddError("Failed Authenticate",true);
			}
		}else{
			AddError("Empty Code",true);
		}
		AddError("Failed try again",true);
		redirect("user/login");
		
	}	
	function recover(){
	    $encrypt=RequestValue("k");
	    if(!empty($encrypt)) {
            //$encrypt=urldecode($encrypt);
            add_css("css/fade-bg.css");
        
            $this->load->library("APPEncryptionLib");
            $appencp = new APPEncryptionLib();
            $encryptedObj = $appencp->decryptObj($encrypt);
            if (IsPostBack) {
                $pass = PostValue("pass");
                $cpass = PostValue("cpass");
                if (Mapp_user::ChangePassowordById($encryptedObj->id, $pass, $cpass)) {
                    AddInfo("Password changed successfully", true);
                    redirect("admin/user/login");
                }
            }
        
            $this->AddViewData("recover_obj", $encryptedObj);
            $this->Display();
        }else{
	        redirect("admin/user/login");
        }
	    
	}
    public function forget($redirect_url=''){
        //$this->output->clearModules();
        
        $customer_registered = false;
        $this->SetTitle ( "Forgot Password" );
        $this->SetPOPUPColClass ( 'col-md-4' );
        $this->SetPOPUPIconClass ( "fa fa-circle-o " );
        
        // $this->SetSubtitle("Ready to get best offers? Let's get started!");
        $mainobj = new Mapp_user() ;
        if (IsPostBack) {
            if(AppCaptcha::is_valid_captcha()) {
                //AddInfo ( "Registration successful" );
                $username = PostValue("username", "");
                if (!empty($username)) {
                    $suser = Mapp_user::FindBy("user", $username);
                    if ($suser) {
                        if (Mapp_user::sendResetEmailByObj($suser)) {
                            AddInfo("A reset link has been sent to your email address. Please check that");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    } else {
                        AddError("No user found with this email address");
                    }
                } else {
                    AddError("Email address is empty");
                }
            }
        }
        $this->AddViewData ( "mainobj", $mainobj );
        $this->DisplayPOPUP ();
        
    }
	
	
}
