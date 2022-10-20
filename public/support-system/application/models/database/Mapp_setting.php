<?php 			
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:s_key,s_title,s_val,s_type,s_option,s_auto_load		
 */						
class Mapp_setting extends APP_Model{	
	public $s_key;
	public $s_title;
	public $s_val;
	public $s_type;
	public $s_option;
	public $s_auto_load;
	public static $isShowError=true;
    private static $loaded_settings=NULL;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="app_setting";
			$this->primaryKey="s_key";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->s_key=$this->s_title=$this->s_val=$this->s_type=$this->s_option=null;
		$this->s_auto_load=null;

	}



	function SetValidation(){
		$this->validations=array(
			"s_key"=>array("Text"=>"S Key", "Rule"=>"required|max_length[30]"),
			"s_title"=>array("Text"=>"S Title", "Rule"=>"max_length[100]"),
			"s_val"=>array("Text"=>"S Val", "Rule"=>"max_length[255]"),
			"s_type"=>array("Text"=>"S Type", "Rule"=>"max_length[1]"),
			"s_option"=>array("Text"=>"S Option", "Rule"=>"max_length[255]"),
			"s_auto_load"=>array("Text"=>"S Auto Load", "Rule"=>"max_length[1]")
			
		);
	}
    
	 
	/*//auto generated
    function Save(){
	    if(!$this->IsSetPrperty("s_key")){
	        $s_key=$this->GetNewIncId("s_key","AAAAAAAAAA");
	        $this->s_key($s_key);
	    }
	    return parent::Save();
	}	*/          
	

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

	/* add custom function here*/
	/**
	 * @return multitype:
	 */
	function get_decoded_options(){
	    if(!empty($this->s_option)){
	        return json_decode(base64_decode($this->s_option),true);	       
	    }	    
	    return array();	    
	}
	static function decoded_options($str){
	    if(!empty($str)){
	        return json_decode(base64_decode($str),true);
	    }
	    return array();
	}
	static function GetTimeZoneSession($tzone=''){
		$obj=new self();
		$timezone= $obj->session->GetSession("tzone");
		if(empty($timezone)){
			$timezone=self::SetTimeZoneSession();
		}
		return $timezone;
	}
	static function get_cookie_prefix(){
	    $app_name=get_app_title()."appsbd-product";
	    $cookie_name=get8BitHashCode($app_name);
	    return $cookie_name;
	}
	static function get_online_cookie_name(){
	    
	    return self::get_cookie_prefix()."_lg";
	}
	static function SetOnlineStatus($isSet=true){
	    $cookie_name=self::get_online_cookie_name();
	    if($isSet){
	       setcookie ( $cookie_name, "Y" ,null,"/");
	    }else{
	        $ci=get_instance();
	        $ci->load->helper("cookie");
	        delete_cookie($cookie_name,'','/');
	    }
	}
	static function SetTimeZoneSession($tzone=''){
		$isNeedToSetCookie=true;		
		$cookie_name=self::get_cookie_prefix()."_tz";
		if (empty ( $tzone )) {
			if (! empty ( $_COOKIE [$cookie_name] )) {
				$isNeedToSetCookie = false;
				$tzone=$_COOKIE [$cookie_name];
			}else{
                $ipdata=APPIPdata::get();
				$tzone=!empty($ipdata->time_zone)?$ipdata->time_zone:"";
			}
		}
		$obj=new self();
		$obj->session->SetSession("tzone", $tzone);
		if ($isNeedToSetCookie) {
			$expire = time () + 60 * 60 * 24 * 30;
			setcookie ( $cookie_name, $tzone, $expire,"/" );
		}
		return $tzone;
	}
	
	/**
	 * @param string $key
	 * @param string $title
	 * @param string $value
	 * @param string $autoLoad
	 * @param string $type
	 * @param array $options
	 */
	static function AddSettings($key,$value,$title,$autoLoad=false,$type="T",$options=NULL){
	    //T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio
	    if(isset(self::$loaded_settings[$key])){
	       if(self::$isShowError)AddError("Key is already exists");
	       return false;
	    }
	    $obj=new self();
	    if($title){
	        $obj->s_title($title);
	    }
	    $obj->s_val($value);
	    if($autoLoad){
	         $obj->s_auto_load("Y");
	    } 
	    $obj->s_type($type);
	    $option_json_base="";
	    if(is_array($options)){
	        $option_json_base=base64_encode(json_encode($options));
	        $obj->s_option($option_json_base);
	    }
	    $obj->s_key($key);
	    if(!$obj->IsExists("s_key", $key)){
    	    if($obj->IsValidForm()){
    	      $isSaved=$obj->Save();
    	      if($isSaved){
    	          self::$loaded_settings[$key]=$obj;
    	          return true;
    	      }
    	    }
	    }
	    if(self::$isShowError)AddError("Key is already exists");
	    return false;
	     
	}
	static function LoadSettingFormArray($loadsettings=[]){
		if(self::$loaded_settings==NULL){
			self::LoadSettings();
		}
	    foreach ($loadsettings as $key=>$settings){
	        $nobj=new self();
	        $nobj->s_key=$key;
	        $nobj->s_val=$settings;
	        $nobj->s_auto_load='Y';
	        self::$loaded_settings[$key]=$nobj;
        }
    }
	static function UpdateSettingsOrAdd($key,$value,$title=NULL,$autoLoad=NULL,$type=NULL,$options=NULL){
	    $isUpdate=self::UpdateSettings($key, $value,$title,$autoLoad,$type,$options);
	    if(!$isUpdate){
	        $obj=new self();
	        if(!$obj->IsExists("s_key", $key)){
	           return self::AddSettings($key, $value,$title,$autoLoad,$type,$options);
	        }
	    }
	    return $isUpdate;
	}  
	/**
	 * @param string $key
	 * @param string $title
	 * @param string $value
	 * @param Bool $autoLoad
	 * @param string $type
	 * @param array $options
	 */
	static function UpdateSettings($key,$value,$title=NULL,$autoLoad=NULL,$type=NULL,$options=NULL){
	    //T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio
	    $obj=new self();
	    if($title){
	       $obj->s_title($title);
	    }
	    $obj->s_val($value);
	    if($autoLoad!=NULL){
	        if($autoLoad){
	           $obj->s_auto_load('Y');
	        }else{
	            $obj->s_auto_load('N');
	        }
	    }
	    if($title){
	        $obj->s_type($type);
	    }
	    $option_json_base="";
	    if(is_array($options)){
	        $option_json_base=base64_encode(json_encode($options));
	        $obj->s_option($option_json_base);
	    }
	    $obj->SetWhereCondition("s_key", $key);
	    if( $obj->IsSetDataForSaveUpdate()){	
	        $isValueset=$obj->IsSetPrperty('s_val');       
	       $result=$obj->Update();
	       if($result && $isValueset){
		       	if(isset(self::$loaded_settings[$key]) && is_object(self::$loaded_settings[$key])){
		           self::$loaded_settings[$key]->s_val=$obj->s_val;
		       	}	           
	       }
	       return $result;
	    }
	    return false;
	    
	} 
	static function IncreseGivenCommission($com_amount){
		$settings=new self();
		$settings->s_val("s_val + {$com_amount}",true);		
		$settings->SetWhereCondition("s_key", '_total_com_given');
		return $settings->Update();
	}
	static function SetInitialSettings(){
		self::$isShowError=false;
	   // $ci=get_instance();
	    //self::AddSettings("_g_appname", $ci->config->item('app_name'), "Google App Name",true);
	    self::AddSettings("app_email","","App Email",true,"T");
		self::AddSettings("app_title", "Support System", "App Title",true);
		self::AddSettings("app_theme", "client2", "APP Theme",true);
		self::AddSettings("app_hmp", "1", "APP Homepage",true);
		self::AddSettings("isonly_logo","N","Show Only Logo",true,"B");
		//self::AddSettings("welcome_msg", "Welcome to our support system", "Welcome Msg",true);
		//self::AddSettings("footer_text", "", "Footer Text",true);
		Mapp_setting_api::AddSettingsInitial("system", "welcome_msg", "Welcome to our support system", "Welcome Msg",true);
		Mapp_setting_api::AddSettingsInitial("system", "footer_text", "", "Footer Text",true);
	    self::AddSettings("app_date_format", "M d, Y", "Date Format",true);
	    self::AddSettings("app_time_format", "H:i", "Time Format",true);
	    self::AddSettings("regi_enable", "N", "Registration",true);	
	    self::AddSettings("dlogin_enable", "N", "Default Login",true); 
	    self::AddSettings("dgustpopup", "N", "Disable Guest Popup",true); 
	    self::AddSettings("is_alpguest_ticket", "N", "Show All Priroty",true);
	    self::AddSettings("app_captcha", "D", "Captcha Settings",true,"R",array("D"=>"Default","G"=>"Google Re-captcha"));
	    self::AddSettings("ap_dc_length", "6", "Captcha length",true);
	    self::AddSettings("ap_dc_str_type", "AN", "Captcha String Type",true);
	    self::AddSettings("app_gc_secret", "", "Re-Captcha Secret Key",true);
	    self::AddSettings("app_gc_site_key", "", "Re-Captcha Site Key",true); 
	    self::AddSettings("app_main_color", "#0B8EC2", "Main Color",true);  
	    self::AddSettings("app_text_color", "", "Link and Heading Color",true);
	    self::AddSettings("app_welcome_bg", "", "Welcome Background",true);
	    self::AddSettings("app_welcome_text", "#ffffff", "Welcome Text",true);
	    self::AddSettings("app_header_bg", "#FFFFFF", "Header background Color",true);
	    self::AddSettings("app_c_auto", "#0B8EC2", "Auto Others Color",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("app_navbar_bg", "", "Menu Background",true);
	    self::AddSettings("app_nav_acive_text", "", "Menu Active Text color",true);
	    self::AddSettings("footer_bg_color", "", "Footer Background",true);
	    self::AddSettings("footer_text_color", "", "Footer Text Color",true);
	    self::AddSettings("app_header_isg", "N", "Header Gradient",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("is_cptcha_client_login", "N", "Client Captcha Login",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("is_cptcha_guest_ticket", "Y", "On Guest Ticket",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("is_cptcha_client_regi", "Y", "Client Registration Captcha",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("is_cptcha_admin_login", "N", "Admin Login Captcha",true,"B",array("Y"=>"Yes","N"=>"No"));
	    self::AddSettings("max_file_upload_size", "2", "Max Upload File Size",true,"N");
	    self::AddSettings("allowed_file_type", "jpg|png|zip", "Allowed file type",true);
	    self::AddSettings("allow_profile_upload", "N", "Profile Upload",true,"B");
	    self::AddSettings("allow_ticket_file_upload", "N", "Allow Ticket File Upload",true,"B");
	   
	    self::AddSettings("is_guest_ticket", "Y", "Enable Guest Ticket",true,"B");
	    self::AddSettings("is_public_ticket", "N", "Enable Guest Ticket",true,"B");
	    self::AddSettings("ticket_htmleditor", "Y", "Ticket HTML Editor",true,"B");
	    self::AddSettings("app_html_editor", "S", "Choose HTML Editor",true,"R",array("S"=>"Summernote","C"=>"CK Editor")); 
	    self::AddSettings("app_layout", "F", "Application Layout",true,"R",array("F"=>"Full Width","B"=>"Box Size")); 
	    self::AddSettings("is_check_online", "Y", "User Online Status Check",true,"B");
	    self::AddSettings("ticket_email_str", "##Ticket ID:", "Ticket Email String",true,"T");
	    self::AddSettings("ticket_email_rp_str", "##- Please type your reply above this line -##", "Ticket Email Reply Line",true,"T");
	    self::AddSettings("any_can_assign","Y","Is any staff can reply",true,"B");
	    self::AddSettings("is_imap_ticket", "Y", "Email to Ticket",true,"B");
	    self::AddSettings("imap_host", "", "IMAP Host",true,"T");
	    self::AddSettings("imap_port", "", "IMAP Host",true,"T");
	    self::AddSettings("imap_is_secure","", "IMAP Secure Protocol",true,"B");
	    self::AddSettings("imap_secure_type","ssl", "IMAP Protocol Type",true,"T");
	    self::AddSettings("imap_user","","IMAP User",true,"T");
	    self::AddSettings("imap_pass","","IMAP Password",true,"T");	
	    
	    self::AddSettings("out_email_name", "", "From Name",true,"T");
	    self::AddSettings("out_email_from", "", "From Email",true,"T");
	    self::AddSettings("out_reply_to_email", "", "Reply To Email",true,"T");
	    self::AddSettings("out_email_protocol", "sendmail", "Email Protocol",true,"R",["sendmail"=>"Sendmail","smtp"=>"SMTP"]);
	    self::AddSettings("mailpath",'/usr/sbin/sendmail', "Sendmail Path",true,"T");
	    self::AddSettings("smtp_host", "", "SMTP Host",true,"T");
	    self::AddSettings("smtp_port", "", "SMTP Host",true,"T");
	    self::AddSettings("smtp_is_secure","", "SMTP Secure Protocol",true,"B");
	    self::AddSettings("smtp_user","","SMTP User",true,"T");
	    self::AddSettings("smtp_pass","","SMTP Password",true,"T");
        self::AddSettings("is_state_kn","N","Disable Knowledge Stat In Homepage",true,"B");
	  
	    //site security
	    self::AddSettings("app_dos_atk","Y","Enable DoS Attack",true,"B");
	    self::AddSettings("app_dos_req","5","DoS Attack Request Count",true,"T");
	    self::AddSettings("app_dos_sec","5","DoS Attack Request Seconds",true,"T");
	    self::AddSettings("app_dos_action","C","DoS Attack Action",true,"T");
	    
	    //app user settings
	    self::AddSettings("app_user_scq","Y","Enable Admin User Security",true,"B");
	    self::AddSettings("appuser_sec_tried","5","Loing Miss Attempts",true,"N");
	    self::AddSettings("appuser_sec_min","30","Miss Attempts Interval",true,"N");
	    
	    self::AddSettings("fb_enable","Y","Feedback Enable",true,"B");
	    self::AddSettings("fb_e_msg","How do you rate the support you received?","Feedback message email title",true,"T");
	    self::AddSettings("fb_n_msg","Y","Nagative Feedback Message",true,"B");
	    self::AddSettings("fb_p_msg","Y","Positive Feedback Message",true,"B");
	    self::AddSettings("is_app_forcessl","N","Enable Force SSL",true,"B"); 
	    self::AddSettings("app_lang","","App Language",true,"Y"); 
	    self::AddSettings("app_clang","","App Site Language",true,"Y");
	    //notificaiton
	    self::AddSettings("app_noti_email","","Notification Email",true,"T");
	    self::AddSettings("is_netkt_open","N","On Ticket Open",true,"B");
	    self::AddSettings("is_netktu_reply","N","On ticket User Notification",true,"B");
	    self::AddSettings("is_netkta_reply","N","On Admin User Reply Notification",true,"B");

        self::AddSettings("is_aetkt_open","Y","Email On ticket User Assign ",true,"B");
        self::AddSettings("is_astkt_open","Y","icket User Assign Notification",true,"B");



        self::AddSettings("is_nstkt_open","N","On Ticket Open",true,"B");
	    self::AddSettings("is_nstktu_reply","N","On ticket User Notification",true,"B");
	    self::AddSettings("is_nstkta_reply","N","On Admin User Reply Notification",true,"B");
	    self::AddSettings("is_nstone","Y","Is Admin Notification Tone",true,"B");
	    

        self::AddSettings("enable_aclose","N","Enable Ticket Auto close",true,"B");
        self::AddSettings("aclosing_rule","N","Auto closing rule",true,"N");
        self::AddSettings("aclosing_msg","As the ticket has been inactive for a long time, we are considering the issue to be resolved. Our support system is closing this ticket automatically.","Auto closing message",true,"T");
		
        //Country Block Settings
        self::AddSettings("app_ctry_block","N","Is Country block Status",true,"B");
		self::AddSettings("app_ctry_brule","B","Country Block Rule",true,"T");
		self::AddSettings("app_ctry_list","","Country List",true,"T");
		
		self::AddSettings("is_kn_like_dlike","N","knowledge Like Dislike",true,"T");
		self::AddSettings("is_kn_l_upd","N","last update show",true,"T");
		self::AddSettings("is_kn_iconc","N","Counter Icon",true,"T");
		self::AddSettings("smtp_secure_type","ssl","Counter Icon",true,"R",['ssl'=>"SSL","tls"=>"TLS"]);
		
		//for RTL
		self::AddSettings("is_rtl_client","N","RTL Client",true,"B");
		self::AddSettings("is_rtl_admin","N","RTL Admin",true,"B");
		
		self::AddSettings("app_spam_emails","","SPAM Email",true,"T");
		self::AddSettings("is_del_spam_email","N","DeleteSPAMEmail",true,"B");
		self::AddSettings("is_dis_googlefont","N","Disable Google Font",true,"B");
		self::AddSettings("is_hide_knowledge","N","Hide Knowledge Menu",true,"B");
		self::AddSettings("is_priority_hide","N","Priority Hide",true,"B");
		self::AddSettings("is_priority_ad_hide","N","Admin Priority Hide",true,"B");
		self::AddSettings("is_user_can_reopen","Y","Is User Can ReOpen",true,"B");
		self::AddSettings("per_user_max_ticket","0","Per max user ticket ",true,"T");
		self::AddSettings("reopen_time","0","reopen time ",true,"T");
		$value=self::GetSettingsValue('isonly_logo')=="Y"?"N":"Y";
		self::AddSettings("is_show_app_ttl",$value,"Show Title",true,"B");
		self::AddSettings("is_powered_by","Y","Enable Powered By",true,"B");
		
		
	}
	static function GetAgentMinimumWithdrawalAmount(){
		return self::GetSettingsValue('agminclmt');
	}
	static function GetSettingsValue($key,$default=null){
            // T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio
		if(self::$loaded_settings==NULL){
			self::LoadSettings();
		}
		if (isset(self::$loaded_settings[$key])) {
			//GPrint(self::$loaded_settings[$key])
            return self::$loaded_settings[$key]->s_val;
        } else {
            $obj = new self();
            $obj->s_key($key);
            if ($obj->Select()) {
               if($obj->s_auto_load=="Y"){
                	self::$loaded_settings[$key] = $obj;
            	}
                return $obj->s_val;
            }           
        }
        
        return $default;
	}
	static function LoadSettings($isAll=false){
	    $obj=new self();
	    if(!$isAll){
	       $obj->s_auto_load('Y');
	    }
	    
	    self::$loaded_settings=$obj->SelectAllWithIdentity("s_key");
	    if(count(self::$loaded_settings)==0){
	        self::SetInitialSettings();
	    }
	}
	static function DeleteSettingsValue($key){
	    $thisobj=new static();	    
	    $thisobj->GetUpdateDB()->where("s_key", $key);
	    $thisobj->GetUpdateDB()->limit(1);
	    if ($thisobj->GetUpdateDB ()->delete($thisobj->tableName)) {
	        if($thisobj->GetUpdateDB()->affected_rows()>0){
	            return true;
	        }
	    }
	    return false;
	}
	/* end custom function */
	   
 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("s_key",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_key"><?php _e("Key"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="10"
			value="<?php echo  $mainobj->GetPostValue("s_key");?>"
			class="form-control" id="s_key"
			<?php echo in_array("s_key", $disabled)?' disabled="disabled" ':' name="s_key" ';?>
			placeholder="<?php _e("Key"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Key"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("s_title",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_title"><?php _e("Title"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="100"
			value="<?php echo  $mainobj->GetPostValue("s_title");?>"
			class="form-control" id="s_title"
			<?php echo in_array("s_title", $disabled)?' disabled="disabled" ':' name="s_title" ';?>
			placeholder="<?php _e("S Title"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("s_val",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_val"><?php _e("Value"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="255"
			value="<?php echo  $mainobj->GetPostValue("s_val");?>"
			class="form-control" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
			placeholder="<?php _e("Value"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Value"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("s_type",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_type"><?php _e("Type"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<select class="form-control" id="s_type"
			<?php echo in_array("s_type", $disabled)?' disabled="disabled" ':' name="s_type" ';?>
			data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Type"));?>">
			        <?php $s_type_selected= $mainobj->GetPostValue("s_type");
			            GetHTMLOptionByArray(array(""=>"Select","T"=>"Textbox", "A"=>"Textarea", "B"=>"Boolean", "D"=>"Dropdown", "R"=>"Radio", "Z"=>"Timezone"),$s_type_selected);
			            ?>
			        
			        </select>
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("s_option",$except)){ ?>
<div id="option-group" class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_option"><?php _e("Option"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="255"
			value="<?php echo  $mainobj->GetPostValue("s_option");?>"
			class="form-control" id="s_option"
			<?php echo in_array("s_option", $disabled)?' disabled="disabled" ':' name="s_option" ';?>
			placeholder="<?php _e("Option"); ?>"> <small class="help-block">ex:
			Value1=Title1,Value2=Title2</small>
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("s_auto_load",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_auto_load"><?php _e("Auto Load"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="hidden" name="s_auto_load" value="N" /> <input
			type="checkbox"
			<?php echo $mainobj->GetPostValue("s_auto_load","Y") == "Y" ? "checked" : ""?>
			value="Y" class="form-control app-switch-btn" id="s_auto_load"
			<?php echo in_array("s_auto_load", $disabled)?' disabled="disabled" ':' name="s_auto_load" ';?>>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
			  $(function(){
				  ShowHideOption();
				  $("#s_type").change(function(e){ShowHideOption();});
			  });
			  function ShowHideOption(){
				  var type=$("#s_type").val();
				  if(type=="D" || type=="R"){
					  $("#option-group").show();
					  $("#s_option").focus();
				  }else{
					  $("#option-group").hide();
					  $("#s_type").focus();
				  }
			  }
			</script>
<?php 
	}
	static function getInputField(Mapp_setting $obj){
	    //T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio,Z=Timezone
	    if($obj->s_type=="T"){
	        ?>
<input type="text" maxlength="255"
	value="<?php echo  $obj->GetPostValue("s_val");?>" class="form-control"
	id="s_val"
	<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
	placeholder="<?php _e("S Val"); ?>" data-bv-notempty="true"
	data-bv-notempty-message="<?php  _e("%s is required",__("S Val"));?>">
<?php 
	      
	    }elseif($obj->s_type=="T"){
	        
	    }elseif($obj->s_type=="T"){
	        
	    }elseif($obj->s_type=="T"){
	        
	    }elseif($obj->s_type=="T"){
	        
	    }elseif($obj->s_type=="T"){
	        
	    }	    
	}
	function GetAddForm2($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){

	    if(!$mainobj){
	        $mainobj=$this;
	    }
	    $s_val_selected= $mainobj->GetPostValue("s_val");
	    ?>			
    	<?php if(!in_array("s_val",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="s_val"><?php _e($mainobj->s_title); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
          	 <?php if($mainobj->s_type=="T"){?>                   			     	
          		<input type="text" maxlength="255"
			value="<?php echo  $mainobj->GetPostValue("s_val");?>"
			class="form-control" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
			placeholder="<?php echo $mainobj->s_title;?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e($mainobj->s_title." is required");?>">
          	<?php 
	        }elseif($mainobj->s_type=="A"){?>
	            <textarea maxlength="255" class="form-control" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
			placeholder="<?php _e("S Val"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("S Val"));?>"><?php echo  $mainobj->GetPostValue("s_val");?></textarea>
	           <?php 
          	}elseif($mainobj->s_type=="B"){
          	    ?>
          	    <input type="hidden" name="s_val" value="N" /> <input
			type="checkbox"
			<?php echo $mainobj->GetPostValue("s_val","Y") == "Y" ? "checked" : ""?>
			value="Y" class="form-control app-switch-btn" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>>		      
          	    <?php 
          	}elseif($mainobj->s_type=="D"){
          	    ?>
          	    <select class="form-control select2" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
			data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e($mainobj->s_title." is required");?>">
			        <?php 			         
			           $optlist = $mainobj->get_decoded_options();
			           GetHTMLOptionByArray($optlist,$s_val_selected);
			             
			            ?>
			        
			        </select>
          	    <?php 
          	    
          	}elseif($mainobj->s_type=="R"){
          	    $optlist = $mainobj->get_decoded_options();
          	    ?>
          	     <div class="bordered">
          	    <?php 
          	    foreach ($optlist as $op_key=>$op_value){
          	    ?>
              	<label for="s_val_<?php echo $op_key;?>"> <input class="" id="s_val_<?php echo $op_key;?>" name="s_val" type="radio" value="<?php echo $op_key;?>"
    			<?php echo $s_val_selected==$op_key?' checked ="checked" ':' name="s_val" ';?>
    			data-bv-notempty="true"    			
    			data-bv-notempty-message="<?php  _e($mainobj->s_title." is required");?>"><?php echo $op_value;?></label>
          	    <?php 
          	    }
          	    ?>
          	    </div>
          	    <?php 
          	}elseif($mainobj->s_type=="Z"){
          	    ?>
          	    <select class="form-control select2" id="s_val"
			<?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>
			data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e($mainobj->s_title." is required");?>">
			        <?php 			         
			           $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
			             foreach ($tzlist as $tzone){
			                 GetHTMLOption($tzone,$tzone,$s_val_selected);
			             }
			            ?>
			        
			        </select>
          	    <?php 
          	}?>
          	</div>
</div>
<?php } 
	}


}
?>