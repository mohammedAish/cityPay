<?php
/**
 * @since: 21/04/2018
 * @author: Sarwar Hasan
 * @version 1.0.0
 */
class ChatLib{
    /**
     * @var ChatResponse
     */
    public $response;
    function __construct()
    {
            $this->response=new ChatResponse();
    }
    function _handle(){
        $topic=PostValue("topic");
        $chatKey=PostValue("chatKey");
        $serverChatKey=self::getChatKey();
        $ci=get_instance();
	    $http_origin = self::GetOrigin();
        if(self::HasOrigin($http_origin) || ($ci->input->is_ajax_request() && ( $chatKey==$serverChatKey))){
            $topic=strtolower($topic);
            switch ($topic){
                case "start":
                    $this->start_chat();
                    break;
                case "newentry":
                    $this->new_entry();
                    break;
                case "checking":
                    $this->checking();
                case "attach":
                    $this->file_attached();
                    break;
                    case "loadmore":
                $this->loadmore();
                break;
                default:

            }
        }else{
            $this->response->status=false;
            $this->response->msg="Invalid parameter";
            $this->response->Display();
        }

    }
    static function handle_request(){
        $obj=new self();
        $obj->_handle();
    }
    static function handle_file_request()
    {
        $obj = new self();
        $obj->_handle();
    }
    static function getChatKey(){
        $ci=get_instance();
        $key=$ci->session->GetSession("cchatkey");
        if(empty($key)){
            $key=uniqid("ct");
            $ci->session->SetSession("cchatkey",$key);
        }
        return $key;
    }
	static function ChatDomains(){
		$domains=$_SERVER['HTTP_HOST'].','.Mapp_setting_api::GetSettingsValue( "webchat", "chat_allowed_domains" );
		$domains=trim($domains);
		if(empty($domains)){
			$domains="*";
			
		}
		return $domains;
	}
	static function GetOrigin() {
		$http_origin = !empty($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:"";
		if(empty($http_origin)){
			return $http_origin;
		}
		$http_origin=parse_url($http_origin, PHP_URL_HOST);
		return $http_origin;
	}
	static function HasOrigin($origin='') {
    	if(empty($origin)){
		    $origin=self::GetOrigin();
	    }
		$domains=self::ChatDomains();
		if($domains=="*"){
			return true;
		}
		$domains=explode(',',$domains);
		$domains=array_filter($domains,function($val){
			return trim($val);
		});
		
		return in_array($origin,$domains);
	}
	static function GenerateHtaccess(){
    	//plugins/apsbd-chat/.htaccess
		$domains=self::ChatDomains();
		if($domains=="*") {
			$htaccessContent = '
<FilesMatch "\.(ttf|otf|eot|woff|woff2|png|jpg|svg)$">
	<IfModule mod_headers.c>
	Header set Access-Control-Allow-Origin "' . $domains . '"
	</IfModule>
</FilesMatch>
		';
		}else{
			$domains=str_replace(",","|",$domains);
			$htaccessContent = '
<FilesMatch "\.(ttf|otf|eot|woff|woff2|png|jpg|svg)$">
	 <IfModule mod_headers.c>
        SetEnvIf Origin "http(s)?://(www\.)?('.$domains.')$" AccessControlAllowOrigin=$0
        Header add Access-Control-Allow-Origin %{AccessControlAllowOrigin}e env=AccessControlAllowOrigin
        Header merge Vary Origin
    </IfModule>
</FilesMatch>
		';
		}
		file_put_contents(FCPATH.'plugins/apsbd-chat/.htaccess',trim($htaccessContent));
	}
    /**
     * @param Mchat $mcobj
     */
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

    /**
     * @param Mchat_msg $mcmobj
     */
    private function db_obj_chat_msg_obj($mcmobj)
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
           $newobj->senderImg=&$this->response->clientImg;
        }
        if(empty($newobj->senderImg)){
            $newobj->senderImg=image_url("images/no-image.png");
        }
        return $newobj;
    }

    /**
     * @param Mchat $chat
     */
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
    /**
     * @param string $chat_id
     */
    private function setResponseDataByID($chat_id,$clientImg=""){
        $chat=Mchat::FindBy("id",$chat_id);
        if($chat instanceof  Mchat){
            $this->setResponseData($chat);
        }

    }

    /**
     * @param string $chat_id
     * @param string $msg
     * @param string $type, "S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User"
     */
    private function addNewMsg($chat_obj, $msg, $type,$temp_id='',$form_id='',$reply_user_id="",$entry_time='')
    {
        
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
        if(empty($entry_time)){
            $entry_time=date('Y-m-d H:i:s');
        }
        $nobj->entry_time($entry_time);
        if ($nobj->Save()) {
            return $nobj;
        }
        return null;
    }
    private function getHeaderMessage($chat_status,$chat_id='',$chatobj=null)
    {

        switch (strtoupper($chat_status)) {
            case "Q":
                $msg = Mapp_setting_api::GetSettingsValue("webchat","queue_text");
                if (!empty($chat_id)) {
                    $statobj = Mchat::getChatPositionObj($chat_id);
                    $pro=[];
                    $pro["total_queue"] = $statobj->total;
                    $pro["your_position"] = $statobj->pos;
                    $this->SetHeaderMessageProperties($pro,$msg);
                }
                return '<i class="apc-msg-icon fa fa-spin fa-spinner pull-left"></i>'.$msg;
            case "O":
                $msg = Mapp_setting_api::GetSettingsValue("webchat","offline_text");
                return $msg;
            case "A":
                $msg=Mapp_setting_api::GetSettingsValue("webchat","agent_welcome_text");
                if (!empty($chat_id)) {
                    if(empty($chatobj) || !($chatobj instanceof  Mchat)){
                        $chatobj = Mchat::FindBy("id",$chat_id);
                    }
                    if(!empty($chatobj->current_admin_user)){
                        $appuser=Mapp_user::FindBy("id",$chatobj->current_admin_user);
                        $pro=[];
                        if($appuser){
                            $pro["agent_name"] = $appuser->title;
                        }
                        $this->SetHeaderMessageProperties($pro,$msg);
                    }

                }
                return $msg;
            default:
                return "unknown message status";
        }
    }
    private function SetHeaderMessageProperties(&$properties,&$msg){
        if(!is_array($properties)){
            return;
        }
        foreach ($properties as $p => $v) {
            $msg = preg_replace("/\{\{$p\}\}/i", $v, $msg);
        }
    }
    function hasOnlineUsers($chat_id=""){
        if(!empty($chat_id)) {
            $query = "SELECT count(*) as total from app_user JOIN user_online_log ON user_id = app_user.id 
LEFT JOIN chat_denied on chat_denied.app_user_id=app_user.id and chat_denied.chat_id=$chat_id
WHERE app_user.is_enable_chat='Y' and chat_denied.app_user_id is NULL";
        }else{
            $query = "SELECT count(*) as total from app_user JOIN user_online_log ON user_id = app_user.id WHERE app_user.is_enable_chat='Y'";
        }

        $appuser=new Mapp_user();
        $result=$appuser->SelectQuery($query);
        $total=!empty($result[0]->total)?$result[0]->total:0;
        return $total > 0;
    }
    function start_chat()
    {
        $mcobj = new Mchat();
        $mcobj->is_remote_typing('N');
        $mcobj->is_user_typing('N');
        $mcobj->end_by('');
        $mcobj->start_time(date('Y-m-d H:i:s'));
        $onlineuser = new Muser_online_log();
        $appuser = new Mapp_user();
        $appuser->is_enable_chat("Y");
        $onlineuser->Join($appuser, "id", "user_id");
        $loggedInUsers = $onlineuser->CountALL();
        if ($this->hasOnlineUsers()) {
            $mcobj->status('Q');
        } else {
            $mcobj->status('O');
        }
        if (ISDEMOMODE) {
            $mcobj->status('A');
            $mcobj->current_admin_user('AA');
        }
        $mcobj->end_by_type('');
        $mcobj->ip(!empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "");
        $browser = "Unknown";
        $ci = get_instance();
        $ci->load->library('user_agent');
        if ($ci->agent->is_browser()) {
            $version = $ci->agent->version();
            $versiona = explode(".", $version);
            if (isset($versiona[1])) {
                $version = $versiona[0] . "." . $versiona[1];
            }
            $browser = $ci->agent->browser() . ' ' . $version;
        } elseif ($ci->agent->is_mobile()) {
            $browser = $ci->agent->mobile();
        }
        $mcobj->bw_name($browser);
        $ipdata = APPIPdata::get();
        if (!empty($ipdata->country_code)) {
            $mcobj->country($ipdata->country_code);
        }
    
    
        if ($mcobj->Save()) {
            $this->db_obj_chat_obj($mcobj);
            $msg = $this->getHeaderMessage($mcobj->status, $mcobj->id,$mcobj);
            if($mcobj->status=="A"){
                if(ISDEMOMODE){
                    $msg="**DEMO MODE AUTO RESPONSE-".$msg;
                }
                $this->addNewMsg($mcobj,$msg,"A","","","AA");
                Mchat::setLastMsgTime($mcobj->id,"A");
                $this->setResponseData($mcobj);
                $this->response->SetHeaderMessage("");
                
            }else{
                Mchat::updateHeaderMessage($mcobj->id, $msg);
                $this->response->SetHeaderMessage($msg);
            }
         
            $this->response->Display();
        } else {
            $this->response->Display();
        }
        /*
        $objs=$this->addNewMsg($chat_obj,"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet explicabo inventore libero minus perspiciatis repellendus sunt tempore.","S");
        $newresponseobj=$this->db_obj_chat_msg_obj($objs);
        $this->response->AddItem($newresponseobj);
         */
    
    
    }
    function loadmore()
    {
        $lastMsgId=PostValue("last_msg_id");
        $chatId=PostValue("chatId");
        if(!empty($lastMsgId)){
            $mc=new Mchat_msg();
            $mc->chat_id($chatId);
            $mc->msg_id("<'".$lastMsgId."'",true);
            $datas=$mc->SelectAll("","entry_time","DESC",10);
            foreach ($datas as $d){
                $od=$this->db_obj_chat_msg_obj($d);
                $this->response->AddItem($od);
            }
        }
        $this->response->Display();
    }
    function file_attached()
    {
        if(ISDEMOMODE){
            $this->response->attach_status=false;
            $this->response->attach_msg="Attach file has been disabled in demo mode";
            $this->response->Display();
            return;
        }
        $chat_id=PostValue("chatId");
        $msg="Unknown Error";
        $attachStatus=false;
        $name="";
        if(!empty($chat_id)) {
           
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
                            $nobj->reply_user_type("C");//"S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User";
                            $nobj->reply_user_id("");
                            $nobj->temp_id(time() . "file");
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

            $this->setResponseData($chatobj);
        }
        $this->response->attach_status=$attachStatus;
        $this->response->attach_msg=$msg;
        $this->response->Display();

    }
    function new_entry()
    {
        $chat_id=PostValue("chatId");
        if(!empty($chat_id)){
            $chatobj=Mchat::FindBy("id",$chat_id);
            $newObj=PostValue("newobj",null);
            if(empty($chatobj)){
                $this->start_chat();
                return;
            }
            if($newObj){
                $objs=$this->addNewMsg($chatobj,$newObj['msg_html'],$newObj['senderType'],$newObj['temp_id']);
                Mchat::setLastMsgTime($chat_id,"U");
                $newresponseobj=$this->db_obj_chat_msg_obj($objs);
                $this->response->SetCurrentItem($newresponseobj);
            }
            if(ISDEMOMODE){
                $entry_time=date('Y-m-d H:i:s',strtotime("+1 SECOND"));
                $this->addNewMsg($chatobj,"**DEMO MODE AUTO RESPONSE- ".$newObj['msg_html'],"A","","","AA",$entry_time);
                Mchat::setLastMsgTime($chat_id,"A");
            }
            $this->setResponseData($chatobj);
        }

        $this->response->Display();

    }
    function checking()
    {
        $chat_id=PostValue("chatId");
        $clientImg=PostValue("clientImg","");
        $isUserTyping=PostValue("isUserTyping") =='true';
        $isNeedToTypingUpdate=true;
        if(!empty($chat_id)){
            $userid=PostValue("clientId","");
            $chatobj=Mchat::FindBy("id",$chat_id);
            if(empty($chatobj)){
                $this->start_chat();
                return;
            }
            if($chatobj->status=="Q") {
                if (!$this->hasOnlineUsers($chat_id)) {
                    $chatobj->status = "O";
                }
                $msg = $this->getHeaderMessage($chatobj->status, $chat_id);
                if (Mchat::updateHeaderMessage($chat_id, $msg, $chatobj->status)) {
                    $chatobj->header_msg = $msg;
                }
            }
            $cu=GetCurrentUserType();
            if($cu=="CU"){
                $userData=GetUserData();
                if(empty($userid)){
                    //update user id
                    $uchat=new Mchat();
                    $uchat->open_user_id($userData->id);
                    if($isUserTyping){
                        $uchat->is_user_typing("Y");
                        $isNeedToTypingUpdate=false;
                    }
                    $uchat->SetWhereCondition("id",$chat_id);
                    $uchat->Update();
                }elseif($userid!=$userData->id || (!empty($chatobj->open_user_id) && $chatobj->open_user_id !=$userid)){
                    $this->response->isResetChatWindow=true;
                    $this->start_chat();
                    return;
                }

            }
            $userTypingStatus="";
            if($isNeedToTypingUpdate){
                $userTypingStatus=$isUserTyping?"Y":"N";
                /*$uchat=new Mchat();
                $uchat->is_user_typing("Y");
                $isUserTyping=false;
                $uchat->SetWhereCondition("id",$chat_id);
                $uchat->Update();*/
            }

            $this->setResponseData($chatobj,$clientImg,$userTypingStatus);
        }
        $this->response->Display();

    }

}