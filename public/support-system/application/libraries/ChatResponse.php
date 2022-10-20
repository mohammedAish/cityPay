<?php
class ChatResponse{
	public $id="";
	public $msg="unknown";
    public $header_msg="";
	public $currentItem=null;
	public $open_user_id="";
	public $lastData=[];
	public $temp_id_prefix;
    public $start_time;
    public $isStarted=false;
    public $status;
    public $clientImg="";
    public $isAdminTyping=false;
    public $isUserTyping=false;
    public $isResetChatWindow=false;
	function __construct()
    {
        if(function_exists("base_url")){
            $this->temp_id_prefix=hash("crc32b",base_url())."_";
        }else{
            $this->temp_id_prefix="APBDWCHT_";
        }
    }
    function StartChat($id,$msg=""){
	    $this->id=$id;
	    $this->msg=$msg;
	    $this->status=true;
	    $this->Display();
    }
    function SetCurrentItem($obj)
    {
        $this->currentItem = $obj;
    }
    function SetHeaderMessage($message){
        //$obj->msg_time=get_user_datetime_default_format($obj->msg_time);
        if(!is_string($message)){
            $message="Unknow message";
        }
        $this->header_msg=$message;
    }
    function AddItem($obj){
        //$obj->msg_time=get_user_datetime_default_format($obj->msg_time);
        $this->lastData[]=$obj;
    }
    /*function DisplayResponse($staus,$msg,$data=NULL,$is_sticky=false,$title="Notification"){
		$this->SetResponse($staus, $msg,$data,$is_sticky,$title);
		$this->Display();
	}*/
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