<?php
abstract class CORE_Controller extends CI_Controller {
    private static $reset_model_ses="_app_n_new_session";
    private static $is_ses_reseted=false;
	protected $viewData=array();	
	protected $view_controler_dir="";
	protected $view_controler_path="";
	protected $view_file_path="";	
	public $redirect_url="";
	public $redirect_title="";
	function __construct(){
		parent::__construct();		
		if (version_compare(PHP_VERSION, '5.3.0', '<')) {
			$message="Current PHP Version is : <strong>".PHP_VERSION."</strong><br/> Required PHP Version :  <strong> >= 5.3</strong><br/><br/><br/> Please upgrade your server into updated PHP version";
			show_error($message ,500,"PHP Version Error" );
			return;
			
		}
		if(!self::$is_ses_reseted){
		    if(function_exists(self::$reset_model_ses)){
		      call_user_func(self::$reset_model_ses);
		      self::$is_ses_reseted=true;
		    }else{
		        show_error("Some code is not found. It the app could not be run properly");
		        die;
		    }
		}		
		$this->viewData=array();
		$theme=$this->config->item('theme');
		$appversion=$this->config->item('app_version');
		$this->viewData['_app_name']=$this->config->item('app_name');
		$this->viewData['_app_version']=$appversion;
		$this->load->set_themplate_asset_by_theme($theme);
		$this->output->set_template('main');			
		$this->viewData['_title']=ucfirst($this->router->method);
		$this->viewData['_subtitle']="";
		$this->viewData['__icon_class']="";
		$appColor=$this->config->item('app_color');
		$this->SetAPPColor($appColor);		
		$this->view_controler_dir=$this->router->directory;
		$this->view_controler_path=$this->router->class;
		$this->view_file_path=$this->router->method;
		$this->viewData['_uiBreadCrumb']=array();		
		/*bootstrapValidation*/
		$this->load->css("plugins/bootstrapValidation/css/bootstrapValidator.min.css?v={$appversion}");
		$this->load->js("plugins/bootstrapValidation/js/bootstrapValidator.min.js?v={$appversion}");
		add_js('plugins/grid/js/jquery.ba-resize.min.js');
		
		/*notification*/
		$this->load->js("plugins/sliding-growl-notification/js/notify.min.js?v={$appversion}");
		$this->load->css("plugins/sliding-growl-notification/css/notify.css?v={$appversion}");
		
		/*datetimepicker*/
		$this->load->js("plugins/datetimepicker/jquery.datetimepicker.js?v={$appversion}");
		$this->load->css("plugins/datetimepicker/jquery.datetimepicker.css?v={$appversion}");
		/*perfect-scroll-bar*/
		$this->load->css("plugins/perfect-scrollbar/css/perfect-scrollbar.min.css?v={$appversion}");
		$this->load->js("plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js?v={$appversion}");
		/* tag Input*/		
		add_css("plugins/selectize/css/selectize.bootstrap3.css");
		add_css("plugins/selectize/css/selectize.default.css");	
		add_js("plugins/selectize/js/standalone/selectize.min.js");
		
		if(function_exists("load_app_js_css")){
		    load_app_js_css($this);
		}
		add_js("js/base64.js");
		
		$this->load->css("css/animate.min.css");
		$this->load->css("css/fa-ani.min.css");
		
		//add_css("css/app-responsive.css");
        if(ENVIRONMENT=="development"){
            $this->load->js("js/main-script.js?v={$appversion}",10);
        }else{
            $this->load->js("js/main-script.min.js?v={$appversion}",10);
        }
		$this->redirect_url=$this->input->get("_ru",true);		
		
	}
	/**
	 * If it has redirect url then redirect that first. if not then redirect  url param
	 */
	public function redirectIfPossible($url){
		if(!empty($this->redirect_url)){
			redirect($this->redirect_url);
		}else{			
			redirect($url);
		}
		
	}
	public function SetNoNotificaitonAndMessage(){
	   $this->AddViewData("___no_noti_msg",true);
	}
	public function getViewData(){
		return $this->viewData;
	}
	function SetAPPColor($color){	   
	    $this->viewData['_app_color']=$color;	  
	}
	function DisablePOPUPClose($status=true){
	    $this->AddViewData("__close_popup_disable", $status);
	}
	function GetAPPColor(){
		return $this->viewData['_app_color'];
	}
	function __destruct(){
		if(ENVIRONMENT!="production"){	
			try{
			$this->AddIntoPageList();
			}catch(Exception $ex){
				
			}	
			if(class_exists("APP_Model")){	
			$qu=APP_Model::GetTotalQueriesForLog();			
			$path = APPPATH."logs".DIRECTORY_SEPARATOR;	
			if(is_writable($path)){
				if(!is_dir($path)){
					mkdir($path,0740,true);
				}
				$path.="queries.sql";
				//if (is_writable($filename)) {
				if(file_exists($path) && filesize($path) > (1024 * 500)){
					unlink($path);
				}
				if(!empty($qu)){
					$fh = fopen($path, 'a');
					if($fh){
						$count=APP_Model::GetTotalQueriesCountStr();
						$queries="-- ".current_url()."----".(date('Y-m-d h:i:s A'))."--$count\n";
						$queries.=APP_Model::GetTotalQueriesForLog();
						$queries.="-- -----------------------------------------------------\n\n";
						fwrite($fh, $queries);
						fclose($fh);
					}
				}
			}		
			}
		}
	}	
	/**
	 * @param string $skips
	 * @param string $panel
	 * @param string $isReturn
	 * @param string $redirect_page
	 * @return boolean
	 */
	abstract protected function CheckPageAccess($skips='',$panel="",$isReturn=false,$redirect_page='',$_method_permission_check=true);
	protected function SetTitle($title){
		$this->viewData['_title']=$title;
	}
	
