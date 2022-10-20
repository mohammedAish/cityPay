<?php
class Cron extends APP_Controller{
	private $isDebugMode=false;
	private $debugString="";
	
    function __construct(){
        parent::__construct();        
        $this->output->unset_template();
        if(!empty($_GET['debug'])){
        	$this->isDebugMode=true;
        }
        $this->AddDebugLog("----New Process stared-----");
    }
    function __destruct() {
	    parent::__destruct();
	    if($this->isDebugMode){
		    $this->AddDebugLog("----End Process-----");
		    echo "<pre>";
	    	GPrint($this->debugString);
	    	echo "</pre>";
	    }
    }
	
	function process(){
        $this->output->unset_template();       
        $this->email_to_ticket();
        //$this->auto_close_ticket();
    }
    function auto_close_ticket(){
        $this->output->unset_template();
        $limit=10;
        if(Mapp_setting::GetSettingsValue("enable_aclose","N")=="Y"){
            $interval=Mapp_setting::GetSettingsValue("aclosing_rule",72);
            $closingMessage=Mapp_setting::GetSettingsValue("aclosing_msg","Auto closed");
            $closingTime=strtotime("-{$interval} HOUR");
            $mticket=new Mticket();
            $mticket->status("<> 'C'",true);
            $mticket->last_replied_by_type("A");
            $mticket->last_reply_time("<'".date("Y-m-d H:i:s",$closingTime)."'",true);
            $result=$mticket->SelectAllGridData("id,assigned_on","","",$limit);
            foreach ($result as $res) {
                Mticket::UpdateStatus($res->id, "C", "SYS", "S");
                Mticket_reply::add($res->id, "SYS", "S", $closingMessage, "C", true, $res->assigned_on);
            }

        }
        Mchat::AutoCloseChat();
    }
    function email_to_ticket()
    {
        $this->output->unset_template();
        $this->load->library('imap');
        $imapObj = new Imap();
    
        /*$tmpobj=file_get_contents(FCPATH."/tmp/tmp.email");
        $tmpobj=unserialize($tmpobj);
        $this->process_email_by_object($tmpobj, $imapObj);
        return;*/
    
        if ($imapObj->imap_connect_default() === TRUE) {
            $imapObj->select_folder('INBOX');
            $messages = $imapObj->get_unread_messages(10, 0, "ASC", TRUE);
            //$messages=$imapObj->get_messages(5,0,"DESC",TRUE);
	        //GPrint($messages);die;
	        
	        $this->AddDebugLog("Total email found (".count($messages).")");
            foreach ($messages as $msg) {
	            $this->AddDebugLog("\n".count($messages).")");
                $this->process_email_by_object($msg, $imapObj);
            }
        }
        $msg = GetMsgForAPI();
        if (!empty($msg)) {
        	$this->AddDebugLog($msg);
            Mdebug_log::AddGeneralLog("Email to ticket conversion unwanted error message", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, $msg);
        }
        //ticket auto closing
        $this->auto_close_ticket();
    }
    /**
     * @param unknown $email_object
     * @param Imap $imapObj
     */
    private function process_email_by_object($email_object,&$imapObj){
       // $this->load->library('simple_html_dom');
        $from_email=!empty($email_object['from']['email'])?$email_object['from']['email']:"";
        if(!empty($email_object['reply_to']['email'])){
	        $from_email=$email_object['reply_to']['email'];
        }
        $spam_emails=Mapp_setting::GetSettingsValue("app_spam_emails",'');
        if(!empty($spam_emails)){
	        $spam_emails=explode(',',$spam_emails);
	        $spam_emails=array_filter(array_map('trim', $spam_emails));
	        if(in_array($from_email,$spam_emails)){
		        Mdebug_log::AddGeneralLog("Email to ticket conversion failed(Came from SPAM Email Address)",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,"Email comes from spam email list ($from_email)");
		        $imapObj->set_unseen_message($email_object['uid'],FALSE);
		        if(Mapp_setting::GetSettingsValue("is_del_spam_email",'N')=="Y") {
			        $imapObj->delete_message($email_object['uid']);
		        }
		        return;
	        }
        }
        //GPrint($email_object);die($from_email);
        if($from_email==Mapp_setting::GetSettingsValue("out_email_from")){
	        Mdebug_log::AddGeneralLog("Email to ticket conversion failed(Came from SMTP Email Address)",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,"The System avoid those email which are come form its sending email ( SMTP or SENDMAIL form email)");
	        $imapObj->set_unseen_message($email_object['uid'],FALSE);
	        return;
        }
	    if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
		    $imapObj->set_unseen_message($email_object['uid'],FALSE);
		    Mdebug_log::AddGeneralLog("Email to ticket conversion failed-invalid email address",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,"Email Address : ".$from_email);
		    return;
	    }
        $subject=!empty($email_object['subject'])?$email_object['subject']:"";
        $subject=trim($subject);
        if($subject=="Mail delivery failed: returning message to sender"){
            $imapObj->set_unseen_message($email_object['uid'],FALSE);
            return;
        }
        $body=!empty($email_object['body'])?$email_object['body']:"";
        if(!empty($email_object['html'])){
        	$body=str_replace('div class="WordSection1">',' ',$body);
        	$body=str_replace('div dir="ltr">',' ',$body);
	        $body=str_replace('<p>&nbsp</p>',' ',$body);
            $body=CleanHTMLtoText($body);
        }
	   
