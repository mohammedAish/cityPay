<?php

/**
 * @since: 22/Feb/2018
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @property:id,name,login_url,valid_url,button_txt_color,button_color,button_txt,server_type,status
 */
class Mremote_server extends APP_Model
{
    public $id;
    public $name;
    public $private_key;
    public $login_url;
    public $valid_url;
    public $button_text_color;
    public $button_color;
    public $button_txt;
    public $server_type;
    public $status;


    /**
     * @property id,name,login_url,valid_url,button_txt_color,button_color,button_txt,server_type,status
     */
    function __construct() {
        parent::__construct();
        $this->SetValidation();
        $this->tableName    = "remote_server";
        $this->primaryKey   = "id";
        $this->uniqueKey    = array();
        $this->multiKey     = array();
        $this->autoIncField = array("id");
    }


    function SetValidation() {
        $this->validations = array(
            "id"                => array("Text" => "Id", "Rule" => "max_length[10]|integer"),
            "name"              => array("Text" => "Name", "Rule" => "required|max_length[100]"),
            "private_key"       => array("Text" => "Private Key", "Rule" => "required|max_length[255]"),
            "login_url"         => array("Text" => "Login URL", "Rule" => "required|max_length[255]"),
            "valid_url"         => array("Text" => "Valid URL", "Rule" => "required|max_length[255]"),
            "button_color"      => array("Text" => "Button Color", "Rule" => "max_length[20]"),
            "button_text_color" => array("Text" => "Button Text Color", "Rule" => "max_length[20]"),
            "button_txt"        => array("Text" => "Button Txt", "Rule" => "required|max_length[100]"),
            "server_type"       => array("Text" => "Server Type", "Rule" => "max_length[1]"),
            "status"            => array("Text" => "Status", "Rule" => "max_length[1]")

        );
    }

    public function GetPropertyRawOptions($property, $isWithSelect = false) {
        $returnObj = array();
        switch ($property) {
            case "server_type":
                $returnObj = array("L" => "Login Server", "F" => "Field Validation");
                break;
            case "status":
                $returnObj = array("A" => "Active", "I" => "Inactive");
                break;
            default:
        }
        if ($isWithSelect) {
            return array_merge(array("" => "Select"), $returnObj);
        }

        return $returnObj;

    }

    public function GetPropertyOptionsColor($property) {
        $returnObj = array();
        switch ($property) {
            case "server_type":
                $returnObj = array("L" => "success", "F" => "danger");
                break;
            case "status":
                $returnObj = array("A" => "success", "I" => "danger");
                break;
            default:
        }

        return $returnObj;

    }

    public function GetPropertyOptionsIcon($property) {
        $returnObj = array();
        switch ($property) {
            case "server_type":
                $returnObj = array("L" => "", "F" => "fa fa-times-circle-o");
                break;
            default:
        }

        return $returnObj;

    }

    //auto generated
    function Update($notLimit = false, $isShowMsg = true, $dontProcessIdWhereNotset = true) {

        if ($this->IsSetPrperty("login_url") && !filter_var($this->login_url, FILTER_VALIDATE_URL) !== false) {
            AddErrorTranslated(__("%s is not a valid URL", __("Valid URL")));

            return false;
        }
        if ($this->IsSetPrperty("valid_url") && !filter_var($this->valid_url, FILTER_VALIDATE_URL) !== false) {
            AddErrorTranslated(__("%s is not a valid URL", __("Valid URL")));

            return false;
        }

        return parent::Update($notLimit, $isShowMsg, $dontProcessIdWhereNotset);
    }

    function Save() {

        if (!filter_var($this->login_url, FILTER_VALIDATE_URL) !== false) {
            AddErrorTranslated(__("%s is not a valid URL", __("Login URL")));

            return false;
        }
        if (!filter_var($this->valid_url, FILTER_VALIDATE_URL) !== false) {
            AddErrorTranslated(__("%s is not a valid URL", __("Valid URL")));

            return false;
        }

        return parent::Save();
    }


    /* add custom function here*/
    function delete_file($id = '') {
        if (empty($id)) {
            $id = $this->id;
        }
        if (!empty($id) && file_exists(FCPATH."/data/login_button_img/{$id}.png")) {
            unlink(FCPATH."/data/login_button_img/{$id}.png");
        }

        return true;
    }

    function hasImageFile($id = "") {
        if (empty($id)) {
            $id = $this->id;
        }

        return !empty($id) && file_exists(FCPATH."/data/login_button_img/{$id}.png");
    }

    function getImageUrl($isShowTimeparam = false, $id = "") {
        if (empty($id)) {
            $id = $this->id;
        }
        $timeparam = $isShowTimeparam ? "?v=".time() : "";
        if (!$this->hasImageFile($id)) {
            return base_url("images/no-image-2.png");
        }

        return base_url("data/login_button_img/{$id}.png".$timeparam);
    }

