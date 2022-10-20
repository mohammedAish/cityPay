<?php 			
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,reply_counter,ticket_track_id,cat_id,title,ticket_body,ticket_user,opened_time,re_open_time,re_open_by,re_open_by_type,user_type,status,assigned_on,last_replied_by,last_reply_time,ticket_rating,priroty		
 */						
class Mticket extends APP_Model
{
    public $id;
    public $ticket_track_id;
    public $cat_id;
    public $title;
    public $ticket_body;
    public $ticket_user;
    public $opened_time;
    public $re_open_time;
    public $re_open_by;
    public $re_open_by_type;
    public $user_type;
    public $status;
    public $assigned_on;
    public $assigned_date;
    public $last_replied_by;
    public $last_replied_by_type;
    public $last_reply_time;
    public $ticket_rating;
    public $priroty;
    public $is_public;
    public $is_open_using_email;
    public $is_paid_ticket;
    public $reply_counter;
    public $is_user_seen_last_reply;

    function __construct()
    {
        parent::__construct();
        $this->SetValidation();
        $this->tableName = "ticket";
        $this->primaryKey = "id";
        $this->uniqueKey = array(array("ticket_track_id"));
        $this->multiKey = array();
        $this->autoIncField = array("id");
    }


    function SetValidation()
    {
        $this->validations = array(
            "id" => array("Text" => "Id", "Rule" => "max_length[10]|integer"),
            "ticket_track_id" => array("Text" => "Ticket Track Id", "Rule" => "max_length[18]"),
            "cat_id" => array("Text" => "Cat Id", "Rule" => "max_length[11]|integer"),
            "title" => array("Text" => "Title", "Rule" => "required|max_length[150]"),
            "ticket_body" => array("Text" => "Ticket Body", "Rule" => "required"),
            "ticket_user" => array("Text" => "Ticket User", "Rule" => "max_length[10]"),
            "opened_time" => array("Text" => "Opened Time", "Rule" => "max_length[20]"),
            "re_open_time" => array("Text" => "Re Open Time", "Rule" => "max_length[20]"),
            "re_open_by" => array("Text" => "Re Open By", "Rule" => "max_length[10]"),
            "re_open_by_type" => array("Text" => "Re Open By Type", "Rule" => "max_length[1]"),
            "user_type" => array("Text" => "User Type", "Rule" => "max_length[1]"),
            "status" => array("Text" => "Status", "Rule" => "max_length[1]"),
            "assigned_on" => array("Text" => "Assigned On", "Rule" => "max_length[2]"),
            "assigned_date" => array("Text" => "Assigned Time", "Rule" => "max_length[20]"),
            "last_replied_by" => array("Text" => "Last Replied By", "Rule" => "max_length[10]"),
            "last_replied_by_type" => array("Text" => "Last Replied By Type", "Rule" => "max_length[1]"),
            "last_reply_time" => array("Text" => "Last Reply Time", "Rule" => "max_length[20]"),
            "ticket_rating" => array("Text" => "Ticket Rating", "Rule" => "max_length[1]|numeric"),
            "priroty" => array("Text" => "Priority", "Rule" => "max_length[1]"),
            "is_public" => array("Text" => "Is Private", "Rule" => "max_length[1]"),
            "is_open_using_email" => array("Text" => "Using Email", "Rule" => "max_length[1]"),
            "is_paid_ticket" => array("Text" => "Is Paid Ticket", "Rule" => "max_length[1]"),
            "reply_counter" => array("Text" => "Is Paid Ticket", "Rule" => "max_length[10]|integer"),
            "is_user_seen_last_reply" => array("Text" => "Is User Seen", "Rule" => "max_length[1]")

        );
    }
    protected function GetPropertyRawOptions($property, $isWithSelect = false){
	    $returnObj = array();
	    switch ($property) {
		    case "re_open_by_type":
			    $returnObj = array("A" => "Staff", "U" => "Ticket User", "G" => "Guest Ticket User");
			    break;
		    case "user_type":
		    case "last_replied_by_type":
			    $returnObj = array("G" => "Guest", "U" => "User", "A" => "Staff");
			    break;
		    case "status":
			    $returnObj = array("N" => "New", "C" => "Closed", "P" => "In Progress", "R" => "Re-Open", "A" => "Action Required");
			    break;
		    case "priroty":
			    $returnObj = array("L" => "Low", "M" => "Medium", "H" => "High", "U" => "Urgent");
			    break;
		    case "is_public":
		    case "is_open_using_email":
		    case "is_paid_ticket":
		    case "is_user_seen_last_reply":
			    $returnObj = array("Y" => "Yes", "N" => "No");
			    break;
		    default:
	    }
	    if ($isWithSelect) {
		    return array_merge(array("" => "Select"), $returnObj);
	    }
	    return $returnObj;
    }
    public static function CheckLimit($ticket_user,$isShowError=true,&$msg=null) {
	    $openCounter=Mapp_setting::GetSettingsValue("per_user_max_ticket",0);
	    if(!empty($openCounter) && $openCounter>0){
		    //check open ticket counter
		    $cc=self::OpenedTicketCount($ticket_user);
		    if($cc>=$openCounter){
		        $msg=sprintf( "You have already opened %d tickets, you can't open any more ticket until close your old tickets", $cc );
		        if($isShowError) {
			        AddError($msg);
		        }
			    return false;
		    }
	    }
	    return true;
    }
	
	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	public static function UserCanReopenByID($id) {
	    $t=Mticket::FindBy("id",$id);
	    return self::UserCanReopen($t);
	    
	}
	/**
	 * @param self $ticketObj
	 *
	 * @return bool
	 */
	public static function UserCanReopen($ticketObj) {
	    
	    if(($ticketObj instanceof Mticket)&& Mapp_setting::GetSettingsValue("is_user_can_reopen","Y")=="Y"){
	        $openTimeSpan=Mapp_setting::GetSettingsValue("reopen_time",0);
		    if($openTimeSpan>0){
			    if(strtotime("+ $openTimeSpan DAYS",strtotime($ticketObj->last_reply_time))>time()){
			        return true;
                }
            }else{
		        return true;
            }
        }
        return false;
	}
    public function GetPropertyOptionsColor($property)
    {
        $returnObj = array();
        switch ($property) {
            case "re_open_by_type":
                $returnObj = array("A" => "success", "U" => "success", "G" => "success");
                break;
            case "user_type":
            case "last_replied_by_type":
                $returnObj = array("G" => "success", "U" => "success", "A" => "success");
                break;
            case "status":
                $returnObj = array("N" => "info text-bold", "C" => "danger text-bold", "P" => "info text-bold", "R" => "info text-bold", "A" => "danger text-bold");
                break;
            case "priroty":
                $returnObj = array("L" => " label label-default", "M" => " label label-info", "H" => " label label-warning", "U" => " label label-danger");
                break;
            case "is_public":
                $returnObj = array("Y" => "label label-success", "N" => "label label-info");
                break;
            default:
        }
        return $returnObj;

    }

