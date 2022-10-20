<?php
	require_once dirname(__FILE__)."/helper.php";
	
	
	
	AddOnManager::RegisterHook("knowledge_index_before_module",function(){
		//$this->output->UnsetModule("content_header");
		
		UnsetModule("content_header");
		UnsetModule("search_module");
		AddModule("search_module_only_2020",APP_Output::MODULE_CONTENT_TOP,[],false,12);
    });
	
	AddOnManager::RegisterHook("site_index",function(){
		UnsetModule( "content_spacer_2020");
		AddModule("feature_box_2020",APP_Output::MODULE_BEFORE_CONTENT,[],false,12);
		AddModule("faq_category_2020",APP_Output::MODULE_CONTENT_BOTTOM,[],false,12);
		AddModule("feedback_2020",APP_Output::MODULE_CONTENT_BOTTOM,[],false,12);
		AddModule("before_artitle_2020",APP_Output::MODULE_BEFORE_CONTENT,[],false,99);
	});
	AddOnManager::RegisterHook("site_page",function(){
	    UnsetModule("timezone");
	    AddModule("page_title_2020",APP_Output::MODULE_BEFORE_CONTENT,[],false,12);
	   
    });
	
	AddOnManager::RegisterHook('process-style-variable',function(&$options_vars){
		try {
			$options_vars['app_base_color']=$options_vars['app_main_color'];
			unset($options_vars['app_main_color']);
			if(Mapp_setting::GetSettingsValue("app_c_auto","N")=="Y"){
				$options_vars=['app_base_color'=>$options_vars['app_base_color']];
			}
            $options_vars['section_color']=Mapp_setting_api::GetSettingsValue( "bss2020","section_color","rgba(235, 235, 235, 0.3)" );
            $options_vars['top_notification_color']=Mapp_setting_api::GetSettingsValue( "bss2020","top_noti_color","" );
            $options_vars['top_notification_text_color']=Mapp_setting_api::GetSettingsValue( "bss2020","top_noti_text_color","#ffffff" );
            if(empty($options_vars['top_notification_color'])){
                unset($options_vars['top_notification_color']);
            }

			$scss         = new ScssPhp\ScssPhp\Compiler();
			$scss->addImportPath(FCPATH."theme/bss2020/css/");
			$scss->setVariables($options_vars);
			$cssStr=file_get_contents(FCPATH."theme/bss2020/css/style.scss");
			$css = $scss->compile( $cssStr);
			file_put_contents(  FCPATH."theme/bss2020/css/style.css", $css );
		} catch ( Exception $e ) {
			echo  $e->getMessage();
		}
    });
    AddOnManager::RegisterHook('process-color-settings-post',function(&$configsapi,&$config){

        if(is_array($configsapi) && isset($configsapi['bss2020'])) {
            foreach ($configsapi['bss2020'] as $key => $value) {
                Mapp_setting_api::UpdateSettingsOrAdd( "bss2020",$key,$value );
            }
        }
    });
	if(isLiveEditMode()){
	    require_once dirname(__FILE__).'/ThemeLiveUpdate2020.php';
	    new ThemeLiveUpdate2020();
    }