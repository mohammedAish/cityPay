<?php
class ThemeSelector{
	function setThemeAndLayout(){	
		$ci=get_instance();
		$this->loadFunctionPhp();
		$panel=get_panel_by_dir();
		if($panel=="R"){
			$ci->load->view("root/menus");		
		}elseif($panel=="A"){
			if(Mapp_setting::GetSettingsValue("is_rtl_admin")=="Y"){
				jQGrid::setRTL(true);
			}
			$ci->load->view("admin/menus");
            $theme=$ci->config->item("theme");
            $config="themes/{$theme}/config.php";
            if(file_exists(VIEWPATH.$config)){
                $ci->load->view($config);
            }
			$appcolor=$ci->config->item("admin_app_color");
			$ci->SetAPPColor($appcolor);
		}elseif($panel=="C"){
			$this->setClientTheme($ci);
		}elseif($panel=="P"){
			$ci->output->unset_template();
		}
		else{
			$this->setClientTheme($ci);
		}
		//LessProcess::ProcessClientColor();
		//$ms=apache_get_modules();
		//GPrint($ms); die;
		//generate_favicon();

		if(!ISDEMOMODE) {
            $currentUtype=GetCurrentUserType();
            if ($panel == "A" && $currentUtype == "AD") {
                $adminData = GetAdminData();
                if ($adminData->IsSuperUser()) {
                    $_rate_status=Mapp_setting::GetSettingsValue("_rate_status","");
                    $isShowRate=false;
                    if(empty($_rate_status)){
                        $isShowRate=true;
                    }elseif($_rate_status=="a"){
                        $isShowRate==false;
                    }elseif ($_rate_status=="r"){
                        $remainTime=Mapp_setting::GetSettingsValue("_rate_time",strtotime("- 2 SECONDS"));
                        if($remainTime<=time()){
                            $isShowRate=true;
                        }
                    }
                    $ratinglink=AddOnManager::DoFilter("rate-it-link",'');
                    if(empty($ratinglink)) {
                        $isShowRate=false;
                    }
                    if($isShowRate){
                        $first_ticket = Mticket::FetchAll("opened_time", "opened_time", "ASC", 1);
                        if (!empty($first_ticket[0])) {
                            $first_ticket[0]->opened_time;
                            $current = strtotime("- 10 DAYS");
                            if (strtotime($first_ticket[0]->opened_time) < $current) {
                                add_js("js/rate-us.js");
                            }
                        }
                    }
                }
            }
        }
	}
	/**
	 * @param APP_Controller $ci
	 */
	function setClientTheme($ci){
		LoadDemoThemeSettings();
	    $theme= Mapp_setting::GetSettingsValue("app_theme","client2");
		if(method_exists($ci, "SetAppTheme")){
		    
			$ci->SetAppTheme($theme);
		}
		//$ci->load->view("user/menus");
		//$ci->load->view("menus");
		$config="themes/{$theme}/config.php";
		
		
		if(file_exists(VIEWPATH.$config)){
		    $ci->load->view($config);
		}
		
		
		if(Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_active",'N')=="Y" && Mapp_setting_api::GetSettingsValue("gdpr","gdpr_cnb",'N')=="Y" ) {
			if ( Mapp_setting_api::GetSettingsValue( "gdpr", "gdpr_is_active", "Y" ) == "Y" && ( empty( $_COOKIE['is_cookie_accept'] ) || $_COOKIE['is_cookie_accept'] != "Y" ) ) {
				AddModule( "cookie_notification_bar", APP_Output::MODULE_PAGE_FOOTER );
			}
		}
		if(ISDEMOMODE){
			AddModule('themechooser',APP_Output::MODULE_PAGE_FOOTER);
		}
		
		//AddModule("site-menu",APP_Output::MODULE_HEADER);
		/*//AddModule("header",APP_Output::MODULE_HEADER);
		AddModule("site-menu",APP_Output::MODULE_HEADER);
		AddModule("content_header",APP_Output::MODULE_TOP);
		AddModule("breadcrumb",APP_Output::MODULE_TOP);
		AddModule("footer",APP_Output::MODULE_FOOTER);
		AddModule("timezone",APP_Output::MODULE_CONTENT_BOTTOM);*/
		
		
	}
	
	function loadFunctionPhp(){
		$theme= Mapp_setting::GetSettingsValue("app_theme","client2");
		$function_php=VIEWPATH."themes/{$theme}/function.php";
		if(file_exists($function_php)){
			require_once $function_php;
		}
	}
}