<?php
class LessProcess {
	static function ProcessClientColor($is_comporess = true) {
		try {
			$parser = new Less_Parser ( array (
					'compress' => $is_comporess 
			) );
			$parser->parseFile ( FCPATH . "theme/client/css/color.less", base_url ( 'theme' ) );
			$options_vars = array (
					'app_main_color' => Mapp_setting::GetSettingsValue ( "app_main_color", "#0b8ec2" ) ,
					'app_header_bg'=>Mapp_setting::GetSettingsValue("app_header_bg","#FFFFFF")					
			);
			
			if(Mapp_setting::GetSettingsValue("app_c_auto","N")=="N"){
				$options_vars['app_navbar_bg']=Mapp_setting::GetSettingsValue("app_navbar_bg","");
				$options_vars['app_navbar_menu_acive_text_color']=Mapp_setting::GetSettingsValue("app_nav_acive_text","");
				$options_vars['footer_bg_color']=Mapp_setting::GetSettingsValue("footer_bg_color","");
				$options_vars['footer_text_color']=Mapp_setting::GetSettingsValue("footer_text_color","");
				$options_vars['app_text_color']=Mapp_setting::GetSettingsValue("app_text_color","");
				$options_vars['app_welcome_bg']=Mapp_setting::GetSettingsValue("app_welcome_bg","");
				$options_vars['app_welcome_text']=Mapp_setting::GetSettingsValue("app_welcome_text","");
				
			}	
			$options_vars=array_filter($options_vars,function($val){
				if(empty($val)){
					return false;
				}
				return true;
			});
			if(!empty($options_vars['app_header_bg'])){				
				if(strtolower($options_vars['app_header_bg'])!="#fff" && strtolower($options_vars['app_header_bg'])!="#ffffff"){
					$options_vars['app_header_text_color']="#ffffff";
					$options_vars['app_header_text_icon']=$options_vars['app_header_bg'];
				}else{
					$options_vars['app_header_text_color']="#6e6e6e";
					$options_vars['app_header_text_icon']="#ffffff";
				}
			}			
			$parser->ModifyVars ( $options_vars);
			// $parser->ModifyVars( array('app_header_bg'=>Mapp_setting::GetSettingsValue("app_header_bg","#FFFFFF")) );
			
			$css = $parser->getCss ();
			file_put_contents ( FCPATH . "theme/client/css/color.css", $css );
		} catch ( Exception $e ) {
			$error_message = $e->getMessage ();
		}
	}
    static function ProcessChatColor($is_comporess = true) {
        try {
            //client
            $parser = new Less_Parser ( array (
                'compress' => $is_comporess
            ) );
            $parser->parseFile ( FCPATH . "plugins/apsbd-chat/css/appsbd-chat.less", base_url ( 'plugins/apsbd-chat/css' ) );
            $bgptrn=Mapp_setting_api::GetSettingsValue ( "webchat","chat_bg_pattern", "chat-bg5.png");
            $options_vars = array (
                'main_icon_bg' => Mapp_setting_api::GetSettingsValue ( "webchat","chat_main_color", "rgb(11, 193, 255)"),
                'chat_header_color' => Mapp_setting_api::GetSettingsValue ( "webchat","chat_header_color", "#000"),
                'bg_img'=>'"../img/'.$bgptrn.'"'
            );
            $parser->ModifyVars ( $options_vars);
            // $parser->ModifyVars( array('app_header_bg'=>Mapp_setting::GetSettingsValue("app_header_bg","#FFFFFF")) );

            $css = $parser->getCss ();
            file_put_contents ( FCPATH . "plugins/apsbd-chat/css/appsbd-chat.css", $css );

            //admin
            $parser = new Less_Parser ( array (
                'compress' => $is_comporess
            ) );
            @$parser->parseFile ( FCPATH . "plugins/apsbd-chat/css/appsbd-chat-admin.less", base_url ( 'plugins/apsbd-chat/css' ) );
            $options_vars = array (
                'main_icon_bg' => Mapp_setting_api::GetSettingsValue ( "webchat","chat_main_color", "rgb(11, 193, 255)"),
                'chat_header_color' => Mapp_setting_api::GetSettingsValue ( "webchat","chat_header_color", "#000"),
                'bg_img'=>'"../img/'.$bgptrn.'"'
            );
            $parser->ModifyVars ( $options_vars);
            // $parser->ModifyVars( array('app_header_bg'=>Mapp_setting::GetSettingsValue("app_header_bg","#FFFFFF")) );

            $css = $parser->getCss ();
            file_put_contents ( FCPATH . "plugins/apsbd-chat/css/appsbd-chat-admin.css", $css );

        } catch ( Exception $e ) {
            $error_message = $e->getMessage ();
        }
    }
}