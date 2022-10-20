<?php
/**
 * @since: 18/04/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 */

abstract class AppPaymentBase
{
    /**
     * @var AppPaymentBase []
     */
    private static $paymentMethods = [];
    public $ID = "Unknown";
    protected $settings_data = [];

    final function __construct()
    {
        $this->settings_data = Mapp_setting_api::GetSettingsValue($this->ID, "_settings");
        if (!empty($this->settings_data)) {
            $this->settings_data = unserialize(base64_decode($this->settings_data));
        }
        if($this->hasAdminSettingsAccess()) {
            AddOnManager::AddAction("admin-page-" . $this->ID, [$this, "AdminSettings"], 10, 3);
        }
        AddOnManager::AddFilter("role-page-list",[$this,"add_page_role"],10,2);
        AddOnManager::AddFilter("allowed-role-access",[$this,"acl_allowed_list"],10,2);

        AddOnManager::AddAction("admin-ajax-update-" . $this->ID, [$this, "AdminSettingsUpdate"], 10, 3);
        $this->onInit();
    }
    function hasAdminSettingsAccess(){
        return ACL::HasPermissionByPageId($this->getPageId());
    }
    function onInit()
    {

    }
    protected function getPageId()
    {
        return hash('crc32b',"pymt".$this->ID."-settings");
    }

    /**
     * @param $page_list
     * @param Mrole_list [] $role_list
     * @return mixed
     */
    public function add_page_role($page_list,$role_list)
    {
        $resobj = new  stdClass();
        $resobj->res_id = $this->getPageId();
        $resobj->title = $this->getTitle() . " - Settings";
        $resobj->controller_title = "03. Payment Setting";
        foreach ($role_list as $role) {
            $resobj->{$role->role_id}='N';
        }
        $role_access=Mrole_access::FindAllBy("res_id",$resobj->res_id);
        foreach ($role_access as $role_access) {
            $resobj->{$role_access->role_id}=$role_access->status;
        }
        $page_list[]=$resobj;
        return $page_list;
    }
    public function acl_allowed_list($rolearray,$roleId)
    {
        $res_id=$this->getPageId();
        $role_access = Mrole_access::FindBy("res_id", $res_id,["role_id"=>$roleId,"status"=>"Y"]);
        if(!empty($role_access)){
            $rolearray[]=$res_id;
        }

        return $rolearray;
    }
    function getUpdateUrl()
    {
        return admin_addon_ajax_url("update-" . $this->ID);
    }

    public static function RegisterPaymentMethod($method)
    {
        self::$paymentMethods[$method->ID] = $method;
    }

    public static function getActivePaymentMethods($currency='')
    {
        $currency=strtoupper($currency);
        $activePaymentList = [];
        foreach (self::$paymentMethods as $paymentMethod) {
            if ($paymentMethod->isActive() && (empty($currency) || $paymentMethod->is_supported_currency($currency))) {
                $activePaymentList[strtolower($paymentMethod->ID)] = $paymentMethod;
            }
        }
        return $activePaymentList;
    }

    public function AdminSettingsUpdate()
    {
        $ci = get_instance();
        $post_values=AppSecurity::$_POSTData;
        foreach ($post_values as $key=>$val){
            $this->settings_data[$key]=$val;
        }
        $this->settings_data['_up'] = time();
        $response = new AddonAjaxConfirmResponse();
        if ($this->UpdateSettings()) {
            $response->DisplayWithResponse(true, "Successfully updated",null,"",$this->getTitle());
        } else {
            $response->DisplayWithResponse(false, "Updated failed",null,"",$this->getTitle());
        }
    }

    function GetPostValue($name, $default = "", $isXsClean = true)
    {
        $ci = get_instance();
        if (isset($this->settings_data[$name])) {
            $default = $this->settings_data[$name];
        }
        $postvalue = $ci->input->post($name, $isXsClean);
        return !empty($postvalue) ? $postvalue : $default;
    }
   function  GetSettingsValue($name, $default = "")
   {
       if (isset($this->settings_data[$name])) {
           return $this->settings_data[$name];
       }
       return $default;
   }

    function UpdateSettings()
    {
        return Mapp_setting_api::UpdateSettingsOrAdd($this->ID, "_settings", base64_encode(serialize($this->settings_data)),$this->ID."-settings");
    }

    abstract function isActive();

    abstract function getTitle();

    abstract function getButtonImageHTML();

    /**
     * @param $currency
     * @return bool
     */
    abstract function is_supported_currency($currency);

    /**
     * @return []
     */
    abstract function get_supported_currency();

    function AdminSettings($controller,$args){
        ?>
        Not override this method
        <?php
    }
}