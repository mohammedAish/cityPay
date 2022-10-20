<?php
/**
 * PHP Codeigniter Simplicity
 *
 *
 * Copyright (C) 2013  John Skoumbourdis.
 *
 * GROCERY CRUD LICENSE
 *
 * Codeigniter Simplicity is released with dual licensing, using the GPL v3 and the MIT license.
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	Codeigniter Simplicity
 * @copyright  	Copyright (c) 2013, John Skoumbourdis
 * @license    	https://github.com/scoumbourdis/grocery-crud/blob/master/license-grocery-crud.txt
 * @version    	0.6
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 */
class CORE_Output extends CI_Output {
	const OUTPUT_MODE_NORMAL = 10;
	const OUTPUT_MODE_TEMPLATE = 11;
	const TEMPLATE_ROOT = "themes/";
	const MODULE_LEFT = "left";
	const MODULE_RIGHT = "right";
	const MODULE_HEADER = "header";
	const MODULE_HEADER_BOTTOM = "header_bottom";
	const MODULE_CONTENT_TOP = "content_top";
	const MODULE_BEFORE_CONTENT="before_content";
	const MODULE_CONTENT_BOTTOM = "content_bottom";
	const MODULE_TOP = "top";
	const MODULE_BOTTOM = "bottom";
	const MODULE_FOOTER = "footer";	
	const MODULE_FOOTER_TOP = "footer_top";
	const MODULE_FOOTER_BOTTOM = "footer_bottom";
    const MODULE_PAGE_FOOTER = "page_footer";
	
	private $widths=array(
			'_left_col'=>3,
			'_right_col'=>3
	);

	private $_title = "";
	private $_charset = "utf-8";
	private $_language = "en-us";
	private $_canonical = "";
	private $_meta = array("keywords"=>array(), "description"=>null);
	private $_meta_property = array();
	private $_rdf = array("keywords"=>array(), "description"=>null);
	private $_template = null;
	private $_mode = self::OUTPUT_MODE_NORMAL;
	private $_messages = array("error"=>"", "info"=>"", "debug"=>"");
	private $_output_data = array();
	private $_appTheme="";
	private $_layout="";
	private $modules=array();
	private $loaded_modules=array();
	private $module_output=array();
	public static $module_c_loaded=false;
	private static $setAppProperies=[];
	function __construct(){
		parent::__construct();		
	}	
	public function set_cols($left,$right){
		$this->widths=array(
			'_left_col'=>$left,
			'_right_col'=>$right
		);
	}
    public static function SetProptety($name,$value){
        self::$setAppProperies[$name]=$value;
    }
	public function AddModule($name,$postion="left",$data=array(),$uniqueCheck=false,$order=10){
		if($uniqueCheck){
			if(isset($this->loaded_modules[$postion]) && in_array($name, $this->loaded_modules[$postion])){
				return;
			}
		}
		$ci = get_instance();
		$currentTheme="themes/".$this->_appTheme."/modules/";
		$themepath=VIEWPATH.$currentTheme;
		
		if(!empty($postion) && (file_exists(VIEWPATH."modules/".$name.".php") || file_exists($themepath.$name.".php"))){
			$moduleData=new stdClass();
			$moduleData->name=$name;
			$moduleData->data=$data;
			if(empty($this->modules[$order])){
				$this->modules[$order]=[];
            }
			$this->modules[$order][$postion][$name]=$moduleData;
			$this->loaded_modules[$order][$postion][]=$name;
		}
	}
	public function UnsetModule($name,$postion="") {
		if ( empty( $postion ) ) {
			foreach ( $this->loaded_modules as $order=>&$loadedModules ) {
				foreach ( $loadedModules as $postion => $value ) {
					if ( ( $key = array_search( $name, $loadedModules[ $postion ] ) ) !== false ) {
						unset( $loadedModules[ $postion ][ $key ] );
					}
					unset( $this->modules[ $order ][ $postion ][ $name ] );
				}
			}
		} else {
			if ( in_array( $name, $this->loaded_modules[ $postion ] ) ) {
				foreach ( $this->loaded_modules as $order=>&$loadedModules ) {
					if ( ( $key = array_search( $name, $loadedModules[ $postion ] ) ) !== false ) {
						unset( $loadedModules[ $postion ][ $key ] );
					}
				}
				foreach ($this->modules as $sModules){
				    if(isset($sModules[ $postion ][ $name ])) {
					    unset( $sModules[ $postion ][ $name ] );
				    }
                }
				
			}
		}
	}
	public function clearModules($position=""){
		if(empty($position)){
			$this->modules=array();
			$this->loaded_modules=array();
		}else{
			foreach ($this->modules as $sModules){
				if(isset($sModules[ $position ])) {
					$sModules[$position]=array();
				}
			}
			$this->loaded_modules[$position]=array();
		}		
	}


