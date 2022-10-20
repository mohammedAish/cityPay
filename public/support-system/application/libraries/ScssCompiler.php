<?php
	/**
	 * @since: 20/07/2020
	 * @author: Sarwar Hasan
	 * @version 1.0.0
	 */
	use ScssPhp\ScssPhp\Compiler;
	
	
	class ScssCompiler {
		
		static function ProcessClientColor( $is_comporess = true ) {
			try {
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
				AddOnManager::CallHookRef('process-style-variable',$options_vars);
			} catch ( Exception $e ) {
				echo  $e->getMessage();
			}
		}
		
		
	}