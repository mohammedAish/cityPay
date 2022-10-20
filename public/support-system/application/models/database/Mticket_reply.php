<?php 			
/**
 * Version 1.0.0
 * Creation date: 26/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:ticket_id,reply_id,asigned_by,replied_by,replied_by_type,reply_text,reply_time,ticket_status,is_private		
 */						
class Mticket_reply extends APP_Model
{
    public $ticket_id;
    public $reply_id;
    public $asigned_by;
    public $replied_by;
    public $replied_by_type;
    public $reply_text;
    public $reply_time;
    public $ticket_status;
    public $is_private;
    public $payment_id;
    public $is_user_seen;
    public $seen_time;
    private static $ticket_users = [];
    private $is_do_not_add_log = false;
    
    function __construct()
    {
        parent::__construct();
        $this->SetValidation();
        $this->tableName = "ticket_reply";
        $this->primaryKey = "reply_id";
        $this->uniqueKey = array(array("ticket_id", "reply_id"));
        $this->multiKey = array(array("ticket_id"));
        $this->autoIncField = array();
    }
    
    
    function SetValidation()
    {
        $this->validations = array(
            "ticket_id" => array("Text" => "Ticket Id", "Rule" => "max_length[11]|integer"),
            "reply_id" => array("Text" => "Reply Id", "Rule" => "max_length[11]|integer"),
            "asigned_by" => array("Text" => "Asigned By", "Rule" => "max_length[2]"),
            "replied_by" => array("Text" => "Replied By", "Rule" => "required|max_length[6]"),
            "replied_by_type" => array("Text" => "Replied By Type", "Rule" => "max_length[1]"),
            "reply_text" => array("Text" => "Reply Text", "Rule" => "required"),
            "reply_time" => array("Text" => "Reply Time", "Rule" => "max_length[20]"),
            "ticket_status" => array("Text" => "Ticket Status", "Rule" => "max_length[1]"),
            "is_private" => array("Text" => "Is Private", "Rule" => "max_length[1]"),
            "payment_id" => array("Text" => "Payment ID", "Rule" => "max_length[10]|integer"),
            "is_user_seen" => array("Text" => "Is User Seen", "Rule" => "max_length[1]"),
            "seen_time" => array("Text" => "seen time", "Rule" => "max_length[20]")
        
        );
    }
    
    public function GetPropertyRawOptions($property, $isWithSelect = false)
    {
        $returnObj = array();
        switch ($property) {
            case "replied_by_type":
                $returnObj = array("A" => "Staff", "U" => "Ticket User", "G" => "Guest Ticke User");
                break;
            case "ticket_status":
                $returnObj = array("N" => "New", "C" => "Closed", "P" => "In Progress", "R" => "Re-Open");
                break;
            case "is_user_seen":
                $returnObj = array("Y" => "Yes", "N" => "No");
                break;
            default:
        }
        if ($isWithSelect) {
            return array_merge(array("" => "Select"), $returnObj);
        }
        return $returnObj;
        
    }
    
    public function GetPropertyOptionsColor($property)
    {
        $returnObj = array();
        switch ($property) {
            case "replied_by_type":
                $returnObj = array("A" => "success", "U" => "success", "G" => "success");
                break;
            case "ticket_status":
                $returnObj = array("N" => "success", "C" => "success", "P" => "info", "R" => "success");
                break;
            default:
        }
        return $returnObj;
        
    }
    
    public function GetPropertyOptionsIcon($property)
    {
        $returnObj = array();
        switch ($property) {
            case "replied_by_type":
                $returnObj = array("A" => "fa fa-check-circle-o", "U" => "", "G" => "");
                break;
            case "ticket_status":
                $returnObj = array("N" => "", "C" => "", "P" => "fa fa-hourglass-1", "R" => "");
                break;
            default:
        }
        return $returnObj;
        
    }
    