    public function GetPropertyOptionsIcon($property)
    {
        $returnObj = array();
        switch ($property) {
            case "re_open_by_type":
                $returnObj = array("A" => "fa fa-check-circle-o", "U" => "", "G" => "");
                break;
            case "user_type":
            case "last_replied_by_type":
                $returnObj = array("G" => "", "U" => "", "A" => "fa fa-check-circle-o");
                break;
            case "status":
                $returnObj = array("N" => "fa fa-dot-circle-o", "C" => "fa fa-check-circle-o", "P" => "fa fa-hourglass-1", "R" => "fa fa-undo", "A" => "fa fa-user");
                break;
            case "priroty":
                $returnObj = array("L" => "", "M" => "", "H" => "", "U" => "");
                break;
            case "is_public":
                $returnObj = array("Y" => "fa fa-lock", "N" => "fa fa-unlock");
                break;
            default:
        }
        return $returnObj;

    }

    function get_ticket_track_id($uid = "")
    {
        if (empty($uid)) {
            $uid = $this->ticket_user;
        }
        if (empty($uid)) {
            return false;
        }
        $this->load->helper('string');
        $track_id = "T" . get8BitHashCode($uid);
        $track_id = strtoupper($track_id);
        $obj = $this->SelectQuery("select ticket_track_id  from ticket where ticket_track_id like '{$track_id}%'  ORDER BY ticket_track_id DESC LIMIT 1");
        $random_str = strtoupper(random_string('alnum', 3));
        //$obj[0]=new stdClass();
        //$obj[0]->ticket_track_id="T83DCEFB7-001-5ZO";
        if (!empty($obj[0]->ticket_track_id)) {
            $new_track_id = substr($obj[0]->ticket_track_id, 0, -4);
            $new_track_id++;
            $new_track_id .= "-" . $random_str;
            return $new_track_id;
        }
        return $track_id . "-001-" . $random_str;
    }
	function SendTicketOpeningAllEmail(){
		//it need to be call if you used SaveWithoutSendingEmail method
		self::OnTicketOpening($this);
		self::SendTicketOpenEmailByObj($this);
		//self::SendTicketOpenAdminEmailByObj($this);
	}
    function SaveWithoutSendingEmail(){
	    if (!$this->IsSetPrperty('ticket_track_id')) {
		    $trackid = $this->get_ticket_track_id();
		    if ($trackid) {
			    $this->ticket_track_id($trackid);
		    }
	    }
	    if (!$this->IsSetPrperty("opened_time")) {
		    $this->opened_time(date("Y-m-d H:i:s"));
	    }
	    if (!$this->IsSetPrperty("last_reply_time")) {
		    $this->last_reply_time(date("Y-m-d H:i:s"));
	    }
	    if (!$this->IsSetPrperty("re_open_time")) {
		    $this->re_open_time(date("Y-m-d H:i:s"));
	    }
	    $this->filterTicketBody();
	    
	    if(!self::CheckLimit($this->ticket_user)){
	        return false;
        }
	    $opencounter=Mapp_setting::GetSettingsValue("per_user_max_ticket",0);
	    if(!empty($opencounter) && $opencounter>0){
		    //check open ticket counter
		    $cc=Mticket::OpenedTicketCount($this->ticket_user);
		    if($cc>=$opencounter){
			    AddError(sprintf("You have already opened %d tickets, you can't open any more ticket until close your old tickets",$cc));
			    return false;
		    }
	    }
	    if (parent::Save()) {
		    Mticket_log::AddTicketLog($this->id, $this->ticket_user, $this->user_type, "Ticket Opened", $this->status);
            AddOnManager::CallHook("OnNewTicketOpen",$this);
		    return true;
	    } else {
		    return false;
	    }
    }
    
    //auto generated
	function Update( $notLimit = false, $isShowMsg = true, $dontProcessIdWhereNotset = true ) {
		if($this->IsSetPrperty("ticket_body")){
			$this->ticket_body(CleanHTMLtoText($this->ticket_body));
		}
		return parent::Update( $notLimit, $isShowMsg, $dontProcessIdWhereNotset );
	}
	function filterTicketBody(){
		if($this->IsSetPrperty('ticket_body')) {
			$html = AppCleanHtml::CleanHTMLForDirectTicketReply( $this->ticket_body );
			$this->ticket_body( $html );
		}
	}
    function Save()
    {
	    // check ticket counter
        if($this->SaveWithoutSendingEmail()){
            $this->SendTicketOpeningAllEmail();
            return true;
        }
        return false;
    }



    /* add custom function here*/
    /**
     * @param boolean $status
     */
    static function SetSeenStatus($ticket_id, $status)
    {
        $statustext = $status ? "Y" : "N";
        $obj = new self();
        $obj->is_user_seen_last_reply($statustext);
        $obj->SetWhereCondition("id", $ticket_id);
        if ($obj->Update()) {

        }
        if ($status) {
            $obr = new Mticket_reply();
            $obr->is_user_seen("Y");
            $obr->seen_time(date("Y-m-d H:i:s"));
            $obr->SetWhereCondition("ticket_id", $ticket_id);
            $obr->SetWhereCondition("is_user_seen", "N");
            $obr->Update(true);
        }
    }