    static function DeleteById($id) {
        if (parent::DeleteByKeyValue("id", $id, false)) {
            $obj = new self();
            $obj->delete_file($id);

            return true;
        }

        return false;
    }

    static function login_by_token($api_id, $token) {

        $response         = new stdClass();
        $response->status = false;
        $response->msg    = __("Unknown");
        if (!filter_var($api_id, FILTER_VALIDATE_INT)) {
            $response->msg = "Param Error ".$api_id;

            return $response;
        }
        $thisobj = new self();
        $server  = self::FindBy("id", $api_id);
        $server->session->UnsetAllUserData();
        if ($server) {
            $private_key = $server->private_key;
            if (Mapp_setting::GetSettingsValue("is_enc_enable", "N") == "Y") {
                $private_key = $thisobj->decrypt_key($private_key, $private_key);
            }
            $param     = ["private_key" => $private_key, "token" => $token];
            $useragent = get_app_title();
            $ch        = curl_init($server->valid_url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
            //curl_setopt ( $ch, CURLOPT_HEADER, $headers );
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
            $result   = curl_exec($ch);
            $errorNo  = curl_errno($ch);
            $errorMsg = curl_error($ch);
            curl_close($ch);
            if (!empty($errorMsg)) {
                Mdebug_log::AddGeneralLog("Remote Login", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,
                    $errorMsg);
                $response->msg = __("Remote login error");

                return $response;
            }
            if (!empty($result)) {
                $resultobj = json_decode($result);
                if (empty($resultobj->status) || empty($resultobj->data)) {
                    Mdebug_log::AddGeneralLog("Remote Login response error", Mdebug_log::STATUS_FAILED,
                        Mdebug_log::ENTRY_TYPE_ERROR, $result);
                    $response->msg = __("Response Data Error");

                    return $response;
                }
                if (empty($resultobj->type)) {
                    $resultobj->type = "C";
                }

                $resultobj->type = strtoupper($resultobj->type);

                return self::loginUsingRemoteData($resultobj, $response);
            }
        }

    }

    static function loginUsingRemoteData($resultobj, $response) {
        $profile        =& $resultobj->data;
        $response->type = $resultobj->type;
        if ($resultobj->type == "C") {//client
            if (empty($resultobj->status) || empty($profile->email) || empty($profile->first_name)) {
                Mdebug_log::AddGeneralLog("Remote Login response error", Mdebug_log::STATUS_FAILED,
                    Mdebug_log::ENTRY_TYPE_ERROR, json_encode($resultobj));
                $response->msg = __("Empty Data");

                return $response;
            }
            $siteobj = Msite_user::FindBy("email", $profile->email);
            $uobj    = new Msite_user();
            if (!empty($profile->email)) {
                $uobj->email($profile->email);
            }
            if (!empty($profile->first_name)) {
                $uobj->first_name($profile->first_name);
            }
            if (!empty($profile->last_name)) {
                $uobj->last_name($profile->last_name);
            }
            if (!empty($profile->name)) {
                $uobj->username($profile->email);
            }
            if (!empty($profile->email)) {
                $uobj->email($profile->email);
            }
            if (!empty($profile->is_verified_email)) {
                $uobj->is_verified_email("Y");
            }
            if (!empty($profile->city)) {
                $uobj->city($profile->city);
            }
            if (!empty($profile->gender)) {
                $uobj->gender($profile->gender);
            }
            if (!empty($profile->age)) {
                $uobj->age($profile->age);
            }
            if (!empty($profile->phone)) {
                $uobj->phone($profile->phone);
            }
            if (!empty($profile->image_url)) {
                $uobj->photo_url($profile->image_url);
            }
            if (!empty($profile->country)) {
                $uobj->country($profile->country);
            }
            if (!empty($profile->city)) {
                $uobj->city($profile->city);
            }

            if (!empty($profile->zip)) {
                $uobj->city($profile->zip);
            }
            if (!empty($profile->dob)) {
                $uobj->city($profile->dob);
            }
            $uobj->user_type("U");
            if ($siteobj) {
                $uobj->SetWhereCondition("email", $profile->email);
                $uobj->Update();
                $siteobj->SetUserSessionById($siteobj->id, true);
                $response->msg    = __("Successfully logged in");
                $response->status = true;
                self::SaveCustomValue($siteobj->id, $resultobj);

                return $response;
            } else {
                if ($uobj->Save()) {
                    self::SaveCustomValue($uobj->id, $resultobj);
                    Msite_user::SetUserSessionByObject($uobj, true);
                    $response->msg    = __("Successfully logged in");
                    $response->status = true;

                    return $response;
                } else {
                    Mdebug_log::AddGeneralLog("Remote Login client date save failed", Mdebug_log::STATUS_FAILED,
                        Mdebug_log::ENTRY_TYPE_ERROR, GetMsgForAPI());
                    $response->msg = __("Empty Data");
                    return $response;
                }
            }
        } elseif ($resultobj->type == "A") {
            //admin user;
            //  GPrint($resultobj);

            if (empty($profile->email)) {
                Mdebug_log::AddGeneralLog("Remote Login unknown error", Mdebug_log::STATUS_FAILED,
                    Mdebug_log::ENTRY_TYPE_ERROR, "unknown");
                $response->msg = __("Remote server response error, no email address found");

                return $response;
            } else {
                $users = Mapp_user::FindBy("email", $profile->email);
                if ($users) {
                    Mapp_user::LoggedInByEmail($profile->email);
                    $response->msg    = __("Successfully logged in");
                    $response->status = true;

                    return $response;
                } else {
                    $response->msg = __("No admin/agent user found with this email address (%s)", $profile->email);

                    return $response;
                }
            }
        }
        Mdebug_log::AddGeneralLog("Remote Login unknown error", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,
            "unknown");
        $response->msg = __("Unknown error");

        return $response;

    }

    static function SaveCustomValue($user_id, $response_obj) {
        if (count($response_obj->data->custom) > 0) {
            $response_obj->data->custom = (array) $response_obj->data->custom;
        }
        if (!empty($response_obj->data->custom) && is_array($response_obj->data->custom)) {
            Msite_user_custom_field::SaveExtraCustomProperties($user_id, $response_obj->data->custom);
        }
    }

    function encrypt_key($private_key, $string) {
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = $private_key;
        $secret_iv      = md5($private_key);
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv     = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;
    }

    function decrypt_key($private_key, $string) {
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = $private_key;
        $secret_iv      = md5($private_key);
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv     = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        return $output;
    }

    /* end custom function */
    function GetAddForm($label_col = 5, $input_col = 7, $mainobj = null, $except = array(), $disabled = array()) {

        if (!$mainobj) {
            $mainobj = $this;
        }
        ?>
        <?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */ ?>

        <?php if (!in_array("name", $except)) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>" for="name"><?php _e("Name"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="100" value="<?php echo $mainobj->GetPostValue("name"); ?>"
                           class="form-control" id="name" <?php echo in_array("name",
                        $disabled) ? ' disabled="disabled" ' : ' name="name" '; ?> placeholder="<?php _e("Name"); ?>"
                           data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e("%s is required", __("Name")); ?>">
                    <?php /*<span class="form-group-help-block"><?php _e("name");?></span>	*/ ?>
                </div>
            </div>
        <?php } ?>
        <?php if (!in_array("private_key", $except)) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="private_key"><?php _e("Private Key"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="100" value="<?php echo $mainobj->GetPostValue("private_key"); ?>"
                           class="form-control" id="private_key" <?php echo in_array("private_key",
                        $disabled) ? ' disabled="disabled" ' : ' name="private_key" '; ?>
                           placeholder="<?php _e("private_key"); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e("%s is required", __("Private Key")); ?>">
                    <span class="form-group-help-block"><?php _e("It will send this key in verification process as param"); ?></span>
                </div>
            </div>
        <?php } ?>
        <?php if (!in_array("button_txt", $except)) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="button_txt"><?php _e("Button Text"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="100" value="<?php echo $mainobj->GetPostValue("button_txt"); ?>"
                           class="form-control" id="button_txt" <?php echo in_array("button_txt",
                        $disabled) ? ' disabled="disabled" ' : ' name="button_txt" '; ?>
                           placeholder="<?php _e("Button Txt"); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e("%s is required", __("Button Txt")); ?>">
                    <?php /*<span class="form-group-help-block"><?php _e("button_txt");?></span>	*/ ?>
                </div>
            </div>
        <?php } ?>
        <div class="row md-m-t-m-25">
            <div class="col-md-10">

                <?php if (!in_array("button_text_color", $except)) { ?>
                    <div class="form-group">
                        <label class="control-label col-md-<?php echo $label_col + 1; ?>"
                               for="button_text_color"><?php _e("Button Text Color"); ?></label>
                        <div class="col-md-<?php echo $input_col - 1; ?>">
                            <div class="input-group">
                                <input type="text" maxlength="20"
                                       value="<?php echo $mainobj->GetPostValue("button_text_color"); ?>"
                                       class="form-control app-color-picker"
                                       id="button_text_color" <?php echo in_array("button_text_color",
                                    $disabled) ? ' disabled="disabled" ' : ' name="button_text_color" '; ?>
                                       placeholder="<?php _e("Button Text Color"); ?>" data-bv-notempty="true"
                                       data-bv-notempty-message="<?php _e("%s is required",
                                           __("Button Text Color")); ?>">

                                <span class="input-group-addon" id="basic-addon1">
            				<i class="fa fa-square c-preview"></i>
            			</span>
                            </div>
                            <?php /*<span class="form-group-help-block"><?php _e("button_color");?></span>	*/ ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!in_array("button_color", $except)) { ?>
                    <div class="form-group">
                        <label class="control-label col-md-<?php echo $label_col + 1; ?>"
                               for="button_color"><?php _e("Button Color"); ?></label>
                        <div class="col-md-<?php echo $input_col - 1; ?>">
                            <div class="input-group">
                                <input type="text" maxlength="20"
                                       value="<?php echo $mainobj->GetPostValue("button_color"); ?>"
                                       class="form-control app-color-picker"
                                       id="button_color" <?php echo in_array("button_color",
                                    $disabled) ? ' disabled="disabled" ' : ' name="button_color" '; ?>
                                       placeholder="<?php _e("Button Color"); ?>" data-bv-notempty="true"
                                       data-bv-notempty-message="<?php _e("%s is required", __("Button Color")); ?>">

                                <span class="input-group-addon" id="basic-addon1">
            				<i class="fa fa-square c-preview"></i>
            			</span>
                            </div>
                            <?php /*<span class="form-group-help-block"><?php _e("button_color");?></span>	*/ ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="col-md-2">
                <div class="form-group">

                    <img class="app-image-input img-thumbnail" data-change="image_changed"
                         data-noimage="<?php echo base_url("images/no-image-2.png"); ?>" data-delete="true"
                         <?php if ($mainobj->hasImageFile()){ ?>data-show-delete="true" <?php } ?>
                         data-name="button_logo" src="<?php echo $mainobj->getImageUrl(true); ?>"
                         style="height: 75px;"/>
                    <span class="form-group-help-block"><?php _e("Select icon"); ?></span>

                </div>
            </div>
        </div>
        <?php if (!in_array("login_url", $except)) {
            /*data-bv-uri="true" data-bv-uri-message="<?php _e("It not a valid URL") ; ?>"*/
            ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="login_url"><?php _e("Login URL"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <textarea maxlength="255" style="height: 70px;" class="form-control"
                              id="login_url" <?php echo in_array("login_url",
                        $disabled) ? ' disabled="disabled" ' : ' name="login_url" '; ?>     placeholder="<?php _e("ex. http://www.zyz.com?from=support-system"); ?>"
                              data-bv-notempty="true" data-bv-notempty-message="<?php _e("%s is required",
                        __("Login Url")); ?>"><?php echo $mainobj->GetPostValue("login_url"); ?></textarea>
                    <span class="form-group-help-block"><?php _e("It is your remote server login URL. You can add extra parameter to detect, ex. %s ",
                            '<span class="text-bold text-yellow">http://www.zyz.com?from=support-system</span>'); ?></span>
                </div>
            </div>
        <?php } ?>

        <?php if (!in_array("valid_url", $except)) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="valid_url"><?php _e("Validation URL"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <textarea maxlength="255" style="height: 70px;" class="form-control"
                              id="valid_url" <?php echo in_array("valid_url",
                        $disabled) ? ' disabled="disabled" ' : ' name="valid_url" '; ?>     placeholder="<?php _e("ex. http://www.zyz.com/valid.php"); ?>"
                              data-bv-notempty="true" data-bv-notempty-message="<?php _e("%s is required",
                        __("Valid Url")); ?>"><?php echo $mainobj->GetPostValue("valid_url"); ?></textarea>
                    <span class="form-group-help-block"><?php _e("Our server will post to this URL with the response token.%s Post paramater will be look like %s",
                            '<br/>',
                            '<span class="text-bold text-yellow">$_POST["token"]=&lt;token&gt;</span>'); ?></span>
                </div>
            </div>
        <?php } ?>


        <?php /*if(!in_array("server_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="server_type"><?php _e("Server Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $server_type_selected= $mainobj->GetPostValue("server_type","L");
			            $server_type_isDisabled=in_array("server_type", $disabled);
			            GetHTMLRadioByArray("Server Type","server_type","server_type",true,$mainobj->GetPropertyRawOptions("server_type"),$server_type_selected,$server_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("server_type");?></span>	*//*?>
			       </div> 
		      	</div>
		      </div> 
		     <?php }*/ ?>

        <?php if (!in_array("status", $except)) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="status"><?php _e("Status"); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">

                    <div class="togglebutton ">
                        <input name="status" value="I" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue("status",
                                "A") == "A" ? "checked" : "" ?> value="A" class=""
                                   id="status" <?php echo in_array("status",
                                $disabled) ? ' disabled="disabled" ' : ' name="status" '; ?> >

                        </label>
                        <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/ ?>
                    </div>

                </div>
            </div>
        <?php } ?>

        <?php
    }


}

?>