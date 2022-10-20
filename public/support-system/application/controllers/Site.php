<?php
class Site extends APP_Controller {
    private $addon_display_type='';

    function __construct(){
        parent::__construct();
        $this->AddMetaPropertyData("og:image", base_url("images/icon-logo/logo.png"));
    }
    function SetDisplayType($type){
        $type=strtolower($type);
        $this->addon_display_type=$type;
    }
	public function index()
	{
	    AddModule("welcome_msg",APP_Output::MODULE_CONTENT_TOP);
        
	    AddModule("search_module",APP_Output::MODULE_CONTENT_TOP);  
	    AddModule("open_ticket_button",APP_Output::MODULE_BEFORE_CONTENT);
		
		UnsetModule("content_header");
		UnsetModule("breadcrumb");
		$this->SetTitle(get_app_title());
		
		$appHome=Mapp_setting::GetSettingsValue("app_hmp",1);
		if($appHome==2){
		  $this->Display('site/index-2');		
		}else{
		   $this->Display();
		}		
	}
	public function action($action='',...$args){
        $action=strtolower($action);
        ob_start();
        AddOnManager::DoAction("action-" . $action,$this,$args);
        $this->AddViewData("addon_html",ob_get_clean());
        $this->Display();
    }
	public function search(){
	    $srctext=PostValue("src","");
	    $srctext=CleanSearchString($srctext);
	    if($this->input->is_ajax_request() && !empty($srctext)){
	       $result=Mknowledge::Search($srctext);
	       die(json_encode($result));
	    }
	    die(json_encode([]));
	}
	public function page($id='',$title=''){
    	if(empty($id)) {
		    $this->SetTitle( "Undefined page" );
		    $pageObj=new Mcustom_page();
	    }else{
		  
    		$pageObj=Mcustom_page::FindBy("id",$id);
    		if($pageObj){
			    $this->SetTitle( $pageObj->title );
		    }
	    }
	    $this->AddViewData("pageObj",$pageObj);
    	if($this->input->is_ajax_request()){
    		$this->output->set_app_theme('bss2020');
    		$this->SetPOPUPColClass("col-md-11");
		    $this->DisplayPOPUP();
	    }else{
		    $this->Display();
	    }
		
	}
    public function addon($slug='',$action_name='')
    {
        $htmlData = AddOnManager::CallAction('site_'.$slug, $action_name);
        $this->AddViewData('action_html', $htmlData);
        switch ($this->addon_display_type){
            case "p":
                $this->DisplayPOPUP('site/addonpopup');
                break;
            case "m":
                $this->DisplayPOPUPMsg();
                break;
            case "i":
                $this->DisplayPOPUPIframe();
                break;
            case "l":
                $this->Display('user/login_shower');
                break;
            default:
                $this->Display();
        }
    }
    public function subscribe_mail(){
    	$this->output->unset_template();
    	
    	$ajaxResponse=new AjaxConfirmResponse();
    	$mailchampAPI=APP_API::get_api_object('MailChimp');
    	//$mailchampAPI=new MailChimpAPI();
    	$postEmail=PostValue('email');
	    if(ISDEMOMODE){
		    $ajaxResponse->DisplayResponse( false, 'Disabled in demo mode' );
		    return;
	    }
    	if(!empty($postEmail)) {
		    if (!filter_var($postEmail, FILTER_VALIDATE_EMAIL)) {
			    $ajaxResponse->DisplayResponse( false, 'Not a valid email address' );
			    return;
		    }
		    $result = $mailchampAPI->Subscribe( $postEmail );
		    if ( ! empty( $result ) ) {
			    $ajaxResponse->DisplayResponse( true, 'Successfully subscribed');
			    return;
		    } else {
			    $msg = $mailchampAPI->MailChimp->getLastError();
			    $ajaxResponse->DisplayResponse( false, $msg, NULL );
			    return;
		    }
	    }else{
		    $ajaxResponse->DisplayResponse( false, 'Email address is required', NULL );
	    }
    	
    }
	
}