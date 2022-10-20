<?php
	$appversion=$this->config->item('app_version');
	AddModule( "site-menu2", APP_Output::MODULE_HEADER );
	AddModule( "content_header", APP_Output::MODULE_CONTENT_TOP );
	AddModule( "breadcrumb", APP_Output::MODULE_TOP );
	AddModule( "footer", APP_Output::MODULE_FOOTER );
	AddModule( "timezone", APP_Output::MODULE_CONTENT_BOTTOM );
	
	add_js( "plugins/jquery/3.3.1/jquery.min.js", 0 );
	if(Mapp_setting::GetSettingsValue("is_dis_googlefont","N")!="Y") {
		if ( ENVIRONMENT == "development" && is_dir( FCPATH . "../../webplugins" ) ) {
			add_css( "../../webplugins/google/font.css", 1 );
		} else {
			
			add_css( "//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic", 5 );
			
		}
	}
	
	add_css( "plugins/bootstrap/3.3.7/css/bootstrap.min.css", 1 );
	add_js( "plugins/bootstrap/3.3.7/js/bootstrap.min.js", 1 );
	add_css( "plugins/font-awesome/4.7.0/css/font-awesome.min.css", 1 );
	add_css( "plugins/ionicons/2.0.1/css/ionicons.min.css", 1 );
	add_css( "plugins/select2/css/select2.min.css", 1 );
	add_css( "plugins/select2/css/select2-bootstrap.min.css", 1 );
	
	add_css( "theme/client/css/styles.css?v=1.0", 1 );
	add_css( "theme/client/css/theme-responsive.css?v=1.0", 1 );
	add_css( "theme/client/css/color.css", 1 );
	
	if(Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"){
		add_css("css/main-style-rtl.css?v={$appversion}",4);
		add_css( "plugins/rtl/bootstrap-rtl.min.css", 1 );
		add_css( "plugins/rtl/rtl.css", 1 );
	}else{
		add_css("css/main-style.css?v={$appversion}",4);
	}
	add_css( "theme/client/css/app-custom.css", 1);