<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once dirname(__FILE__)."/Google/autoload.php";
class APP_Google_API {
	/**
	 * @var Google_Client
	 */
	static $gClient=null;
	/**
	 * @var Google_Oauth2Service
	 */
	static $google_oauthV2=null;
	static $hasAccessToken=false;
	function __construct(){
		if(!self::$gClient){
			$ci=get_instance();
			$apikey=Mapp_setting::GetSettingsValue("_g_api_key");
			$client_id=Mapp_setting::GetSettingsValue("_g_client_id");
			$client_secret=Mapp_setting::GetSettingsValue("_g_client_secret");			
			self::$gClient = new Google_Client();
			self::$gClient->setApplicationName($ci->config->item('app_name'));
			self::$gClient->setClientId($client_id);
			self::$gClient->setClientSecret($client_secret);
			self::$gClient->setApprovalPrompt ("auto");
			self::$gClient->setAccessType('offline');
			//self::$gClient->setScopes(array('https://www.googleapis.com/auth/drive.file'));
			self::$google_oauthV2 = new Google_Service_Oauth2(self::$gClient);
			$token=$ci->session->GetSession("gtoken");			
			if(!empty($token)){
				$access_token=json_decode($token);
				$gtime=$ci->session->GetSession("gtoken_time");				
				if( !empty($gtime)&& !empty($access_token->expires_in) &&  ($gtime+$access_token->expires_in)>time()){
					self::$hasAccessToken=true;
					self::$gClient->setAccessToken($token);
				}
			}
		}
	}
	static function SetAccessTokenSession($token){
		if(!empty($token)){
			$ci=get_instance();
			$ci->session->SetSession("gtoken",$token);
			$ci->session->SetSession("gtoken_time",time());
		}
	}
}