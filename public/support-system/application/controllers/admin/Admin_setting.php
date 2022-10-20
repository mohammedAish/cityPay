<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_setting extends APP_Controller{
	function __construct(){
		parent::__construct();
		$this->CheckPageAccess('enable_cwr');		
		if(Mapp_setting::GetSettingsValue("is_first_run","Y")=="Y"){
		    Mapp_setting::SetInitialSettings();
		    Mapp_setting::UpdateSettingsOrAdd("is_first_run", "N");	
		}
	}
	
	function index(){
		
	}
	function general(){
		AddAppHTMLEditor();
		//add_css("plugins/vetical-tab/vertical-tab.css");
		//add_js("plugins/vetical-tab/vertical-tab.js");
		$this->SetTitle("Application Settings");
		$this->SetSubtitle("Application All Settings");
		$mainobj=new Mapp_settings_advance();
		$apiobject=new Mapp_settings_api_advance();
		$apiobject->SetAPIName("system");
		$this->AddViewData("apiobject", $apiobject);
		$this->AddViewData("mainobj", $mainobj);
		$this->Display();
	}
	function security(){
	    //AddAppHTMLEditor();
	    $this->SetTitle("Security Settings");
	    $this->SetPOPUPIconClass("ap ap-shield");
	    $this->SetSubtitle("Application Security Settings");
	    $mainobj=new Mapp_settings_advance();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	function notification(){
	    //AddAppHTMLEditor();
	    $this->SetTitle("Admin Notification Settings");
	    $this->SetPOPUPIconClass("fa fa-bell");
	    $this->SetSubtitle("Ticket open or reply notification settings");
	    $mainobj=new Mapp_settings_advance();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	function imap(){
	    
	    $this->SetTitle("Email To Ticket Settings");
	    $this->SetSubtitle("Imap Settings");
	    $mainobj=new Mapp_settings_advance();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	function email_out_settings(){	   
	    $this->SetTitle("Email Outgoing Settings");
	    $this->SetSubtitle("Sendmail or SMTP");
	    $mainobj=new Mapp_settings_advance();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	
	function theme(){
	    //AddAppHTMLEditor();
	    $this->SetTitle("Theme Settings");
	    $this->SetPOPUPIconClass("ap ap-shield");
	    $this->SetSubtitle("Application Theme Settings");
	    $mainobj=new Mapp_settings_advance();
	    $this->AddViewData("mainobj", $mainobj);
	    $this->Display();
	}
	function fb_msg_settings(){
    //AddAppHTMLEditor();
        $this->SetTitle("Facebook Chat Settings");
        $this->SetPOPUPIconClass("ap ap-shield");
        $this->SetSubtitle("Messenger Settings");
       // $mainobj=new Mapp_settings_api_advance();
        //$this->AddViewData("webmainobj", $mainobj);
        $this->Display();
}
    function webchat_settings(){
        //AddAppHTMLEditor();
        $this->SetTitle("Chat Settings");
        $this->SetPOPUPIconClass("ap ap-msg");
        $this->SetSubtitle("Web Chat Settings");
        // $mainobj=new Mapp_settings_api_advance();
        //$this->AddViewData("webmainobj", $mainobj);
        $this->Display();
    }
    function ganalytics(){
        //AddAppHTMLEditor();
        $this->SetTitle("Chat Settings");
        $this->SetPOPUPIconClass("ap ap-msg");
        $this->SetSubtitle("Web Chat Settings");
        // $mainobj=new Mapp_settings_api_advance();
        //$this->AddViewData("webmainobj", $mainobj);
        $this->Display();
    }
}