<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_setting extends APP_Controller{
	function __construct(){
		parent::__construct();
		$this->CheckPageAccess();
	}

	function index(){

	}
	function process_api($api_name=''){
		
		$this->SetTitle("$api_name Process");
		//$this->SetSubtitle("API");
		$this->AddViewData("api_name", $api_name);	
		if($this->input->is_ajax_request()){
			$this->DisplayPOPUP();
		}else{
			$this->Display();
		}
		
	}
	function api($api_name=''){	
		$this->SetTitle("$api_name Setting");
		$this->SetSubtitle("API Settings");
		$this->AddViewData("api_name", $api_name);	
		$this->Display();
	}
	function api_description($api_name=''){
		$this->output->unset_template();
		
		
		$description="";
		if(!empty($api_name)){
			$mainObj=APP_API::get_api_object($api_name);
			if($mainObj){
				$description=$mainObj->get_api_description();
			}
		}else{
			$description="API Name empty";
		}
		die($description);
	}
	function paypal_setting(){
	    $this->SetTitle("Paypal Settings");
	    $this->SetSubtitle("to get custom payment");
	    $this->SetIcon("ap ap-paypal");	    
	    $mainobj=new Mapp_settings_api_advance();
	    $mainobj->SetAPIName("paypal");
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	function social_setting(){
	    $this->SetTitle("Social Settings");
	    $this->SetSubtitle("setup for Social Login");
	    $this->SetIcon("fa fa-share-alt");
	    $mainobj=new Mapp_settings_api_advance();
	    $mainobj->SetAPIName("social");
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
    function payment_basic(){
        $this->SetTitle("Payment Basic Settings");
        //$this->SetSubtitle("setup for Social Login");
        $this->SetIcon("fa fa-money");
        $mainobj=new Mapp_settings_advance();
        $this->AddViewData("mainobj", $mainobj);
        $this->Display();
    }
}