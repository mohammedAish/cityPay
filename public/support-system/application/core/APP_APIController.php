<?php
class APP_APIController extends APP_Controller {
 	/**
 	 * @var APPAPIResponse
 	 */
 	protected $response;
 	protected $postedData;
 	protected  $isDisplayed=false;
 	protected $isDebugMode=false; 
 	public $userTimezone="";
    function __construct(){
        parent::__construct();
        $this->load->library("APPAPIResponse");
        $this->output->unset_template();
        $this->response=new APPAPIResponse();        
         $this->isDebugMode=ENVIRONMENT!="production";
         $request=$this->input->post(); 
         $this->postedData=$request;
         $this->AddApiFileLog("Current URL:".current_url());
         $this->AddApiFileLog("User Agent:".$this->input->user_agent(),true);
         $this->AddApiFileLog("Request:\n".json_encode($request),true); 
         $useragent=$this->input->user_agent();    
    }   	
    function __destruct(){
        parent::__destruct();
    	if(!$this->isDisplayed){
    		$this->Display();
    	}
    }  
    protected  function get_user_timezone(){
        if(empty($this->userTimezone)){
            $userTimezone=$this->PostValue("tZone");
            $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
            $tzlist = array_map(function (&$val)
            {
                return strtolower($val);
            }, $tzlist);
    
            if(in_array(strtolower($userTimezone), $tzlist)){
                $this->userTimezone=$userTimezone;
            }else{
                $this->userTimezone="UTC";
            }
        }
        return $this->userTimezone;
    }  
    function PostValue($name, $default = "",$isXsClean=true) {    
    	return !empty($this->postedData[$name])?$this->postedData[$name]:$default;
    }
    function setResponse($status,$msg,$data=null,$response_code=404){
    	$this->response->status=$status;
    	$this->response->msg=$msg;
    	
    	/*
    	//temporary
    	$this->response->logged_user="";
    	$userdata=GetAdminData();
    	if(!empty($userdata->user)){
    	    $this->response->logged_user=$userdata->user;
    	}*/
    	//end temporary
    	$this->response->data=$data;
    	
    	$this->response->code=$response_code;
    }
    function AddApiFileLog($logdata,$autodateadd=false){
    	if($this->isDebugMode){
    		AddFileLog($logdata,true,"api.log",$autodateadd);
    	}
    }
    function Display($no_need_to_add=null){    	
     	$this->isDisplayed=true;
     	if($this->response->status){
     		$this->response->code=200;
     	}
     	$this->AddApiFileLog("Response:\n".json_encode($this->response),true);
     	$this->AddApiFileLog("---------------END--------------------\n",true);
     	//$this->output->set_header('Content-Type: text/event-stream');
     //	$this->output->set_header('Cache-Control: no-cache');
     	$evvalue=GetValue("ev",0);
     	if(GetValue("ev",0)>=1){
     		header('Content-Type: text/event-stream');
     		header('Cache-Control: no-cache');
     		$time = date('r');
     		//echo "data: The server time is: {$time}\n\n";
     		$ouput=json_encode($this->response);
     		$retry=$evvalue*1000;     		
     		$ouput="data:".$ouput."\n\nretry:{$retry}\n\n";
     		echo $ouput;
     		flush();
     		die;
     	} 
     	header('Content-Type: text/json');   	
     	die(json_encode($this->response));
    }  
    protected function CheckAdminSession($skips='',$isReturn=false,$redirect_page=''){
            $response=Mapp_user::HasAdminSession();
            if($isReturn){
                return $response;
            }
            if(!$response){
                $this->response->code=401;
                $this->response->status=false;
                $this->response->msg="Authenticaiton Error";
                $this->Display();
            }
        
        return $response;
    } 
    protected function CheckPageAccess($skips='',$panel="",$isReturn=false,$redirect_page='',$_method_permission_check=true){
    	if(!parent::CheckPageAccess($skips,$panel,true)){
    		if($isReturn){
    			return false;
    		} 
    		$this->response->code=401;
    		$this->response->status=false;
    		$this->response->msg="Authenticaiton Error";
    		$this->Display();    				
    	}
    	return true;
    }
}
