<?php 			
/** 
 * @since: 21/Apr/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,open_user_id,is_remote_typing,is_user_typing,end_by_type,end_by,current_admin_user,start_time,end_time,status		
 */						
class Mchat extends APP_Model
{
    public $id;
    public $open_user_id;
    public $is_remote_typing;
    public $is_user_typing;
    public $end_by_type;
    public $end_by;
    public $current_admin_user;
    public $start_time;
    public $end_time;
    public $bw_name;
    public $country;
    public $last_msg_time;
    public $last_msg_by;
    public $last_page_list;
    public $ip;
    public $header_msg;
    public $status;


    /**
     * @property id,open_user_id,is_remote_typing,is_user_typing,end_by_type,end_by,current_admin_user,start_time,end_time,status
     */
    function __construct()
    {
        parent::__construct();
        $this->SetValidation();
        $this->tableName = "chat";
        $this->primaryKey = "id";
        $this->uniqueKey = array();
        $this->multiKey = array();
        $this->autoIncField = array("id");
    }
    function __call($func, $args)
    {
        if($func=="header_msg"){
            if(strlen($args[0])>255){
                $args[0]=substr($args[0],0,254);
            }
        }
        parent::__call($func, $args);
    }


    function SetValidation()
    {
        $this->validations = array(
            "id" => array("Text" => "Id", "Rule" => "max_length[10]|integer"),
            "open_user_id" => array("Text" => "Open User Id", "Rule" => "max_length[10]"),
            "is_remote_typing" => array("Text" => "Is Remote Typing", "Rule" => "max_length[1]"),
            "is_user_typing" => array("Text" => "Is User Typing", "Rule" => "max_length[1]"),
            "end_by_type" => array("Text" => "End By Type", "Rule" => "max_length[1]"),
            "end_by" => array("Text" => "End By", "Rule" => "max_length[10]"),
            "current_admin_user" => array("Text" => "Current Admin User", "Rule" => "max_length[2]"),
            "start_time" => array("Text" => "Start Time", "Rule" => "max_length[20]"),
            "end_time" => array("Text" => "End Time", "Rule" => "max_length[20]"),
            "bw_name" => array("Text" => "Bw Name", "Rule" => "max_length[50]"),
            "country" => array("Text" => "Country", "Rule" => "max_length[50]"),
            "end_time" => array("Text" => "Last Message Time", "Rule" => "max_length[20]"),
            "last_msg_time" => array("Text" => "Last Page List", "Rule" => "max_length[150]"),
            "last_msg_by" => array("Text" => "Last Message Sent", "Rule" => "max_length[1]"),
            "ip" => array("Text" => "Ip", "Rule" => "required|max_length[20]"),
            "header_msg" => array("Text" => "Ip", "Rule" => "max_length[255]"),
            "status" => array("Text" => "Status", "Rule" => "max_length[1]")

        );
    }

    public function GetPropertyRawOptions($property, $isWithSelect = false)
    {
        $returnObj = array();
        switch ($property) {
            case "is_remote_typing":
                $returnObj = array("Y" => "Yes", "N" => "No");
                break;
            case "is_user_typing":
                $returnObj = array("Y" => "Yes", "N" => "No");
                break;
            case "end_by_type":
                $returnObj = array("A" => "Staff", "C" => "Client");
                break;
            case "status":
                $returnObj = array("N" => "Not Started", "S" => "Started", "E" => "End");
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
            case "end_by_type":
                $returnObj = array("A" => "success", "C" => "success");
                break;
            case "status":
                $returnObj = array("N" => "success", "S" => "success", "E" => "success");
                break;
            default:
        }
        return $returnObj;

    }

    public function GetPropertyOptionsIcon($property)
    {
        $returnObj = array();
        switch ($property) {
            case "end_by_type":
                $returnObj = array("A" => "fa fa-check-circle-o", "C" => "");
                break;
            case "status":
                $returnObj = array("N" => "", "S" => "fa fa-check-circle-o", "E" => "");
                break;
            default:
        }
        return $returnObj;

    }

    //auto generated
    /*function Save(){			   
	    return parent::Save();
	}*/


    /* add custom function here*/
    static function hasLimit($user_id){
        $obj=new self();
        $obj->current_admin_user($user_id);
        $obj->status("A");
        $total=$obj->CountALL();
        if($total>=Mapp_setting_api::GetSettingsValue("webchat","max_chat_per_user")){
            return false;
        }
        return true;
    }
    static function getChatLogoUrl($isSetTime=true){

        if(file_exists(FCPATH."images/chatlogo.png")){
            $isTimestr=$isSetTime?"?t=".fileatime(FCPATH."images/chatlogo.png"):"";
            return base_url("images/chatlogo.png$isTimestr");
        }else{
            return base_url("images/logo.png");
        }
    }
    static function getChatPositionObj($chat_id)
    {
        $chat_id=(int)$chat_id;
        $response = new stdClass();
        $obj = new self();
        $obj->status('Q');
        $response->total = $obj->CountALL();
        $response->pos= $obj->SelectQuery("SELECT count(chat.id) AS pos FROM	chat WHERE `status`='Q' AND chat.id <= $chat_id")[0]->pos;
        return $response;
    }

