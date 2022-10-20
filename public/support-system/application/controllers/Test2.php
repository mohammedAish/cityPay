<?php
class test extends APP_Controller{
	function __construct(){
		parent::__construct();
		
	}
	function index(){
		$this->output->unset_template();		
		$this->load->library("email");
		$muser=Msite_user::FindBy("id","29");
		$muser->SetUserSession(true);
      
	}	
}