<?php
/**
 * Version 1.0.0
 * Creation date: 27/Oct/2015
 * @Written By: S.M. Sarwar Hasan (Appsbd) 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class session {
	var $prefix="_dwbd";
	var $admin_prefix="_dwbd_admin";
	function __construct() {
	    $ci=get_instance();
	    $sesprefix=$ci->config->item("sess_prefix");
	    $sescookienmae=$ci->config->item("sess_cookie_name");
	    if(!is_cli()){
	    $ses_time=time()+$ci->config->item("sess_expiration");
	    session_name($sescookienmae);
	    session_set_cookie_params($ses_time,'/','',false,true);
		session_start ();	
		if(!isset($_SESSION[$sesprefix.'__my_stime'])){
		    $ses_update_time=$ci->config->item("sess_time_to_update");
		    $_SESSION[$sesprefix.'__my_stime']=strtotime("+ $ses_update_time SECOND");
		}else{
		    $ses_update_time=$ci->config->item("sess_time_to_update");
    		$mysesstion=$_SESSION[$sesprefix.'__my_stime'];
    		if($mysesstion<time()){
    		    $bk=$_SESSION;
    		    session_regenerate_id(true);
    		    $_SESSION=$bk;
    		    $_SESSION[$sesprefix.'__my_stime']=strtotime("+ $ses_update_time SECOND");
    		    //AddFileLog("Session Regenerated-updated",true,"session.log");
    		}
	    }
	    //$this->CheckSessionTokenKey();
	   
	    }
		
		if(empty($sesprefix)){
			$sesprefix=hash("crc32b",base_url());
		}
		$this->prefix=$sesprefix;
		$this->admin_prefix="admin_".$sesprefix;
		//$currentCookieParams = session_get_cookie_params();
		//var_dump($_SESSION);
		//echo date('H:i:s')." =>".date('H:i:s',$_SESSION[$sesprefix.'__my_stime']);
		//die;
	}
	private function CheckSessionTokenKey(){
		//we could add ip protection here but for some reason we didn't do here
        if(empty($_SESSION['app_ses_key_']) || $_SESSION['app_ses_key_']!=$_SERVER['HTTP_USER_AGENT']){
            $this->UnsetAllUserData();
            
	    }
	}
	function GetUniqueId($isWIthTime=false){
		//$uId=$_SESSION["SID"]
		$uid=$isWIthTime?session_id().time():session_id();
		return md5($uid);
		
	}
	function CleanForSession(&$obj){
		if(method_exists($obj, "CleanForSession")){
			$obj->CleanForSession();
			
		}
		if(is_array($obj)&& is_object($obj)){ foreach ($obj as $key=>$value){
			
			if(method_exists($obj->$key, "CleanForSession")){				
				$this->CleanForSession($obj->$key);
			}
		}
		}
	}
	function SetSession($name, $obj) {
		$this->CleanForSession($obj);
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			unset ( $_SESSION [$this->prefix.$name] );
		}
		$_SESSION [$this->prefix.$name] = serialize ( $obj );
	
	}
	function NewSession(){			
		//session_destroy();
		//session_start();
		foreach ($_SESSION as $key=>$value){
			if($key=="Country"){
				continue;
			}
			unset($_SESSION[$key]);			
		}
	}
	function DestroySession(){
		session_destroy();
	}
	function GetSession($name, $isUnset = false,$default=null) {		
		$rData = null;
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			$rData = unserialize ( $_SESSION [$this->prefix.$name] );
			if ($isUnset) {
				unset ( $_SESSION [$this->prefix.$name] );
			}
			return $rData;
		} else {
			return $default;
		}
	}
	function GetCurrentUserType() {		
		if (isset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] )) {
				$data = unserialize ( $_SESSION [$this->admin_prefix.'loggedAdminData'] );
				if (!empty($data->LoggedIn)) {
					return "AD";
				}
		}
		if (isset ( $_SESSION [$this->prefix.'loggedAgentData'] )) {
			$data = unserialize ( $_SESSION [$this->prefix.'loggedAgentData'] );
			if (isset($data->LoggedIn)&& $data->LoggedIn) {
				return "AG";
			}
		}
		if (isset ( $_SESSION [$this->prefix.'loggedStaffData'] )) {
			$data = unserialize ( $_SESSION [$this->prefix.'loggedStaffData'] );
			if (isset($data->LoggedIn)&& $data->LoggedIn) {
				return "SF";
			}
		}	
		if (isset ( $_SESSION [$this->prefix.'loggedCallCenterData'] )) {
			$data = unserialize ( $_SESSION [$this->prefix.'loggedCallCenterData'] );
			if (isset($data->LoggedIn)&& $data->LoggedIn) {
				return "CC";
			}
		} 	
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			$data = unserialize ( $_SESSION [$this->prefix.'loggedUserData'] );
			if (isset($data->LoggedIn)&& $data->LoggedIn) {
				return "CU";
			}
		} 			
		return null;
	}
	
	function SetAdminData($obj) {
		$this->CleanForSession($obj);
		if (isset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] )) {
			unset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] );
		}
		$_SESSION [$this->admin_prefix.'loggedAdminData'] = serialize ( $obj );
	}
	/**
	 * Enter description here ...
	 * @return AdminSessionData|NULL
	 */
	function GetAdminData() {
		if (isset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] )) {
			return unserialize ( $_SESSION [$this->admin_prefix.'loggedAdminData'] );
		} else {
			return null;
		}
	}
	function GetAgentData() {
		if (isset ( $_SESSION [$this->prefix.'loggedAgentData'] )) {
			return unserialize ( $_SESSION [$this->prefix.'loggedAgentData'] );
		} else {
			return null;
		}
	}
	function GetStaffData() {
		if (isset ( $_SESSION [$this->prefix.'loggedStaffData'] )) {
			return unserialize ( $_SESSION [$this->prefix.'loggedStaffData'] );
		} else {
			return null;
		}
	}
	function SetCallCenterData($obj) {
		if (isset ( $_SESSION [$this->prefix.'loggedCallCenterData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedCallCenterData'] );
		}
		$_SESSION [$this->prefix.'loggedCallCenterData'] = serialize ( $obj );
	}
	/**
	 * Enter description here ...
	 * @return CallCenterSessionData|NULL
	 */
	function GetCallCenterData() {
		if (isset ( $_SESSION [$this->prefix.'loggedCallCenterData'] )) {
			return unserialize ( $_SESSION [$this->prefix.'loggedCallCenterData'] );
		} else {
			return null;
		}
	}
	function IssetSession($sessionName){		
		return isset ( $_SESSION [$this->prefix.$sessionName] );
	}
	/**
	 * @param UserSessionData $obj
	 */
	function SetUserData($obj) {
		$this->CleanForSession($obj);
		//print_r($obj);
	//	echo "<p>Count</p>";
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedUserData'] );
		}
		$_SESSION [$this->prefix.'loggedUserData'] = serialize ( $obj );
	}
	function SetExtnUserData($obj) {
		$this->CleanForSession($obj);
		//print_r($obj);
	//	echo "<p>Count</p>";
		if (isset ( $_SESSION [$this->prefix.'loggedExtnUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedExtnUserData'] );
		}
		$_SESSION [$this->prefix.'loggedExtnUserData'] = serialize ( $obj );
	}
	/**
	 * @param AgentSessionData $obj
	 */
	function SetAgentData($obj) {
		$this->CleanForSession($obj);
		//print_r($obj);
		//	echo "<p>Count</p>";
		if (isset ( $_SESSION [$this->prefix.'loggedAgentData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedAgentData'] );
		}
		$_SESSION [$this->prefix.'loggedAgentData'] = serialize ( $obj );
	}
	
	/**
	 * @param StaffSessionData $obj
	 */
	function SetStaffData($obj) {
		$this->CleanForSession($obj);
		//print_r($obj);
		//	echo "<p>Count</p>";
		if (isset ( $_SESSION [$this->prefix.'loggedStaffData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedStaffData'] );
		}
		$_SESSION [$this->prefix.'loggedStaffData'] = serialize ( $obj );
	}
	
	function UnsetUserData() {
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedUserData'] );
		}
	
	}
	function UnsetExtnUserData() {
		if (isset ( $_SESSION [$this->prefix.'loggedExtnUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedExtnUserData'] );
		}
	
	}
	static function hasAdminSession(){
	    $ci=get_instance();
	    $type=$ci->session->GetCurrentUserType();
	    return $type=="AD";
	}
	
	/**
	 * Session User data ...
	 * @return UserData
	 */
	function GetUserData() {		
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			$data=unserialize ( $_SESSION [$this->prefix.'loggedUserData'] );
			//print_r($data);
			return unserialize ( $_SESSION [$this->prefix.'loggedUserData'] );
		} else {
			return null;
		}
	}
		
	function UnsetSession($name) {
		if (isset ( $_SESSION [$this->prefix.$name] )) {
			unset ( $_SESSION [$this->prefix.$name] );
		}
	}
	
	function UnsetAllUserData() {		
		if (isset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] )) {
			unset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] );
		}
		if (isset ( $_SESSION [$this->prefix.'loggedCallCenterData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedCallCenterData'] );
		}
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedUserData'] );		
		}	

		if (isset ( $_SESSION [$this->admin_prefix.'loggedAdminData'] )) {
			$data = unserialize ( $_SESSION [$this->admin_prefix.'loggedAdminData'] );
			if (!empty($data->LoggedIn)) {
				return "AD";
			}
		}
		if (isset ( $_SESSION [$this->prefix.'loggedAgentData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedAgentData'] );
		}
		if (isset ( $_SESSION [$this->prefix.'loggedStaffData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedStaffData'] );
		}
		if (isset ( $_SESSION [$this->prefix.'loggedCallCenterData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedCallCenterData'] );
		}
		
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedUserData'] );
		}
		session_regenerate_id(true);
		if(!is_cli()) {
            if (!empty($_SERVER['HTTP_USER_AGENT'])) {
                $_SESSION['app_ses_key_'] = $_SERVER['HTTP_USER_AGENT'];
            }
        }
	}
	
	function UsetAllCustomerData(){
		if (isset ( $_SESSION [$this->prefix.'loggedUserData'] )) {
			unset ( $_SESSION [$this->prefix.'loggedUserData'] );
		}			
		$this->UnsetSession("ac_first");
	}
}
class MainUserSession{
	public $LoggedIn;
	public $user_img;
	public $add_date;
	public $role_title;
	public $panel;	
	public $RoleAccess=array();
	public $timezone;
	function getLogoutUrl(){		
		if($this->panel=="A"){
			return site_url("admin/user/logout");
		}elseif ($this->panel=="G"){
			return site_url("agent/user/logout");
		}elseif ($this->panel=="S"){
			return site_url("staff/user/logout");
		}elseif ($this->panel=="M"){
			return site_url("user/logout");
		}
		return site_url("user/logout");
	}
}
class UserSessionData  extends MainUserSession{	
    public $id;
	public $user;
	public $title;	
	public $email;	
	public $role;
	public $panel;	
	public $add_date;	
	public $is_verified_email;	
	public $user_type;
	public $login_type;
	public $is_skip_old_pass=false;
	
}
class CallCenterSessionData extends MainUserSession{		
	public $userName;
	public $agent_id;
	
}
class AdminSessionData  extends MainUserSession{
	public $id;
	public $user;
	public $title;
	public $email;	
	public $role;
	public $grade;
	public $isChatEnable=false;
	public $RoleAccess=array();
	public $ProductBase=array();
	public $ProductAccess=array();
	function IsSuperUser(){
		return $this->grade==0;
	}
	function hasProductPermission($pid){
		return in_array($this->$pid, $this->ProductAccess);
	}
	function hasProductBasePermission($pbase){
		return in_array($this->$pbase, $this->ProductBase);
	}
	function getProductBaseSQLInValue(){
		if(count($this->ProductBase)>0){
			return " IN ('".implode("','", $this->ProductBase)."')";
		}else{
			return " IN ('')";
		}
	}
	function getProductSQLInValue(){
		if(count($this->ProductAccess)>0){
			return " IN ('".implode("','", $this->ProductAccess)."')";
		}else{
			return " IN ('')";
		}
	}
}

class AgentSessionData  extends MainUserSession{
	public $id;
	public $user;
	public $title;
	public $email;
	public $role;
	public $user_img;
	public $add_date;
	public $panel;
	public $grade;
	public $isSubAgent=false;
	public $parent_agent_id="";
	public $RoleAccess=array();
	public $ProductBase=array();
	public $ProductAccess=array();
}
class StaffSessionData  extends MainUserSession{
	public $id;
	public $user;
	public $title;
	public $email;
	public $role;
	public $user_img;
	public $add_date;
	public $panel;
	public $grade;
	public $RoleAccess=array();
	public $ProductBase=array();
	public $ProductAccess=array();
	public $agent_id;
	public $agent_name;
	public $isSubAgent=false;
	public $parent_agent_id="";
	
}


?>
