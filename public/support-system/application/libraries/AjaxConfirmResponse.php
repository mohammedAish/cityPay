<?php
class AjaxConfirmResponse{
	public $status=false;
	public $msg="unknown";
	public $data=null;
	public $is_sticky=false;
	public $title="";
	public $icon="";
	function SetResponse($staus,$msg,$data=NULL,$is_sticky=false,$title="Notification",$icon=""){
		$this->status=$staus;
		$this->msg=__($msg);
		$this->data=$data;
		$this->is_sticky=$is_sticky;
		$this->title=__($title);
		$this->icon=str_replace("fa-", "", $icon);
	}
	function DisplayResponse($staus,$msg,$data=NULL,$is_sticky=false,$title="Notification"){
		$this->SetResponse($staus, $msg,$data,$is_sticky,$title);
		$this->Display();
	}
	function Display(){
		echo json_encode ( $this );die;
	}
}
if(!function_exists("__")){
	function __($msgid)
	{
		return $msgid;  
	}
}