        $isUnread=!empty($email_object['unread'])?$email_object['unread']:false;
        if(empty($from_email) || empty($subject) || empty($body)){
	        $imapObj->set_unseen_message($email_object['uid'],FALSE);
            Mdebug_log::AddGeneralLog("Email to ticket conversion failed(email,subject or body empty)",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR);
            return;
        }
	   
       
        if($isUnread){
            $ticket_dtls=null;
            preg_match('/##TRACKID:(.*?)##/', $body,$ticket_dtls);
            if(!empty($ticket_dtls[1])){
	            $this->AddDebugLog("Reply found: $subject");
               $ticket_track_id=trim($ticket_dtls[1]);
               $ticketObj=Mticket::FindBy("ticket_track_id", $ticket_track_id);
               if($ticketObj){
                   $user=Msite_user::FindBy("email", $from_email);
                   if($user){ 
                       $this->new_replay($ticketObj,$user,$body,$email_object,$imapObj);                                 
                   }
                   return;
               }
            }
	        $this->AddDebugLog("Processing New Created : $subject");
	        $this->open_new_ticket($from_email,$subject,$body,$email_object, $imapObj);
        }else{
	        $this->AddDebugLog("Email Already Read : $subject");
        }
    }
	
	/**
	 * @param $ticketObj
	 * @param $user
	 * @param $body
	 * @param $email_object
	 * @param Imap $imapObj
	 */
	private function new_replay($ticketObj,$user,$body,$email_object,&$imapObj){
       
       // $this->cleanEmailBody($body);
		$body=CleanEmailToTicketOrReplyBodyText($body);
        if($ticketObj->status=="C"){
            Mticket::ReopenStatus($ticketObj->id, "R",$user->id,"U",false,true);
            $ticketObj->status="R";
        }
        $repies=Mticket_reply::FindAllBy("ticket_id", $ticketObj->id);
        if(!empty($repies)){
            foreach ($repies as $tir){             
                $body=str_replace($tir->reply_text, "", $body);
            }
        }
	    
	    if(empty($body)){
		    //$imapObj->set_unseen_message($email_object['uid'],FALSE);
		    $imapObj->set_unseen_message($email_object['uid'],FALSE);
		    Mdebug_log::AddGeneralLog("Email to ticket replay conversion failed,Empty body",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR);
		    return;
	    }
		//$body=CleanHTMLtoText($body);
		//$body=CleanEmailToTicketOrReplyBodyText($body);
        $ticket_reply_obj=Mticket_reply::add($ticketObj->id,$user->id,"U",$body,$ticketObj->status,"Y",$ticketObj->assigned_on,true,true);
        if(!empty($ticket_reply_obj)){           
            $imapObj->set_unseen_message($email_object['uid'],FALSE);
            
            if(isset($email_object['attachments']) && count($email_object['attachments']>0)){
            	$this->AddDebugLog("Attachments founds (".count($email_object['attachments']).")");
                $ticket_path=Mticket::get_ticket_file_path($ticketObj->ticket_user,$ticketObj->id,false,$ticket_reply_obj->reply_id);
                if(app_make_dir($ticket_path,0755,true)){
	                $this->AddDebugLog("Path Created : $ticket_path");
	                $this->addAttachement($ticket_path,$email_object,$imapObj);
	                $this->AddDebugLog("Finished attachment process");
                }else{
	                $this->AddDebugLog("Failed to Create Path : $ticket_path");
                }
            }//endi if
        }
    }
	
	/**
	 * @param $from_email
	 * @param $subject
	 * @param $body
	 * @param $email_object
	 * @param Imap $imapObj
	 */
	private function open_new_ticket($from_email,$subject,$body,$email_object,&$imapObj){
        $from_name=!empty($email_object['from']['name'])?$email_object['from']['name']:"-";
		if(!empty($email_object['reply_to']['name'])){
			$from_name=$email_object['reply_to']['name'];
		}
		
        //$this->cleanEmailBody($body);
		$body=CleanEmailToTicketOrReplyBodyText($body);
		
		$this->AddDebugLog("Body\n".$body);
        $isHtml=!empty($email_object['html'])?$email_object['html']:false;
        $this->AddDebugLog("Trying to add new ticket");
        $newobj=new Mticket();
	    if(!empty($subject)){
	    	$oldTicket=new Mticket();
	    	$oldTicket->title($subject);
		    $oldtickets=$oldTicket->SelectAll();
		    if(count($oldtickets)>0){
		    	foreach ($oldtickets as $otic){
		    		if($otic->ticket_body==$body){
					    $imapObj->set_unseen_message($email_object['uid'],FALSE);
					    $this->AddDebugLog("Already added this ticket");
		    			return;
				    }
			    }
		    }
			
	    }else{
	    	return;
	    }
		$this->AddDebugLog("Pass the old ticket");
        $old_site_user=Msite_user::FindBy("email", $from_email);
        if(!$old_site_user){
	       // is_guest_ticket
	        if(Mapp_setting::GetSettingsValue("is_guest_ticket","N")=="Y") {
		        $password = strtoupper( get8BitHashCode( rand( 1000, 9999 ) ) ) . rand( 10, 99 );
		        $siteU    = new Msite_user();
		        $siteU->email( $from_email );
		        $siteU->first_name( $from_name );
		        $siteU->user_type( "G" );
		        $siteU->pass( $password );
		        if ( $siteU->Save() ) {
			        $newobj->ticket_user( $siteU->id );
			        $newobj->user_type( $siteU->user_type );
			        $isNewlyOpenGuestUser = true;
		        } else {
			        $imapObj->set_unseen_message($email_object['uid'],FALSE);
			        Mdebug_log::AddGeneralLog( "Email to ticket conversion failed", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR );
			        return;
		        }
	        }else{
		        $this->AddDebugLog("Guest ticket has been disabled");
	        	return;
	        }
        }else{
            $newobj->ticket_user($old_site_user->id);
            $newobj->user_type($old_site_user->user_type);
        }
		$this->AddDebugLog("Pass guest ticket");
        $newobj->is_open_using_email("Y");
        $newobj->ticket_body($body);
        $newobj->title($subject);
        $newobj->cat_id('0');
        $newobj->is_public("N");
        //$newobj->ticket_user("");
        $newobj->status("N");
        $newobj->priroty("M");
        if($newobj->IsValidForm()){
	        $this->AddDebugLog("Pass ticket object validation");
            $isOk=$newobj->SaveWithoutSendingEmail();
            if($isOk){
	            $this->AddDebugLog("Ticket Created");
                $imapObj->set_unseen_message($email_object['uid'],FALSE);
                $ticket_path=Mticket::get_ticket_file_path($newobj->ticket_user,$newobj->id);
                if(app_make_dir($ticket_path,0755,true)){
	                $this->AddDebugLog("Path Created : $ticket_path");
	                $this->addAttachement($ticket_path,$email_object,$imapObj);
	                $this->AddDebugLog("Finished attachment process");
                }else{
	                $this->AddDebugLog("attachment path createtion false");
                }
	            $newobj->SendTicketOpeningAllEmail();
            }else{
	            $this->AddDebugLog("Ticket Created Failed : ".GetMsgForAPI());
                $imapObj->set_unseen_message($email_object['uid'],TRUE);
                Mdebug_log::AddGeneralLog("Email to ticket conversion failed",Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR);
            }
        }else{
	        $imapObj->set_unseen_message($email_object['uid'],false);
	        $this->AddDebugLog("Invalid form found");
        }
    }
	
	/**
	 * @param $ticket_path
	 * @param $email_object
	 * @param Imap $imapObj
	 */
	private function addAttachement($ticket_path,$email_object,$imapObj){
	    $prefix=time()."_";
	    if(!empty($email_object['attachments']) && is_array($email_object['attachments']) && count($email_object['attachments'] > 0)) {
		    foreach ( $email_object['attachments'] as $aid => $value ) {
			    $obj          = $imapObj->get_attachment( $email_object['id'], $aid, $ticket_path );
			    $allowed_type = Mapp_setting::GetSettingsValue( "allowed_file_type" );
			    $allowed_type = explode( "|", $allowed_type );
			    $allowed_type = array_map( function ( $value ) {
				    return strtoupper( $value );
			    }, $allowed_type );
			    if ( file_exists( $obj['content'] ) ) {
				    $this->AddDebugLog( "Trying to attach file: " . $obj['name'] );
				    $type = strtoupper( $obj['type'] );
				    $type = $type == "JPEG" ? "JPG" : $type;
				    $extn = substr( $obj['name'], - 3 );
				    $extn = strtoupper( $extn );
				    if ( in_array( $type, $allowed_type ) || in_array( $extn, $allowed_type ) ) {
					    rename( $obj['content'], $ticket_path . $prefix . $obj['name'] );
				    } else {
					    unlink( $obj['content'] );
					    Mdebug_log::AddGeneralLog( "Unauthrized file type, {$obj['name']} Deleted", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR );
				    }
			    }
		    }
	    }
	    $this->AddDebugLog("Finished attachment process");
    }
    function cleanEmailBody(&$body){
		$allowed_tags="<h1><h2><h3><h4><strong><b><br><pre><span><ul><ol><u><font><li><table><tr><img><div><td><th><tbody><thead><tfoot><hr><p><a>";
	    $body=preg_replace('/<div style=\"display:none\">\-\-start\-<\/div>[\d\D]+\-\-end\-<\/div>/', "", $body);
	    $body=preg_replace('/<.*?font-family:.*?,Helvetica,Arial[^\/]+<\/div>/', "", $body);
	    $body=trim($body);
	    //$body = preg_replace('/\s+/', ' ',$body);
	    $body=strip_tags($body,$allowed_tags);
	    $body=trim($body);
	    $body=preg_replace( "/<div\s*class=\"gmail_quote\".*?>[^\/]+<\/div>/i", "", $body );
	    $body=preg_replace( "/<div class=\"gmail_signature\" data-smartmail=\"gmail_signature\"><div\s*dir=\".*?\">?[^\/]+<\/div><\/div>/i", "", $body );
	    $body=str_replace( '<div', '<br><div', $body );
	    $body=strip_tags($body,$allowed_tags);
	    $body=preg_replace("/(<br\s*\/?>\s*)+/i", "<br>", $body);
	    $body=trim($body,'<br>');
	    $body=preg_replace( "/[\r\n]+/i", "<br>", $body );
	    //$body = preg_replace('/[ ]+/', ' ',$body);
	    $body=nl2br($body);
	    $body=preg_replace('/On .*?wrote:/i', "<br/>", $body);
    }
    function AddDebugLog($msg){
		if($this->isDebugMode){
			$msg="\n".date('Y-m-d H:i:s')." - ".$msg;
			file_put_contents(APPPATH."/logs/email_to_ticket.log",$msg,FILE_APPEND);
			$this->debugString.=$msg;
		}
    }
	
}