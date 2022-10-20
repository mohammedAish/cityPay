<?php 
/**
 * Version 1.0.0
 * Creation date: 11/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,first_name,last_name,username,email,pass,is_verified_email,gender,phone,address,region,city,zip,country,dob,profile_url,photo_url,age,login_type,join_date,tzone,last_login_time,status		
 */						
class Msite_user extends APP_Model{	
	public $id;
	public $first_name;
	public $last_name;
	public $username;
	public $email;
	public $pass;
	public $is_verified_email;
	public $gender;
	public $phone;
	public $address;
	public $region;
	public $city;
	public $zip;
	public $country;
	public $dob;
	public $profile_url;
	public $photo_url;
	public $age;
	public $login_type;
	public $join_date;
	public $tzone;
	public $last_login_time;
	public $status;
	public $user_type;
	public $user_social_session_data;
	

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="site_user";
			$this->primaryKey="id";
			$this->uniqueKey=array(array("email"));	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"first_name"=>array("Text"=>"First Name", "Rule"=>"required|max_length[100]"),
			"last_name"=>array("Text"=>"Last Name", "Rule"=>"max_length[100]"),
			"username"=>array("Text"=>"Username", "Rule"=>"max_length[50]"),
			"email"=>array("Text"=>"Email", "Rule"=>"required|max_length[100]"),
			"pass"=>array("Text"=>"Pass", "Rule"=>"max_length[32]"),
			"is_verified_email"=>array("Text"=>"Is Verified Email", "Rule"=>"max_length[1]"),
			"gender"=>array("Text"=>"Gender", "Rule"=>"max_length[6]"),
			"phone"=>array("Text"=>"Phone", "Rule"=>"max_length[20]"),
			"address"=>array("Text"=>"Address", "Rule"=>"max_length[255]"),
			"region"=>array("Text"=>"Region", "Rule"=>"max_length[100]"),
			"city"=>array("Text"=>"City", "Rule"=>"max_length[100]"),
			"zip"=>array("Text"=>"Zip", "Rule"=>"max_length[20]"),
			"country"=>array("Text"=>"Country", "Rule"=>"max_length[2]"),
			"dob"=>array("Text"=>"Dob", "Rule"=>"max_length[20]"),
			"profile_url"=>array("Text"=>"Profile Url", "Rule"=>"max_length[150]"),
			"photo_url"=>array("Text"=>"Photo Url", "Rule"=>"max_length[150]"),
			"age"=>array("Text"=>"Age", "Rule"=>"max_length[2]|numeric"),
			"login_type"=>array("Text"=>"Login Type", "Rule"=>"max_length[1]"),
			"join_date"=>array("Text"=>"Join Date", "Rule"=>"max_length[20]"),
			"tzone"=>array("Text"=>"Tzone", "Rule"=>"max_length[50]"),
			"last_login_time"=>array("Text"=>"Last Login Time", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]"),
			"user_type"=>array("Text"=>"User Type", "Rule"=>"max_length[1]"),
			"user_social_session_data"=>array("Text"=>"User Social Session Data", "Rule"=>"")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
            case "tzone":
                $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                foreach ($tzlist as $tzone) {
                    $returnObj[$tzone] = $tzone;
                }
                break;
            case "login_type":
                $returnObj = array("N" => "Normal", "F" => "Facebook", "T" => "Twitter", "G" => "Google", "L" => "Linked In","E"=>"Envato");
                break;
            case "status":
                $returnObj = array("A" => "Active", "I" => "Inactive", "L" => "Locked");
                break;
            case "user_type":
                $returnObj = array("G" => "Guest", "U" => "User");
                break;
            case "is_verified_email":
                $returnObj = array("Y" => "Yes", "N" => "No");
                break;
            default:
        }
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;
		
	}

	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      case "login_type":
	         $returnObj=array("N"=>"success","F"=>"danger","T"=>"success","G"=>"success","L"=>"success");
	         break;
	      case "status":
	         $returnObj=array("A"=>"success","I"=>"danger","L"=>"success");
	         break;
          case "user_type":
         	 $returnObj=array("G"=>"info","U"=>"success");
         	 break;
	      default:
	    }       
        return $returnObj;
		}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "login_type":
	         $returnObj=array("N"=>"","F"=>"fa fa-times-circle-o","T"=>"","G"=>"","L"=>"");
	         break;
	      case "status":
	         $returnObj=array("A"=>"fa fa-check-circle-o","I"=>"fa fa-times-circle-o","L"=>"");
	         break;
	      case "user_type":
	         $returnObj=array("G"=>"fa fa-user-times","U"=>"fa fa-user-circle-o");
	         break;
	      default:
	    }
        return $returnObj;
	
	} 	
	//auto generated
    function Save(){    	
    	$ip_data=APPIPdata::get();
    	if(!$this->IsSetPrperty("city")){
    		$this->city($ip_data->city);
    	}
    	if(!$this->IsSetPrperty("tzone")){
    		$this->tzone($ip_data->time_zone);
    	}
    	if(!$this->IsSetPrperty("region")){
    		$this->region($ip_data->region_name);
    	}
    	if (! $this->IsSetPrperty ( "zip" )) {
			$this->zip ( $ip_data->zip_code );
		}
		if (! $this->IsSetPrperty ( "country" )) {
			$this->country ( $ip_data->country_code );
		}
		if (! $this->IsSetPrperty ( "user_social_session_data" )) {
			$this->user_social_session_data ( "" );
		}
		if(!$this->IsSetPrperty("email")){
            AddError(__("%s is required",__("Email address")));
		   return false; 
		}else{
		    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		        AddError(__("%s is not valid",__("Email address")));
		        return false;
		    }else{
		        if($this->IsExists("email",$this->email)){
                    AddError(__("%s is already exists",__("Email address")));
                    return false;
                }
            }
		}
    	
    	$needToUpdatePass=false;
    	$bkPass="";
    	if($this->IsSetPrperty("pass")){
    		$bkPass=$this->pass;
    		$this->pass('');
    		$needToUpdatePass=true;
    	}
    	if(!$this->IsSetPrperty("join_date")){
    	    $this->join_date(date("Y-m-d H:i:s"));
    	}
    	if(!$this->IsSetPrperty("last_login_time")){
    	    $this->last_login_time(date("Y-m-d H:i:s"));
    	}
    	
    	$isSaved= parent::Save();
    	if($isSaved && $needToUpdatePass){
    		$obj=new self();
    		$obj->pass(md5($this->id.$bkPass));
    		$obj->SetWhereCondition("id", $this->id);
    		$obj->Update();    		
    		Msite_user::SendUserEmailByObj("UWE", $this,"Your entered password");
    	}    	
    	return $isSaved;	
	}
	function SaveWithRandomPassword(){
		    $this->load->helper("string");
		    $password=random_string('alnum',8);
		    if($this->Save()){
                $obj=new self();
                $obj->pass(md5($this->id.$password));
                $obj->SetWhereCondition("id", $this->id);
                $obj->Update();
                Msite_user::SendUserEmailByObj("UWE", $this,$password);
                return true;
            }
            return false;
    }
    static function DeleteAccount($id) {
	    $upbk = new self();
	    $upbk->first_name( "Deleted" );
	    $upbk->last_name( "Deleted" );
	    $upbk->username( $id."_deleted" );
	    $upbk->email( $id.'@deleted.com');
	    $upbk->pass( "" );
        $upbk->gender( "" );
        $upbk->phone( "" );
        $upbk->address( "" );
        $upbk->region( "" );
        $upbk->city( "" );
        $upbk->zip( "" );
        $upbk->country( "" );
        $upbk->dob( "" );
        $upbk->profile_url( "" );
        $upbk->photo_url( "" );
        $upbk->age( "" );
        $upbk->login_type( "" );
        $upbk->join_date( "" );
        $upbk->tzone( "" );
        $upbk->last_login_time( "" );
        $upbk->status( "D" );
        $upbk->user_type( "" );
        $upbk->user_social_session_data( "" );
	    $upbk->SetWhereCondition("id",$id);
	    if($upbk->Update()){
	        $tupdate=new Mticket();
		    $tupdate->status("C");
		    $tupdate->SetWhereCondition("ticket_user",$id);
		    if($tupdate->Update(true)){
		        
            }
	        return true;
        }
        return false;
		   
    }
	static function ChangePassoword($user_id,$old_password,$new_password,$c_password){
		if($new_password!=$c_password){
			AddError("Repeat password is not same");
			return false;
		}
		$thisobj=new self();
		$thisobj->id($user_id);
		if($thisobj->Select()){
			if(empty($thisobj->pass) ||($thisobj->pass==md5($thisobj->id.$old_password))){
				$uppass=new self();
				$uppass->pass(md5($user_id.$new_password));
				$uppass->SetWhereCondition("id", $user_id);
				if($uppass->Update()){
					$userData=GetUserData();
					$userData->is_skip_old_pass=false;
					$thisobj->session->SetUserData($userData);
					AddInfo("Password updated successfully");
					return true;
				}else{
					AddError("Password update failed");
					return false;
				}
			}else{
				AddError("Old passoword is wrong");
				return false;
			}
		}
	
		AddError("Invalid Information");
		return false;
	}
	/*
	 //Delete override
	 public static function DeleteByKeyValue($key,$value,$noLimit=false){
	 return parent::DeleteByKeyValue($key,$value,$noLimit);
	 }
	 //*/
	
	/* add custom function here*/
	function setCustomFields(&$customes,&$hasCustom) {
		$customes=Mcustom_field::getGridColumn("R");
		$hasCustom=count($customes)>0;
		$custom_field_ids=[];
		if($hasCustom) {
			foreach ( $customes as $cf ) {
				$custom_field_ids["custom_".$cf->id]=$cf->id;
			}
		}
		if($hasCustom && isset($custom_field_ids[$this->srcItem])){
			$mjobj=new Msite_user_custom_field();
			$mjobj->fld_value(" LIKE '%".$this->srcText."%'",true);
			$this->Join($mjobj,"user_id","id","left","",["custom_id"=>"'".$custom_field_ids[$this->srcItem]."'"]);
			$this->srcItem="";
			$this->srcText="";
		}
	}
	static function send_reset_email($email){
	    $user_obj= self::FindBy("email", $email);
	    return self::sendResetEmailByObj($user_obj);
	}
    static function send_reset_by_id($id){
        $user_obj= self::FindBy("id", $id);
        return self::sendResetEmailByObj($user_obj);
    }
	/**
	 * @param Msite_user $user_obj
	 * @return boolean
	 */
	static function sendResetEmailByObj($user_obj){
	    if($user_obj instanceof self){
	         
	        $res=new stdClass();
	        $res->email=$user_obj->email;
	        $res->id=$user_obj->id;
	        $res->time=time();
	        $res->panel="user";
	
	        $obj=new self();
	        $obj->load->library("APPEncryptionLib");
	        $appencp=new APPEncryptionLib();
	        $encrypted=$appencp->encryptObj($res);
	        $encrypted=urlencode($encrypted);
	        $kword="UFP";
	        $emailobj=new Memail_templates();
	        $params=Memail_templates::getEmailParamListClearData($kword);
	         
	        $params["user_name"]=$user_obj->first_name." ".$user_obj->last_name;
	        $params["recover_button"]='<a href="'.base_url("user/recover?k={$encrypted}").'" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #2ea226; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 4px; display: inline-block;padding: 5px 14px;line-height: 27px;">'.__("Reset Password").'</a>';
	
	
	        if($emailobj->SendEmailTemplates($kword, $user_obj->email,"",$params)){
	            //echo "Success";
	            return true;
	        }
	        //GPrint($params);
	    }else{
	        return false;
	    }
	
	    
	}
	/**
	 * @param unknown $kword
	 * @param Msite_user $app_user_obj
	 * @param string $pass
	 * @return boolean
	 */
	static function SendUserEmailByObj($kword,$site_user_obj,$pass=''){
	    if($site_user_obj instanceof self){
	        $emailobj=new Memail_templates();
	
	        $params=Memail_templates::getEmailParamListClearData($kword);
	        $params["full_name"]=$site_user_obj->first_name." ".$site_user_obj->last_name;       
            if($site_user_obj->login_type !="N"){
                $passtitle=$site_user_obj->getTextByKey("login_type");                
                $pass=__("You logged in using %s", $passtitle);
            }

	        ob_start();
	        ?>
				<div>
				<table class='bordered' style="max-width: 600px;">
					<tr>
						<th><?php _e("Login Email") ; ?></th>
						<td><?php echo $site_user_obj->email;?></td>
					</tr>
					<tr>
						<th><?php _e("Password") ; ?></th>
						<td><?php echo $pass;?></td>
					</tr>
					<tr>
						<th><?php _e("Login Link") ; ?></th>
						<td><a href="<?php echo base_url();?>"><?php echo base_url();?></a></td>
					</tr>
				</table>
				</div>
				<?php 
				$params["login_info"]=ob_get_clean();
		        if($emailobj->SendEmailTemplates($kword, $site_user_obj->email,"",$params,false)){
		            //echo "Success";
		            return true;
		        }
		        //GPrint($params);
		    }else{
		        return false;
		    }
		
		}
	static function ChangePassowordById($user_id,$new_password,$c_password){
	    if($new_password!=$c_password){
	        AddError("Confirm password is not same");
	        return false;
	    }
	    $thisobj=new self();
	    $thisobj->id($user_id);
	    if($thisobj->Select()){
	        $uppass=new self();
	        // AddInfo($user_id.$new_password,true);
	        // AddInfo(md5($user_id.$new_password),true);
	        $uppass->pass(md5($user_id.$new_password));
	        $uppass->SetWhereCondition("id", $user_id);
	        if($uppass->Update()){
	            self::sendChangeNotificationEmailByObj($thisobj);
	            AddInfo("Password updated successfully");
	            return true;
	        }else{
	            AddError("Password update failed");
	            return false;
	        }
	    }
	
	    AddError("Invalid Information");
	    return false;
	}
	static function sendChangeNotificationEmailByObj($user_obj){
	    if($user_obj instanceof self){	
	       
	        $kword="UPC";
	        $emailobj=new Memail_templates();
	        $params=Memail_templates::getEmailParamListClearData($kword);
	
	        $params["user_name"]=$user_obj->first_name." ".$user_obj->last_name;
	        //$params["recover_button"]='<a href="'.base_url("admin/user/recover?k={$encrypted}").'" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #2ea226; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 4px; display: inline-block;padding: 5px 14px;line-height: 27px;">Reset Password</a>';
	
	
	        if($emailobj->SendEmailTemplates($kword, $user_obj->email,"",$params,false)){
	            //echo "Success";
	            return true;
	        }
	        //GPrint($params);
	    }else{
	        return false;
	    }
	
	}
	/**
	 * @param Hybrid_User_Profile $profile
	 * @return boolean
	 */
	static function loginUsingSocial($profile,$social_session_data=''){
		if(!empty($social_session_data)){
			$social_session_data=base64_encode($social_session_data);
		}
		if($profile instanceof Hybrid_User_Profile ){
			$obj=new self();			
			//just update sessiondata
			$loginObj=self::FindBy("email", $profile->email);
            $providers=$obj->hybridauth->HA->getConnectedProviders();
            $provider=!empty($providers[0])?substr($providers[0], 0,1):"";
            if($loginObj){
				//$d=new Hybridauth();
				//$d->HA->	

				$uobj=new self();
				if($loginObj->user_type=="G"){					
					$uobj->first_name($profile->firstName);
					$uobj->last_name($profile->lastName);
					$uobj->username($profile->displayName);
					if(!empty($profile->emailVerified)){
						$uobj->email($profile->emailVerified);
						$uobj->is_verified_email("Y");
					}else{
						if(empty($profile->email)){
							AddError("Email field is empty form social data ",true);
							return false;
						}
						$uobj->email($profile->email);
					}
					$uobj->city($profile->city);
					$uobj->gender($profile->gender);
					$uobj->age($profile->age);
					$uobj->address($profile->address);
					$uobj->phone($profile->phone);
					$uobj->photo_url($profile->photoURL);
					$uobj->profile_url($profile->profileURL);
					if(strlen($profile->country)>2){
						$country=getCountryKeyValuePair(true);
						if(!empty($country[$profile->country])){						
							$uobj->country($country[$profile->country]);
						}
					}
					
					$uobj->region($profile->region);
					$uobj->city($profile->city);
					$uobj->zip($profile->zip);
					//$uobj->pass();
					if(!empty($profile->birthDay) && !empty($profile->birthMonth)&& !empty($profile->birthYear)){
						$dob= mktime(0,0,0,$profile->birthMonth,$profile->birthDay,$profile->birthYear);
						$uobj->dob(date("Y-m-d",$dob));
					}
					$uobj->user_type("U");
				}
				$uobj->login_type($provider);				
				$uobj->user_social_session_data($social_session_data);
				$uobj->SetWhereCondition("id", $loginObj->id);
				//GPrint($uobj);
				if($uobj->Update()){					
					if($loginObj->user_type=="G"){
						$loginObj=self::FindBy("email", $profile->email);
					}
				}
				if($loginObj->status=='A'){
					AddLog ( "A", "", "l001", "Login using social");
					return self::SetUserSessionByObject($loginObj,true);
				}else{
					$p_options=$loginObj->GetPropertyRawOptions('status');
					AddError("The account status is ".getTextByKey($loginObj->status,$p_options),true);
					return false;
				}
			}else{
				//new user
				$nobj=new self();
				$nobj->first_name($profile->firstName);
				$nobj->last_name($profile->lastName);
				$nobj->username($profile->displayName);
				if(!empty($profile->emailVerified)){
					$nobj->email($profile->emailVerified);
					$nobj->is_verified_email("Y");
				}else{
					if(empty($profile->email)){
						AddError("Email field is empty form social data ",true);
						return false;
					}
					$nobj->email($profile->email);
				}
				$nobj->city($profile->city);
				$nobj->gender($profile->gender);
				$intAge=filter_var($profile->age, FILTER_SANITIZE_NUMBER_INT);
				$nobj->age($intAge);
				$nobj->address($profile->address);
				$nobj->phone($profile->phone);
				$nobj->photo_url($profile->photoURL);
				$nobj->profile_url($profile->profileURL);
				if(strlen($profile->country)>2){
					$country=getCountryKeyValuePair(true);
					if(!empty($country[$profile->country])){
						$nobj->country($country[$profile->country]);
					}
				}				
				$nobj->region($profile->region);
				$nobj->city($profile->city);
				$nobj->zip($profile->zip);
				$nobj->login_type($provider);
				//$nobj->pass("");
				if(!empty($profile->birthDay) && !empty($profile->birthMonth)&& !empty($profile->birthYear)){
					$dob= mktime(0,0,0,$profile->birthMonth,$profile->birthDay,$profile->birthYear);
					$nobj->dob(date("Y-m-d",$dob));
				}				
				if($nobj->Save()){
					AddLog("A",$nobj->settedPropertyforLog(),"l001","");
					return self::SetUserSessionById($nobj->id,true);
				}	
				Mdebug_log::AddGeneralLog("Social Login Error", "F","E", GetMsgForAPI().json_encode($nobj->setProperties));				
				AddError("Social login error. Try again later",true);
				return false;
			}
			
		}else{
			AddError("Something went error",true);
		}
		return false;
	}
	static function CheckLogin($username,$password,$isApiCall=false){
		$type=mb_detect_encoding($username, "auto");
		if($type!="ASCII"){
			AddError("Invalid username. Please write username in English");
			return false;
		}
	
		if(true || strlen($username)<=25){
				
			$thisobj=new self();
			if (filter_var ( $username, FILTER_VALIDATE_EMAIL )) {
				$thisobj->email($username);
			} else {
				AddError("Not a valid email address");
				return false;
				$thisobj->username($username);
			}
			//$thisobj->username($username);
			//$thisobj->status('A');
			if($thisobj->Select()){
				if ($thisobj->status == "A") {
					if ($thisobj->pass == md5 ( $thisobj->id . $password )) {
						$thisobj->login_type="N";
						if(empty($thisobj->tzone)){
						    $thisobj->tzone=Msite_user::UpdateTimeZoneByIp($thisobj->id);
						}
						$isLogged = $thisobj->SetUserSession ( true );
						if ($isLogged) {
							AddLog ( "A", "", "l001", "Login ", $thisobj->email);
						}
						return $isLogged;
					}
				}else{
					AddError("Account is not activated");
					return false;
				}
			}
		}
		AddError("Invalid Information");
		return false;
	}
	static function UpdateTimeZoneByIp($id){
	    $ipinfo=APPIPdata::get();
	    if(!empty($ipinfo->time_zone) && !empty($ipinfo->country_code)){
	       $obj=new self();
	       $obj->tzone($ipinfo->time_zone);
	       $obj->country($ipinfo->country_code);
	       $obj->SetWhereCondition("id", $id);
	       if($obj->Update()){
	       }
	    }
	    return $ipinfo->time_zone;
	}
	static function SetUserSessionById($id,$logged_id=false){
		$obj=self::FindBy("id", $id);
		if($obj){
			return $obj->SetUserSessionByObject($obj,$logged_id);
		}
		return false;
		
	}
	
	/**
	 * @param self $obj
	 * @param string $logged_id
	 * @return boolean
	 */
	static function SetUserSessionByObject($obj,$logged_id=false){		
		if($obj){
			return $obj->SetUserSession($logged_id);
		}
		return false;
		
	} 
	function SetUserSession($isLoggedIn=false){
		/*if(empty($this->img_url)){
		 $this->img_url=custom_url("images/user1-160x160.jpg");
		 }*/
		$img_url=!empty($this->photo_url)?$this->photo_url:base_url("images/default-user-image.png");
		/*$gimg=get_gravatar($this->email);
		if($gimg!=""){
			$img_url=$gimg;
		}*/
		$UserData=new UserSessionData();
		$UserData->id=$this->id;
		$UserData->user=$this->username;
		$UserData->title=$this->first_name.' '.$this->last_name;
		$UserData->panel='C';
		$UserData->email=$this->email;
		$UserData->user_img=$img_url;
		$UserData->is_verified_email=$this->is_verified_email;
		//$UserData->mobile=$this->mobile;
		$UserData->timezone=$this->tzone;
		$UserData->add_date= get_current_user_timezonetime($this->join_date,'Y-m-d H:i:s');
		$UserData->LoggedIn=$isLoggedIn;
		$UserData->user_type=$this->user_type;
		$UserData->login_type=$this->login_type;
		$UserData->is_skip_old_pass=empty($this->pass) && $this->login_type!="N";
		if($isLoggedIn){
			Mapp_setting::SetTimeZoneSession($this->tzone);
			Muser_online_log::UpdateUserOnline($this->id,"U");
			Mapp_setting::SetOnlineStatus();			
			$this->session->UnsetAllUserData();
		}
		$this->session->SetUserData($UserData);
		return true;
	}
			


