<?php
/**
 * @since: 21/04/2018
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @property Msite_user [] $loadedUserList;
 */
class ChatAdminLib{
    /**
     * @var ChatResponse
     */
    public $response;
    public $request;
    private $loadedUserList=[];
    function __construct()
    {
            $this->response=new ChatAdminResponse();
            $this->request=new ChatAdminRequest();
    }
    static function handle_request(){
        $obj=new self();
        $obj->_handle();
    }
    function _handle(){
        switch ($this->request->topic){
            case "start":
                $this->start_chat();
                break;
            case "newentry":
                $this->new_entry();
                break;
            case "checking":
                $this->checking();
            case "loadmore":
                $this->loadmore();
            case "attach":
                $this->file_attached();
                break;
            break;
            default:

        }
    }
    function loadmore()
    {
        $responseObj=[];
        $lastMsgId=PostValue("last_msg_id");
        $chatId=PostValue("currentChatId");
        if(!empty($lastMsgId) && !empty($chatId)){
            $chatobj=Mchat::FindBy("id",$chatId);
            if($chatobj){
                $mc=new Mchat_msg();
                $mc->chat_id($chatId);
                $mc->msg_id("<'".$lastMsgId."'",true);
                $datas=$mc->SelectAll("","entry_time","DESC",10);
                foreach ($datas as $d){
                    $responseObj[]=$this->db_obj_chat_msg_obj($d,$chatobj);
                }
            }

        }
        echo json_encode($responseObj);die;
    }
    function file_attached()
    {
        $adminData=GetAdminData();
        $chat_id=PostValue("chatId");
        $msg="Unknown Error";
        $attachStatus=false;
        $name="";
        if(!empty($adminData) && !empty($chat_id)) {
            $chatobj = Mchat::FindBy("id", $chat_id);
            $allowed_file_type = Mapp_setting::GetSettingsValue("allowed_file_type");
            $allowed_file_type = explode("|", $allowed_file_type);
            $max_file_upload_size = Mapp_setting::GetSettingsValue("max_file_upload_size");
            if ($_FILES['attach_file']['error'] == 0) {
                $name = $_FILES['attach_file']['name'];
                $extn = substr($name, -3);
                $extn2 = substr($name, -4);
                $usize = $_FILES['attach_file']['size'];
                if (in_array($extn, $allowed_file_type) || in_array($extn2, $allowed_file_type)) {
                    if (($usize / 1048576) < $max_file_upload_size) {
                        $upfilename = preg_replace('/[^a-z0-9\.]/i', "", $name);
                        $filePath = "data/chat_file/{$chat_id}";
                        if (!is_dir(FCPATH.$filePath)) {
                            app_make_dir(FCPATH.$filePath);
                            if(!file_exists(FCPATH."data/chat_file/index.html")){
                                file_put_contents(FCPATH."data/chat_file/index.html","Access Denied");
                            }
                        }

                        if(strlen($upfilename)>30){
                            $upfilename=substr($upfilename,0,10)."..".substr($upfilename,-20);
                        }
                        if (file_exists(FCPATH.$filePath . "/" . $upfilename)) {
                            $co=1;
                            do {
                                $fileTempPath=$co."_".$upfilename;
                                $co++;
                            }while(file_exists(FCPATH.$filePath . "/" .$fileTempPath));
                            $upfilename =$fileTempPath;
                        }
                        if (move_uploaded_file($_FILES['attach_file']['tmp_name'], FCPATH.$filePath . "/" . $upfilename)) {
                            $upUrl = site_url("chat/dl/$chat_id?f=$upfilename&sk=--sessionkey--");
                            $nobj = new Mchat_msg();
                            $nobj->chat_id($chat_id);
                            $chatmsg = "";
                            $isImageFile = strtolower(substr($_FILES['attach_file']['type'], 0,3)) == "ima";
                            if ($isImageFile) {
                                $chatmsg = '<div class="apc-attach-file"><a class="apc-chat-img" target="_blank" href="' . $upUrl . '"><img src="' . $upUrl . '" alt="' . $upfilename . '"></a>
                                <a class="apc-chat-img-dl" target="_blank" href="' . $upUrl. '">'.__("Download").'</a>
                                </div>';
                            } else {
                                $chatmsg = '<div class="apc-attach-file"><a class="apc-chat-file" target="_blank" href="' . $upUrl . '">'.
                                    '<i class="fa fa-file"></i> ' . $upfilename . '</a></div>';
                            }
                            $nobj->msg($chatmsg);
                            $nobj->reply_user_type("A");//"S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User";
                            $nobj->reply_user_id($adminData->id);
                            $nobj->temp_id($adminData->id.time());
                            $nobj->form_id("");
                            $nobj->entry_time(date('Y-m-d H:i:s'));
                            if ($nobj->Save()) {
                                $attachStatus=true;
                            }
                        }
                    } else {
                        $msg = _e("File larger than %s MB : %s", $max_file_upload_size, $name);
                    }
                } else {
                    $msg = _e("Unsupported type of file: %s", $name);
                }

            } else {
                $a = [
                    0 => "There is no error, the file uploaded with success",
                    1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                    2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                    3 => "The uploaded file was only partially uploaded",
                    4 => "No file was uploaded",
                    6 => "Missing a temporary folder"
                ];
                $msg = isset($_FILES['attach_file']['error']) ? $_FILES['attach_file']['error'] : _("File Upload Error");
            }
            Mchat::setAdminTyping($this->request->currentChatId,($this->request->isUserTyping?"Y":"N"),$this->request->userId);

           // $this->setResponseData($chatobj);
        }
       
        $this->loadMessage();
	    $this->response->attach_status=$attachStatus;
	    $this->response->attach_msg=$msg;
        $this->response->Display();

    }