    /*
     * For Use msg
     * */
	private static $errorMessage=array();
	private static $errorFields=array();
	private static $infoMessage=array();
	private static $hiddenFilelds=array();	
	public static function AddErrorField($name,$msg,$isSession=false){
		self::AddError($msg,$isSession);
		if($isSession){
			$ci=get_instance();
			$getSession=$ci->session->GetSession("errorFields");
			if(!$getSession){
				$getSession=array();
			}
			$getSession[$name]=$msg;
			$ci->session->SetSession("errorFields",$getSession);
			return;
		}
		self::$errorFields[$name]=$msg;
	}
	public static function AddError($msg,$isSession=false,$is_unique=false){
	    
	    
		if($isSession){
			$ci=get_instance();
			$getSession=$ci->session->GetSession("errorMessage");
			if(!$getSession){
				$getSession=array();
			}
			if($is_unique){
			    if(in_array($msg, $getSession)){
			        return ;
			    }
			}
			$getSession[]=$msg;
			$ci->session->SetSession("errorMessage",$getSession);
			return;
		}
		if($is_unique){
		    if(in_array($msg, self::$errorMessage)){
		        return ;
		    }
		}
		self::$errorMessage[]=$msg;
	}
	public static function AddInfo($msg,$isSession=false,$is_unique=false){	   
	     
		if($isSession){
			$ci=get_instance();
			$getSession=$ci->session->GetSession("infoMessage");
			if(!$getSession){
				$getSession=array();
			}
			if($is_unique){
			    if(in_array($msg, $getSession)){
			        return ;
			    }
			}
			$getSession[]=$msg;			
			$ci->session->SetSession("infoMessage",$getSession);
			return;
		}
		if($is_unique){
		    if(in_array($msg, self::$infoMessage)){
		        return ;
		    }
		}
		self::$infoMessage[]=$msg;
	}
	/**
	 * @param string $prefix
	 * @param string $postfix
	 * @return multitype:
	 */
	public static function GetErrorFields(){
		$ci=get_instance();
		$getSession=$ci->session->GetSession("errorFields",true);
		if($getSession){
			self::$errorFields=array_merge($getSession,self::$errorFields);
		}
		if(count(self::$errorFields)>0){
			return  self::$errorFields;
		}
		return array();
	}
	public static function GetError($prefix='',$postfix=''){
		$ci=get_instance();
		$getSession=$ci->session->GetSession("errorMessage",true);
		if($getSession){
			self::$errorMessage=array_merge($getSession,self::$errorMessage);
		}
		if(count(self::$errorMessage)>0){
			return $prefix.implode($postfix.$prefix, self::$errorMessage).$postfix;
		}
		return '';
	}
	public static function GetInfo($prefix='',$postfix=''){
		$ci=get_instance();
		$getSession=$ci->session->GetSession("infoMessage",true);
		if($getSession){
			self::$infoMessage=array_merge($getSession,self::$infoMessage);
		}
		if(count(self::$infoMessage)>0){
			return $prefix.implode($postfix.$prefix, self::$infoMessage).$postfix;
		}
		return '';
	}
	public static function GetMsg($prefix1='',$prefix2='',$postfix=''){
		$str=self::GetError($prefix2,$postfix);
		$str.=self::GetInfo($prefix1,$postfix);
		if(!empty($str)){
			return '<div class="d-m-b">'.$str.'</div>';
		}
		return '';
	}
	public static function HasUIMsg(){
		return count(self::$infoMessage)>0 ||count(self::$errorMessage)>0;
	}
	public static function AddHiddenFields($key,$value){
		self::$hiddenFilelds[$key]=$value;
	}
	public static function AddOldFields($key,$value){
		self::AddHiddenFields("old_".$key, $value);
	}
	public static function GetHiddenFieldsArray(){		
		return  self::$hiddenFilelds;				
	}
	public static function GetHiddenFieldsHTML(){
		ob_start();
		foreach (self::$hiddenFilelds as $name=>$value){
			?>
			<input type="hidden" name="<?php echo $name;?>" value="<?php echo $value;?>" />
			<?php 
			}
			return ob_get_clean();		
	}
	
	
	/**
	 * Set the  template that should be contain the output <br /><em><b>Note:</b> This method set the output mode to MY_Output::OUTPUT_MODE_TEMPLATE</em>
	 *
	 * @uses MY_Output::set_mode()
	 * @param string $template_view
	 * @return void
	 */
	function set_template($template_view){
		$ci=get_instance();			
		$themename=$ci->config->item('theme');		
		$this->set_mode(self::OUTPUT_MODE_TEMPLATE);
		$template_view = str_replace(".php", "", $template_view);
		$this->_layout=$template_view;
		$this->_template = self::TEMPLATE_ROOT.$this->get_app_theme()."/" . $this->_layout;
		$override_layout= "override/".self::TEMPLATE_ROOT.$this->get_app_theme()."/" . $this->_layout;
        if(file_exists(VIEWPATH.$override_layout.".php" ) || file_exists(VIEWPATH.$override_layout)){
            $this->_template = $override_layout;
        }elseif(!file_exists(VIEWPATH.$this->_template.".php")){
			$this->_template = self::TEMPLATE_ROOT."default/" . $this->_layout;
		}
	}
	function set_app_theme($theme_name){
		$this->_appTheme=$theme_name;		
		$this->set_template($this->_layout);		
	}
	
