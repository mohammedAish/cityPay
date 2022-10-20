<?php
	$appversion=$this->config->item('app_version');
AddModule("header",APP_Output::MODULE_HEADER);
AddModule("site-menu",APP_Output::MODULE_HEADER);
AddModule("content_header",APP_Output::MODULE_TOP);
AddModule("breadcrumb",APP_Output::MODULE_TOP);
AddModule("footer",APP_Output::MODULE_FOOTER);
AddModule("timezone",APP_Output::MODULE_CONTENT_BOTTOM);
	if(Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"){
		add_css("css/main-style-rtl.css?v={$appversion}",4);
		add_css( "plugins/rtl/bootstrap-rtl.min.css", 1 );
		add_css( "plugins/rtl/rtl.css", 1 );
	}else{
		add_css("css/main-style.css?v={$appversion}",4);
	}