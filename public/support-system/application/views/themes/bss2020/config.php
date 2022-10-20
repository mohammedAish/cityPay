<?php
	reset_css();
	//reset_js();
	$appversion=$this->config->item('app_version');
	
	AddModule( "notification_2020", APP_Output::MODULE_HEADER );
	AddModule( "site-menu2", APP_Output::MODULE_HEADER );
	AddModule( "content_header", APP_Output::MODULE_CONTENT_TOP );
	AddModule( "content_spacer_2020", APP_Output::MODULE_BEFORE_CONTENT );
	AddModule( "breadcrumb", APP_Output::MODULE_TOP );
	AddModule( "mail_subscribe_form_2020", APP_Output::MODULE_FOOTER );
	AddModule( "footer", APP_Output::MODULE_FOOTER );
	AddModule( "timezone", APP_Output::MODULE_CONTENT_BOTTOM );
	remove_js('plugins/magnific/magnific.min.js');
	add_js( "plugins/jquery/3.3.1/jquery.min.js", 0 );
	if(Mapp_setting::GetSettingsValue("is_dis_googlefont","N")!="Y") {
		add_css( "//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;1,100;1,300&family=Open+Sans:ital,wght@0,300;0,700;1,300&display=swap", 1 );
	}
	add_css( "plugins/bootstrap/4.5.0/css/bootstrap.min.css", 2 );
	add_css( "theme/bss2020/plugins/magnific/apbd-magnific-bootstrap.css", 2 );
	add_css( "css/animate.min.css", 2 );
	add_css( "plugins/sliding-growl-notification/css/notify.css", 2 );
	add_css( "plugins/select2/css/select2.min.css", 2 );
	add_css( "plugins/select2/css/select2-bootstrap.min.css", 2 );
	add_css( "plugins/sweetalert/sweetalert.css", 2 );
	if(Mapp_setting::GetSettingsValue('app_html_editor')=='S') {
		add_css( "theme/bss2020/plugins/summernote/summernote-bs4.min.css", 2 );
		add_js( "theme/bss2020/plugins/summernote/summernote-bs4.min.js", 2 );
		remove_js('plugins/summernote/summernote.min.js');
	}
	if(Mapp_setting_api::GetSettingsValue("webchat","wc_is_active","N")=="Y") {
		$chatType = Mapp_setting_api::GetSettingsValue( "webchat", "app_chat_type", "" );
		if ( in_array( $chatType, [ 'B', 'P' ] ) ) {
			add_css( "plugins/apsbd-chat/css/appsbd-chat.css", 2 );
		}
	}
	add_css( "plugins/icon/style.css", 2 );
	add_js( "plugins/bootstrap/4.5.0/js/bootstrap.bundle.min.js", 2 );
	add_js( "theme/bss2020/plugins/magnific/magnific.min.js", 2 );
	add_css( "theme/bss2020/css/style.css", 2,false,false,"main_theme_style");
	if(Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"){
		add_css( "theme/bss2020/css/theme_rtl.css", 2);
	}else{
	
	}
	add_js( "theme/bss2020/bootstrapValidation/js/bootstrapValidator4.min.js", 2);
	add_js( "theme/bss2020/plugins/masonry/masonry.pkgd.min.js", 1);
	add_js( "js/main-script.js", 2);
	add_js( "theme/bss2020/js/theme.js", 2);
	add_js( "js/custom-app-script.js", 2);
	add_js( "js/user-custom.js", 2);
	add_css( "theme/bss2020/plugins/font-awesome/5.14.0/css/all.min.css", 2 );
	add_css( "plugins/ionicons/2.0.1/css/ionicons.min.css", 2 );
	if(isLiveEditMode()) {
		add_css( 'theme/bss2020/plugins/material/material.css', 3 );
		//add_css( 'plugins/colorpicker/css/bootstrap-colorpicker.min.css', 3 );
		add_css('theme/bss2020/plugins/spectrum/spectrum.min.css');
		add_js('theme/bss2020/plugins/spectrum/spectrum.min.js');
		AddModule( "live_color_picker", APP_Output::MODULE_PAGE_FOOTER);
	}
	add_css( "css/user-custom.css", 10);
	/*if(ISDEMOMODE){
		AddModule('themechooser',APP_Output::MODULE_PAGE_FOOTER);
	}*/