<?php
class Recaptcha{
	private static $secret;
	private static $site_key;
	private static $response;
	private static $isloadedSettings=false;
	private static $id=0;
	function __construct(){
		
	}
	static function load_setting(){		
		self::$secret=Mapp_setting::GetSettingsValue("app_gc_secret","");
		self::$site_key=Mapp_setting::GetSettingsValue("app_gc_site_key","");
		self::$isloadedSettings=true;
	} 
	
	static function is_valid_response($user_response){
		if(!self::$isloadedSettings){
			self::load_setting();
		}
		$error_codes=[
				"missing-input-secret"=>"The secret parameter is missing.",
				"invalid-input-secret"=>"The secret parameter is invalid or malformed.",
				"missing-input-response"=>"Captcha error.",
				"invalid-input-response"=>"Captcha is invalid or malformed.",
				"bad-request"=>"The request is invalid or malformed."
		];
		$response=self::SendRequest($user_response);
		$response=json_decode($response);
		if($response->success){
			return true;
		}else{
			if(is_array($response->{"error-codes"})){
				foreach ($response->{"error-codes"} as $ecode){
					if(isset($error_codes[$ecode])){
						AddError($error_codes[$ecode]);
					}
				}
			}
			
		}
		return false;
	
	}
	static function get_chapcha_html($class="",$input_class=''){
		if(!self::$isloadedSettings){
			self::load_setting();
		}
		self::$id++;		
		return '<div class="'.$class.'"><div id="rc-'.self::$id.'"  class="g-recaptcha" data-sitekey="'.self::$site_key.'"></div></div>';
		
	}
	static function SendRequest($user_response) {
		$isLog=ENVIRONMENT=="development";
		$fields=array(
				"secret"=>self::$secret,
				"response"=>$user_response
		);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, true);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	
		$result = curl_exec($ch);
		if ($result === FALSE) {
			if($isLog && function_exists("AddFileLog")){
				AddFileLog('Problem occurred: ' . curl_error($ch),true,"recaptcha.log",false);
			}
			return FALSE;
		}
	
		curl_close($ch);
		if($isLog && function_exists("AddFileLog")){
			AddFileLog('GCM Result: ' .$result,true,"recaptcha.log",false);
		}
	
		return $result;
	}
	
}