    static function setAdminTyping($chat_id, $status, $user_id = '')
    {
        if (empty($chat_id)) {
            return false;
        }
        $chat_id = (int)$chat_id;
        if (!empty($user_id)) {
            $ubj = new self();
            $ubj->is_remote_typing("N");
            $ubj->SetWhereCondition("id", "!='" . $chat_id . "'", true);
            $ubj->SetWhereCondition("current_admin_user", $user_id);
            $ubj->Update(true);
        }
        $obj = new self();
        $obj->is_remote_typing($status);
        $obj->SetWhereCondition("id", $chat_id);
        return $obj->Update();

    }
    static function setLastMsgTime($chat_id,$by)
    {
        if (empty($chat_id)) {
            return false;
        }
        $chat_id = (int)$chat_id;
        $ubj = new self();
        $ubj->last_msg_time(date("Y-m-d H:i:s"));
        $ubj->last_msg_by($by);
        $ubj->SetWhereCondition("id", $chat_id);
        return $ubj->Update();
    }

    static function setAssignMe($chat_id)
    {
        if (empty($chat_id)) {
            return false;
        }
        $adminUser = GetAdminData();
        $chat_id = (int)$chat_id;
        if (!empty($adminUser)) {
            $ubj = new self();
            $ubj->status("A");
            $ubj->header_msg("");
            $ubj->current_admin_user($adminUser->id);
            $ubj->SetWhereCondition("id", $chat_id);
            if($ubj->Update()){
               ChatAdminLib::add_initial_entry($adminUser->id,$chat_id);
               return true;
            }
        }
        return false;

    }