    static function update_last_reply_info($ticket_id, $replied_by, $replied_by_type)
    {
        $ticket = new self();
        $ticket->last_replied_by($replied_by);
        $ticket->last_replied_by_type($replied_by_type);
        $ticket->last_reply_time(date('Y-m-d H:i:s'));
        $ticket->reply_counter("reply_counter+1", true);
        $ticket->SetWhereCondition("id", $ticket_id);
        return $ticket->Update();
    }

    static function SendTicketOpenEmailById($ticket_id)
    {
        if (empty($ticket_id)) {
            return false;
        }
        $ticket_obj = self::FindBy("id", $ticket_id);
        if ($ticket_obj) {
            return self::SendTicketOpenEmailByObj($ticket_obj);
        }
        return false;
    }

    static function SendTicketOpenEmailByTrackId($ticket_track_id)
    {
        if (empty($ticket_track_id)) {
            return false;
        }
        $ticket_obj = self::FindBy("ticket_track_id", $ticket_track_id);
        if ($ticket_obj) {
            return self::SendTicketOpenEmailByObj($ticket_obj);
        }
        return false;
    }
	
	/**
	 * @param $id
	 *
	 * @return bool|int
	 */
	static function OpenedTicketCount($id){
	    $tobj=new Mticket();
	    $tobj->ticket_user($id);
	    $tobj->user_type(" in ('U','G') ",true);
	    $tobj->status(" != 'C'" , true);
	    return $tobj->CountALL();
    }
	
	/**
	 * @param Mticket $ticket_obj
	 *
	 * @return bool
	 */
    static function SendTicketOpenEmailByObj($ticket_obj)
    {
        if ($ticket_obj instanceof self) {
            $emailobj = new Memail_templates();

            $ticket_link = "";
            $tuserobj = Msite_user::FindBy("id", $ticket_obj->ticket_user);
            if ($tuserobj->user_type == "G") {
                $kword = "GOT";
                $ticket_link = site_url("ticket/guest-ticket/{$ticket_obj->ticket_track_id}");
            } else {
                $kword = "UOT";
                $ticket_link = site_url("ticket/user-ticket/{$ticket_obj->ticket_track_id}");
            }
            $ticket_link = '<a href="' . $ticket_link . '">' . $ticket_link . '</a>';
            $params = Memail_templates::getEmailParamListClearData($kword);
            $params["ticket_track_id"] = $ticket_obj->ticket_track_id;
            $params["ticket_title"] = $ticket_obj->title;
            $params["ticket_category"] = Mcategory::getParentStr($ticket_obj->cat_id);
            $params["ticket_body"] = $ticket_obj->ticket_body;
            $params["ticket_priroty"] = $ticket_obj->getTextByKey("priroty", false);
            $params["ticket_open_app_time"] = get_timezonetime(date_default_timezone_get(), $ticket_obj->opened_time, "Y-m-d H:i:s ") . date_default_timezone_get();
            $params["ticket_user"] = $tuserobj->first_name . " " . $tuserobj->last_name;
            $params["ticket_link"] = $ticket_link;
            if ($emailobj->SendEmailTemplates($kword, $tuserobj->email, "", $params)) {
                return true;
            }
            //GPrint($params);
        } else {
            return false;
        }

    }

    static function SendTicketOpenAdminEmailById($ticket_id, $emailAddress = "")
    {
        if (empty($ticket_id)) {
            return false;
        }
        $ticket_obj = self::FindBy("id", $ticket_id);
        if ($ticket_obj) {
            return self::SendTicketOpenAdminEmailByObj($ticket_obj, $emailAddress);
        }
        return false;
    }

    /**
     * @param Mticket $ticket_obj
     */
    static function SendTicketOpenAdminEmailByObj($ticket_obj, $emailAddress = "")
    {

        if (Mapp_setting::GetSettingsValue("is_netkt_open", "N") != "Y") {
            return false;
        }
        if (empty($emailAddress)) {
            $emailAddress = Mapp_setting::GetSettingsValue("app_noti_email");
            if (empty($emailAddress)) {
                $emailAddress = Mapp_setting::GetSettingsValue("app_email");
            }
        }
        if (empty($emailAddress)) {
            return false;
        }
        if ($ticket_obj instanceof self) {
            $emailobj = new Memail_templates();
            $kword = "ANT";
            $ticket_link = "";
            $tuserobj = Msite_user::FindBy("id", $ticket_obj->ticket_user);
            $ticket_link = site_url("admin/ticket/details/{$ticket_obj->id}");
            $ticket_link = '<a href="' . $ticket_link . '">' . $ticket_link . '</a>';
            $params = Memail_templates::getEmailParamListClearData($kword);
            $params["ticket_track_id"] = $ticket_obj->ticket_track_id;
            $params["ticket_title"] = $ticket_obj->title;
            $params["ticket_category"] = Mcategory::getParentStr($ticket_obj->cat_id);
            $params["ticket_body"] = $ticket_obj->ticket_body;
            $params["ticket_priroty"] = $ticket_obj->getTextByKey("priroty", false);
            $params["ticket_open_app_time"] = get_timezonetime(date_default_timezone_get(), $ticket_obj->opened_time, "Y-m-d H:i:s ") . date_default_timezone_get();
            $params["ticket_user"] = $tuserobj->first_name . " " . $tuserobj->last_name;
            $params["ticket_link"] = $ticket_link;
            if ($emailobj->SendEmailTemplates($kword, $emailAddress, "", $params)) {
                return true;
            }
            //GPrint($params);
        } else {
            return false;
        }

    }
    /**
     * @param Mticket $ticket_obj
     */
    static function SendTicketAssignAdminEmailByObj($ticket_obj, $user_id)
    {

        if (Mapp_setting::GetSettingsValue("is_aetkt_open", "N") != "Y") {
            return false;
        }
        $appuser=Mapp_user::FindBy("id",$user_id);
        if(empty($appuser) || empty($appuser->email)){
            return false;
        }
        $emailAddress=$appuser->email;
        if ($ticket_obj instanceof self) {
            $emailobj = new Memail_templates();
            $kword = "AAT";
            $ticket_link = "";
            $tuserobj = Msite_user::FindBy("id", $ticket_obj->ticket_user);
            $ticket_link = site_url("admin/ticket/details/{$ticket_obj->id}");
            $ticket_link = '<a href="' . $ticket_link . '">' . $ticket_link . '</a>';
            $params = Memail_templates::getEmailParamListClearData($kword);
            $params["ticket_assigned_user"] = $appuser->title;
            $params["ticket_track_id"] = $ticket_obj->ticket_track_id;
            $params["ticket_title"] = $ticket_obj->title;
            $params["ticket_category"] = Mcategory::getParentStr($ticket_obj->cat_id);
            $params["ticket_body"] = $ticket_obj->ticket_body;
            $params["ticket_priroty"] = $ticket_obj->getTextByKey("priroty", false);
            $params["ticket_open_app_time"] = get_timezonetime(date_default_timezone_get(), $ticket_obj->opened_time, "Y-m-d H:i:s ") . date_default_timezone_get();
            $params["ticket_user"] = $tuserobj->first_name . " " . $tuserobj->last_name;
            $params["ticket_link"] = $ticket_link;
            if ($emailobj->SendEmailTemplates($kword, $emailAddress, "", $params)) {
                return true;
            }
            //GPrint($params);
        } else {
            return false;
        }

    }

