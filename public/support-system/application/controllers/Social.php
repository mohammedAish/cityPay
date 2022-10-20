<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hauth Controller Class
*/
class Social extends APP_Controller {

	/**
	 * {@inheritdoc}
	 */
	public function __construct()
	{
		parent::__construct();
		try {
			$this->load->library( 'hybridauth' );
		}catch (Exception $e){
			if(ENVIRONMENT!=="production"){
				AddError($e->getMessage(),true);
			}
			$provider_id=$this->uri->segment(3);
			redirect("social/login-error/{$provider_id}");
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function index()
	{
		// Build a list of enabled providers.
		$providers = array();
		foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)
		{
			$providers[] = anchor("social/login/{$provider_id}", $provider_id);
		}

		$this->load->view('hauth/login_widget', array(
				'providers' => $providers,
		));
	}

	/**
	 * Try to authenticate the user with a given provider
	 *
	 * @param string $provider_id Define provider to login
	 */
	public function login($provider_id="",$redirect_token='')
	{
		if(empty($provider_id)){
			redirect("social/social-error");
		}
		$final_redirect_token="";
		if(!empty($redirect_token)){
			$final_redirect_token="/{$redirect_token}";
		}
		
		$params = array(
				'hauth_return_to' => site_url("social/login/{$provider_id}{$final_redirect_token}"),
		);
		if (isset($_REQUEST['openid_identifier']))
		{
			$params['openid_identifier'] = $_REQUEST['openid_identifier'];
		}
		try
		{
			$this->hybridauth=new Hybridauth();
			$adapter = $this->hybridauth->HA->authenticate($provider_id, $params);
			
			$data= $adapter->getAccessToken();			
			$data= $this->hybridauth->HA->getSessionData();
			//Hybrid_User_Profile
			$profile = $adapter->getUserProfile();
			$isLoggedIn=Msite_user::loginUsingSocial($profile,$data);
			if($isLoggedIn){
				$redirect_url=get_redirect_url_by_token($redirect_token);
				if(!empty($redirect_url)){
					redirect($redirect_url);
				}else{
					redirect("client/panel/dashboard");
				}
			}else{
				redirect("social/login-error/{$provider_id}");
			}
		}
		catch (Exception $e)
		{
			Mdebug_log::AddGeneralLog("Social Login Failed:{$provider_id}",Mdebug_log::STATUS_FAILED,Mdebug_log::ENTRY_TYPE_ERROR,$e->getMessage());
			if(ENVIRONMENT!=="production"){
				AddError($e->getMessage(),true);
			}
			redirect("social/login-error/{$provider_id}");			
		}
	}

	/**
	 * Handle the OpenID and OAuth endpoint
	 */
	//http://localhost/Projects/support-system/index.php/social/endpoint.html?hauth.done=Twitter&denied=pYg_AAAAAAAAFDPjAAABXwKA7L8
	public function endpoint()
	{	    
		$this->output->unset_template();
		$denied=RequestValue("denied",null);
		if(!empty($denied)){			
			$provider_id=RequestValue("hauth_done",null);
			redirect("social/login-error/{$provider_id}");
			return ;
		}
		$this->hybridauth->process();
	}
	public function login_error($provider_id=""){
		$this->SetTitle("Social Login Error");
		$this->Display();
	}
	public function login_error_msg($provider_id=""){
		$this->SetTitle("Social Login Error");
		$this->Display();
	}
}
