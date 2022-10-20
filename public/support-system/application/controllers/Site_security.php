<?php
class Site_security extends APP_Controller {
	function __construct() {
		parent::__construct();
		
	}
	
	function ipblock() {
		//$this->output->set_app_theme("block-msg");
		$this->output->set_template( "block-msg" );
		$isIPStatus = $this->session->GetSession( "is_ip" );
		if ( $isIPStatus == "N" ) {
			$url = $this->session->GetSession( "ip_req_url", true );
			redirect( $url );
		}
		if ( empty( $isIPStatus ) || $isIPStatus == "C" ) {
			$captchatype = Mapp_setting::GetSettingsValue( "app_captcha", "D" );
			if ( $captchatype == "G" ) {
				$lock_type = "GC";
			} else {
				$lock_type = "C";
			}
		} else {
			$lock_type = "L";
		}
		//$this->session->SetSession("is_ip", "N");
		if ( IsPostBack && ( $lock_type == "GC" || $lock_type == "C" ) ) {
			if ( AppCaptcha::is_valid_captcha() ) {
				AddInfo( "Captcha Success" );
				$this->session->SetSession( "is_ip", "N" );
				$url = $this->session->GetSession( "ip_req_url", true );
				redirect( $url );
			}
		}
		$this->AddViewData( "lock_type", $lock_type );
		$this->AddViewData( "current_ip", $this->input->ip_address() );
		$this->Display();
	}
	
	function full_blocked() {
		//$this->output->set_app_theme("block-msg");
		$this->output->set_template( "block-msg" );
		$ipData = Miplist::FindBy( "ip", $this->input->ip_address() );
		if ( ! empty( $ipData->status ) && $ipData->status == "N" ) {
			$this->session->UnsetSession( "is_ip", "N" );
			redirect( base_url() );
			die;
		}
		$this->AddViewData( "lock_type", ! empty( $ipData ) ? $ipData->status : "" );
		$this->AddViewData( "current_ip", $this->input->ip_address() );
		$this->Display();
	}
	
	function hacking_warning() {
		//$this->output->set_app_theme("block-msg");
		$this->output->set_template( "block-msg" );
		$ipData = Miplist::FindBy( "ip", $this->input->ip_address() );
		
		if ( ! empty( $ipData ) && strtoupper( $ipData->status ) == 'H' ) {
			redirect( "site-security/full-blocked" );
			die;
		}
		$msg = "";
		$this->AddViewData( "warning_messages", __( "Suspicious: Malicious File Upload Attempts. If you tried to upload again then your ip will be blocked automatically" ) );
		$this->AddViewData( "current_ip", $this->input->ip_address() );
		$this->Display();
	}
	
	function country_block() {
		$this->output->set_template( "block-msg" );
		$cpuntryInfo = APPIPdata::get();
		$countryName = "";
		if ( ! empty( $cpuntryInfo->country_name ) ) {
			$countryName = $cpuntryInfo->country_name;
		}
		$this->AddViewData( "current_name", $countryName );
		$this->Display();
	}
	
	function country_admin_block() {
		$this->SetTitle("Blocked Request");
		$cpuntryInfo = APPIPdata::get();
		$countryName = "";
		if ( ! empty( $cpuntryInfo->country_name ) ) {
			$countryName = $cpuntryInfo->country_name;
		}
		$this->AddViewData( "current_name", $countryName );
		$this->Display();
	}
	
}