    //auto generated
    function Update( $notLimit = false, $isShowMsg = true, $dontProcessIdWhereNotset = true ) {
        if($this->IsSetPrperty("reply_text")){
	        $this->reply_text(CleanHTMLtoText($this->reply_text));
        }
	    return parent::Update( $notLimit, $isShowMsg, $dontProcessIdWhereNotset );
    }
	function filterReplyHtml(){
        if($this->IsSetPrperty('reply_text')) {
	        $html = AppCleanHtml::CleanHTMLForDirectTicketReply( $this->reply_text );
	        $this->reply_text( $html );
        }
    }
	function Save()
    {
        if (!$this->IsSetPrperty('log_id')) {
            $reply_id = $this->GetNewIncId("reply_id", 1, array("ticket_id" => $this->ticket_id));
            $this->reply_id($reply_id);
            
        }
        $this->filterReplyHtml();
        if (parent::Save()) {
            if (!$this->is_do_not_add_log) {
                Mticket_log::AddTicketLog($this->ticket_id, $this->replied_by, $this->replied_by_type, "Replied", $this->ticket_status);
            }
            return true;
        } else {
            return false;
        }
    }
    
    
    /* add custom function here*/
    static function get_reply_attachments_by($reply_object, $is_public = false, &$ticket_user_id = "")
    {
        $ticket_reply_path = "";
        if (empty($ticket_user_id)) {
            $ticket = Mticket::FindBy("id", $reply_object->ticket_id);
            $ticket_user_id = $ticket->ticket_user;
        }
        $dir = Mticket::get_ticket_file_path($ticket_user_id, $reply_object->ticket_id, false, $reply_object->reply_id);
        $reply_object->load->helper('directory');
        $files = directory_map($dir, true);
        //GPrint($files);
        $newList = [];
        app_process_already_uploaded($files, $newList, $dir);
        return $newList;
    }
    
    /**
     * @param unknown $ticket_id
     * @param unknown $replied_by
     * @param unknown $replied_by_type
     * @param unknown $reply_text
     * @param unknown $ticket_status
     * @param unknown $is_private
     * @param unknown $asigned_by
     * @return Mticket_reply|NULL
     */
    static function add($ticket_id, $replied_by, $replied_by_type, $reply_text, $ticket_status, $is_private, $asigned_by, $is_log_added = true, $is_alredy_emailed = false)
    {
        if (empty($reply_text)) {
            AddError("Ticket reply text is required");
            return NULL;
        }
        $utype = GetCurrentUserType();
        if ($utype != "AD") {
            $isHtmlEditor = Mapp_setting::GetSettingsValue("ticket_htmleditor", "Y") == "Y";
            if (!$isHtmlEditor) {
                $reply_text = strip_tags($reply_text);
            } else {
                $reply_text = strip_tags($reply_text, '<h1><h2><h3><h4><strong><b><span><ul><u><font><li><table><tr><img><div><td><th><tbody><thead><tfoot><hr><p><a>');
            }
        }
        $ticket_reply = new Mticket_reply();
        $ticket_reply->ticket_id($ticket_id);
        $ticket_reply->replied_by($replied_by);
        $ticket_reply->replied_by_type($replied_by_type);
        $ticket_reply->reply_text($reply_text);
        $ticket_reply->ticket_status($ticket_status);
        $ticket_reply->is_private($is_private);
        $ticket_reply->asigned_by($asigned_by);
        if (!$is_log_added) {
            $ticket_reply->is_do_not_add_log = true;
        }
        if ($ticket_reply->Save()) {
            Mticket::update_last_reply_info($ticket_id, $replied_by, $replied_by_type);
            $ticket_obj = Mticket::FindBy("id", $ticket_id);
            if (!$is_alredy_emailed) {
                if ($ticket_status == "C") {
                    //send closed email
                    self::SendTicketReplyEmailByObj("TCL", $ticket_obj, $ticket_reply);
                    if ($replied_by_type == "S" && $replied_by == "SYS") {
                        self::SendTicketReplyEmailByObj("TAC", $ticket_obj, $ticket_reply);
                    }
                } elseif ($ticket_status == "R") {
                    //send reply email
                    self::SendTicketReplyEmailByObj("TRO", $ticket_obj, $ticket_reply);
                } elseif ($replied_by_type == "A") {
                    //send reply email
                    self::SendTicketReplyEmailByObj("TRR", $ticket_obj, $ticket_reply);
                }
            }
            return $ticket_reply;
        }
        return NULL;
    }
    
