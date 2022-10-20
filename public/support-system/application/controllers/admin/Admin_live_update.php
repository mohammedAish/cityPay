<?php 
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Admin_live_update extends APP_Controller {
	
	function __construct() {
		parent::__construct();
		$this->output->unset_template();
	}
	
	
	function index() {
	
	
	}
	
	function act( $live_action = '' ) {
		if(isLiveEditMode()) {
			$this->SetTitle( $live_action );
			$this->SetPOPUPColClass( "col-md-6 col-sm-6" );
			$this->SetPOPUPIconClass( "fa fa-star " );
			if(IsPostBack && ISDEMOMODE) {
				$this->SetTitle( "Demo Mode" );
				$apptheme= Mapp_setting::GetSettingsValue("app_theme","bss2020");
				$this->output->set_app_theme($apptheme);
				AddError("The update has been disabled in DEMO MODE");
				$this->DisplayPOPUPMsg();
				return false;
				
			}
			AddOnManager::CallHookRef( "live-update-{$live_action}", $this );
		}else{
			echo "Access denied";
		}
		
	}
	
	public function DisplayPOPUP( $viewName = '' ) {
		parent::DisplayPOPUP( $viewName );
	}
	
	public function DisplayPOPUPMsg( $viewName = '' ) {
		parent::DisplayPOPUPMsg( $viewName );
	}
	
	
}