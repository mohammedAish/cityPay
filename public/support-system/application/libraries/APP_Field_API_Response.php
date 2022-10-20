<?php
class APP_Field_API_Response{
	public $status=false;
	public $msg="unknown";
	public $data=null;
	public $rtime=null;
	function __construct(){
		$this->rtime=time();
	}
	function SetResponse($staus,$msg,$data=NULL){
		$this->status=$staus;
		$this->msg=$msg;
		$this->data=$data;
	}
	function __toString(){
		return json_encode ($this);
	}
}