    /**
     * @param keyword $kword
     * @param unknown $ticket_id
     * @param unknown $reply_id
     * @return boolean
     */
    static function SendTicketReplyEmailById($kword, $ticket_id, $reply_id, $emailAddress = '')
    {
        $ticket_obj = Mticket::FindBy("id", $ticket_id);
        $reply_obj = self::FindBy("ticket_id", $ticket_id, ["reply_id" => $reply_id]);
        return self::SendTicketReplyEmailByObj($kword, $ticket_obj, $reply_obj, $emailAddress);
    }
    
    /**
     * @param keyword $kword
     * @param Mticket $ticket_obj
     * @param Mticket_reply $reply_on
     * @return boolean
     */
    static function SendTicketReplyEmailByObj($kword, $ticket_obj, $reply_obj, $emailAddress = '')
    {
        if ($ticket_obj instanceof Mticket && $reply_obj instanceof self) {
            $emailobj = new Memail_templates();
            
            $ticket_link = "";
            $tuserobj = Msite_user::FindBy("id", $ticket_obj->ticket_user);
            $ticket_link = '<a href="' . $ticket_link . '">' . $ticket_link . '</a>';
            $params = Memail_templates::getEmailParamListClearData($kword);
            
            $params["ticket_track_id"] = $ticket_obj->ticket_track_id;
            $params["ticket_title"] = $ticket_obj->title;
            $params["ticket_category"] = Mcategory::getParentStr($ticket_obj->cat_id);
            $params["ticket_body"] = $ticket_obj->ticket_body;
            $params["replied_text"] = $reply_obj->reply_text;
            $params["ticket_priroty"] = $ticket_obj->getTextByKey("priroty", false);
            $params["ticket_open_app_time"] = get_timezonetime(date_default_timezone_get(), $ticket_obj->opened_time, "Y-m-d H:i:s ") . date_default_timezone_get();
            if ($tuserobj->user_type == "G") {
                $params["ticket_link"] = '<a href="' . site_url("ticket/guest-ticket/{$ticket_obj->ticket_track_id}") . '" target="_blank" style="">'.__("Show Ticket").'</a>';
                if ($tuserobj->first_name != "-") {
                    $params["ticket_user"] = $tuserobj->first_name . " " . $tuserobj->last_name;
                } else {
                    $params["ticket_user"] = "Guest User";
                }
            } else {
                $params["ticket_link"] = '<a href="' . site_url("ticket/user-ticket/{$ticket_obj->ticket_track_id}") . '" target="_blank" style="">'.__("Show Ticket").'</a>';
                $params["ticket_user"] = $tuserobj->first_name . " " . $tuserobj->last_name;
            }
            
            
            $repliedUser = self::get_user_by_id($ticket_obj->id, $reply_obj->replied_by);
            $params["ticket_replied_user"] = $repliedUser->title;
            $params["replied_text"] = $reply_obj->reply_text;
            if (!empty($reply_obj->payment_id)) {
                $params["replied_text"] .= "<br/>".__("A Payment has been added please login to pay that");
            }
            $params["ticket_reopen_by"] = $params["ticket_replied_user"];
            if ($kword == "TAC") {
                $params["ticket_closing_msg"] = Mapp_setting::GetSettingsValue("aclosing_msg");
            }
            if ($kword == "TCL") {
                $positive = new stdClass();
                $positive->ticket_id = $ticket_obj->id;
                $positive->feedback_type = "P";
                $positive->time = time();
                
                $nagative = new stdClass();
                $nagative->ticket_id = $ticket_obj->id;
                $nagative->feedback_type = "N";
                $nagative->time = $positive->time;
                
                $obj = new self();
                $obj->load->library("APPEncryptionLib");
                $appencp = new APPEncryptionLib();
                $pencrypted = $appencp->encryptObj($positive);
                $pencrypted = urlencode($pencrypted);
                
                $feebackmsg = "";
                $nencrypted = $appencp->encryptObj($nagative);
                $nencrypted = urlencode($nencrypted);
                $nagativebtn = $positiveBtn = "";
                
                if (Mapp_setting::GetSettingsValue("fb_enable", "Y") == "Y") {
                    $feebackmsg = Mapp_setting::GetSettingsValue("fb_e_msg", "How do you rate the support you received?");
                    $positiveBtn = '<a href="' . base_url("ticket/feedback?k={$pencrypted}") . '" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #2ea226; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 4px; display: inline-block;padding: 5px 14px;line-height: 18px;">'.__("Well, satisfied").'</a>';
                    $nagativebtn = '<a href="' . base_url("ticket/feedback?k={$nencrypted}") . '" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #a22626; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 4px; display: inline-block;padding: 5px 14px;line-height: 18px;">'.__("Bad, dissatisfied").'</a>';
                }
                $params["ticket_feedback_button"] = "<br>" . $feebackmsg . "<br>" . $positiveBtn . " " . $nagativebtn;
            }
            //echo $params["ticket_feedback_button"];
            // GPrint($params);
            //return true;
            //echo $tuserobj->email;
            if (empty($emailAddress)) {
                $emailAddress = $tuserobj->email;
            }
            if ($emailobj->SendEmailTemplates($kword, $tuserobj->email, "", $params)) {
                //echo "Success";
                return true;
            }
            //GPrint($params);
        } else {
            return false;
        }
        
    }
    
