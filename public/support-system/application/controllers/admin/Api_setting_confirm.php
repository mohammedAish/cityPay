<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Api_setting_confirm extends APP_ConfirmController{
        function __construct(){
            parent::__construct();
            //$this->CheckPageAccess('update_paypal');
           // Mapp_setting::SetInitialSettings();
           if(IsPostBack){
               $this->checkDemoMode();
           }
        }
                 
	    function modify($api_name=""){
	        $this->checkManualPermission("api-setting/api");
	       
	    	//sleep(60);
	    	//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
	    	if(!empty($api_name)){
		    	$mapiobj=APP_API::get_api_object($api_name);
		    	$errormsg="";
		    	$successmsg="";	
		    	$message="";
		    	$mapiobj->set_post_values();
		    	if($mapiobj->save_configuation($message)){
		    		$data_string=$mapiobj->get_api_description();
		    		$this->SetConfirmResponse(true,"Successfully updated".$errormsg,$data_string,false,$api_name." Settings","puzzle-piece");
		    	}else{
		    		$this->SetConfirmResponse(false,$message,null,false,$api_name." Settings","puzzle-piece");
		    	}		    	
	    	}else{
	    		$this->SetConfirmResponse(false,"API Info Error",null,false,"API Error","puzzle-piece");
	    	}
	    	
        
	    }
	    private function update($api_type="",$title="",$icon=""){
	        $config=PostValue("config",[]);
	        foreach ($config as $key=>$opt){
	            $type=substr($key, 0,3)=="is_"?"B":"T";
	            Mapp_setting_api::UpdateSettingsOrAdd($api_type, $key, $opt,$key,true,$type);
	        }
	        $this->SetConfirmResponse(true,"Successfully updated","",false,$title,$icon);
	    }
	    function update_paypal(){ 
	      
	        $this->checkManualPermission("admin/api-setting/paypal-setting");
	    	$this->update("paypal","PayPal Settings","paypal");      
	    }
	    function update_social(){
	        $this->checkManualPermission("admin/api-setting/social-setting");
	        $this->update("social","Social Settings","share-alt");
	    }

	    function update_payment_basic(){
            $this->checkManualPermission("admin/api-setting/payment-basic");
            $payment_currencies=$this->input->post("payment_currencies");
            $payment_currencies=strtoupper($payment_currencies);
            if(Mapp_setting::UpdateSettingsOrAdd("payment_currencies",$payment_currencies,"Payment Currencies",true)){
                $this->SetConfirmResponse(true,"Successfully updated","",false,"Payment Basic Settings","gear");
            }else{
                $this->SetConfirmResponse(false,"No change found for update","",false,"Payment Basic Settings","gear");
            }
        }
	   
        
                
    
}