	function get_app_theme(){
		if(!empty($this->_appTheme)){			
			return $this->_appTheme;
		}else{
			$ci=get_instance();		
			return $ci->config->item('theme');
		}
	}
	
	/**set_mode alias
	 *
	 * Enter description here ...
	 */
	function unset_template()
	{
		$this->_template = null;
		$this->set_mode(self::OUTPUT_MODE_NORMAL);
	}

	public function set_common_meta($title, $description, $keywords)
	{
		$this->set_meta("description", $description);
		$this->set_meta("keywords", $keywords);
		$this->set_title($title);
	}

	/**
	 * Sets the way that the final output should be handled.<p>Accepts two possible values 	MY_Output::OUTPUT_MODE_NORMAL for direct output
	 * or MY_Output::OUTPUT_MODE_TEMPLATE for displaying the output contained in the specified template.</p>
	 *
	 * @throws Exception when the given mode hasn't defined.
	 * @param integer $mode one of the constants MY_Output::OUTPUT_MODE_NORMAL or MY_Output::OUTPUT_MODE_TEMPLATE
	 * @return void
	 */
	function set_mode($mode){

		switch($mode){
			case self::OUTPUT_MODE_NORMAL:
			case self::OUTPUT_MODE_TEMPLATE:
				$this->_mode = $mode;
				break;
			default:
				throw new Exception(get_instance()->lang->line("Unknown output mode."));
		}

		return;
	}

	/**
	 * Set the title of a page, it works only with MY_Output::OUTPUT_MODE_TEMPLATE
	 *
	 *
	 * @param string $title
	 * @return void
	 */
	function set_title($title){
		$this->_title = $title;
	}

	/**
	 * Append the given string at the end of the current page title
	 *
	 * @param string $title
	 * @return void
	 */
	function append_title($title){
		$this->_title .= " - {$title}";
	}

	/**
	 * Prepend the given string at the bigining of the curent title.
	 *
	 * @param string $title
	 * @return void
	 */
	function prepend_title($title){
		$this->_title = "{$title} - {$this->_title}";
	}

	function set_message($message, $type="error"){
// 		log_message($type, $message);
		$this->_messages[$type] .= $message;
//		get_instance()->session->set_flashdata("__messages", serialize($this->_messages));
	}