    static function DeleteByTicketId($ticket_id)
    {
        return parent::DeleteByKeyValue("ticket_id", $ticket_id, true);
    }
    
    static function SendTicketReplyAdminEmailById($ticket_id, $reply_id, $emailAddress = '')
    {
        $ticket_obj = Mticket::FindBy("id", $ticket_id);
        $ticket_replay_obj = self::FindBy("reply_id", $reply_id, ["ticket_id" => $ticket_id]);
        if ($ticket_obj && $ticket_replay_obj) {
            return self::SendTicketReplyAdminEmailByObj($ticket_obj, $ticket_replay_obj, $emailAddress);
        }
        return false;
    }
    
    /**
     * @param Mticket $ticket_obj
     * @param self $reply_obj
     */
    static function SendAdminNotification($ticket_obj, $reply_obj)
    {
        $isEnabledEmail = false;
        $isEnabledScreen = false;
        $isEmailUserReply = Mapp_setting::GetSettingsValue("is_netktu_reply", "N") == "Y";
        $isEmailAdminReply = Mapp_setting::GetSettingsValue("is_netkta_reply", "N") == "Y";
    
        $onScreenTicketUserTicket = Mapp_setting::GetSettingsValue("is_nstktu_reply", "N") == "Y";
        $onScreenAdminReplyTicket = Mapp_setting::GetSettingsValue("is_nstkta_reply", "N") == "Y";
        if ($reply_obj->replied_by_type == "A" && $isEmailAdminReply) {
            $isEnabledEmail = true;
        } elseif ($reply_obj->replied_by_type == "U" && $isEmailUserReply) {
            $isEnabledEmail = true;
        }
    
        if ($reply_obj->replied_by_type == "A" && $onScreenAdminReplyTicket) {
            $isEnabledScreen = true;
        } elseif ($reply_obj->replied_by_type == "U" && $onScreenTicketUserTicket) {
            $isEnabledScreen = true;
        }
        if (!$isEnabledEmail && !$isEnabledScreen) {
            return;
        }
        $notiuserInfo = new stdClass();
        $notiuserInfo->user_id = "";
        $notiuserInfo->email = "";
        if (!empty($ticket_obj->assigned_on)) {
            $adminUser = Mapp_user::FindBy("id", $ticket_obj->assigned_on);
            if ($adminUser) {
                $notiuserInfo->user_id = $adminUser->id;
                $notiuserInfo->email = $adminUser->email;
            }
        
        } else {
            $rule = Mticket_assign_rule::GetNotifyRulesByCategory($ticket_obj->cat_id);
            if ($rule && $rule->rule_type == "N") {
                $adminUser = Mapp_user::FindBy("id", $rule->rule_id);
                $notiuserInfo->user_id = $adminUser->id;
                $notiuserInfo->email = $adminUser->email;
            }
        }
        if (!empty($notiuserInfo->user_id) && !empty($notiuserInfo->email)) {
            if ($isEnabledEmail) {
                self::SendTicketReplyAdminEmailByObj($ticket_obj, $reply_obj, $notiuserInfo->email);
            }
            if ($isEnabledScreen) {
                $objpatam = new stdClass();
                $objpatam->id = $ticket_obj->id;
                $objpatam->title = $ticket_obj->title;
                $paramstr = base64_encode(json_encode($objpatam));
                if ($reply_obj->replied_by_type == "U") {
                    $site_user=Msite_user::FindBy("id",$reply_obj->replied_by);
                    if(!empty($site_user->first_name)) {
	                    Mapp_notificaiton::AddNotification( $notiuserInfo->user_id, __( "Ticket user(%s) replied", $site_user->first_name . " " . $site_user->last_name ), __( "A  ticket reply has been received from ticket user" ), admin_url( "ticket/details/{$ticket_obj->id}" ), false, "TU", $paramstr );
                    }else{
	                    Mapp_notificaiton::AddNotification($notiuserInfo->user_id, __("Ticket user replied"), __("A  ticket reply has been received from ticket user"), admin_url("ticket/details/{$ticket_obj->id}"), false, "TU", $paramstr);
                    }
                    
                } else {
                    Mapp_notificaiton::AddNotification($notiuserInfo->user_id, __("You replied a ticket"), __("You have been replied a ticket"), admin_url("ticket/details/{$ticket_obj->id}"), false, "TA", $paramstr);
                }
            }
        }
    
    }