    static function hasTicketReplyPermission($ticketObj)
    {
        if (ACL::HasPermission("admin/ticket-confirm/ticket-reply")) {
            return self::hasTicketAssignPermission($ticketObj);
        }
        return false;
    }

    static function hasTicketAssignPermission($ticketObj)
    {
        $any_can_assign = Mapp_setting::GetSettingsValue("any_can_assign", "N") == "Y";
        /*if($ticketObj->status=="C"){
            return false;
        }*/
        if (!empty($ticketObj->assigned_on) && !$any_can_assign) {
            $admindata = GetAdminData();
            if (!$admindata->IsSuperUser() && $admindata->id != $ticketObj->assigned_on) {
                AddError("You can't assign or change other's ticket. Only assigned user can change the user");
                return false;
            }
        }
        return true;
    }
    
    /**
     * @param Mticket $ticketObj
     * @param $user_id
     */
    static function SendTicketAssignNotification($ticketObj, $user_id)
    {
        //email
        $isEnableEmailAssignTicket=Mapp_setting::GetSettingsValue("is_aetkt_open","N")=="Y";
        if($isEnableEmailAssignTicket){
            self::SendTicketAssignAdminEmailByObj($ticketObj,$user_id);
        }
         //screen
        $isEnableScreenAssignTicket=Mapp_setting::GetSettingsValue("is_astkt_open","N")=="Y";
        if($isEnableScreenAssignTicket){
            $objpatam=new stdClass();
            $objpatam->id=$ticketObj->id;
            $objpatam->title=$ticketObj->title;
            $paramstr=base64_encode(json_encode($objpatam));
            $adminData=GetAdminData();
            $status="A";
            $title=__("New ticket assigned");
            $msg=__("A new ticket is assigned to you");
            if(!empty($adminData->id) && $adminData->id==$user_id){
                $status="V";
                $title=__("New ticket assigned by you");
                $msg=__("You have assigned self to a ticket");
            }
            Mapp_notificaiton::AddNotification($user_id,$title,$msg,admin_url("ticket/details/{$ticketObj->id}"),false,"TA",$paramstr,$status);
            
        }

    }

    static function AssignUser($ticket_id, $user_id, $assigner_user_id, $isTicketLogEntry = false)
    {
        $ticketObj = Mticket::FindBy("id", $ticket_id);
        $any_can_assign = Mapp_setting::GetSettingsValue("any_can_assign", "N") == "Y";
        if ($ticketObj->status == "C") {
            AddError("Ticket closed already.");
            return false;
        }
        if ($ticketObj) {
            if (!self::hasTicketAssignPermission($ticketObj)) {
                return false;
            }
            $obj = new self();
            $obj->assigned_on($user_id);
            $obj->assigned_date(date('Y-m-d H:i:s'));
            $obj->SetWhereCondition("id", $ticket_id);
            if ($obj->Update()) {
                $ticketObj->assigned_on=$user_id;
                if ($isTicketLogEntry) {
                    if ($assigner_user_id == $user_id) {
                        $msg = "Assign self";
                    } else {
                        $userobj = Mapp_user::get_user_obj_by("$user_id");
                        $msg = "Assign user  " . $userobj->title;
                    }
                    Mticket_log::AddTicketLog($ticket_id, $assigner_user_id, "A", $msg, $ticketObj->status);
                }
                self::SendTicketAssignNotification($ticketObj,$user_id);
                return true;
            }
        }
        return false;
    }

    /**
     * @param self $ticketObj
     * @param $user_id
     * @param $assigner_user_id
     * @param bool $isTicketLogEntry
     * @return bool
     */
    static function AutoAssignUser($ticketObj, $user_id, $assigner_user_id, $isTicketLogEntry = false)
    {

        $any_can_assign = Mapp_setting::GetSettingsValue("any_can_assign", "N") == "Y";
        if ($ticketObj->status == "C") {
            AddError("Ticket closed already.");
            return false;
        }
        if ($ticketObj) {
            $obj = new self();
            $obj->assigned_on($user_id);
            $obj->assigned_date(date('Y-m-d H:i:s'));
            $obj->SetWhereCondition("id", $ticketObj->id);
            if ($obj->Update()) {
                $ticketObj->assigned_on=$user_id;
                if ($isTicketLogEntry) {
                    $assigner_user_id=strtolower($assigner_user_id);
                    if ($assigner_user_id =="SYS") {
                        $msg = "Auto Assigned to";
                    }elseif ($assigner_user_id == $user_id) {
                        $msg = "Assign self";
                    } else {
                        $userobj = Mapp_user::get_user_obj_by("$user_id");
                        $msg = "Assign user  " . $userobj->title;
                    }
                    Mticket_log::AddTicketLog($ticketObj->id, $assigner_user_id, "A", $msg, $ticketObj->status);
                }

                self::SendTicketAssignNotification($ticketObj,$user_id);
                return true;
            }
        }
        return false;
    }