/* add custom function here*/
	static function isEmailExists($emailAddress){
		$muser=new self();
		if($muser->IsExists("email", $emailAddress,array("user_type"=>"U"))){
			return true;
		}
		return false;
	}
	
	
/* end custom function */
	function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
	    $this->GetAddForm2($label_col,$input_col,$mainobj,$except,$disabled,[]);
	}
	 function GetAddForm2($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array(),$custom_fields=[]){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("first_name",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="first_name"><?php _e("First Name"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="100"
			value="<?php echo  $mainobj->GetPostValue("first_name");?>"
			class="form-control" id="first_name"
			<?php echo in_array("first_name", $disabled)?' disabled="disabled" ':' name="first_name" ';?>
			placeholder="<?php _e("First Name"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("First Name"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("last_name",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="last_name"><?php _e("Last Name"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="100"
			value="<?php echo  $mainobj->GetPostValue("last_name");?>"
			class="form-control" id="last_name"
			<?php echo in_array("last_name", $disabled)?' disabled="disabled" ':' name="last_name" ';?>
			placeholder="<?php _e("Last Name"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Last Name"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(false && !in_array("username",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="username"><?php _e("Username"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="50"
			value="<?php echo  $mainobj->GetPostValue("username");?>"
			class="form-control" id="username"
			<?php echo in_array("username", $disabled)?' disabled="disabled" ':' name="username" ';?>
			placeholder="<?php _e("Username"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Username"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("email",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>"
		for="email"><?php _e("Email"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="100"
			value="<?php echo  $mainobj->GetPostValue("email");?>"
			class="form-control" id="email"
			<?php echo in_array("email", $disabled)?' disabled="disabled" ':' name="email" ';?>
			placeholder="<?php _e("Email"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Email"));?>">
	</div>
</div>
<?php } ?>
			
			<?php if(!in_array("pass",$except)){ ?>
<div class="form-group">
	<label class="control-label col-md-<?php echo $label_col;?>" for="pass"><?php _e("Password"); ?></label>
	<div class="col-md-<?php echo $input_col;?>">
		<input type="text" maxlength="32"
			value="<?php echo  $mainobj->GetPostValue("pass");?>"
			class="form-control" id="pass"
			<?php echo in_array("password", $disabled)?' disabled="disabled" ':' name="pass" ';?>
			placeholder="<?php _e("Password"); ?>" data-bv-notempty="true"
			data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
	</div>
</div>
<?php } ?>
         <?php if(!in_array("gender",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="gender"><?php _e("Gender"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <div class="inline radio-inline">
                         <?php
                         $gender=$mainobj->GetPostValue("gender");
                         $goption=["male"=>"Male","female"=>"Female"];
                         GetHTMLRadioByArray("Gender","gender","gender",true,$goption,$gender,in_array("gender", $disabled));
                         ?>
                     </div>
                 </div>
             </div>
         <?php } ?>
         <?php if(!in_array("country",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <select    class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
                         <?php $country_selected= $mainobj->GetPostValue("country","");
                         GetHTMLOption("","Select");
                         GetHTMLOptionByArray(getCountryKeyValuePair(),$country_selected);
                         ?>
                     </select>
                     <?php /*<span class="form-group-help-block"><?php _e("country");?></span>	*/?>
                 </div>
             </div>
         <?php }
         if(!empty($custom_fields)){
				 //Custome All Category
				 foreach ($custom_fields as $fld_group) {
					 echo app_get_html_form_field( $fld_group, "custom_", "", "", $label_col, $input_col, true );
					
				 }
         }
          if(!in_array("status",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <div class="inline radio-inline">
                         <?php
                         $status_selected= $mainobj->GetPostValue("status","A");
                         $status_isDisabled=in_array("status", $disabled);
                         GetHTMLRadioByArray("Status","status","status",true,$mainobj->GetPropertyRawOptions("status"),$status_selected,$status_isDisabled);
                         ?>
                         <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>
                     </div>
                 </div>
             </div>
         <?php } ?>
			<?php /*?>
			<?php  if(!in_array("is_verified_email",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_verified_email"><?php _e("Is Verified Email"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_verified_email" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_verified_email","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_verified_email" <?php echo in_array("is_verified_email", $disabled)?' disabled="disabled" ':' name="is_verified_email" ';?>   > 
					</label>
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			

			
			<?php if(!in_array("phone",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="phone"><?php _e("Phone"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("phone");?>" class="form-control" id="phone" <?php echo in_array("phone", $disabled)?' disabled="disabled" ':' name="phone" ';?>     placeholder="<?php _e("Phone"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Phone"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("address",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="address"><?php _e("Address"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("address");?>" class="form-control" id="address" <?php echo in_array("address", $disabled)?' disabled="disabled" ':' name="address" ';?>     placeholder="<?php _e("Address"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("region",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="region"><?php _e("Region"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("region");?>" class="form-control" id="region" <?php echo in_array("region", $disabled)?' disabled="disabled" ':' name="region" ';?>     placeholder="<?php _e("Region"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Region"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("city",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="city"><?php _e("City"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("city");?>" class="form-control" id="city" <?php echo in_array("city", $disabled)?' disabled="disabled" ':' name="city" ';?>     placeholder="<?php _e("City"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("City"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("zip",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="zip"><?php _e("Zip"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("zip");?>" class="form-control" id="zip" <?php echo in_array("zip", $disabled)?' disabled="disabled" ':' name="zip" ';?>     placeholder="<?php _e("Zip"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Zip"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("country",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("country");?>" class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>     placeholder="<?php _e("Country"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("dob",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="dob"><?php _e("Dob"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("dob");?>" class="form-control" id="dob" <?php echo in_array("dob", $disabled)?' disabled="disabled" ':' name="dob" ';?>     placeholder="<?php _e("Dob"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Dob"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("profile_url",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="profile_url"><?php _e("Profile Url"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("profile_url");?>" class="form-control" id="profile_url" <?php echo in_array("profile_url", $disabled)?' disabled="disabled" ':' name="profile_url" ';?>     placeholder="<?php _e("Profile Url"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Profile Url"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("photo_url",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="photo_url"><?php _e("Photo Url"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("photo_url");?>" class="form-control" id="photo_url" <?php echo in_array("photo_url", $disabled)?' disabled="disabled" ':' name="photo_url" ';?>     placeholder="<?php _e("Photo Url"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Photo Url"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("age",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="age"><?php _e("Age"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("age");?>" class="form-control" id="age" <?php echo in_array("age", $disabled)?' disabled="disabled" ':' name="age" ';?>     placeholder="<?php _e("Age"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Age"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("login_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="login_type"><?php _e("Login Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $login_type_selected= $mainobj->GetPostValue("login_type","N");
			            $login_type_isDisabled=in_array("login_type", $disabled);
			            GetHTMLRadioByArray("Login Type","login_type","login_type",true,$mainobj->GetPropertyRawOptions("login_type"),$login_type_selected,$login_type_isDisabled);
			            ?>
			        
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("join_date",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="join_date"><?php _e("Join Date"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("join_date");?>" class="form-control" id="join_date" <?php echo in_array("join_date", $disabled)?' disabled="disabled" ':' name="join_date" ';?>     placeholder="<?php _e("Join Date"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Join Date"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("tzone",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="tzone"><?php _e("Tzone"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("tzone");?>" class="form-control" id="tzone" <?php echo in_array("tzone", $disabled)?' disabled="disabled" ':' name="tzone" ';?>     placeholder="<?php _e("Tzone"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Tzone"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
			*/
	}


}
?>