	/**	
	 * @param Mticket $ticket_obj
	 * @param Mticket_reply $reply_on
	 * @return boolean
	 */
	static function SendTicketReplyAdminEmailByObj($ticket_obj,$reply_obj,$emailAddress=''){
	    
        if(empty($emailAddress)){
	        return false;
        }
	    if($ticket_obj instanceof Mticket && $reply_obj instanceof self){
	        $isUserReply=Mapp_setting::GetSettingsValue("is_netktu_reply","N")=="Y";
	        $isAdminReply=Mapp_setting::GetSettingsValue("is_netkta_reply","N")=="Y";
	        if(!$isUserReply && !$isAdminReply){
	            return false;
	        }
	        $isSend=false;
	        if(!(($isUserReply && ($reply_obj->replied_by_type =="U" || $reply_obj->replied_by_type =="G")) || ($isAdminReply && $reply_obj->replied_by_type =="A"))){
	            return false;
	        }
	        
	        $emailobj=new Memail_templates();
	        $kword="ANR";
	        $ticket_link="";
	        $tuserobj=Msite_user::FindBy("id", $ticket_obj->ticket_user);
	        
	        $ticket_link='<a href="'.$ticket_link.'">'.$ticket_link.'</a>';
	        $params=Memail_templates::getEmailParamListClearData($kword);
	        $params["ticket_track_id"]=$ticket_obj->ticket_track_id;
	        $params["ticket_title"]=$ticket_obj->title;
	        $params["ticket_category"]=Mcategory::getParentStr($ticket_obj->cat_id);
	        $params["ticket_body"]=$ticket_obj->ticket_body;
            $params["ticket_status"]=$ticket_obj->getTextByKey('status',false);
	        $params["ticket_priroty"]=$ticket_obj->getTextByKey("priroty",false);
	        $params["ticket_open_app_time"]=get_timezonetime(date_default_timezone_get (),$ticket_obj->opened_time,"Y-m-d H:i:s ").date_default_timezone_get ();
	        if($tuserobj->user_type=="G"){	            
	            if($tuserobj->first_name!="-"){
	                $params["ticket_user"]=$tuserobj->first_name." ".$tuserobj->last_name;
	            }else{
	                $params["ticket_user"]="Guest User";
	            }
	        }else{	           
	            $params["ticket_user"]=$tuserobj->first_name." ".$tuserobj->last_name;
	        }
	        $params["ticket_link"]='<a href="'.site_url("admin/ticket/details/{$ticket_obj->id}").'" target="_blank" style="">Show Ticket</a>';
	
	        $repliedUser=self::get_user_by_id($ticket_obj->id, $reply_obj->replied_by);
	        $params["ticket_replied_user"]=$repliedUser->title.($reply_obj->replied_by_type=="A"?" (Our Staff) ":"");
	        $params["replied_text"]=trim($reply_obj->reply_text);
	        if(!empty($reply_obj->payment_id)){
	            $params["replied_text"].="<br/>".__("A Payment has been added please login to pay that");
	        }
	        $params["ticket_reopen_by"]=$params["ticket_replied_user"]; 
	        if(empty($emailAddress)){
	            $emailAddress=$tuserobj->email;
	        }
	        //GPrint($reply_obj);
	        //GPrint($params);
	        //die;
	        if($emailobj->SendEmailTemplates($kword, $emailAddress,"",$params)){
	            //echo "Success";
	            return true;
	        }
	        //GPrint($params);
	    }else{
	        return false;
	    }
	
	}
	