    static function closeChat($chat_id)
    {
        if (empty($chat_id)) {
            return false;
        }
        $adminUser = GetAdminData();
        $chat_id = (int)$chat_id;
        if (!empty($adminUser)) {
            $ubj = new self();
            $ubj->status("C");
            $msg=Mapp_setting_api::GetSettingsValue("webchat","chat_closing_text");
            $msg=preg_replace("/\{\{agent_name\}\}/i", $adminUser->title, $msg);
            $ubj->header_msg($msg);
            $ubj->end_time(date("Y-m-d H:i:s"));
            $ubj->current_admin_user($adminUser->id);
            $ubj->SetWhereCondition("id", $chat_id);
            return $ubj->Update();
        }
        return false;

    }
    static function AutoCloseChat()
    {
        if(Mapp_setting_api::GetSettingsValue("webchat","is_active","N")=="Y") {
            $chatType = Mapp_setting_api::GetSettingsValue("webchat", "app_chat_type");
            if ($chatType == "B" || $chatType == "P") {
                $getTimeInterval = Mapp_setting_api::GetSettingsValue("webchat", "chat_closing_int", 30);
                if ($getTimeInterval > 0) {
                    $chatobj = new self();
                    $chatobj->status("<> 'C'", true);
                    $lastmsg = strtotime("-{$getTimeInterval} MINUTE");
                    $chatobj->last_msg_time("<'" . date("Y-m-d H:i:s", $lastmsg) . "'", true);
                    $chats = $chatobj->SelectAll();
                    if ($chats) {
                        foreach ($chats as $cht) {
                            $ubj = new self();
                            $ubj->status("C");
                            $ubj->header_msg(__("Chat has been auto closed by system"));
                            $ubj->end_time(date("Y-m-d H:i:s"));
                            $ubj->SetWhereCondition("id", $cht->id);
                            $ubj->Update();
                        }
                    }
                }
            }
        }
    }
    static function updateHeaderMessage($chat_id,$msg='',$setStatus='')
    {
        if (empty($chat_id)) {
            return false;
        }

        $chat_id = (int)$chat_id;
        $ubj = new self();
        if(!empty($setStatus)){
            $ubj->status($setStatus);
        }
        $ubj->header_msg($msg);
        $ubj->SetWhereCondition("id", $chat_id);
        return $ubj->Update();
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */
        ?>

        <?php if (!in_array("open_user_id", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="open_user_id"><?php _e("Open User Id"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="10" value="<?php echo $mainobj->GetPostValue("open_user_id"); ?>"
                       class="form-control"
                       id="open_user_id" <?php echo in_array("open_user_id", $disabled) ? ' disabled="disabled" ' : ' name="open_user_id" '; ?>
                       placeholder="<?php _e("Open User Id"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Open User Id")); ?>">
                <?php /*<span class="form-group-help-block"><?php _e("open_user_id");?></span>	*/ ?>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("is_remote_typing", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="is_remote_typing"><?php _e("Is Remote Typing"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">

                <div class="togglebutton ">
                    <input name="is_remote_typing" value="N" type="hidden">
                    <label>
                        <input type="checkbox" <?php echo $mainobj->GetPostValue("is_remote_typing", "N") == "Y" ? "checked" : "" ?>
                               value="Y" class=""
                               id="is_remote_typing" <?php echo in_array("is_remote_typing", $disabled) ? ' disabled="disabled" ' : ' name="is_remote_typing" '; ?> >

                    </label>
                    <?php /*<span class="form-group-help-block"><?php _e("is_remote_typing");?></span>	*/ ?>
                </div>

            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("is_user_typing", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="is_user_typing"><?php _e("Is User Typing"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">

                <div class="togglebutton ">
                    <input name="is_user_typing" value="N" type="hidden">
                    <label>
                        <input type="checkbox" <?php echo $mainobj->GetPostValue("is_user_typing", "N") == "Y" ? "checked" : "" ?>
                               value="Y" class=""
                               id="is_user_typing" <?php echo in_array("is_user_typing", $disabled) ? ' disabled="disabled" ' : ' name="is_user_typing" '; ?> >

                    </label>
                    <?php /*<span class="form-group-help-block"><?php _e("is_user_typing");?></span>	*/ ?>
                </div>

            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("end_by_type", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="end_by_type"><?php _e("End By Type"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <div class="inline radio-inline">
                    <?php
                    $end_by_type_selected = $mainobj->GetPostValue("end_by_type", "");
                    $end_by_type_isDisabled = in_array("end_by_type", $disabled);
                    GetHTMLRadioByArray("End By Type", "end_by_type", "end_by_type", true, $mainobj->GetPropertyRawOptions("end_by_type"), $end_by_type_selected, $end_by_type_isDisabled);
                    ?>
                    <?php /*<span class="form-group-help-block"><?php _e("end_by_type");?></span>	*/ ?>
                </div>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("end_by", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="end_by"><?php _e("End By"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="10" value="<?php echo $mainobj->GetPostValue("end_by"); ?>"
                       class="form-control"
                       id="end_by" <?php echo in_array("end_by", $disabled) ? ' disabled="disabled" ' : ' name="end_by" '; ?>
                       placeholder="<?php _e("End By"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("End By")); ?>">
                <?php /*<span class="form-group-help-block"><?php _e("end_by");?></span>	*/ ?>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("current_admin_user", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="current_admin_user"><?php _e("Current Admin User"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="2" value="<?php echo $mainobj->GetPostValue("current_admin_user"); ?>"
                       class="form-control"
                       id="current_admin_user" <?php echo in_array("current_admin_user", $disabled) ? ' disabled="disabled" ' : ' name="current_admin_user" '; ?>
                       placeholder="<?php _e("Current Admin User"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Current Admin User")); ?>">
                <?php /*<span class="form-group-help-block"><?php _e("current_admin_user");?></span>	*/ ?>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("start_time", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="start_time"><?php _e("Start Time"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue("start_time"); ?>"
                       class="form-control"
                       id="start_time" <?php echo in_array("start_time", $disabled) ? ' disabled="disabled" ' : ' name="start_time" '; ?>
                       placeholder="<?php _e("Start Time"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("Start Time")); ?>">
                <?php /*<span class="form-group-help-block"><?php _e("start_time");?></span>	*/ ?>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("end_time", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>"
                   for="end_time"><?php _e("End Time"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue("end_time"); ?>"
                       class="form-control"
                       id="end_time" <?php echo in_array("end_time", $disabled) ? ' disabled="disabled" ' : ' name="end_time" '; ?>
                       placeholder="<?php _e("End Time"); ?>" data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e("%s is required", __("End Time")); ?>">
                <?php /*<span class="form-group-help-block"><?php _e("end_time");?></span>	*/ ?>
            </div>
        </div>
    <?php } ?>

        <?php if (!in_array("status", $except)) { ?>
        <div class="form-group">
            <label class="control-label col-md-<?php echo $label_col; ?>" for="status"><?php _e("Status"); ?></label>
            <div class="col-md-<?php echo $input_col; ?>">
                <div class="inline radio-inline">
                    <?php
                    $status_selected = $mainobj->GetPostValue("status", "N");
                    $status_isDisabled = in_array("status", $disabled);
                    GetHTMLRadioByArray("Status", "status", "status", true, $mainobj->GetPropertyRawOptions("status"), $status_selected, $status_isDisabled);
                    ?>
                    <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/ ?>
                </div>
            </div>
        </div>
    <?php } ?>

        <?php
    }


}
?>