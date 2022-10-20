<?php
class Mapp_settings_advance extends Mapp_setting{
	private $app_configs=array();
	private $postArray=array();
	function __construct(){
		parent::__construct();
		//$this->postArray=$this->input->post();
		$parent=new Mapp_setting();
		$this->app_configs=$parent->SelectAllWithIdentity("s_key");
	}
	function GetPostValue($name, $default = "",$isXsClean=true) {
	    if($name=="app_custom_css"){
	        if(!file_exists(FCPATH."css/user-custom.css")){
	            file_put_contents(FCPATH."css/user-custom.css", "");
	        }
	        return file_get_contents(FCPATH."css/user-custom.css");
	    }elseif($name=="app_custom_js"){
	         if(!file_exists(FCPATH."js/user-custom.js")){
	            file_put_contents(FCPATH."js/user-custom.js", "");
	        }
	        return file_get_contents(FCPATH."js/user-custom.js");
	    }
	    
		if (! empty ( $this->app_configs[$name]->s_key)) {
			$default = $this->app_configs[$name]->s_val;
		}
		
		$postvalue=!empty($this->postArray[$name])?$this->postArray[$name]:"";
		$returndata=!empty($postvalue)?$postvalue:$default;
		if(strlen($returndata)>3 && ISDEMOMODE){
		    $skipped=['imap_host','imap_port','imap_user','imap_pass','smtp_host','smtp_port','smtp_user','smtp_pass'];
		    if(in_array($name, $skipped)){
		      return "Demo Mode Default Data";
		    }
		}
		return $returndata;
	}
}