<?php
class APPLanguage{
    /**
     * @var MoTranslator\Translator
     */
    public static $translator=null;
    private static $file_file="";
    private static $is_loaded=false;
    function __construct(){
        $ci=get_instance();
        
    }
    static function initialize($isForce=false){   
        $panel=get_panel_by_dir(); 
        if($panel=="A"){  
            $applang=Mapp_setting::GetSettingsValue("app_lang");
        }elseif($panel=="C"){
            $applang=self::getSiteLanguage();
        }elseif($panel=="*"){
            $current_type=GetCurrentUserType();
            if($current_type=="CU"){
                $applang=self::getSiteLanguage();
            }else{
                $applang=Mapp_setting::GetSettingsValue("app_lang");
            }
        }
        if(!empty($applang) || $isForce){
            $finalFile=FCPATH."language/default/".DIRECTORY_SEPARATOR."{$applang}.mo";
            if(file_exists(FCPATH."language/override/".DIRECTORY_SEPARATOR."{$applang}.mo")){
                $finalFile=FCPATH."language/override/".DIRECTORY_SEPARATOR."{$applang}.mo";
            }
            self::$translator['default'] = new MoTranslator\Translator($finalFile);
        }
        self::$is_loaded=true;
    }
    static function loadDomain($domain,$path){
    	if(isset(self::$translator[$domain])){
    		return;
	    }
	    $panel=get_panel_by_dir();
	    if($panel=="A"){
		    $applang=Mapp_setting::GetSettingsValue("app_lang");
	    }elseif($panel=="C"){
		    $applang=self::getSiteLanguage();
	    }elseif($panel=="*"){
		    $current_type=GetCurrentUserType();
		    if($current_type=="CU"){
			    $applang=self::getSiteLanguage();
		    }else{
			    $applang=Mapp_setting::GetSettingsValue("app_lang");
		    }
	    }
	    if(!empty($applang)){
		    $finalFile=$path.DIRECTORY_SEPARATOR."{$applang}.mo";
		    self::$translator[$domain] = new MoTranslator\Translator($finalFile);
	    }
    }
    static function getSiteLanguage(){
        $applang=Mapp_setting::GetSettingsValue("app_clang");
        if($applang=="en_US"){
            $applang="";
        }elseif(empty($applang)){
            $applang=Mapp_setting::GetSettingsValue("app_lang");
        }
        return $applang;
    }
    public static function gettext($str,$domain="default"){
        if(!self::$is_loaded){
            self::initialize();
        }
	    if(isset(self::$translator[$domain]) &&  self::$translator[$domain]){
            $str=trim($str);
            return self::$translator[$domain]->gettext($str);
        }
        return $str;
    }
    public static function getnemeric($number,$domain="default"){
        if(!self::$is_loaded){
            self::initialize();
        }
    	if(isset(self::$translator[$domain]) &&  self::$translator[$domain]){
    		return self::$translator[$domain]->getNumber($number);
    	}
    	return $number;
    }
    public static function load_po_file($param){
        self::$file_file=$param;
    }
    
    
}