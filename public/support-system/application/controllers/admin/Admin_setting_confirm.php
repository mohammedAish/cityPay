<?php
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Admin_setting_confirm extends APP_ConfirmController {
	function __construct() {
		parent::__construct();
		//$this->CheckPageAccess();
		Mapp_setting::SetInitialSettings();
		if ( IsPostBack ) {
			$this->checkDemoMode();
		}
	}
	
	protected function checkDemoMode() {
		if ( ISDEMOMODE ) {
			$this->SetConfirmResponse( false, "The update has been disabled in DEMO MODE", NULL, false, "Demo Mode", "puzzle-piece" );
			$this->DisplayConfirmResponse();
			
			return false;
		}
	}
	
	function modify( $type = "g" ) {
		$this->checkManualPermission( "admin/admin-setting/general" );
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configs    = $this->input->post( "config" );
		$configsapi = $this->input->post( "api" );
		$errormsg   = "";
		$successmsg = "";
		
		if ( $type == "m" || $type == "s" ) {
			$this->checkDemoMode();
		}
		if ( $type == "o" && ! empty( $configs['app_c_auto'] ) && $configs['app_c_auto'] == "Y" ) {
			$mconfig = get_color_list( $configs['app_main_color'] );
			foreach ( $mconfig as $key => $valc ) {
				//if(isset($configs[$key])){
				$configs[ $key ] = $valc;
				//}
			}


		}
		if ( is_array( $configs ) && count( $configs ) > 0 ) {
			if ( isset( $configs['allowed_file_type'] ) ) {
				$configs['allowed_file_type'] = str_replace( array(
					",",
					".",
					" "
				), "", $configs['allowed_file_type'] );
			}
		}
		$currentLangauge = Mapp_setting::GetSettingsValue( "app_lang" );
		$currentAdminRTLLangauge = Mapp_setting::GetSettingsValue( "is_rtl_admin" );
		$isNeedToReload  = false;
		if ( is_array( $configs ) && count( $configs ) > 0 ) {
			foreach ( $configs as $key => $val ) {
				if ( ( $type == "m" && $key == "imap_pass" || ( $type == "s" && $key == "smtp_pass" ) ) && $val == "**nopasshackplz**" ) {
					continue;
				}
				
				Mapp_setting::UpdateSettings( $key, $val );
				if ( $key == "app_lang" && $currentLangauge != $val ) {
					APPLanguage::initialize( true );
					$isNeedToReload = true;
				}
				if ( $key == "is_rtl_admin" && $currentAdminRTLLangauge != $val ) {
					APPLanguage::initialize( true );
					$isNeedToReload = true;
				}
			}
		}
		if ( $isNeedToReload ) {
			$configs['is_need_reload'] = true;
			$configs['is_need_msg']    = __( "Language changed. Reloading" );
		}
		
		if ( $type == "t") {
			if ( is_array( $configsapi ) && count( $configsapi ) > 0 ) {
				foreach ( $configsapi as $api_type => $capi ) {
					foreach ( $capi as $key => $opt ) {
						$type = substr( $key, 0, 3 ) == "is_" ? "B" : "T";
						Mapp_setting_api::UpdateSettingsOrAdd( $api_type, $key, $opt, $key, true, $type );
					}
				}
			}
		}
		if ( $type == "j" ) {
			$custom = AppSecurity::RawPostValue("custom");
			if ( isset( $custom['css'] ) ) {
				$custom['css']=str_replace(['<?','<?php'],'',$custom['css']);
				file_put_contents( FCPATH . "css/user-custom.css", $custom['css'] );
			}
			if ( isset( $custom['js'] ) ) {
				file_put_contents( FCPATH . "js/user-custom.js", $custom['js'] );
			}
		}
		$type        = strtolower( $type );
		$type_string = getTextByKey( $type, array(
			"g" => "Basic Settings",
			"f" => "File Settings",
			"c" => "Captcha Settings",
			"o" => "Color Settings",
			"t" => "Welcome & Footer Text",
			"i" => "Ticket Settings",
			"m" => "Email To Ticket Settings",
			"s" => "Email Settings",
			"j" => "Custom CSS & JavaScript"
		) );
		$icon_string = getTextByKey( $type, array(
			"g" => "gear",
			"f" => "hdd-o",
			"c" => "bullseye",
			"o" => "square text-red",
			"t" => "pencil-square-o",
			"i" => "ticket",
			"m" => "envelope-o",
			"s" => " ap ap-email-settings",
			"j" => "html5"
		) );
		if ( $type == "c" ) {
			if ( $configs['app_captcha'] == "G" ) {
				$icon_string = "google";
			}
		}
		if ( $type == "o" ) {
            AddOnManager::CallHookRef('process-color-settings-post',$configsapi, $configs);
			LessProcess::ProcessClientColor();
			ScssCompiler::ProcessClientColor();
			
		}
		if ( strlen( $icon_string ) == 1 ) {
			$icon_string = "gear";
		}
		if ( strlen( $type_string ) == 1 ) {
			$type_string = "Settings";
		}
		
		if ( $type == "g" && ! empty( $errormsg ) ) {
			$this->SetConfirmResponse( false, "Data successfully updated" . $errormsg, $configs, false, $type_string, $icon_string );
		} elseif ( $type == "g" && ! empty( $successmsg ) ) {
			$this->SetConfirmResponse( true, "Image and data successfully updated", $configs, false, $type_string, $icon_string );
		} elseif ( $type == "m" ) {
			$this->load->library( "imap" );
			if ( ! function_exists( "imap_open" ) ) {
				$this->SetConfirmResponse( false, "IMAP module is not activated in you php", $configs, false, $type_string, $icon_string );
				
				return;
			}
			if ( ( isset( $configs['is_imap_ticket'] ) && $configs['is_imap_ticket'] == "N" ) || $this->imap->imap_connect_default() === true ) {
				if ( ! Msystem_msg::IsTagExist( "imapc" ) ) {
					Msystem_msg::Add( "imapc", "Cron Job", "Did you added this command (<b>wget --no-check-certificate --quiet -O /dev/null " . site_url( "autoscript/cron/email-to-ticket" ) . "</b>) into your server cron job list in a short interval?", "W", "A", "Y" );
				}
				
				$this->SetConfirmResponse( true, "Successfully updated", $configs, false, $type_string, $icon_string );
				
			} else {
				$this->set_debug( false );
				$this->SetConfirmResponse( false, "Data Successfully Updated Settings but IMAP Connect Failed. Please re-check your details", $configs, false, $type_string, $icon_string );
				
				return;
			}
			
		} else {
			$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configs, false, $type_string, $icon_string );
		}
		
	}
	
	function modify_security( $type = "g" ) {
		$this->checkManualPermission( "admin/admin-setting/security" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configs       = $this->input->post( "config" );
		$errormsg      = "";
		$successmsg    = "";
		$type          = strtolower( $type );
		$type_string   = getTextByKey( $type, array(
			"g" => "Site Security",
			't' => "Admin/Staff User Security",
			"c" => "Country Block Settings",
			"s" => "Spam Email",
			"a" => "Admin Security"
		) );
		$icon_string   = getTextByKey( $type, array(
			"g" => "gear",
			"t" => " ap ap-locked-user2",
			"c" => "fa-map-marker",
			"s" => "fa-envelope",
			"a" => " ap ap-locked-user2",
		
		) );
		$supported_key = [
			'app_dos_atk',
			'app_dos_req',
			'app_dos_sec',
			'app_dos_action',
			'app_user_scq',
			'per_user_max_ticket',
			'appuser_sec_tried',
			'appuser_sec_min',
			'app_ctry_block',
			'app_ctry_brule',
			'app_ctry_list',
			'app_spam_emails',
			'is_del_spam_email',
			'app_adctry_block',
			'app_adctry_brule',
			'app_adctry_list',
			'app_adctry_ptype',
		];
		$success=true;
		$msg="Successfully updated";
		$cpuntryInfo = APPIPdata::get();
		$isOk=true;
		if(!empty($configs["app_adctry_list"])) {
			$valCtry         = &$configs["app_adctry_list"];
			$valCtry         = strtoupper( $valCtry );
			$countryList = explode( ",", $valCtry );
			$countryList = array_filter( $countryList, function($v){
				return trim($v);
			} );
			if ( in_array( $cpuntryInfo->country_code, $countryList ) ) {
				if($configs["app_adctry_brule"]=="B") {
					$isOk=false;
					$this->SetConfirmResponse( false, "You can't block your own country (".$cpuntryInfo->country_code.")" . $errormsg, $configs, false, $type_string, $icon_string );
				}else{
					$valCtry = implode( ',', $countryList );
				}
			} else {
				if($configs["app_adctry_brule"]!="B") {
					$isOk=false;
					$this->SetConfirmResponse( false, "You can't block your own country (".$cpuntryInfo->country_code.")" . $errormsg, $configs, false, $type_string, $icon_string );
				}
				$valCtry = implode( ',', $countryList );
			}
		}else{
			
			if($type=="c" && (!empty($configs["app_ctry_brule"]) || $configs["app_ctry_brule"]!="B") && empty($configs['app_ctry_list'])){
				$isOk=false;
				$this->SetConfirmResponse( false, "You must add minimum one country in country list to allow admin panel" . $errormsg, $configs, false, $type_string, $icon_string );
			}
		}
		
		if($isOk) {
			foreach ( $configs as $key => $val ) {
				if ( in_array( $key, $supported_key ) ) {
					if ( $key == "app_ctry_list" ) {
						$val = strtoupper( $val );
					}
					Mapp_setting::UpdateSettingsOrAdd( $key, $val );
				}
			}
			$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configs, false, $type_string, $icon_string );
			//$this->SetConfirmResponse(false,"Data successfully updated".$errormsg,$configs,false,$type_string,$icon_string);
		}
		
		
	}
	
	function modify_theme( $type = "g" ) {
		$this->checkManualPermission( "admin/admin-setting/theme" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configs    = $this->input->post( "config" );
		$errormsg   = "";
		$successmsg = "";
		if ( isset( $_FILES['app_logo'] ) ) {
			if ( move_upload_file_if_ok( 'app_logo', FCPATH . "images/logo.png" ) ) {
				generate_favicon();
				$successmsg = "Image and";
			} else {
				$errormsg = " but image upload failed";
			}
		}
		if ( isset( $_FILES['app_white_logo'] ) ) {
			if ( move_upload_file_if_ok( 'app_white_logo', FCPATH . "images/white-logo.png" ) ) {
				$successmsg = "Image and";
			} else {
				$errormsg = " but image upload failed";
			}
		}
		$type          = strtolower( $type );
		$type_string   = getTextByKey( $type, array( "g" => "Site Theme Settings" ) );
		$icon_string   = getTextByKey( $type, array( "g" => "gear" ) );
		$supported_key = [ 'is_state_kn', 'app_theme', 'isonly_logo','is_show_app_ttl', 'app_hmp','is_kn_like_dlike' ,'is_kn_l_upd','is_kn_iconc'];
		foreach ( $configs as $key => $val ) {
			if ( in_array( $key, $supported_key ) ) {
				Mapp_setting::UpdateSettings( $key, $val );
			}
		}
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configs, false, $type_string, $icon_string );
		//$this->SetConfirmResponse(false,"Data successfully updated".$errormsg,$configs,false,$type_string,$icon_string);
		
		
	}
	
	function modify_notification( $type = "e" ) {
		$this->checkManualPermission( "admin/admin-setting/notification" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configs    = $this->input->post( "config" );
		$errormsg   = "";
		$successmsg = "";
		if ( isset( $_FILES['app_logo'] ) ) {
			if ( move_upload_file_if_ok( 'app_logo', FCPATH . "images/logo.png" ) ) {
				generate_favicon();
				$successmsg = "Image and";
			} else {
				$errormsg = " but image upload failed";
			}
		}
		if ( isset( $_FILES['app_white_logo'] ) ) {
			if ( move_upload_file_if_ok( 'app_white_logo', FCPATH . "images/white-logo.png" ) ) {
				$successmsg = "Image and";
			} else {
				$errormsg = " but image upload failed";
			}
		}
		$type          = strtolower( $type );
		$type_string   = getTextByKey( $type, [
			"e" => "Email Notification Settings",
			"s" => "On Screen Notificaiton Settings"
		] );
		$icon_string   = getTextByKey( $type, [ "e" => "envelope", "s" => "desktop" ] );
		$supported_key = [
			'is_aetkt_open',
			'is_astkt_open',
			'app_noti_email',
			'is_netkt_open',
			'is_netktu_reply',
			'is_netkta_reply',
			'is_nstkt_open',
			'is_nstktu_reply',
			'is_nstkta_reply',
			'is_nstone'
		];
		foreach ( $configs as $key => $val ) {
			if ( in_array( $key, $supported_key ) ) {
				Mapp_setting::UpdateSettings( $key, $val );
			}
		}
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configs, false, $type_string, $icon_string );
		//$this->SetConfirmResponse(false,"Data successfully updated".$errormsg,$configs,false,$type_string,$icon_string);
		
		
	}
	
	function modify_fbchat( $type = "e" ) {
		$this->checkManualPermission( "admin/admin-setting/fb-msg-settings" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configsapi    = $this->input->post( "config" );
		$errormsg      = "";
		$successmsg    = "";
		$type          = strtolower( $type );
		$type_string   = "Facebook Chat Settings";
		$icon_string   = "facebook-f";
		$supported_key = [ 'is_active', 'page_id' ];
		foreach ( $configsapi as $key => $opt ) {
			if ( in_array( $key, $supported_key ) ) {
				$type = substr( $key, 0, 3 ) == "is_" ? "B" : "T";
				Mapp_setting_api::UpdateSettingsOrAdd( "fbchat", $key, $opt, $key, true, $type );
			}
		}
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configsapi, false, $type_string, $icon_string );
		//$this->SetConfirmResponse(false,"Data successfully updated".$errormsg,$configs,false,$type_string,$icon_string);
		
		
	}
	
	function modify_webchat( $type = "e" ) {
		$this->checkManualPermission( "admin/admin-setting/webchat_settings" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configsapi    = $this->input->post( "config" );
		$errormsg      = "";
		$successmsg    = "";
		$type          = strtolower( $type );
		$type_string   = "Chat Settings";
		$icon_string   = " ap ap-chat2";
		$supported_key = [
			'chat_closing_int',
			'app_chat_title',
			'app_chat_tagline',
			'chat_closing_text',
			'chat_btn_icon',
            'chat_header_color',
			'chat_main_color',
			'chat_bg_pattern',
			'wc_is_active',
			'app_chat_type',
			'max_chat_per_user',
			'open_text',
			'offline_text',
			'agent_welcome_text',
			'queue_text',
			'fb_page_id',
			'chat_allowed_domains',
		];
		if ( isset( $configsapi['app_chat_type'] ) ) {
			$configsapi['app_chat_type'] = strtoupper( $configsapi['app_chat_type'] );
			if ( $configsapi['app_chat_type'] == "P" ) {
				$this->SetConfirmResponse( false, "You can't set pro version now. Pro version is coming soon. Please choose default chat now" . $errormsg, $configsapi, false, $type_string, $icon_string );
				
				return;
			}
			
		}
		if ( isset( $_FILES['app_chat_logo'] ) ) {
			if ( move_upload_file_if_ok( 'app_chat_logo', FCPATH . "images/chatlogo.png" ) ) {
			}
		}
		foreach ( $configsapi as $key => $opt ) {
			if ( in_array( $key, $supported_key ) ) {
				$type = substr( $key, 0, 3 ) == "is_" ? "B" : "T";
				Mapp_setting_api::UpdateSettingsOrAdd( "webchat", $key, $opt, $key, true, $type );
			}
		}
		LessProcess::ProcessChatColor();
		ChatLib::GenerateHtaccess();
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configsapi, false, $type_string, $icon_string );
	}
	
	function modify_analytics( $type = "e" ) {
		$this->checkManualPermission( "admin/admin-setting/ganalytics" );
		$this->checkDemoMode();
		//sleep(60);
		//AddLog("D",$ur->settedPropertyforLog, "l003","App_setting_confirm", $param);
		$configsapi    = $this->input->post( "config" );
		$errormsg      = "";
		$successmsg    = "";
		$type          = strtolower( $type );
		$type_string   = "Google Analytics Settings";
		$icon_string   = " ap ap-analytics";
		$supported_key = [ 'is_ga_active', 'gtag_id' ];
		foreach ( $configsapi as $key => $opt ) {
			if ( in_array( $key, $supported_key ) ) {
				$type = substr( $key, 0, 3 ) == "is_" ? "B" : "T";
				Mapp_setting_api::UpdateSettingsOrAdd( "gana", $key, $opt, $key, true, $type );
			}
		}
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configsapi, false, $type_string, $icon_string );
	}
	function modify_gdpr() {
		$this->checkManualPermission( "admin/admin-setting/general" );
		$this->checkDemoMode();
		$configsapi    = $this->input->post( "config" );
		$errormsg      = "";
		$type_string   = "GDPR Settings";
		$icon_string   = " ap ap-gdpr";
		//$supported_key = [ 'is_ga_active', 'gtag_id' ];
		foreach ( $configsapi as $key => $opt ) {
			//if ( in_array( $key, $supported_key ) ) {
				$type = substr( $key, 0, 3 ) == "is_" ? "B" : "T";
				if($key=="gdpr_cookie_msg"){
					$optc=AppSecurity::RawPostValue("config");
					if(isset($optc['gdpr_cookie_msg'])){
						$opt=$optc['gdpr_cookie_msg'];
					}
				}
				if($key=="gdpr_agree_message"){
				$optc=AppSecurity::RawPostValue("config");
				if(isset($optc['gdpr_agree_message'])){
					$opt=$optc['gdpr_agree_message'];
				}
			}
				Mapp_setting_api::UpdateSettingsOrAdd( "gdpr", $key, $opt, $key, true, $type );
			//}
		}
		$this->SetConfirmResponse( true, "Successfully updated" . $errormsg, $configsapi, false, $type_string, $icon_string );
	}
	
}
?>