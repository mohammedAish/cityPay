<?php
class Mapp_settings_api_advance extends Mapp_setting_api{
	private $app_configs=array();
	private $postArray=array();
	private $api_name="";
	function __construct(){
		parent::__construct();
		//$this->postArray=$this->input->post();
		$parent=new Mapp_setting_api();
		$this->app_configs=$parent->SelectAllWithIdentity("s_key");
	}
	function SetAPIName($apiName){
	    $this->api_name=$apiName;
	}
	function GetAPIName(){
	    return $this->api_name;
	}
	function GetPostValue($name, $default = "",$isXsClean=true) {
        $postvalue=Mapp_setting_api::GetSettingsValue($this->api_name, $name);
        $returndata=!empty($postvalue) || is_numeric($postvalue)?$postvalue:$default;
		if(strlen($returndata)>3 && ISDEMOMODE){
		    return "Demo Mode Default Data";
		}
		return $returndata;
	}
}