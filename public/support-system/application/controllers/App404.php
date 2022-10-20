<?php
class App404 extends APP_Controller {
    function __construct(){
        parent::__construct();        
       
    }
   
	public function index()
	{
		$this->output->set_status_header('404');
		$this->SetTitle(get_app_title());
		UnsetModule('timezone');
		$this->Display("App404/index");
		
	}

}