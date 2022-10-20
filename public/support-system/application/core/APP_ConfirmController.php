<?php
class APP_ConfirmController extends APP_Controller {
	/**
	 * @var AjaxConfirmResponse
	 */
	private $response;	
	private $isDownloadCSV=false;
	private $is_displayed_response=false;
	private $is_debug_mode=false;
	function __construct(){	
		parent::__construct();
		$this->output->unset_template();
		$this->response=new AjaxConfirmResponse();
		$this->is_debug_mode=ENVIRONMENT=="development";
		ob_start();
		
		
	}	
	protected function checkDemoMode(){
	    if(ISDEMOMODE){
	        $this->SetConfirmResponse(false,"The update has been disabled in DEMO MODE",null,false,"Demo Mode","puzzle-piece");
	        $this->DisplayConfirmResponse();
	        return false;
	    }
	}	
	function __destruct(){
	    parent::__destruct();
	    if(!$this->is_displayed_response){
	        $this->DisplayConfirmResponse();
	    }
	}
	function set_debug($status){
	    $this->is_debug_mode=$status;
	}
	function checkManualPermission($uri){
	    if(!ACL::HasPermission("admin/api-setting/paypal-setting")){
	        $this->SetConfirmResponse(false, "Permission Denied or logged out.",null,false,"Authentication Error","user-times");
	        //$this->response->msg="";
	        $this->DisplayConfirmResponse();
	        return false;
	    }
	    return true;
	}
	/*protected function AddIntoPageList(){
	
	}*/
	protected function CheckPageAccess($skips='',$panel="",$isReturn=false,$redirect_page='',$_method_permission_check=true){
	    //return Mapp_user::HasAdminSession();
	    $is_checkPage= parent::CheckPageAccess($skips,$panel,true);
	    if(!$is_checkPage){
	    	$this->SetConfirmResponse(false, "Permission Denied or logged out.",null,false,"Authentication Error","user-times");
	        //$this->response->msg="";
	        $this->DisplayConfirmResponse();
	    }
	}
	protected function SetConfirmResponse($staus,$msg,$data=NULL,$is_sticky=false,$title='Notification',$icon=''){
		$this->response->status=$staus;
		$this->response->msg=__($msg);
		$this->response->data=$data;
		$this->response->title=__($title);
		$this->response->is_sticky=$is_sticky;
		$this->response->icon=str_replace(array("fa-","ion-"), array(" fa-"," ion-"), $icon);
	}
    protected function SetConfirmResponseTranslated($staus,$msg,$data=NULL,$is_sticky=false,$title='Notification',$icon=''){
        $this->response->status=$staus;
        $this->response->msg=$msg;
        $this->response->data=$data;
        $this->response->title=$title;
        $this->response->is_sticky=$is_sticky;
        $this->response->icon=str_replace(array("fa-","ion-"), array(" fa-"," ion-"), $icon);
    }
	protected function DisplayConfirmResponse(){	  
	   if($this->is_debug_mode){
	       echo ob_get_clean();
	   }else{
	       error_reporting(0);
	       ob_end_clean();
	   }
       $this->is_displayed_response=true;
       $this->response->msg=__($this->response->msg);
	   echo json_encode ( $this->response );die;
	}
	
	
}