	protected function SetSubtitle($title){
		$this->viewData['_subTitle']=$title;
	}
	protected function SetPopUpWidth($width){
		$this->viewData['cboxWidth']=$width;
	}
	protected function SetIcon($icon){
		$this->viewData['__icon_class']=$icon;
	}
	protected function SetPopUpFormType($formType){
		$formType=strtolower($formType);
		$this->viewData['formtype']=$formType;
		
	}
	protected function SetPopUpFormMethod($method){
		$method=strtolower($method);
		if(in_array($method, array("post","get"))){
			$this->viewData['method']=$method;
		}
	}

	protected function AddBreadCrumb($title,$url,$icon="",$isAlreadyTranslate=false){
		$title=ucfirst($title);
		$obj=new stdClass();
		$obj->title=$title;
		$obj->url=$url;
		$obj->icon=$icon;
		$this->viewData['_uiBreadCrumb'][$title]=$obj;
	}
	protected function SetControllerPath($controller_name){
		$this->view_controler_path=$controller_name;
	}
	protected function SetViewName($viewname){
		$this->view_file_path=$viewname;
	}
    public function setOverrideView(&$viewname){
        $viewname=ltrim($viewname,'/');
        $checkfile=$viewname;
		$currentTheme="themes/".$this->output->get_app_theme()."/";
		$themepath=VIEWPATH.$currentTheme;
		
        if(strpos($viewname,".php")==false){
            $checkfile=$viewname.".php";
        }
        if(file_exists(VIEWPATH."override/{$checkfile}")){
            $viewname="override/{$viewname}";
        }
		if(file_exists($themepath."{$checkfile}")){
			$viewname=$currentTheme.$viewname;
		}
    }
    public function Display($viewName='',$isAjaxContentFirst=true){
		if($isAjaxContentFirst && (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ){
			$this->output->set_template("ajax-content");
			//$this->output->headers[] = array("tt", "test");	
		}
		if(empty($viewName)){	
		    $dirname="";
		    if(!empty($this->view_controler_dir)){	
		      $dirname=rtrim($this->view_controler_dir,'/');	
		    }
			$viewName=$dirname."/".(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}		
		$this->output->set_title($this->viewData['_title']);
		$this->AddBreadCrumb($this->viewData['_title'], "#",$this->viewData['__icon_class'],true);
		//$this->load->view("menus",true);
		AppMenu::$isMenuLoaded=true;
		$viewName=strtolower($viewName);
        $this->setOverrideView($viewName);
		$this->load->view($viewName,$this->viewData);
		
		
	}
    public function DisplaySpecial($string='',$isAjaxContentFirst=true){
       $themename=$this->output->get_app_theme(); 
       if(!file_exists(APP_Output::TEMPLATE_ROOT.$themename."/html.php")){
           $themename="default";
       }    
       $this->AddViewData("__html", $string);      
       $this->Display("themes/{$themename}/html"); 
	}	
	public function DisplayMSGOnly($msg='',$redirect_page='',$time=10,$is_success=false){
	   $this->AddViewData("_msg_only", __($msg));
       $themename=$this->output->get_app_theme(); 
       if(!file_exists(APP_Output::TEMPLATE_ROOT.$themename."/msg-only.php")){
           $themename="default";
       } 
       $this->AddViewData("__rdir_page", $redirect_page);  
       $this->AddViewData("__rdir_time", $time);      
       if($is_success){
           $this->AddViewData("__msg_class_name", "text-success");
       }else{
           $this->AddViewData("__msg_class_name", "text-danger");
       }
       $viewName="themes/{$themename}/msg-only";
       $this->setOverrideView($viewName);
       $this->Display($viewName);
	}
	public function AddViewData($key,$value){

		$this->viewData[$key]=$value;
	}
	protected function AddLeftButtonData($title,$url,$class=""){
		$key="back_url";
		if(!empty($this->viewData[$key])){
			$this->viewData[$key]=array();
		}
		$backurl=new stdClass();
		$backurl->title=$title;
		$backurl->url=$url;
		$backurl->class=$class;
		$this->viewData[$key][]=$backurl;
	}
	protected function AddMetaData($key,$value){		
		$value=strip_tags($value);		
		$value=str_replace(array("\r", "\n"), ' ', $value);			
		$this->output->set_meta($key, $value);		
	}
	protected function AddMetaPropertyData($key,$value){		
		$value=strip_tags($value);		
		$value=str_replace(array("\r", "\n"), ' ', $value);			
		$this->output->set_meta_property($key, $value);		
	}
	protected function getUriArray(){		
		$directory=$this->router->directory;
		if(!empty($directory)){
		    $response=$this->uri->uri_to_assoc ( 4 );
		}else{
		    $response=$this->uri->uri_to_assoc ( 3 );
		}
		$preg="/\-\-|[;'\"]|eval|cast|base64_decode|gzinflate|str_rot13|javascript/i";
		//it clear -- ; ' " eval cast base64_decode gzinflate str_rot13 javascript
		foreach ($response as &$value){
			if(!empty($value)){
				$value=preg_replace($preg, "", $value);
			}
		}
		return $response;
	}
	protected function getUriData($key,$default=""){
		$uridata=$this->getUriArray();
		if(isset($uridata[$key])){
			return $uridata[$key];
		}		
		return $default;
	}
	function SetPOPUPColClass($col_class){
		$this->AddViewData("__col_class", $col_class);
	}
	function SetPOPUPIconClass($icon_class){
		$this->AddViewData("__icon_class", $icon_class);
	}
	protected function DisplayPOPUP($viewName=''){
		//$this->router=new CI_Router();
		$this->output->set_template("popup");
		if(empty($viewName)){
			$viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}
		
		
		if(file_exists(VIEWPATH.$viewName.".php")){
            $this->setOverrideView($viewName);
			$this->load->view($viewName,$this->viewData);
		}

	
	}
	function SetAppTheme($app_theme,$color="",$layout="main"){
		$this->load->set_themplate_asset_by_theme($app_theme);
		$this->output->set_app_theme($app_theme);	
		if(!empty($color)){
			$this->viewData['_app_color']=$color;
		}	
		$this->output->set_template($layout);
	}
	function SetPopupFromMutipart($isSet=true){
	    $this->AddViewData("isPopupFormMultiPath", $isSet);
	}
	function DisableForm(){
	    $this->AddViewData("__disable_form", true);
	}
	
	protected function DisplayPOPUPMsg($msg=""){
		//$this->router=new CI_Router();
		
		$this->output->set_output_data_array($this->viewData);
		$this->output->set_output_data("_msg_only", $msg);
		$this->output->set_template("popupmsg");
	}
	protected function DisplayPrintView($viewName=''){
		//$this->router=new CI_Router();
		if(empty($viewName)){
			$viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}
		
		$this->load->library('user_agent');	
		$this->output->set_template('print');
		$this->output->set_title($this->viewData['_title']);
        $this->setOverrideView($viewName);
		$this->load->view($viewName,$this->viewData);
	}
	protected function DisplayPOPOver($viewName=''){
		//$this->router=new CI_Router();
		if(empty($viewName)){
			$viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}
		$this->output->set_template('popover');
		$this->output->set_title($this->viewData['_title']);
        $this->setOverrideView($viewName);
		$this->load->view($viewName,$this->viewData);
	}
	protected function DisplayPOPOver2($viewName=''){
	    //$this->router=new CI_Router();
	    if(empty($viewName)){
	        $viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
	    }
	    $this->output->set_template('popover2');
	    $this->output->set_title($this->viewData['_title']);
        $this->setOverrideView($viewName);
	    $this->load->view($viewName,$this->viewData);
	}
	protected function DisplayPOPUPIframe($viewName=''){
		//$this->router=new CI_Router();
		if(empty($viewName)){
			$viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}
        $this->setOverrideView($viewName);
		$this->output->set_template('iframe');
		$this->output->set_title($this->viewData['_title']);
        $this->setOverrideView($viewName);
		$this->load->view($viewName,$this->viewData);
	
	}
	public static function LoadGridController(){		
		if(file_exists(APPPATH."core".DIRECTORY_SEPARATOR."APP_GridDataController.php")){
			require_once APPPATH."core".DIRECTORY_SEPARATOR."APP_GridDataController.php";
		}
	}
	public static function LoadConfirmController(){				
		if(file_exists(APPPATH."core".DIRECTORY_SEPARATOR."APP_ConfirmController.php")){
			require_once APPPATH."core".DIRECTORY_SEPARATOR."APP_ConfirmController.php";
		}
	}
	protected function AddIntoPageList(){
		if(ENVIRONMENT!="production"){
			$this->config->load("public_page_list");
			$ppagelist=$this->config->item("public_page_list",FALSE,TRUE);		
			$mpa=new Mpage_list();
			$class=str_replace("_", "-", $this->router->class);
			$method=str_replace("_", "-",$this->router->method);
			$dir=str_replace("_", "-",$this->router->directory);
			$dir=rtrim($this->router->directory,'/');
			$panel=get_panel_by_dir();			
			$controller_title=str_replace("_", " ",$this->router->class);
			if(function_exists("ucwords")){
			    $controller_title=ucwords($controller_title);
			}
			if(ACL::hasInRuntimePermission("$dir/$class/$method")){
				return ;
			}
			if(!in_array($class."/*", $ppagelist) && !in_array($class."/".$method, $ppagelist)){
				if(!$mpa->IsExists("controller", $class,array("directory"=>$dir,"method"=>$method))){
					$title=str_replace("_", " ",$this->viewData['_title']);
					if(!Mpage_list::AddNewPage($title,$class, $method,$controller_title,$dir,$panel)){					
					}
				}
			}
		}
	}
}