	/**
	 * (non-PHPdoc)
	 * @see system/libraries/CI_Output#_display($output)
	 */
	function _display($output=''){
		$ci = get_instance();
		$currentTheme="themes/".$this->_appTheme."/modules/";
		$themepath=VIEWPATH.$currentTheme;
		/*echo '<pre>';
		print_r($this->modules);
		echo '</pre>';
		die;//*/
		$this->module_output['app_module'] = [];
		AddOnManager::CallBeforeModuleLoad();
		foreach ($this->modules as $order_modules){
			
			foreach ($order_modules as $position=>$modules) {
				if(!isset($this->module_output['app_module'][ $position ])){
					$this->module_output['app_module'][ $position ]="";
                }
				foreach ( $modules as $module ) {
					if ( file_exists( VIEWPATH . "override/modules/" . $module->name . ".php" ) ) {
						$this->module_output['app_module'][ $position ] .= $ci->load->view( "override/modules/" . $module->name, $module->data, true );
					} elseif ( file_exists( $themepath . $module->name . ".php" ) ) {
						$this->module_output['app_module'][ $position ] .= $ci->load->view( $currentTheme . $module->name, $module->data, true );
					} else {
						$this->module_output['app_module'][ $position ] .= $ci->load->view( "modules/" . $module->name, $module->data, true );
					}
				}
			}
		}
		if($output=='')
			$output = $this->get_output();

		switch($this->_mode){
			case self::OUTPUT_MODE_TEMPLATE:
				$output = $this->get_template_output($output);
				break;
			case self::OUTPUT_MODE_NORMAL:
			default:
				$output = $output;
				break;
		}

		parent::_display($output);
	}
	function set_output_data_array($oarray){
		$this->_output_data = array_merge($this->_output_data, $oarray);
	}
	function set_output_data($varname, $value){
		$this->_output_data[$varname] = $value;
	}
	public static function get_template_output_from_str($output){
		if(function_exists("get_instance") && class_exists("CI_Controller")){
			$ci = get_instance();			
			$data=$ci->getViewData();
			$ci->output->_output_data = array_merge($ci->output->_output_data, $data);			
			return $ci->output->get_template_output($output);
		}
	}
	private function get_template_output($output){

		if(function_exists("get_instance") && class_exists("CI_Controller")){
			$ci = get_instance();

			$inline = $ci->load->get_inline_scripting();

			if($inline["infile"]!=""){
				$checksum = md5($inline["infile"], false);
				$ci->load->driver('cache');
				$ci->cache->memcached->save($checksum, $inline["infile"], 5*60);
				$ci->load->js(site_url("content/js/{$checksum}.js"), true);
			}

			if( strlen($inline['stripped']) ){
				$inline['unstripped'] .= "\r\n\r\n<script type=\"text/javascript\">{$inline['stripped']}</script>";
			}

			$data = array();

			$css_files = array();
			$js_files=array();
			
			if($ci->config->item('css_compress')){
			    $css_files=$ci->load->get_combined_css();
			}else{
			    $css_files = $ci->load->get_processed_css();
			}
			
			if($ci->config->item('js_compress')){
			    $js_files=$ci->load->get_combined_js();			    
			}else{
			    $js_files = $ci->load->get_processed_js(); 
			}
			

			$cached_js_files = $ci->load->get_cached_js_files();
			if(!empty($cached_js_files))
			{
				$cached_js_files_string = '';
				foreach ($cached_js_files as $cahed_js_file) {
					$cached_js_files_string .= str_replace("\t","",file_get_contents($cahed_js_file, FILE_USE_INCLUDE_PATH));
				}

				$cache_file_name = 'cache_'.md5(serialize($cached_js_files)).'.js';
				$cache_file_path = 'assets/themes/default/js/'.$cache_file_name;

				$fh = fopen($cache_file_path, 'w') or die("can't open file");
				fwrite($fh, $cached_js_files_string);
				fclose($fh);

				$js_files[] = base_url().$cache_file_path;

			}

			if (is_array($this->_meta["keywords"]))
			{
				$this->_meta["keywords"] = implode(" ,", $this->_meta["keywords"]);
			}

			$data["output"] = $output;
			$data["messages"] = $this->_messages;
			$data["modules"] = $ci->load->get_sections();
			$data["title"] = $this->_title;
			$data["meta"] = $this->_meta;
			$data["meta_property"] = $this->_meta_property;
			$data["language"] = $this->_language;
			$data["rdf"] = $this->_rdf;
			$data["charset"] = $this->_charset;
			$data["js"] = $js_files;
			$data["css"] = $css_files;
			$data["inline_scripting"] = $inline['unstripped'];
			$data["canonical"] = $this->_canonical;
			$data["ci"]			= &get_instance();
			$data['app_module']		= $this->modules;			
			$data['_left_col']=$this->widths['_left_col'];
			$data['_right_col']=$this->widths['_right_col'];			
			/*foreach ($this->modules as $position=>$modules){
				$data['app_module'][$position]="";
				foreach ($modules as $module){
					$data['app_module'][$position].=$ci->load->view("modules/".$module->name,$module->data,TRUE);
				}
			}*/			
			$data = array_merge($data, $this->_output_data,$this->module_output);			
			$output = $ci->load->view($this->_template, $data, true);
		}

		return $output;
	}
    public static function __callStatic($func,$args)
    {
        if(isset(self::$setAppProperies[$func])){
            return call_user_func_array(self::$setAppProperies[$func],$args);
        }
        return;
    }

    /**
	 * Adds meta tags.
	 *
	 * @access public
	 * @param string $name the name of the meta tag
	 * @param string $content the content of the meta tag
	 * @return bool
	 */
	public function set_meta($name, $content){
		$this->_meta[$name] = $content;
		return true;
	}
	public function set_meta_property($name, $content){
		$this->_meta_property[$name] = $content;
		return true;
	}
    public function set_canonical($url)
    {
       $this->_canonical = $url;
    }
    static function SetJSCombinedMode($status=false){
        self::$is_combined_js=$status;
    }
}