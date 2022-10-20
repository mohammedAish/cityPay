<?php

class MSystem_model extends APP_Model
{
    public static $selfobj;
    function __construct()
    {
        
        parent::__construct();
        $is_sql_mode = $this->config->item("is_sql_mode");
        if($is_sql_mode){
            $this->GetSelectDB()->query("SET SESSION sql_mode = ''");
		}
        $lastCheck = Mapp_setting::GetSettingsValue("_uprcs", "1.5.9");
        $current_version = $this->config->item("app_version");
        $isForce=RequestValue("__fru","N");
        $isForce=strtoupper($isForce)=="Y";
        if ($isForce || version_compare($lastCheck, $current_version, "<")) {
            self::$selfobj=$this;
            AddOnManager::DoAction("app-version-update",$lastCheck, $current_version);
            self::UpdateProcess($lastCheck,$current_version,$isForce);
        }
    }

    public static function UpdateProcess($lastCheck, $current_version,$isForce=false,$showForceMsg=true)
    {
        Mapp_setting::SetInitialSettings();
	   
        //1.5.10
        if (version_compare($lastCheck, "1.5.10", "<")) {
            Mpage_list::AddUpdatePage("A","admin","ticket-confirm","ticket-delete","Ticket Delete","10. Ticket");
            Mpage_list::AddUpdatePage("H","admin","system-update","site-info","Site Info","System Update");
            Mpage_list::AddUpdatePage("A","admin","app-permission-confirm","archive-user","Archive User","05. User Settings");
            Mpage_list::AddUpdatePage("A","client","panel","change-photo","Change Profile Photo","Panel","C");
        }

        if (version_compare($lastCheck, "1.5.11", "<")) {
            Mcanned_msg::DBColumnAddOrModify("title","char","150","","NOT NULL","user_id","","utf8");
            Mcanned_msg::DBColumnAddOrModify("canned_msg","text","","","NULL","title","textarea","utf8");
            Mnotice::DBColumnAddOrModify("msg","text","","","NULL","title","textarea","utf8");
        }
        if (version_compare($lastCheck, "1.5.12", "<")) {
            Mpage_list::AddUpdatePage("S", "admin", "app-permission", "set-user-pass", "Set User Password", "05. User Settings");
        }
        if ($isForce || version_compare($lastCheck, "2.0", "<")) {
            if($isForce){
                echo "DB Migration Started<br/>";
            }
            Mpage_list::AddUpdatePage("A","admin","system-update","index","Application Update Info","07. App Information","A");
            Mpage_list::AddUpdatePage("A","admin","system-update","process-update","Application Update Process","07. App Information","A");
            Mknowledge::DBColumnAddOrModify("last_update_time","timestamp","","CURRENT_TIMESTAMP","NOT NULL","featured_video_link","","");
            Mapp_user::DBColumnAddOrModify("is_enable_chat","char","1","'Y'","NOT NULL","","bool(Y=Yes,N=No)");
            Mcanned_msg::DBColumnAddOrModify("canned_msg","text","","","NULL","title","textarea","utf8");
            Mcanned_msg::DBColumnAddOrModify("canned_type","char","1","'T'","NOT NULL","","drop(T=Ticket,C=Chat)");
            Mapp_notificaiton::DBColumnAddOrModify("item_type","char","2","''","NOT NULL","entry_time");
            Mapp_notificaiton::DBColumnAddOrModify("extra_param","char","255","''","NOT NULL","item_type","","utf8");
          
            Memail_templates::addNewTemplate('TAC', 'Ticket', 'Ticket Auto Closing message', 'A', '[{{site_name}}]  Ticket has been auto closed # {{ticket_track_id}}', '<p>Dear {{ticket_user}},</p><p>{{ticket_closing_msg}}<br></p><p>If the issue is still exist then you can reopen the ticket anytime. </p><p>The ticket information are  given bellow:<br></p><p><b>Ticket Title: </b>{{ticket_title}}<br><b>Your ticket track id :</b> {{ticket_track_id}}<b><br>Your ticket link :</b> {{ticket_link}}</p><p><b><br></b></p><p><b><br></b>Thanks,<br>{{site_name}}<br></p>');
            Memail_templates::addNewTemplate('AAT', 'Admin', 'Admin Ticket Assign notification email', 'A', '[{{site_name}}] New ticket has been assigned to you # {{ticket_track_id}}', '<h5>Dear Admin,</h5><h5>New ticket has been received. Ticket information is given below:<br></h5><p>Ticket User  :  <b>{{ticket_user}}</b><br>Ticket track id  :<b>  {{ticket_track_id}}</b><b><br></b>Ticket title :<b>  </b><b>{{ticket_title}}<br></b>Ticket link  :<b>  {{ticket_link}}</b><b><br></b></p><p><b><br></b></p><p><span style=\"font-size: 14px;\">Thanks</span><b><br></b><span style=\"font-size: 14px;\">{{site_name}}</span><b><br></b></p><p><br></p>');
            Mapp_notificaiton::DBAddIndex("user_id_item",'user_id,item_type');
            
            self::$selfobj->create_table("chat","CREATE TABLE `chat` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `open_user_id` char(10) NOT NULL, `is_remote_typing` char(1) NOT NULL DEFAULT 'N' COMMENT 'bool(Y=Yes,N=No)', `is_user_typing` char(1) NOT NULL DEFAULT 'N' COMMENT 'bool(Y=Yes,N=No)', `end_by_type` char(1) NOT NULL DEFAULT '' COMMENT 'radio(A=Staff,C=Client)', `end_by` char(10) NOT NULL DEFAULT '', `current_admin_user` char(2) NOT NULL, `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', `bw_name` char(50) NOT NULL DEFAULT '' COMMENT 'Browser Idea', `country` char(50) NOT NULL DEFAULT '', `last_msg_time` timestamp NULL DEFAULT NULL, `last_msg_by` char(1) NOT NULL DEFAULT '' COMMENT 'radio(A=Admin,U=User)', `last_page_list` char(150) NOT NULL DEFAULT '', `ip` char(20) NOT NULL DEFAULT '', `header_msg` char(255) NOT NULL DEFAULT '', `status` char(1) NOT NULL DEFAULT 'N' COMMENT 'radio(N=Not Started, S=Started,E=End)', PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
            self::$selfobj->create_table("chat_denied","CREATE TABLE `chat_denied` ( `id` int(11) NOT NULL AUTO_INCREMENT, `chat_id` int(11) NOT NULL DEFAULT '0', `app_user_id` char(2) NOT NULL DEFAULT '', `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
            self::$selfobj->create_table("chat_msg","CREATE TABLE `chat_msg` ( `chat_id` int(10) unsigned NOT NULL, `msg_id` char(4) NOT NULL, `temp_id` char(32) NOT NULL, `reply_user_type` char(1) NOT NULL DEFAULT 'N' COMMENT 'radio(S=System,U=User,A=Admin,N=No User)', `reply_user_id` char(10) NOT NULL, `msg` text CHARACTER SET utf8 NOT NULL, `form_id` char(2) NOT NULL DEFAULT '', `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, UNIQUE KEY `chat_id_msg_id` (`chat_id`,`msg_id`) USING BTREE, KEY `chat_id` (`chat_id`) USING BTREE ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
            self::$selfobj->create_table("admin_note","CREATE TABLE `admin_note` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `ref_id` int(10) unsigned NOT NULL DEFAULT '0', `ref_type` char(1) NOT NULL DEFAULT 'T' COMMENT 'radio(T=On TIcket, U=On Client)', `user_id` char(2) NOT NULL DEFAULT '', `note` char(255) CHARACTER SET utf8 NOT NULL DEFAULT '', `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
            self::$selfobj->create_table("ticket_assign_rule","CREATE TABLE `ticket_assign_rule` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `cat_ids` char(255) NOT NULL DEFAULT '', `rule_type` char(1) NOT NULL DEFAULT 'A' COMMENT 'radio(A=Assign,N=Notifiy)', `rule_id` char(2) NOT NULL, `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'bool(A=Active,I=Inactive)', PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
            $obj=new Mticket_assign_rule();
            if($obj->CountALL()==0){
                $newo=new Mticket_assign_rule();
                $newo->cat_ids('*');
                $newo->rule_type('N');
                $newo->rule_id('AA');
                $newo->status('A');
                $newo->Save();
            }
            
        }
        if ($isForce || version_compare($lastCheck, "2.0.1", "<")) {
            Mcanned_msg::DBColumnAddOrModify("canned_msg", "text", "", "", "NULL", "title", "textarea", "utf8");
            Mcanned_msg::DBColumnAddOrModify("canned_type", "char", "1", "'T'", "NOT NULL", "", "drop(T=Ticket,C=Chat)");
        }
        if ($isForce || version_compare($lastCheck, "2.0.2", "<")) {
            Mpage_list::AddUpdatePage("A","admin","admin-chat","index","WebChat Panel","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","admin-chat","chat-response","Chat Response","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","admin-chat-confirm","user-chat-close","User Chat Close","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","admin-chat-confirm","user-answer","User Answer","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","chat-canned-msg","edit","Edit Chat Canned Message","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","chat-canned-msg","add","New Chat Canned Msg","17. Web Chat","A");
            Mpage_list::AddUpdatePage("S","admin","chat-canned-msg","index","Chat Canned Msg List","17. Web Chat","A");
            
            Mpage_list::AddUpdatePage("S","admin","admin-note","add","New Admin Note","Admin Note","A");
            Mpage_list::AddUpdatePage("S","admin","admin-note","get-notes","Get Notes","Admin Note","A");
            
            Mpage_list::AddUpdatePage("A","admin","admin-setting","webchat-settings","Chat Settings","02. Admin Setting","A");
            
            
            Mpage_list::AddUpdatePage("A","admin","client-confirm","reset-user-pass","Reset User Pass","14. Client","A");
            Mpage_list::AddUpdatePage("S","admin","dashboard","update-chat-status","Update Chat Status","Dashboard","A");
            Mpage_list::AddUpdatePage("S","admin","dashboard","update-notification-trey","Update Notification Trey","Dashboard","A");
            Mpage_list::AddUpdatePage("A","admin","knowledge-confirm","del-attach-file","Delete Attach File","11. Knowledge","A");
            Mpage_list::AddUpdatePage("S","admin","ticket","edit-reply","Edit Ticket Reply","10. Ticket","A");
            Mpage_list::AddUpdatePage("S","admin","ticket","load-ticket-reply","Load Ticket Reply","10. Ticket","A");
            Mpage_list::AddUpdatePage("S","admin","ticket","opened","Ticket Open By Admin","10. Ticket","A");
            Mpage_list::AddUpdatePage("A","admin","ticket","open","Admin Ticket Creation","10. Ticket","A");
            
            Mpage_list::AddUpdatePage("A","admin","ticket-assign-rule","index","Ticket Assign Rule List","17. Ticket Assign Rule","A");
            Mpage_list::AddUpdatePage("A","admin","ticket-assign-rule","edit","Edit Ticket Assign Rule","17. Ticket Assign Rule","A");
            Mpage_list::AddUpdatePage("A","admin","ticket-assign-rule","add","New Ticket Assign Rule","17. Ticket Assign Rule","A");
            Mpage_list::AddUpdatePage("A","admin","ticket-assign-rule-confirm","ticket-assign-rule-delete","17. Ticket Assign Rule","17. Ticket Assign Rule","A");
            Mpage_list::AddUpdatePage("A","admin","ticket-assign-rule-confirm","status-change","Status Change","17. Ticket Assign Rule","A");
        
            Mpage_list::AddUpdatePage("S","admin","system-update","rate-it","Rate It","System Update","A");
            Mpage_list::AddUpdatePage("S","admin","system-update","rate-status","Rate Status","System Update","A");
            Mpage_list::AddUpdatePage("S","admin","system-update","thank-you","Please Rate It !!","System Update","A");
            
            Mpage_list::AddUpdatePage("A","admin","remote-server","index","Remote Login List","03. API Setting","A");
            Mpage_list::AddUpdatePage("A","admin","remote-server","add","New Remote Login","03. API Setting","A");
            Mpage_list::AddUpdatePage("A","admin","remote-server","edit","Edit Remote Login","03. API Setting","A");
            Mpage_list::AddUpdatePage("A","admin","remote-server-confirm","remote-server-delete","Delete Remote Login","03. API Setting","A");
            Mpage_list::AddUpdatePage("A","admin","remote-server-confirm","status-change","Remote Login Status Change","03. API Setting","A");
        }
	    if ($isForce || version_compare($lastCheck, "2.0.7", "<")) {
		    Mapp_log::DBColumnAddOrModify( "ip", "char", "50", "", "NOT NULL", "", "", "" );
		    Miplist::DBColumnAddOrModify( "ip", "char", "50", "", "NOT NULL", "", "", "" );
		    Miplist::DBColumnAddOrModify( "h_at_count", "decimal", "3", "0", "NOT NULL", "", "", "" );
		    Mcustom_field::DBColumnAddOrModify( "is_on_grid", "char", "1", "'N'", "NOT NULL", "is_private", "bool(Y=Yes,N=No)", "" );
		    self::$selfobj->create_table("work_log","CREATE TABLE `work_log` (  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  `ticket_id` int(10) unsigned NOT NULL DEFAULT '0',  `user_id` char(2) NOT NULL DEFAULT '',  `note` char(255) CHARACTER SET utf8 NOT NULL DEFAULT '',  `w_time` decimal(4,0) unsigned NOT NULL DEFAULT '0',  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1");
		    //self::$selfobj->create_table("site_user_custom_field","CREATE TABLE `site_user_custom_field` (  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  `user_id` int(10) unsigned NOT NULL DEFAULT '0',  `custom_id` char(2) NOT NULL DEFAULT '',  `fld_title` char(100) CHARACTER SET utf8 NOT NULL,  `fld_type` char(1) NOT NULL DEFAULT 'T' COMMENT 'radio(T=Textbox,N=Numeric,D=Dropdown,A=Date,R=Radio)',  `fld_value` char(100) CHARACTER SET utf8 NOT NULL,  `fld_value_text` char(100) CHARACTER SET utf8 NOT NULL,  `is_api_based` char(1) NOT NULL DEFAULT 'N' COMMENT 'bool(Y=Yes,N=No)',  `api_name` char(50) NOT NULL,  `api_data` text CHARACTER SET utf8 NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1");
		
		    Mpage_list::AddUpdatePage("S","admin","work-log","add","New Work Log","10. Ticket","A");
		    Mpage_list::AddUpdatePage("S","admin","work-log","get-notes","Get Notes","10. Ticket","A");
	    }
	    if ($isForce || version_compare($lastCheck, "2.0.8", "<")) {
		    Mmenu::DBColumnAddOrModify( "href_type", "char", "1", "'L'", "NOT NULL", "title", "radio(L=Link, P=Page)");
		    Mpage_list::AddUpdatePage("S","admin","work-log","add","New Work Log","10. Ticket","A");
		    Mpage_list::AddUpdatePage("S","admin","work-log","get-notes","Get Notes","10. Ticket","A");
		    Mpage_list::AddUpdatePage("A", "admin","page","index","Page List","02. Admin Setting","A");
		    Mpage_list::AddUpdatePage("A", "admin","page","add","New Page","02. Admin Setting","A");
		    Mpage_list::AddUpdatePage("A", "admin","page","edit","Edit Page","02. Admin Setting","A");
		    self::$selfobj->create_table("custom_page","CREATE TABLE `custom_page`  ( `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, `slag_title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '', `page_body` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'textarea', `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'A' COMMENT 'bool(A=Active, I=Inactive)', PRIMARY KEY (`id`) USING BTREE ) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'page'");
		    self::$selfobj->create_table("site_user_custom_field","CREATE TABLE `site_user_custom_field`  ( `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0, `custom_id` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '', `fld_title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `fld_type` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'T' COMMENT 'radio(T=Textbox,N=Numeric,D=Dropdown,A=Date,R=Radio)', `fld_value` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `fld_value_text` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `is_api_based` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N' COMMENT 'bool(Y=Yes,N=No)', `api_name` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, `api_data` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`id`) USING BTREE ) ENGINE = MyISAM");
		
	    }
	
	    if ($isForce || version_compare($lastCheck, "2.1.7", "<")) {
		    Mcustom_field::DBColumnAddOrModify( "cat_id", "char", "100", "'0'", "NOT NULL", "id", "FK(category,id,title)", "" );
	    }
	    
	    if ($isForce || version_compare($lastCheck, "2.1.8", "<")) {
		    generate_favicon();
	    }
	    if ($isForce || version_compare($lastCheck, "2.1.9", "<")) {
		    Mcustom_field::DBColumnAddOrModify("cat_id","char","255","'0'","NOT NULL","id","","");
		    Mcustom_field::DBColumnAddOrModify("fld_order","int","3","'0'","unsigned NOT NULL","status","","");
		    Madmin_message::DBColumnAddOrModify("to_user","char","255","''","NOT NULL","body","FK(app_user,id,title)","");
	    }
	    if ($isForce || version_compare($lastCheck, "3.0", "<")) {
		    self::$selfobj->create_table("faq_category", "CREATE TABLE `faq_category` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '', `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'bool(A=Active,I=Inactive)', PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1");
		    self::$selfobj->create_table("faq_list", "CREATE TABLE `faq_list` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `cat_id` int(10) unsigned NOT NULL COMMENT 'FK(faq_category,id,name)', `question` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '', `ans` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '', `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `ord` int(10) unsigned NOT NULL DEFAULT 0, `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'bool(A=Active,I=Inactive)', PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1");
		    self::$selfobj->create_table("testimonial", "CREATE TABLE `testimonial` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) CHARACTER SET utf8 NOT NULL, `designation` varchar(255) CHARACTER SET utf8 NOT NULL, `testimonial` text CHARACTER SET utf8 NOT NULL, `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'bool(A=Active,B=Inactive)', PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1");
			
		    Mpage_list::AddUpdatePage("A","admin","faq-lis","index","FAQ List","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-lis","add","FAQ Add","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-lis","edit","FAQ edit","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-category","index","FAQ Category List","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-category","add","FAQ Category Add","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-category","edit","FAQ Category Edit","18. FAQ","A");
		    Mpage_list::AddUpdatePage("A","admin","faq-category-confirm","status-change","FAQ Category Status Change","18. FAQ","A");
		    
		    Mpage_list::AddUpdatePage("A","admin","testimonial","index","Testimonial List","19. Testimonial","A");
		    Mpage_list::AddUpdatePage("A","admin","testimonial","add","Testimonial Add","19. Testimonial","A");
		    Mpage_list::AddUpdatePage("A","admin","testimonial","edit","Testimonial Edit","19. Testimonial","A");
		    Mpage_list::AddUpdatePage("A","admin","testimonial-confirm","status-change","Testimonial Status Change","19. Testimonial","A");
		    PutHtaccessProperly();
	    }
	    if ($isForce || version_compare($lastCheck, "3.0.6", "<")) {
		    Mchat::DBColumnAddOrModify( 'header_msg', "char", "255", "''", "NOT NULL", "ip", "", "utf8 COLLATE utf8_general_ci" );
	    }
        if ($isForce || version_compare($lastCheck, "3.1.0", "<")) {
            Mpage_list::AddUpdatePage("S","admin","addons","admin-page","Admin Addons page","19. Admin Addons page","A");
            Mpage_list::AddUpdatePage("S","admin","api-setting-confirm","update-payment-basic","Update Payment Basic","3. payment Settings","A");
            Mpage_list::AddUpdatePage("A","admin","api-setting","payment-basic","Basic Settings","03. Payment Setting","A");
            Mpage_list::AddUpdatePage("S","admin","ticket","change-priority","Change Priority","10. Ticket","A");
        }

        Mapp_setting::UpdateSettingsOrAdd("_uprcs", $current_version, "UProcs", true, "T");
	    
	    ScssCompiler::ProcessClientColor();
	    LessProcess::ProcessClientColor();
	    LessProcess::ProcessChatColor();
        if($isForce){
        	if($showForceMsg) {
		        echo "END DB Migration<br/>";
		        die;
	        }
        }
    }
    function create_table($table_name,$query)
    {
	    if(strpos($this->GetSelectDB()->database,'.')!==false){
		    $tables=[];
		    $tables_obj=$this->SelectQuery("SHOW TABLES FROM `{$this->GetSelectDB()->database}`",true);
		    foreach ($tables_obj as $t){
		    	foreach ($t as $v){
				    $tables[]=$v;
				    break;
			    }
		    }
	    }else {
		    $tables = $this->GetSelectDB()->list_tables();
	    }
        $table_name = trim($table_name);
        if (!in_array($table_name, $tables)) {
            $result = $this->GetSelectDB()->query($query);
	        
            if (!$result) {
                Mdebug_log::AddGeneralLog("Database table creation failed",Mdebug_log::STATUS_FAILED,Mdebug_log::STATUS_SUCCESS,$query);
            }
        }
    }
}