    /**
     * @param Mchat $chat_obj
     * @param string $msg
     * @param $type
     * @param string $temp_id
     * @param string $form_id
     * @return Mchat_msg|null
     */
    private function addNewMsg($chat_obj, $msg, $type, $temp_id='', $form_id='')
    {
        $reply_user_id=$this->request->userId;
        if($chat_obj instanceof  Mchat){
            $chat_id=$chat_obj->id;
        }
        $type = strtoupper($type);
        $nobj = new Mchat_msg();
        $nobj->chat_id($chat_id);
        $nobj->msg($msg);
        $nobj->reply_user_type($type);//"S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User";
        if(!empty($reply_user_id)){
            $nobj->reply_user_id($reply_user_id);
        }
        $nobj->temp_id($temp_id);
        $nobj->form_id($form_id);
        $nobj->entry_time(date('Y-m-d H:i:s'));
        if ($nobj->Save()) {
            return $nobj;
        }
        return null;
    }


    /**
     * @param $client_id
     * @return Msite_user
     */
    private function get_client_data($client_id){
        if(!isset($this->loadedUserList[$client_id])){
            $this->loadedUserList[$client_id]=Msite_user::FindBy("id",$client_id);
        }
        return $this->loadedUserList[$client_id];
    }

    /**
     * @param Mchat_msg $mcmobj
     * @param Mchat $chatObj
     * @return stdClass
     */
    private function db_obj_chat_msg_obj($mcmobj,$chatObj)
    {
        $newobj = new stdClass();
        $newobj->id = $mcmobj->msg_id;
        $newobj->temp_id = $mcmobj->temp_id;
        if(empty($newobj->temp_id)){
            $newobj->temp_id=$mcmobj->msg_id;
        }
        $newobj->msg_html = $mcmobj->msg;
        $newobj->msg_time = get_user_datetime_default_format($mcmobj->entry_time);;
        $newobj->chatId = $mcmobj->chat_id;
        $newobj->senderType = $mcmobj->reply_user_type;
        if ($newobj->senderType == "S") {
            $newobj->senderImg = base_url("images/logo.png");
        } elseif ($newobj->senderType == "A") {
            $newobj->senderImg = Mapp_user::get_user_image_url($mcmobj->reply_user_id);
        } elseif ($newobj->senderType == "C") {
            if(!empty($chatObj->open_user_id)){
                $ug=$this->get_client_data($chatObj->open_user_id);
                $newobj->senderImg=!empty($ug->photo_url)?$ug->photo_url:base_url("images/no-image.png");
            }else{
                $newobj->senderImg=base_url("images/no-image.png");
            }

        }
        return $newobj;
    }
    function loadMessage(){
        $mchat=new Mchat();
        $mchat->current_admin_user($this->request->userId);
        $mchat->status("A");
        $this->response->chatlist=$mchat->SelectAllGridData('',"start_time","DESC");
        $limit=$this->request->isFirstLoad?20:10;
        foreach ($this->response->chatlist as &$ct) {
            $ct->start_time=app_time_elapsed_string($ct->start_time);
            $ct->end_time=app_time_elapsed_string($ct->end_time);
            $mchatMessage = new Mchat_msg();
            $mchatMessage->chat_id($ct->id);
            $ct->open_user_title=__("Guest User");
            if(!empty($ct->open_user_id)){
                $ug=$this->get_client_data($ct->open_user_id);
                $ct->open_user_title=$ug->first_name." ".$ug->last_name;
            }
            $ct->msgs = [];
            $msgs = $mchatMessage->SelectAllGridData('', 'entry_time', 'DESC', $limit);
            foreach ($msgs as $msg) {
                $ct->msgs[] = $this->db_obj_chat_msg_obj($msg,$ct);
            }
        }

        $mchat=new Mchat();
        $mchat->current_admin_user($this->request->userId);
        $mchat->status("C");

        $this->response->chatEndlist=$mchat->SelectAllGridData('',"start_time","DESC",5);
        foreach ($this->response->chatEndlist as &$ct) {
            $ct->start_time=app_time_elapsed_string($ct->start_time);
            $ct->end_time=app_time_elapsed_string($ct->end_time);
            $mchatMessage = new Mchat_msg();
            $mchatMessage->chat_id($ct->id);
            $ct->open_user_title=__("Guest User");
            if(!empty($ct->open_user_id)){
                $ug=$this->get_client_data($ct->open_user_id);
                $ct->open_user_title=$ug->first_name." ".$ug->last_name;
            }
            $ct->msgs = [];
            $msgs = $mchatMessage->SelectAllGridData('', 'entry_time', 'DESC', $limit);
            foreach ($msgs as $msg) {
                $ct->msgs[] = $this->db_obj_chat_msg_obj($msg,$ct);
            }
        }

    }
    function start_chat()
    {

    }
    static function add_initial_entry($user_id,$chat_id)
    {

        $welcomemessage = Mapp_setting_api::GetSettingsValue("webchat", "agent_welcome_text");
        if (!empty($chat_id)) {
            $statobj = Mchat::FindBy("id",$chat_id);
            if (!empty($statobj->current_admin_user)) {
                $appuser = Mapp_user::FindBy("id",$user_id);
                $pro = [];
                if ($appuser) {
                    $pro["agent_name"] = $appuser->title;
                }
                self::SetHeaderMessageProperties($pro, $welcomemessage);
            }
        }
        $nobj = new Mchat_msg();
        $nobj->chat_id($chat_id);
        $nobj->msg($welcomemessage);
        $nobj->reply_user_type("A");//"S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User";

        $nobj->reply_user_id($user_id);
        $nobj->temp_id($user_id.time());
        $nobj->form_id("");
        $nobj->entry_time(date('Y-m-d H:i:s'));
        if ($nobj->Save()) {
            return $nobj;
        }
        return null;

    }
	private function db_obj_chat_obj($mcobj,$clientImg=""){
		$this->response->open_user_id=$mcobj->open_user_id;
		$this->response->id=$mcobj->id;
		$this->response->status=true;
		$this->response->chatStatus=$mcobj->status;
		$this->response->start_time=date("H:i",strtotime($mcobj->start_time));
		$this->response->msg="";
		$this->response->isClosed=$mcobj->status=="C";
		$this->response->SetHeaderMessage($mcobj->header_msg);
		$this->response->isStarted=$mcobj->status=="A";
		$cu=GetCurrentUserType();
		$this->response->clientImg="";
		if(empty($clientImg)){
			if($cu=="CU"){
				$userData=GetUserData();
				if(!empty($mcobj->open_user_id) && $mcobj->open_user_id==$userData->id){
					$this->response->clientImg=$userData->user_img;
				}
			}elseif (!empty($mcobj->open_user_id)){
				$ug=Msite_user::FindBy("id",$mcobj->open_user_id);
				$this->response->clientImg=$ug->photo_url;
			}
		}
		else{
			$this->response->clientImg=$clientImg;
		}
		if(empty($this->response->clientImg)){
			$this->response->clientImg=image_url("images/no-image.png");
		}
		$this->response->isAdminTyping=$mcobj->is_remote_typing=="Y";
		$this->response->isUserTyping=$mcobj->is_user_typing=="Y";
	}
	private function setResponseData($chat,$clientImg="",$userTypingStatus=""){
		if($chat instanceof  Mchat){
			if(!empty($userTypingStatus) || ($chat->is_user_typing!=$userTypingStatus)){
				$uchat=new Mchat();
				$uchat->is_user_typing($userTypingStatus);
				$uchat->SetWhereCondition("id",$chat->id);
				$uchat->Update();
			}
			$this->db_obj_chat_obj($chat,$clientImg="");
			$datas=Mchat_msg::FindAllBy("chat_id",$chat->id,[],"entry_time","DESC",10);
			foreach ($datas as $d){
				$od=$this->db_obj_chat_msg_obj($d);
				$this->response->AddItem($od);
			}
		}elseif(empty($chat)){
			$this->response->open_user_id="";
			$this->response->id="";
			$this->response->status=false;
			$this->response->chatStatus="X";
			$this->response->start_time="";
			$this->response->msg="";
			$this->response->isClosed=true;
			$this->response->SetHeaderMessage("");
			$this->response->isStarted=false;
			$this->response->isAdminTyping=false;
			$this->response->isUserTyping=false;
		}
		
	}
    private static function SetHeaderMessageProperties(&$properties,&$msg){
        if(!is_array($properties)){
            return;
        }
        foreach ($properties as $p => $v) {
            echo "/\{\{$p\}\}/i";
            $msg = preg_replace("/\{\{$p\}\}/i", $v, $msg);
        }
    }
    function new_entry()
    {
        if(!empty($this->request->currentChatId)){
            $chatobj=Mchat::FindBy("id",$this->request->currentChatId);
            $newObj=$this->request->newEntry;
            if(!empty($newObj)){
                $objs=$this->addNewMsg($chatobj,$newObj['msg_html'],$newObj['senderType'],$newObj['temp_id']);
                Mchat::setLastMsgTime($chatobj->id,"A");
                $newresponseobj=$this->db_obj_chat_msg_obj($objs,$chatobj);
                $this->response->SetCurrentItem($newresponseobj);
            }
            Mchat::setAdminTyping($chatobj->id,'N',$this->request->userId);
        }
        $this->loadMessage();
        //var_dump($this->request);
        $this->response->Display();
    }
    function checking()
    {
        //var_dump($this->request);
        Mchat::setAdminTyping($this->request->currentChatId,($this->request->isUserTyping?"Y":"N"),$this->request->userId);
       $this->loadMessage();

       $this->response->Display();

    }

}

class ChatAdminRequest
{
    public $currentChatId;
    public $isUserTyping;
    public $topic;
    public $userId;
    public $newEntry;
    public $isFirstLoad=false;

    function __construct()
    {
        $this->currentChatId=PostValue("currentChatId");
        $this->isUserTyping=PostValue("isUserTyping")=="true";
        $this->topic=PostValue("topic");
        $this->topic=strtolower($this->topic);
        $this->userId=PostValue("userId");
        $this->newEntry=PostValue("newEntry",null);
        $this->isFirstLoad=PostValue("isFirstLoad",'false')=="true";
    }
}