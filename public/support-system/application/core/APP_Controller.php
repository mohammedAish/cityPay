<?php
require_once APPPATH."core".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."CORE_Controller.php";
class APP_Controller extends CORE_Controller {
    function __construct(){
        parent::__construct();
        
        /*datetimepicker*/
        $this->load->js("plugins/magnific/magnific.min.js");
        $this->load->css("plugins/magnific/magnific-bootstrap.css");
        $this->load->css("plugins/sweetalert/sweetalert.css");
        $this->load->js("plugins/sweetalert/sweetalert.min.js");
        //$this->load->js("plugins/bootstrap-select/js/bootstrap-select.min.js");
        //$this->load->css("css/loader.css");
        add_css("plugins/icon/style.css");
    }
   
    function SetAPPColor($color){
        parent::SetAPPColor($color);
        /*Icheck*/
        $icheckcolor=$this->config->item('icheck_color');
        $this->load->remove_css("plugins/icheck/skins/square/$icheckcolor.css");
        //$this->load->css("plugins/icheck/skins/square/$color.css");
        //$this->load->js("plugins/icheck/icheck.min.js");
    }
    /* (non-PHPdoc)
     * @see CORE_Controller::SetSubtitle()
     */
    function SetSubtitle($title, $parameter = null, $_ = null){
       $args=func_get_args();
       $title=call_user_func_array("__",$args);
       parent::SetSubtitle($title);
    }
    function SetTitle($title, $parameter = null, $_ = null){
        $args=func_get_args();
        $title=call_user_func_array("__",$args);
        parent::SetTitle($title);
    }
    public function AddBreadCrumb($title,$url,$icon="",$isAlreadyTranslate=false){
        if(!$isAlreadyTranslate){
            $title=__($title);
        }
       parent::AddBreadCrumb($title, $url,$icon,$isAlreadyTranslate);
    }
	protected function CheckPageAccess($skips='',$panel="",$isReturn=false,$redirect_page='',$_method_permission_check=true){

		if(!empty($skips)){
			$skippages=explode(",", $skips);
			if(in_array($this->router->method, $skippages)){
				return true;
			}
		}
		if(empty($panel)){
		    $panel=get_panel_by_dir();
		}
		$type=$this->session->GetCurrentUserType();
		$currentUrl=current_url();
		$currentUrl=urlencode($currentUrl);
		if(!empty($currentUrl)){
			$currentUrl='_ru='.$currentUrl;
		}
		if(empty($type)){
		    if(!$isReturn){
    			if($panel=="A"){
    				redirect('admin/user/login?'.$currentUrl,'auto');
    			}elseif($panel=="C"){
    				redirect(base_url(),'auto');
    			}else{
    				redirect(base_url(),'auto');
    			}
		    }else{
		        return false;
		    }
		}else{
			if($panel=="*"){
				return true;
			}
		}
		if($panel=="A" && $type!="AD"){
			if(!$isReturn){redirect('admin/user/login','auto');}
			return false;
		}
		
		
		if($panel=="A" && (!$_method_permission_check || ACL::HasPermission())){
			return true;
		}
		
		if(($type=="CU" && $panel=="C") || ($type=="AD" && $panel=="C")){
			$userData=GetUserData();
			if(!empty($userData)){
				return true;
			}
			if(!$isReturn){redirect('error/denied-page','auto');}
			return false;
		}
		if(!$isReturn){redirect('error/denied-page','auto');}
		return false;
		
	}
	public static function LoadApiController(){
	    if(file_exists(APPPATH."core".DIRECTORY_SEPARATOR."APP_APIController.php")){
	        require_once APPPATH."core".DIRECTORY_SEPARATOR."APP_APIController.php";
	    }else{
	        show_error(APPPATH."core".DIRECTORY_SEPARATOR."APP_APIController.php file doesn't exits",404);
	    }
	}
	public static function LoadChartDataController(){
	    if(file_exists(APPPATH."core".DIRECTORY_SEPARATOR."APP_ChartDataController.php")){
	        require_once APPPATH."core".DIRECTORY_SEPARATOR."APP_ChartDataController.php";
	    }else{
	        show_error(APPPATH."core".DIRECTORY_SEPARATOR."APP_ChartDataController.php file doesn't exits",404);
	    }
	}
	
	
	function SetThemeBySessionType(){
		$user_type=GetCurrentUserType();
		if($user_type=="RO"){
			$this->load->view("root/menus");
		}elseif($user_type=="AD"){
			$this->load->view("admin/menus");
			$appcolor=$this->config->item("admin_app_color");
			$this->SetAPPColor($appcolor);
		}elseif($user_type=="AG"){
			$this->load->view("agent/menus");
			$appcolor=$this->config->item("agent_app_color");
			$this->SetAPPColor($appcolor);
		}elseif($user_type=="SF"){
			$this->load->view("staff/menus");
			$appcolor=$this->config->item("agent_app_color");
			$this->SetAPPColor($appcolor);
		}elseif($user_type=="CU"){
			$this->load->view("member/menus");
			$appcolor=$this->config->item("member_app_color");
			$this->SetAPPColor($appcolor);
		}
	}
	protected function DisplayPrintPreview($viewName=''){
		//$this->router=new CI_Router();
		if(empty($viewName)){
			$viewName=(!empty($this->view_controler_dir)?$this->view_controler_dir."/":"").(!empty($this->view_controler_path)?$this->view_controler_path."/":"").$this->view_file_path;
		}
	
		$this->load->library('user_agent');
		$this->output->set_template('printpreview');
		$this->output->set_title($this->viewData['_title']);
		$this->load->view($viewName,$this->viewData);
	}
}