	static function update_payment_id($ticket_id,$reply_id,$payment_id){
	    $ticket_reply=new Mticket_reply();
	    $ticket_reply->payment_id($payment_id);
	    $ticket_reply->SetWhereCondition("ticket_id", $ticket_id);
	    $ticket_reply->SetWhereCondition("reply_id", $reply_id);
	    return $ticket_reply->Update();
	}	
	static function get_all_user_of_replies($ticket_id){
		if(!isset(self::$ticket_users[$ticket_id])){
			$obj=new self();
			$obj->ticket_id($ticket_id);
			$ticketUsers=$obj->SelectAll('replied_by,replied_by_type');
			$usersType=[];
			foreach ($ticketUsers as $ticket){
				$ticket->replied_by_type=strtoupper($ticket->replied_by_type);
				if($ticket->replied_by_type=="G"){
					$ticket->replied_by_type="U";
				}
				if(!isset($usersType[$ticket->replied_by_type])){
					$usersType[$ticket->replied_by_type]=[];
				}
				if(!in_array($ticket->replied_by, $usersType[$ticket->replied_by_type])){
					$usersType[$ticket->replied_by_type][]=$ticket->replied_by;
				}
			}
			$final_users=[];
			if(!empty($usersType["A"])){
				$rolelist=Mrole_list::FetchAllKeyValue("role_id", "title");
				$in_A="('".implode("','", $usersType["A"])."')";			
				$appu=new Mapp_user();
				$appu->id("in $in_A ",true);
				$appusers=$appu->SelectAll('id,user,title,email,img_url,role');
				foreach ($appusers as $au){
					$obja=new stdClass();
					$obja->id=$au->id;
					$obja->title=$au->title;
					$obja->type="A";
					$obja->type_title=getTextByKey($au->role,$rolelist);
					$obja->email=$au->email;
					$obja->photo_url=Mapp_user::get_user_image_url($au->id);
					$final_users[$obja->id]=$obja;
				}
			}
			if(!empty($usersType["U"])){
				$in_U="('".implode("','", $usersType["U"])."')";			
				$suser=new Msite_user();
				$suser->id("in $in_U ",true);
				$siteusers=$suser->SelectAll('id,first_name,last_name,username,email,photo_url,user_type');
				foreach ($siteusers as $au){
					$obja=new stdClass();
					$obja->id=$au->id;
					$obja->title=$au->first_name." ".$au->last_name;
					$obja->type=$au->user_type;;
					$obja->type_title=$au->user_type=="G"?"Guest":"User";
					$obja->email=$au->email;
					$obja->photo_url=$au->photo_url;
					$final_users[$obja->id]=$obja;
				}
			}
			self::$ticket_users[$ticket_id]=$final_users;
		}
		return self::$ticket_users[$ticket_id];
	}
	static function get_user_by_id($ticket_id,$user_id){
	    if($user_id=="SYS"){
            $obja=new stdClass();
            $obja->id="SYS";
            $obja->title=__("SYSTEM");
            $obja->type="S";
            $obja->type_title=__("Application");
            $obja->email="";
            $obja->photo_url=base_url("images/logo.png");
            return $obja;
        }
		if(!isset(self::$ticket_users[$ticket_id])){
			self::get_all_user_of_replies($ticket_id);
		}
		//GPrint(self::$ticket_users);
		return !empty(self::$ticket_users[$ticket_id][$user_id])?self::$ticket_users[$ticket_id][$user_id]:null;
	}
	static function SetSeenStatus($ticket_id,$reply_id,$status){
	    $statustext=$status?"Y":"N";
	    $obj=new self();
	    $obj->is_user_seen($statustext);
	    $obj->SetWhereCondition("ticket_id", $ticket_id);
	    $obj->SetWhereCondition("reply_id", $reply_id);
	    return $obj->Update();
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			
			<?php if(!in_array("asigned_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="asigned_by"><?php _e("Asigned By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("asigned_by");?>" class="form-control" id="asigned_by" <?php echo in_array("asigned_by", $disabled)?' disabled="disabled" ':' name="asigned_by" ';?>     placeholder="<?php _e("Asigned By"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Asigned By"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("asigned_by");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("replied_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="replied_by"><?php _e("Replied By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php $options_replied_by= Mapp_user::FetchAllKeyValue("id", "name",true);?>
			        <select class="form-control" id="replied_by" <?php echo in_array("replied_by", $disabled)?' disabled="disabled" ':' name="replied_by" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Replied By"));?>">
			        <?php $replied_by_selected= $mainobj->GetPostValue("replied_by");
			            GetHTMLOptionByArray($options_replied_by,$replied_by_selected);
			            ?>			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("replied_by");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("replied_by_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="replied_by_type"><?php _e("Replied By Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $replied_by_type_selected= $mainobj->GetPostValue("replied_by_type","A");
			            $replied_by_type_isDisabled=in_array("replied_by_type", $disabled);
			            GetHTMLRadioByArray("Replied By Type","replied_by_type","replied_by_type",true,$mainobj->GetPropertyRawOptions("replied_by_type"),$replied_by_type_selected,$replied_by_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("replied_by_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_text",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_text"><?php _e("Reply Text"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea maxlength=""   class="form-control" id="reply_text" <?php echo in_array("reply_text", $disabled)?' disabled="disabled" ':' name="reply_text" ';?>     placeholder="<?php _e("Reply Text"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply Text"));?>"><?php echo  $mainobj->GetPostValue("reply_text");?></textarea>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_time"><?php _e("Reply Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("reply_time");?>" class="form-control" id="reply_time" <?php echo in_array("reply_time", $disabled)?' disabled="disabled" ':' name="reply_time" ';?>     placeholder="<?php _e("Reply Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("reply_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ticket_status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ticket_status"><?php _e("Ticket Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control" id="ticket_status" <?php echo in_array("ticket_status", $disabled)?' disabled="disabled" ':' name="ticket_status" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Status"));?>">
			        <?php $ticket_status_selected= $mainobj->GetPostValue("ticket_status","P");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("ticket_status",true),$ticket_status_selected);
			            ?>
			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("ticket_status");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("is_private",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_private"><?php _e("Is Private"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("is_private");?>" class="form-control" id="is_private" <?php echo in_array("is_private", $disabled)?' disabled="disabled" ':' name="is_private" ';?>     placeholder="<?php _e("Is Private"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Is Private"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("is_private");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>