    static function ReopenStatus($ticket_id, $newstatus, $last_replied_by, $last_replied_by_type, $isTicketLogEntry = false, $is_already_emailed = false)
    {
        $obj = new self();
        $obj->status($newstatus);
        $obj->re_open_by($last_replied_by);
        $obj->re_open_by_type($last_replied_by_type);
        $obj->re_open_time(date('Y-m-d H:i:s'));
        $obj->last_replied_by($last_replied_by);
        $obj->last_replied_by_type($last_replied_by_type);
        $obj->last_reply_time(date('Y-m-d H:i:s'));
        $obj->SetWhereCondition("id", $ticket_id);
        if ($obj->Update()) {
            if ($isTicketLogEntry) {
                $msg = "Ticket " . $obj->getTextByKey("status", false, $newstatus);
                Mticket_log::AddTicketLog($ticket_id, $last_replied_by, $last_replied_by_type, $msg, $newstatus);
            }
            return true;
        }
        return false;
    }

    static function UpdateStatus($ticket_id, $newstatus, $last_replied_by, $last_replied_by_type, $isTicketLogEntry = false)
    {
        $obj = new self();
        $obj->status($newstatus);
        $obj->last_replied_by($last_replied_by);
        $obj->last_replied_by_type($last_replied_by_type);
        $obj->last_reply_time(date('Y-m-d H:i:s'));
        $obj->SetWhereCondition("id", $ticket_id);
        if ($obj->Update()) {
            if ($isTicketLogEntry) {
                $msg = "Ticket " . $obj->getTextByKey("status", false, $newstatus);
                Mticket_log::AddTicketLog($ticket_id, $last_replied_by, $last_replied_by_type, $msg, $newstatus);
            }
            return true;
        }
        return false;
    }

    static function get_all_attachments($ticket_id, $is_public = false)
    {
        $obj = Mticket::FindBy("id", $ticket_id);
        return self::get_all_attachments_by_ticket_obj($obj, $is_public);
    }
	function setCustomFields(&$customes,&$hasCustom) {
		$customes=Mcustom_field::getGridColumn("");
		$hasCustom=count($customes)>0;
		$custom_field_ids=[];
		if($hasCustom) {
			foreach ( $customes as $cf ) {
				$custom_field_ids["custom_".$cf->id]=$cf->id;
			}
		}
		if($hasCustom && isset($custom_field_ids[$this->srcItem])){
			$mjobj=new Mticket_custom_field();
			$mjobj->fld_value(" LIKE '%".$this->srcText."%'",true);
			$this->Join($mjobj,"ticket_id","id","left","",["custom_id"=>"'".$custom_field_ids[$this->srcItem]."'"]);
			$this->srcItem="";
			$this->srcText="";
		}
	}
    /**
     * @param Mticket $ticket_obj
     */
    static function get_all_attachments_by_ticket_obj($ticket_obj, $is_public = false)
    {
        $dir = self::get_ticket_file_path($ticket_obj->ticket_user, $ticket_obj->id, $is_public);
        $ticket_obj->load->helper('directory');
        $files = directory_map($dir, true);
        $newList = [];
        app_process_already_uploaded($files, $newList, $dir);
        return $newList;
    }

    static function get_ticket_file_path($user_id, $ticket_id, $is_public = false, $replied_id = '')
    {

        if (!$is_public) {
            $dir = FCPATH . "data/{$user_id}/ticket/{$ticket_id}/pri/";
        } else {
            $dir = FCPATH . "data/{$user_id}/ticket/{$ticket_id}/pub/";
        }
        if (!empty($replied_id)) {
            $dir .= "rep/" . $replied_id . "/";
        }
        return $dir;
    }

    static function get_hash($path)
    {
        //$path=str_replace(array("//","\\"), "/", $path);
        $path = str_replace(array('/', '\\'), "-", $path);
        $path = str_replace("--", "-", $path);
        //echo "<br/>".$path."<br/>";
        $start_date = date("YmdH:i", strtotime("- 30 MINUTES"));
        $end_date = date("YmdH:i", strtotime("+ 30 MINUTES"));
        return get8BitHashCode($path . "/appsbd/" . date("YmdH"));
    }

    static function setPaidTicket($id)
    {
        $obj = new self();
        $obj->is_paid_ticket('Y');
        $obj->SetWhereCondition("id", $id);
        return $obj->Update();
    }

    static function getTicketYearlyOpenData($fromYear, $toYear = "", $app_user = "")
    {
        $btproperty = !empty($app_user) ? "assigned_date" : "opened_time";
        if (empty($toYear)) {
            $toYear = $fromYear;
        }
        $fromYear = "$fromYear-01-01 00:00:00";
        $toYear = "$toYear-12-31 23:23:59";
        if (!empty($app_user)) {
            $app_user = "  `assigned_on` = '{$app_user}' AND ";
        }
        $query = "SELECT
	    count(*) as total,MONTH({$btproperty}) as month
	    FROM ticket
	    WHERE  {$app_user} {$btproperty} BETWEEN '{$fromYear}' AND '{$toYear}'
	    GROUP BY MONTH($btproperty)";
        // die($query);
        $obj = new self();
        $result = $obj->SelectQuery($query);
        $response_array = [];
        foreach ($result as $d) {
            $response_array[$d->month] = $d->total;
        }
        return $response_array;
        /* SELECT
        count(*) as total,DAY(last_reply_time) as date
        FROM ticket
        WHERE `status` ='C' and opened_time BETWEEN '2017-10-01 00:00:00' AND '2017-12-31 23:23:59'
        GROUP BY DAY(last_reply_time);*/
    }

    /**
     * @param $ticket_id
     * @param bool $noLimit
     * @return bool
     */
    static function DeleteByID($ticket_id, $noLimit = false)
    {
        $isDeleted = parent::DeleteByKeyValue("id", $ticket_id, $noLimit);
        if ($isDeleted) {
            Mticket_reply::DeleteByTicketId($ticket_id);
            Mticket_log::DeleteByTicketId($ticket_id);
            Mticket_feedback::DeleteByTicketId($ticket_id);
            Mticket_custom_field::DeleteByTicketId($ticket_id);
        }
        return $isDeleted;
    }

