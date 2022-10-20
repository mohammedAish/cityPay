<?php
class APPAPIResponse {
    public $status=false;
    public $code=404;
    public $msg="Unknown";
    //public $msg_type=false;
    public $data=null;
    public $rtime;
    function __construct(){
        $this->rtime=time();
    }
    function displayResponse(){
        die(json_encode($this));
    }
    function setResponse($status,$msg,$data=null,$response_code=404){
        $this->status=$status;
        $this->msg=$msg;      
        $this->data=$data;         
        $this->code=$response_code;
    }
}