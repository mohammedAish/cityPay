<?php 
			
/**
 * Version 1.0.0
 * Creation date: 31/Oct/2015
 * @Written By: S.M. Sarwar Hasan
 * Appsbd
 * DB Properties : id,user,title,email,pass,role,panel,status,add_date
 */						
class Mapp_user extends APP_Model{	
    public $pvid;
	public $id;
	public $user;
	public $title;
	public $email;
	public $pass;
	public $role;
	public $panel;
	public $status;
	public $contact_number;
	public $add_date;
	public $img_url;
	public $tzone;
	public $gender;
	public $address;
	public $region;
	public $city;
	public $zip;
	public $country;
    public $is_enable_chat;
	public $dob;
	private static $users; 
	private static $is_user_loaded=false;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="app_user";
			$this->primaryKey="user";
			$this->uniqueKey=array(array("pvid","user"),array("pvid","email"));		
			$this->multiKey=array(array("pvid","user","status"));
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->pvid=$this->id=$this->user=$this->title=$this->email=null;
		$this->pass=$this->role=$this->panel=$this->status=$this->add_date=null;
		$this->img_url=null;

	}
	function SetValidation(){
	    $this->validations=array(
	        "pvid"=>array("Text"=>"Pvid", "Rule"=>"max_length[4]"),
	        "id"=>array("Text"=>"Id", "Rule"=>"max_length[2]"),
	        "user"=>array("Text"=>"User", "Rule"=>"required|max_length[25]"),
	        "title"=>array("Text"=>"Title", "Rule"=>"required|max_length[50]"),
	        "email"=>array("Text"=>"Email", "Rule"=>"required|max_length[100]"),
	        "pass"=>array("Text"=>"Pass", "Rule"=>"required|max_length[32]"),
	        "role"=>array("Text"=>"Role", "Rule"=>"required|max_length[2]"),
	        "panel"=>array("Text"=>"Panel", "Rule"=>"required|max_length[1]"),
	        "status"=>array("Text"=>"Status", "Rule"=>"max_length[1]"),
	        "add_date"=>array("Text"=>"Add Date", "Rule"=>"max_length[20]"),
	        "contact_number"=>array("Text"=>"Contact Number", "Rule"=>"max_length[25]"),
	        "img_url"=>array("Text"=>"Img Url", "Rule"=>"max_length[255]"),
	        "tzone"=>array("Text"=>"Tzone", "Rule"=>"required|max_length[50]"),
	        "gender"=>array("Text"=>"Gender", "Rule"=>"required|max_length[6]"),
	        "address"=>array("Text"=>"Address", "Rule"=>"required|max_length[255]"),
	        "region"=>array("Text"=>"Region", "Rule"=>"max_length[100]"),
	        "city"=>array("Text"=>"City", "Rule"=>"required|max_length[100]"),
	        "zip"=>array("Text"=>"Zip", "Rule"=>"required|max_length[20]"),
	        "country"=>array("Text"=>"Country", "Rule"=>"required|max_length[2]"),
	        "dob"=>array("Text"=>"Dob", "Rule"=>"required|max_length[20]"),
            "is_enable_chat"=>array("Text"=>"Enable Chat", "Rule"=>"max_length[1]")
	        	
	        );
	        }
	        
	        public function GetPropertyRawOptions($property,$isWithSelect=false){
	            $returnObj=array();
	            switch ($property) {
	                case "tzone":
	                    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
	                    foreach ($tzlist as $tzone){
	                        $returnObj[$tzone]=$tzone;
	                    }	 
	                    break;
	                case "gender":
	                    $returnObj=array("M"=>"Male","F"=>"Female");
	                    break;
	                case "status":
                        $returnObj=array("A"=>"Active","I"=>"Inactive","D"=>"Archive");
                        break;
	                case "country":
	                    $returnObj=getCountryKeyValuePair();
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
	                case "tzone":
	                    break;
	                case "gender":
	                    $returnObj=array("M"=>"success","F"=>"danger");
	                    break;
	                case "country":
	                    $returnObj=array();
	                    break;
                    case "status":
                        $returnObj=array("A"=>"success","I"=>"danger","D"=>"warning");
                        break;
                    default:
	            }
	            return $returnObj;
	        
	        }
	        
	        public function GetPropertyOptionsIcon($property){
	            $returnObj=array();
	            switch ($property) {
	                case "tzone":
	                    $returnObj=array();
	                    break;
	                case "gender":
	                    $returnObj=array("M"=>"fa fa-male","F"=>"fa fa-female");
	                    break;
	                case "country":
	                    $returnObj=array();
	                    break;
                    case "status":
                        $returnObj=array("A"=>"fa fa-check-circle-o","I"=>"fa fa-times-circle-o","D"=>"fa fa-archive");
                        break;
	                 default:
	            }
	            return $returnObj;
	        
	        }
	static function get_all_user(){
		if(empty(self::$users)){
			$obj=new Mapp_user();
			self::$users=$obj->SelectAllWithIdentity('id','id,user,title,email,role,panel,status');
			self::$is_user_loaded=true;
		}
		return self::$users;
	}
	/**
	 * @param string $id
	 * @return Mapp_user
	 */
	static function get_user_obj_by($id){
		if(!self::$is_user_loaded){
			self::get_all_user();
		}
		return !empty(self::$users[$id])?self::$users[$id]:new Mapp_user();
	}
	static function check_grade($creator_role_id,$check_role_id){
	    $crole=new Mrole_list();
	    $crole->role_id($creator_role_id);
	    if($crole->Select()){
	        $chrole=new Mrole_list();
	        $chrole->role_id($check_role_id);
	        if($chrole->Select()){
                if($crole->grade<=$chrole->grade){
                    return true;
                }
            }else{
	            return true;//when role doesn't exits
            }

	    }
	    return false;
	}
	static function CheckLogin($username,$password,$isApiCall=false){
	    if(function_exists("mb_detect_encoding")) {
            $type = mb_detect_encoding($username, "auto");
            if ($type != "ASCII") {
                AddError("Invalid username. Please write username in English");
                return false;
            }
        }

		if(true || strlen($username)<=25){
			$thisobj=new self();
			$thisobj->user($username);
			$thisobj->status('A');
			if($thisobj->Select()){
			   
			  if(Mhistory_misslogin::is_ok_history_login($thisobj->id)){
    				if($thisobj->pass==md5($thisobj->id.$password)){
    				    Mhistory_misslogin::clear_history_by($thisobj->id);
    				    $isLogged=$thisobj->SetUserSession(true);
    				    if($isLogged){
    					   AddLog("A", "", "l001","Login ",$username);
    				    }
    				    return $isLogged;
    				}else{
    				    Mhistory_misslogin::add($thisobj->id);
    				}			   
			   }else{
			       $interval_min=Mapp_setting::GetSettingsValue("appuser_sec_min");
			       AddError("This account has been temporary locked for {$interval_min} minutes, try again later or contact with admin to unlock");
			       return false;
			   }
			}
		}
		AddError("Invalid Information");
		return false;
	}
	static function LoggedInByEmail($email,$imgurl="",$using="Google",$otherParam=array()){		
		$thisobj=new self();
		$thisobj->email($email);
		$thisobj->status('A');
		if($thisobj->Select()){	
			if((empty($thisobj->img_url) && !empty($imgurl)) || (empty($thisobj->title) && !empty($otherParam['name']))){
				$uo=new self();
				if(!empty($imgurl)){
					$uo->img_url($imgurl);
					$thisobj->img_url=$imgurl;
				}	
				if(!empty($otherParam['name'])){
					$uo->title($otherParam['name']);
					$thisobj->title=$otherParam['name'];
				}			
				$uo->SetWhereCondition("id", $thisobj->id);
				if($uo->Update()){
					//updated
					//$thisobj->img_url=$imgurl;
					
				}
				
			}		
			$thisobj->SetUserSession(true);
			AddLog("A", "", "l001","Login (using $using) ");
			//addlog
			return true;			
		}	
		AddError("$using email address is not registered or inactive",true);
		return false;
	}
	/**
	 * @return AdminSessionData;
	 */
	static function GetAdminData(){
		$thisobj=new self();
		return $thisobj->session->GetAdminData();
	}
	/**
	 * @return string;
	 */
	static function GetCurrentUserType(){
	    $thisobj=new self();
	    return $thisobj->session->GetCurrentUserType();
	}
	/**
	 * @return AdminSessionData;
	 */
	static function IsSuperUser(){
		$admindata=self::GetAdminData();
		if($admindata){
			return $admindata->IsSuperUser();
		}
		return false;
	}
	/**
	 * @return AdminSessionData;
	 */
	static function HasAdminSession(){
	    return self::GetCurrentUserType()=="AD";
	}
	static function getLoggedUserTitle(){
		$admindata=self::GetAdminData();
		if($admindata){
			return $admindata->title;
		}
		return "";
	}
	function SetUserSession($isLoggedIn=false){
		/*if(empty($this->img_url)){
			$this->img_url=custom_url("images/user1-160x160.jpg");
		}*/
	    $this->img_url=Mapp_user::get_user_image_url($this->id);
	   /* $imggravater=get_gravatar($this->email); 
	    $this->img_url=$imggravater;*/
		$AdminData=new AdminSessionData();
		$AdminData->id=$this->id;
		$AdminData->user=$this->user;
		$AdminData->title=$this->title;
		$AdminData->panel='A';//$this->panel;
		$AdminData->role=$this->role;
		$AdminData->email=$this->email;
		$AdminData->user_img=$this->img_url;
		$AdminData->add_date=$this->add_date;	
		$AdminData->timezone=$this->tzone;
		$AdminData->isChatEnable=$this->is_enable_chat=="Y";
		$role=new Mrole_list();
		//$role->pv_id($this->pvid);
		$role->role_id($this->role);				
		if(!$role->Select()){
		    AddError("Invalid Role, Please contact with admin");
		    return false;
		}
		
		//$roleGrade=array("S"=>0,"N"=>3,"A"=>3,"E"=>4);
		//$AdminData->grade=isset($roleGrade[$AdminData->role])?$roleGrade[$AdminData->role]:3;
		$AdminData->role_title=$role->title;
		$AdminData->grade=$role->grade;
		$AdminData->LoggedIn=$isLoggedIn;
		if($AdminData->grade!=0){
			$this->load->db_model("Mrole_access");
			$AdminData->RoleAccess=Mrole_access::GetRoleAccessArrayByRoleId($AdminData->role);				
		}		
		if($isLoggedIn){
		    Mapp_setting::SetTimeZoneSession($AdminData->timezone);
		    Mapp_setting::SetOnlineStatus();
		    Muser_online_log::UpdateUserOnline($this->id,"A");
		    $this->session->UnsetAllUserData();
		}
		$this->session->SetAdminData($AdminData);			
		$this->session->SetSession("admin_noti_time", time());	
	   return true;
	}
	static function UpdateCurrentUserChatStatus($status)
    {
        $adminData = GetAdminData();
        if ($status === $adminData->isChatEnable) {
            return true;
        } else {
            if (self::UpdateChatStatus($adminData->id, $status)) {
                $adminData->isChatEnable = $status;
                $thisobj=new self();
                $thisobj->session->SetAdminData($adminData);
                return true;
            }
        }
        return false;
    }
    static function UpdateChatStatus($id,$status){
        $obj=new self();
        $obj->is_enable_chat($status?"Y":"N");
        $obj->SetWhereCondition("id",$id);
        return $obj->Update();
    }
	static function ChangePassoword($user_id,$old_password,$new_password,$c_password){
		if($new_password!=$c_password){
			AddError("Repeat password is not same");
			return false;
		}
		$thisobj=new self();
		$thisobj->id($user_id);
		if($thisobj->Select()){
			if($thisobj->pass==md5($thisobj->id.$old_password)){
				$uppass=new self();
				$uppass->pass($user_id.$new_password);
				$uppass->SetWhereCondition("id", $user_id);
				if($uppass->Update()){
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
            $uppass->pass($user_id.$new_password);
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
    static function DeleteAccount($id)
    {
        $upbk = new self();
        $upbk->GetUpdateDB()->set("user", "{$id}_deleted");
        $upbk->GetUpdateDB()->set("email", "{$id}@deleted.com");
        $upbk->GetUpdateDB()->set("title", "-");
        $upbk->GetUpdateDB()->set("role", "-");
        $upbk->GetUpdateDB()->set("status", "D");
        $upbk->GetUpdateDB()->limit(1);
        $upbk->GetUpdateDB()->where("id", $id);
        if ($upbk->GetUpdateDB()->update($upbk->tableName)) {
            if ($upbk->GetUpdateDB()->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }
    function IsExistsEmail($email) {
        $mainobj=new self();
        $mainobj->email($email);
        $mainobj->status( "!='D'",true);
        if($mainobj->CountALL()>0){
            return true;
        }
        return false;
    }

	function Save(){
		$return=true;
		//Temporary
		$this->panel("A");		
		if($this->IsExists("user", $this->user)){
			AddError("This username is already exists");
			$return=false;
		}
		if($this->IsExists("email", $this->email)){
            $mainobj=new self();
            $mainobj->email($this->email);
            if($mainobj->Select()){
                if($mainobj->status=='D'){
                    if(!Mapp_user::DeleteAccount($mainobj->id)){
                        AddError("This email address is already exists");
                        $return=false;
                    }
                }else{
                    AddError("This email address is already exists");
                    $return=false;
                }
            }
        }
		if(!$return){
			return false;
		}		
		if(!$this->IsSetPrperty("pvid")){		   
		    $pvid=ProviderSession::get_session_provider_id();
		    $this->pvid($pvid);
		}
		if(!$this->IsSetPrperty("id")){
			$newid=$this->GetNewIncId("id", "AA",array("pvid"=>$this->pvid));
			$this->id($newid);
		}
		$pass="";
		if($this->IsSetPrperty("pass")){
		    $pass=$this->pass;
			$this->pass(md5($this->id.$this->pass));
		}else{
		    $this->load->helper("string");
		    $pass=random_string('alnum',8);
		    $this->pass(md5($this->id.$pass));
		}
		$rtured=parent::Save();
		if($return){
		    Mapp_user::SendUserEmailByObj("AWE", $this,$pass);
		}
		return  $rtured;
	}
	/**
	 * @param unknown $kword
	 * @param Mapp_user $app_user_obj
	 * @param string $pass
	 * @return boolean
	 */
	static function SendUserEmailByObj($kword,$app_user_obj,$pass=''){
	    if($app_user_obj instanceof self){
	        $emailobj=new Memail_templates();
	
	        $params=Memail_templates::getEmailParamListClearData($kword);
	        $params["full_name"]=$app_user_obj->title;
			ob_start();
			?>
			<div>
			<table class='bordered' style="max-width: 600px;">
				<tr>
					<th><?php _e("Username") ; ?></th>
					<td><?php echo $app_user_obj->user;?></td>
				</tr>
				<tr>
					<th><?php _e("Password") ; ?></th>
					<td><?php echo $pass;?></td>
				</tr>
				<tr>
					<th><?php _e("Login Link") ; ?></th>
					<td><a href="<?php echo base_url("admin");?>"><?php echo base_url("admin");?></a></td>
				</tr>
			</table>
			</div>
			<?php 
			$params["login_info"]=ob_get_clean();
	        if($emailobj->SendEmailTemplates($kword, $app_user_obj->email,"",$params,false)){
	            //echo "Success";
	            return true;
	        }
	        //GPrint($params);
	    }else{
	        return false;
	    }
	
	}
	function Update($notLimit = false, $isShowMsg = true,$dontProcessIdWhereNotset=true){
		if($this->IsSetPrperty("email") && $this->IsExists("email", $this->email)){
			AddError("This email address is already exist");
			return false;
		}
		if($this->IsSetPrperty("pass")){
			$this->pass(md5($this->pass));
		}
		return parent::Update($notLimit,$isShowMsg);
	}
	protected function SetCustomModelWhereProperties($isForUpdate=FALSE){
		return true;
	}
	static function get_user_image_url($id,$isVersionAdd=false){
	    if(!empty($id) && file_exists(FCPATH."/data/appuser/$id/profile.jpg")){
	        if($isVersionAdd){
	           $ftime=filemtime(FCPATH."/data/appuser/$id/profile.jpg");
	           return base_url("data/appuser/$id/profile.jpg?v=".$ftime);
	        }else{
	           
	           return base_url("data/appuser/$id/profile.jpg");
	        }
	    }
	    return base_url("images/no-image.png");
	}
	static function get_user_profile_path($id){
	    $path=FCPATH."/data/appuser/$id/";
	    if(app_make_dir($path)){
	      
	    }
	    return $path.DIRECTORY_SEPARATOR."profile.jpg";
	}
	static function upload_user_profile_path($post_name,$id){
	     $userpath=Mapp_user::get_user_profile_path($id);
	     if(move_upload_file_if_ok($post_name, $userpath)){	
	         $objthis=new self();       
	         $objthis->load->library("SimpleImage");
	         $m = new SimpleImage($userpath);	                  
             $m->thumbnail(400, 400, 'center');
             $m->save();	         
	         return true;
	     }else{
	         return false;
	     }
	}
	static function send_reset_email($id){
	    $user_obj= Mapp_user::FindBy("id", $id);
	   return self::sendResetEmailByObj($user_obj);
	}
	/**
	 * @param Mapp_user $user_obj
	 * @return boolean
	 */
	static function sendResetEmailByObj($user_obj){
	    if($user_obj instanceof self){
	        
	        $res=new stdClass();
	        $res->email=$user_obj->email;
	        $res->id=$user_obj->id;
	        $res->time=time();
	         
	        $obj=new self();
	        $obj->load->library("APPEncryptionLib");
	        $appencp=new APPEncryptionLib();
	        $encrypted=$appencp->encryptObj($res);
	        $encrypted=urlencode($encrypted);
	        $kword="AFP";
	        $emailobj=new Memail_templates();	
	        $params=Memail_templates::getEmailParamListClearData($kword);
	        
	        $params["user_name"]=$user_obj->title;
	        $params["recover_button"]='<a href="'.base_url("admin/user/recover?k={$encrypted}").'" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #2ea226; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 4px; display: inline-block;padding: 5px 14px;line-height: 27px;">'.__("Reset Password").'</a>';
	       
	       
	        if($emailobj->SendEmailTemplates($kword, $user_obj->email,"",$params)){
	            //echo "Success";
	            return true;
	        }
	        //GPrint($params);
	    }else{
	        return false;
	    }
	
	}
	static function sendChangeNotificationEmailByObj($user_obj){
	    if($user_obj instanceof self){
	         
	        $res=new stdClass();
	        $res->email=$user_obj->email;
	        $res->id=$user_obj->id;
	        $res->time=time();
	      
	        $kword="APC";
	        $emailobj=new Memail_templates();
	        $params=Memail_templates::getEmailParamListClearData($kword);
	         
	        $params["user_name"]=$user_obj->title;
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
	
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<div class="col-sm-4">
				<?php if(!in_array("user",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user"><?php _e("Username"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text"  maxlength="25"  <?php echo in_array("user", $disabled)?' disabled="disabled"':' name="user" ';?>  value="<?php echo  $mainobj->GetPostValue("user");?>" class="form-control" id="user"  placeholder="<?php _e("Username"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
		     
		     
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Name"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text"  maxlength="50"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" name="title" placeholder="<?php _e("Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("email",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="email"><?php _e("Email"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text"  maxlength="100"   value="<?php echo  $mainobj->GetPostValue("email");?>" class="form-control" id="email" name="email" placeholder="<?php _e("Email"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Email"));?>">
		      	</div>
		      </div> 
		     <?php } ?>	
		     	<?php if(false && !in_array("pass",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user"><?php _e("Password"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="password"  maxlength="25"  autocomplete="off"  value="<?php echo  $mainobj->GetPostValue("pass");?>" class="form-control" id="pass" name="pass" placeholder="<?php _e("Password"); ?>" 
		      		data-bv-notempty="true" 	
		      		data-bv-notempty-message="<?php  _e("The password is required and cannot be empty");?>"	      		

	                data-bv-identical="true"
	                data-bv-identical-field="cpass"
	                data-bv-identical-message="<?php _e("The password and its confirm are not the same");?>"	
	
	                data-bv-different="true"
	                data-bv-different-field="user"
	                data-bv-different-message="<?php  _e("The password cannot be the same as username");?>"	 
		      		>
		      	</div>
		      </div> <?php }?>
		     <?php if(!in_array("gender",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="gender"><?php _e("Gender"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $gender_selected= $mainobj->GetPostValue("gender","");
			            $gender_isDisabled=in_array("gender", $disabled);
			            GetHTMLRadioByArray("Gender","gender","gender",true,$mainobj->GetPropertyRawOptions("gender"),$gender_selected,$gender_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("gender");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
		     
		     <?php if(!in_array("address",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="address"><?php _e("Address"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("address");?>" class="form-control" id="address" <?php echo in_array("address", $disabled)?' disabled="disabled" ':' name="address" ';?>     placeholder="<?php _e("Address"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("address");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("country",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
			        <?php $country_selected= $mainobj->GetPostValue("country","");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("country",true),$country_selected);
			            ?>
			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("country");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
		     
		     <?php if(!in_array("tzone",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="tzone"><?php _e("Timezone"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control select2" id="tzone" <?php echo in_array("tzone", $disabled)?' disabled="disabled" ':' name="tzone" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Tzone"));?>">
			        <?php 
			        $tzone_selected= $mainobj->GetPostValue("tzone","");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("tzone",true),$tzone_selected);
			            ?>
			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("tzone");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			</div>
			<div class="col-sm-5">	
		     <?php if(!in_array("role",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="role"><?php _e("Role"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php 
		      		$adminUser=GetAdminData();
		      		if($adminUser){
		      		    $role=new Mrole_list();
		      		    $role->grade(">=".$adminUser->grade,true);
		      		    $options_role= $role->SelectAllWithKeyValue("role_id", "title",false);
		      		}else{
		      		  $options_role= Mrole_list::FetchAllKeyValue("role_id", "title",false);
		      		}?>
			        <select  class="form-control" id="role" <?php echo in_array("role", $disabled)?' disabled="disabled" ':' name="role" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Role"));?>">
			        <?php $role_selected= $mainobj->GetPostValue("role");
			            GetHTMLOptionByArray($options_role,$role_selected);
			            ?>			        
			        </select>
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("contact_number",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="contact_number"><?php _e("Contact Number"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="25"  value="<?php echo  $mainobj->GetPostValue("contact_number");?>" class="form-control" id="contact_number" name="contact_number" placeholder="<?php _e("Contact Number"); ?>" >
		      	</div>
		      </div> 
		     <?php } ?>
		     
			<?php /*if(!in_array("panel",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="panel"><?php _e("Panel"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      	<?php 		      		
					$panels=array("A"=>"Admin","U"=>"User","C"=>"Call Center");
					?>
					<select class="form-control form-group-sm" id="panel" name="panel" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Panel"));?>" >
		      			<?php 		      			
		      			foreach ($panels as $key=>$rtitle){
							GetHTMLOption($key, $rtitle,$mainobj->GetPostValue("panel"));
						}
		      			?>
		      		</select>
					
		      	</div>
		      </div> 
		     <?php }*/ ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select class="form-control form-group-sm" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Status"));?>" >
		      			<?php
		      			$status=$mainobj->GetPropertyRawOptions('status');
		      			$sstatus=$mainobj->GetPostValue("status");
		      			if($sstatus!="D"){
		      			    if(isset($status["D"])){
		      			        unset($status["D"]);
                            }
                        }
		      			foreach ($status as $key=>$rtitle){
							GetHTMLOption($key, $rtitle,$sstatus);
						}
		      			?>
		      		</select>
		      	</div>
		      </div> 
		     <?php } ?>
		      <?php if(false && !in_array("pass",$except)){ ?>
		       <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user"><?php _e("Confirm"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="password"  maxlength="25"   value="<?php echo  $mainobj->GetPostValue("cpass");?>" class="form-control" id="cpass" name="cpass" placeholder="<?php _e("Confirm Password"); ?>" 
		      		
		      		data-bv-notempty="true" 	
		      		data-bv-notempty-message="<?php  _e("The confirm password is required and cannot be empty");?>"	
	                data-bv-identical="true"
	                data-bv-identical-field="pass"
	                data-bv-identical-message="<?php  _e("The password and its confirm are not the same");?>"	
	
	                data-bv-different="true"
	                data-bv-different-field="username"
	                data-bv-different-message="<?php  _e("The password cannot be the same as username");?>"
		      		>
		      	</div>
		      </div>
		     <?php } ?>
		     <?php if(!in_array("dob",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="dob"><?php _e("Birthday"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("dob");?>" class="form-control app-date-picker" id="dob" <?php echo in_array("dob", $disabled)?' disabled="disabled" ':' name="dob" ';?>     placeholder="<?php _e("YYYY-MM-DD"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Birthday"));?>">
			     		<span class="form-group-help-block">YYYY-MM-DD, ex. 1988-07-01</span>
		      	</div>
		      </div> 
		     <?php } ?>
		     
		     <?php if(!in_array("city",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="city"><?php _e("City"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("city");?>" class="form-control" id="city" <?php echo in_array("city", $disabled)?' disabled="disabled" ':' name="city" ';?>     placeholder="<?php _e("City"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("City"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("city");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("zip",$except)){ ?>
			 <div class="form-group form-group-sm">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="zip"><?php _e("Zip"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("zip");?>" class="form-control" id="zip" <?php echo in_array("zip", $disabled)?' disabled="disabled" ':' name="zip" ';?>     placeholder="<?php _e("Zip"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Zip"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("zip");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
		     
		     
			</div>
			
			<div class="col-sm-3 text-right">
			<div class="form-group">
                		
                		<div class="col-md-12">                		
                		 	<img class="app-image-input img-thumbnail" data-name="user_img" src="<?php echo self::get_user_image_url($mainobj->id,true);?>" style="width:230px; height: 230px;"/>	
                		 	<span class="form-group-help-block text-center"><?php _e("Click on the Image to change");?><br/> <?php _e("Best size is 400px x 400px");?></span>
                		</div>
                	</div>
			</div>
			
			
			
			<div class="row"></div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<?php 
	}
	



}
?>