    static function getTicketYearlyCloseData($fromYear, $toYear = "", $app_user = "")
    {
        $btproperty = "last_reply_time";
        if (empty($toYear)) {
            $toYear = $fromYear;
        }
        $fromYear = "$fromYear-01-01 00:00:00";
        $toYear = "$toYear-12-31 23:23:59";
        if (!empty($app_user)) {
            $app_user = "  `assigned_on` = '{$app_user}' AND ";
        }
        $query = "SELECT
	    count(*) as total,MONTH($btproperty) as Month
	    FROM ticket
	    WHERE  {$app_user} `status` ='C' and {$btproperty} BETWEEN '{$fromYear}' AND '{$toYear}'
	    GROUP BY MONTH({$btproperty})";
        // die($query);

        $obj = new self();
        $result = $obj->SelectQuery($query);
        $response_array = [];
        foreach ($result as $d) {
            $response_array[$d->Month] = $d->total;
        }
        return $response_array;
    }

    static function getTicketOpenData($fromDate, $toData, $app_user = "")
    {
        $btproperty = !empty($app_user) ? "assigned_date" : "opened_time";
        $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate));
        $toData = date("Y-m-d 23:23:59", strtotime($toData));
        if (!empty($app_user)) {
            $app_user = "  `assigned_on` = '{$app_user}' AND ";
        }
        $query = "SELECT
        	    count(*) as total,DAY({$btproperty}) as day
        	    FROM ticket
        	    WHERE  {$app_user} {$btproperty} BETWEEN '{$fromDate}' AND '{$toData}'
        	    GROUP BY DAY($btproperty)";
        $obj = new self();
        $result = $obj->SelectQuery($query);
        $response_array = [];
        foreach ($result as $d) {
            $response_array[$d->day] = $d->total;
        }
        return $response_array;
        /* SELECT
         count(*) as total,DAY(last_reply_time) as date
         FROM ticket
         WHERE `status` ='C' and opened_time BETWEEN '2017-10-01 00:00:00' AND '2017-12-31 23:23:59'
         GROUP BY DAY(last_reply_time);*/
    }

    static function getTicketCloseData($fromDate, $toData, $app_user = "")
    {
        $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate));
        $toData = date("Y-m-d 23:23:59", strtotime($toData));
        $btproperty = "last_reply_time";
        if (!empty($app_user)) {
            $app_user = "  `assigned_on` = '{$app_user}' AND ";
        }
        $query = "SELECT
	    count(*) as total,DAY($btproperty) as day
	    FROM ticket
	    WHERE  {$app_user} `status` ='C' and {$btproperty} BETWEEN '{$fromDate}' AND '{$toData}'
	    GROUP BY DAY({$btproperty})";
        // die($query);

        $obj = new self();
        $result = $obj->SelectQuery($query);
        $response_array = [];
        foreach ($result as $d) {
            $response_array[$d->day] = $d->total;
        }
        return $response_array;
    }
    static function getClientTicketCounter($user_id)
    {
        $obj = new self();
        $couter = $obj->SelectQuery("SELECT count(*) as total, `status` FROM ticket WHERE ticket_user={$user_id} GROUP BY `status`");
        $display_counter = new stdClass();
        $display_counter->active = 0;
        $display_counter->closed = 0;
        $display_counter->action_required = 0;
        $display_counter->other = 0;
        $active_status = ['P', 'N', 'R'];
        foreach ($couter as $c) {
            if (in_array($c->status, $active_status)) {
                $display_counter->active += $c->total;
            } elseif ($c->status == "A") {
                $display_counter->action_required += $c->total;
            } elseif ($c->status == "C") {
                $display_counter->closed += $c->total;
            } else {
                $display_counter->other += $c->total;
            }
        }

        return $display_counter;
    }
    static function getTicketStat($fromDate = "", $toDate = "", $app_user = "")
    {
        $btproperty = !empty($app_user) ? "assigned_date" : "opened_time";
        $where = "";
        $where2 = "";
        if (!empty($app_user)) {
            $where = " WHERE `assigned_on` = '{$app_user}'";
            $where2 = " WHERE `assigned_on` = '{$app_user}'";
        }
        if (!empty($fromDate) && !empty($toDate)) {
            $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate));
            $toDate = date("Y-m-d 23:23:59", strtotime($toDate));
            $where .= !empty($where) ? " AND " : " WHERE ";
            $where .= " $btproperty BETWEEN '{$fromDate}' AND '{$toDate}'";

            $where2 .= !empty($where) ? " AND " : " WHERE ";
            $where2 .= " last_reply_time BETWEEN '{$fromDate}' AND '{$toDate}'";
        }


        $query1 = "SELECT count(*) as total_ticket,
	    SUM( CASE  WHEN`is_paid_ticket` = 'Y' THEN 1 ELSE 0 END ) as paid_ticket,
	    SUM( CASE  WHEN`status` <> 'C' THEN 1 ELSE 0 END ) as pending_ticket,
	    SUM( CASE  WHEN`status` <> 'C' AND assigned_on='' THEN 1 ELSE 0 END ) as unassigned_ticket
	        
	    FROM ticket {$where}";

        $query2 = "SELECT 
	    SUM( CASE  WHEN`status` = 'C' THEN 1 ELSE 0 END ) as close_ticket ,	   	    
	    SUM( CASE  WHEN (`is_paid_ticket` = 'Y' AND  `status`='C') THEN 1 ELSE 0 END ) as paid_closed_ticket
	    FROM ticket {$where2}";
        //die($query1);
        $obj = new self();
        $totalTicket = $obj->SelectQuery($query1);
        $othersStat = $obj->SelectQuery($query2);

        $response = new stdClass();
        $response->total = !empty($totalTicket[0]->total_ticket) ? $totalTicket[0]->total_ticket : 0;
        $response->pending_ticket = !empty($totalTicket[0]->pending_ticket) ? $totalTicket[0]->pending_ticket : 0;
        $response->paid_ticket = !empty($totalTicket[0]->paid_ticket) ? $totalTicket[0]->paid_ticket : 0;
        $response->unassigned_ticket = !empty($totalTicket[0]->unassigned_ticket) ? $totalTicket[0]->unassigned_ticket : 0;

        $response->close_ticket = !empty($othersStat[0]->close_ticket) ? $othersStat[0]->close_ticket : 0;
        $response->paid_closed_ticket = !empty($othersStat[0]->paid_closed_ticket) ? $othersStat[0]->paid_closed_ticket : 0;
        return $response;
    }

    static function GetDefaultRule()
    {
        $rule = Mticket_assign_rule::FindBy("cat_ids", "*",['rule_type'=>'A']);
        if (!empty($rule)) {
            return $rule;
        }
        return NULL;
    }
	
	static function GetDefaultNotifyRule()
	{
		$rule = Mticket_assign_rule::FindBy("cat_ids", "*",['rule_type'=>'N']);
		if (!empty($rule)) {
			return $rule;
		}
		return NULL;
	}

    /**
     * @param $cat_id
     * @return Mticket_assign_rule|NULL
     */
    static function GetAssignRuleByCategory($cat_id)
    {
        if ($cat_id == 0) {
            return self::GetDefaultRule();
        }
        $rule = Mticket_assign_rule::GetAssignRuleByCategory($cat_id);
        if (!empty($rule)) {
            return $rule;
        } else {
            $category = Mcategory::FindBy("id", $cat_id);
            if ($category) {
                return self::GetAssignRuleByCategory($category->parent_category);
            }
        }
        return self::GetDefaultRule();
    }

    static function GetRoleMinAssignedUser($fromdata, $todate, $role_id)
    {
        $query = "SELECT app_user.id,
    SUM(IF(ticket.assigned_on IS NULL,0,1) ) as total_assign 
    FROM app_user 
    JOIN role_list ON app_user.role=role_list.role_id
    LEFT JOIN ticket ON app_user.id=ticket.assigned_on and ticket.assigned_date BETWEEN '$fromdata' AND '$todate'
    WHERE role='$role_id' 
    GROUP BY app_user.id ORDER BY total_assign LIMIT 1";
        $obj = new self();
        $result = $obj->SelectQuery($query);
        if (!empty($result[0]->id)) {
            return $result[0]->id;
        }
        return null;
    }
	static function GetNotifyRulesByCategory($cat_id)
	{
		if ($cat_id == 0) {
			$obj= self::GetDefaultNotifyRule();
			if(!empty($obj)){
				return [$obj];
            }else{
			    return [];
            }
		}
		$rules = Mticket_assign_rule::GetNotifyRulesByCategory($cat_id);
		if (!empty($rules)) {
			return $rules;
		} else {
			$category = Mcategory::FindBy("id", $cat_id);
			if ($category) {
				return self::GetNotifyRulesByCategory($category->parent_category);
			}
		}
		return self::GetDefaultNotifyRule();
	}
    /**
     * @param self $ticketObj
     */
    static function OnTicketOpening($ticketObj)
    {
        if ($ticketObj instanceof self) {
            $assignRule = self::GetAssignRuleByCategory($ticketObj->cat_id);
            $assignedId="";
            if (!empty($assignRule)) {
                if ($assignRule->rule_type == "A") {
                    //assign
                    $fromDate = date('Y-m-01 00:00:00');
                    $todate = date('Y-m-t 23:23:59');
                    $app_user_id = self::GetRoleMinAssignedUser($fromDate, $todate, $assignRule->rule_id);
                    if (!empty($app_user_id)) {
	                    $assignedId=$app_user_id;
                        //assigned user;
                        Mticket::AutoAssignUser($ticketObj,$app_user_id,"sys",true);
                    }
                }
            }
            
            $notifyRules=self::GetNotifyRulesByCategory($ticketObj->cat_id);
	        foreach ( $notifyRules as $notifyRule ) {
	            
	            if($assignedId==$notifyRule->rule_id){continue;}
	            
		        $app_user=Mapp_user::FindBy("id",$notifyRule->rule_id);
		        //email notification
		        if(!empty($app_user)) {
			        self::SendTicketOpenAdminEmailByObj($ticketObj, $app_user->email);
		        }
		        //on screen notification;
		        $isEnableScreenAssignTicket=Mapp_setting::GetSettingsValue("is_astkt_open","N")=="Y";
		        if($isEnableScreenAssignTicket){
			        $objpatam=new stdClass();
			        $objpatam->id=$ticketObj->id;
			        $objpatam->title=$ticketObj->title;
			        $paramstr=base64_encode(json_encode($objpatam));
			        Mapp_notificaiton::AddNotification($app_user->id,__("New ticket received"),__("A new ticket has been received, please assign"),admin_url("ticket/details/{$ticketObj->id}"),false,"TO",$paramstr);
		        }
            }
        }
    }

    /* end custom function */
    function GetAddForm($label_col = 5, $input_col = 7, $mainobj = null, $except = array(), $disabled = array())
    {

        if (!$mainobj) {
            $mainobj = $this;
        }
        ?>
        <?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
		      	</div>
		      </div> 
		     <?php } */
        ?>

        <?php if (!in_array("ticket_track_id", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="ticket_track_id"><?php _e("Ticket Track Id"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="10" value="<?php echo $mainobj->GetPostValue("ticket_track_id"); ?>"
                       class="form-control"
                       id="ticket_track_id" <?php echo in_array("ticket_track_id", $disabled) ? ' disabled="disabled" ' : ' name="ticket_track_id" '; ?>
                       placeholder="<?php _e("Ticket Track Id"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Ticket Track Id")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("cat_id", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="cat_id"><?php _e("Cat Id"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="11" value="<?php echo $mainobj->GetPostValue("cat_id"); ?>"
                       class="form-control"
                       id="cat_id" <?php echo in_array("cat_id", $disabled) ? ' disabled="disabled" ' : ' name="cat_id" '; ?>
                       placeholder="<?php _e("Cat Id"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Cat Id")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("title", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="title"><?php _e("Title"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="150" value="<?php echo $mainobj->GetPostValue("title"); ?>"
                       class="form-control"
                       id="title" <?php echo in_array("title", $disabled) ? ' disabled="disabled" ' : ' name="title" '; ?>
                       placeholder="<?php _e("Title"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Title")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("ticket_body", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="ticket_body"><?php _e("Ticket Body"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <textarea maxlength="" class="form-control"
                          id="ticket_body" <?php echo in_array("ticket_body", $disabled) ? ' disabled="disabled" ' : ' name="ticket_body" '; ?>
                          placeholder="<?php _e("Ticket Body"); ?>" data-bv-notempty="true"
                          data-bv-notempty-message="<?php _e("%s is required", __("Ticket Body")); ?>"><?php echo $mainobj->GetPostValue("ticket_body"); ?></textarea>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("ticket_user", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="ticket_user"><?php _e("Ticket User"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="6" value="<?php echo $mainobj->GetPostValue("ticket_user"); ?>"
                       class="form-control"
                       id="ticket_user" <?php echo in_array("ticket_user", $disabled) ? ' disabled="disabled" ' : ' name="ticket_user" '; ?>
                       placeholder="<?php _e("Ticket User"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Ticket User")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("opened_time", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="opened_time"><?php _e("Opened Time"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue("opened_time"); ?>"
                       class="form-control"
                       id="opened_time" <?php echo in_array("opened_time", $disabled) ? ' disabled="disabled" ' : ' name="opened_time" '; ?>
                       placeholder="<?php _e("Opened Time"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Opened Time")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("re_open_time", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="re_open_time"><?php _e("Re Open Time"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue("re_open_time"); ?>"
                       class="form-control"
                       id="re_open_time" <?php echo in_array("re_open_time", $disabled) ? ' disabled="disabled" ' : ' name="re_open_time" '; ?>
                       placeholder="<?php _e("Re Open Time"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Re Open Time")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("re_open_by", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="re_open_by"><?php _e("Re Open By"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="6" value="<?php echo $mainobj->GetPostValue("re_open_by"); ?>"
                       class="form-control"
                       id="re_open_by" <?php echo in_array("re_open_by", $disabled) ? ' disabled="disabled" ' : ' name="re_open_by" '; ?>
                       placeholder="<?php _e("Re Open By"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Re Open By")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("re_open_by_type", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="re_open_by_type"><?php _e("Re Open By Type"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <div class="inline radio-inline">
                    <?php
                    $re_open_by_type_selected = $mainobj->GetPostValue("re_open_by_type", "");
                    $re_open_by_type_isDisabled = in_array("re_open_by_type", $disabled);
                    GetHTMLRadioByArray("Re Open By Type", "re_open_by_type", "re_open_by_type", true, $mainobj->GetPropertyRawOptions("re_open_by_type"), $re_open_by_type_selected, $re_open_by_type_isDisabled);
                    ?>

                </div>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("user_type", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="user_type"><?php _e("User Type"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <div class="inline radio-inline">
                    <?php
                    $user_type_selected = $mainobj->GetPostValue("user_type", "U");
                    $user_type_isDisabled = in_array("user_type", $disabled);
                    GetHTMLRadioByArray("User Type", "user_type", "user_type", true, $mainobj->GetPropertyRawOptions("user_type"), $user_type_selected, $user_type_isDisabled);
                    ?>

                </div>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("status", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="status"><?php _e("Status"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <select class="form-control"
                        id="status" <?php echo in_array("status", $disabled) ? ' disabled="disabled" ' : ' name="status" '; ?>
                        data-bv-notempty="true" data-bv-notempty-message="<?php _e("%s is required", __("Status")); ?>">
                    <?php $status_selected = $mainobj->GetPostValue("status", "N");
                    GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("status", true), $status_selected);
                    ?>

                </select>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("assigned_on", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="assigned_on"><?php _e("Assigned On"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <?php $options_assigned_on = Mapp_user::FetchAllKeyValue("id", "title", true); ?>
                <select class="form-control"
                        id="assigned_on" <?php echo in_array("assigned_on", $disabled) ? ' disabled="disabled" ' : ' name="assigned_on" '; ?>
                        data-bv-notempty="true"
                        data-bv-notempty-message="<?php _e("%s is required", __("Assigned On")); ?>">
                    <?php $assigned_on_selected = $mainobj->GetPostValue("assigned_on");
                    GetHTMLOptionByArray($options_assigned_on, $assigned_on_selected);
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("last_replied_by", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="last_replied_by"><?php _e("Last Replied By"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <?php $options_last_replied_by = Mapp_user::FetchAllKeyValue("id", "title", true); ?>
                <select class="form-control"
                        id="last_replied_by" <?php echo in_array("last_replied_by", $disabled) ? ' disabled="disabled" ' : ' name="last_replied_by" '; ?>
                        data-bv-notempty="true"
                        data-bv-notempty-message="<?php _e("%s is required", __("Last Replied By")); ?>">
                    <?php $last_replied_by_selected = $mainobj->GetPostValue("last_replied_by");
                    GetHTMLOptionByArray($options_last_replied_by, $last_replied_by_selected);
                    ?>
                </select>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("last_reply_time", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="last_reply_time"><?php _e("Last Reply Time"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue("last_reply_time"); ?>"
                       class="form-control"
                       id="last_reply_time" <?php echo in_array("last_reply_time", $disabled) ? ' disabled="disabled" ' : ' name="last_reply_time" '; ?>
                       placeholder="<?php _e("Last Reply Time"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Last Reply Time")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("ticket_rating", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="ticket_rating"><?php _e("Ticket Rating"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="1" value="<?php echo $mainobj->GetPostValue("ticket_rating"); ?>"
                       class="form-control"
                       id="ticket_rating" <?php echo in_array("ticket_rating", $disabled) ? ' disabled="disabled" ' : ' name="ticket_rating" '; ?>
                       placeholder="<?php _e("Ticket Rating"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Ticket Rating")); ?>">
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("priroty", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="priroty"><?php _e("Priroty"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <select class="form-control"
                        id="priroty" <?php echo in_array("priroty", $disabled) ? ' disabled="disabled" ' : ' name="priroty" '; ?>
                        data-bv-notempty="true"
                        data-bv-notempty-message="<?php _e("%s is required", __("Priroty")); ?>">
                    <?php $priroty_selected = $mainobj->GetPostValue("priroty", "L");
                    GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("priroty", true), $priroty_selected);
                    ?>

                </select>
            </div>
        </div>
    <?php } ?>

        <?php
    }


}
?>