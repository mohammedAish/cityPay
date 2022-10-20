<?php
require_once FCPATH."/application/libraries/APPAddOns.php";
class AddOnManager
{
    private static $loadedAddons = [];
    private static $actions=[];
    private static $filters=[];
    private $file_headers;
    static $selfObj;
    private static $hooks = [];
    /* @var AddonSiteMenu [] */
    private static $site_links = [];

    function __construct()
    {


    }

    /**
     * @param $hook_name
     * @param callable $func
     * Hooks : OnActivate, OnDeactivate, OnAppInit,OnNewTicketOpen,OnNewTicketReply
     */
    static function RegisterHook($hook_name, $func, $priority=10, $lengthOfParam=1)
    {
        if (is_callable($func)) {
            $std=new stdClass();
            $std->lop=$lengthOfParam;
            $std->callable=$func;
            if(!isset(self::$hooks[$hook_name])){
                self::$hooks[$hook_name]=[];
                self::$hooks[$hook_name][$priority]=[];
            }
            self::$hooks[$hook_name][$priority][] = $std;
        }
    }

    /**
     * @param $action_name
     * @param callable $func
     * @param int $priority
     * @param int $lengthOfParam
     */
    static function AddAction($action_name, $func, $priority=10, $lengthOfParam=1)
    {
        self::RegisterHook($action_name,$func, $priority, $lengthOfParam);
    }
    static function RegisterAction($plugin_slug, $action_name, $func, $priority=10, $lengthOfParam=1)
    {
        $ind = strtolower($plugin_slug . '_' . $action_name);
        if (is_callable($func)) {
            $std=new stdClass();
            $std->lop=$lengthOfParam;
            $std->callable=$func;
            self::$actions[$ind][$priority][] = $std;
        }
    }

    /**
     * @param $filter_name
     * @param callable $func
     * @param int $priority
     * @param int $lengthOfParam
     */
    static function AddFilter($filter_name, $func, $priority=10, $lengthOfParam=1)
    {
        $ind = strtolower($filter_name);
        if (is_callable($func)) {
            $std=new stdClass();
            $std->lop=$lengthOfParam;
            $std->callable=$func;
            if(!isset(self::$filters[$filter_name])){
                self::$filters[$filter_name]=[];
                self::$filters[$filter_name][$priority]=[];
            }
            self::$filters[$filter_name][$priority][] = $std;
        }
    }
    static function RegisterFilter($action_name, $func, $priority=10, $lengthOfParam=1)
    {
        self::AddFilter($action_name,$func,$priority,$lengthOfParam);
    }
    static function CallAction($plugin_slug, $action_name)
    {
        $ci=get_instance();
        // $ci->uri=new CI_URI();
        $params=$ci->uri->segment_array();
        $params = array_values($params);
        if(get_class($ci)=="Addons"){
            $params=array_splice($params,5);
        }else{
            if(!empty($params[0]) && strtolower($params[0])=="a"){
                $params=array_splice($params,3);
            }else {
                $params = array_splice($params, 4);
            }
        }
        $ind = strtolower($plugin_slug . '_' . $action_name);
        if (isset(self::$actions[$plugin_slug . '_' . $action_name]) && is_callable(self::$actions[$plugin_slug . '_' . $action_name])) {
            ob_start();
            call_user_func_array(self::$actions[$ind],$params);
            return ob_get_clean();
        } else {
            return __("No action found");
        }

    }

    static function CallHook( ...$args)
    {
        call_user_func_array("self::DoAction", $args);
    }
    static function DoAction($hook_name, ...$args){
        if (isset(self::$hooks[$hook_name])) {
            ksort(self::$hooks[$hook_name]);
            foreach (self::$hooks[$hook_name] as $pri_array) {
                foreach ($pri_array as $hook) {
                    if (is_callable($hook->callable)) {
                        if($hook->lop>0){
                            if(count($args) > $hook->lop) {
                                $nargs = array_splice($args, 0, $hook->lop);
                            }else{
                                $nargs=$args;
                            }
                        }else{
                            $nargs=[];
                        }
                        call_user_func_array($hook->callable, $nargs);
                    }
                }
            }

        }
    }
    static function CallHookRef($hook_name,&...$args)
    {
        if (isset(self::$hooks[$hook_name])) {
            ksort(self::$hooks[$hook_name]);
            foreach (self::$hooks[$hook_name] as $pri_array) {
                foreach ($pri_array as $hook) {
                    if (is_callable($hook->callable)) {
                        call_user_func_array($hook->callable, $args);
                    }
                }
            }
        }
    }

    /**
     * @param $hook_name
     * @param mixed ...$args
     */
    static function DoFilter($hook_name,...$args)
    {
        //$args = func_get_args();
        //unset($args[0]);

        $return_value=$args[0];
        if (isset(self::$filters[$hook_name])) {
            ksort(self::$filters[$hook_name]);
            foreach (self::$filters[$hook_name] as $pri_array) {
                foreach ($pri_array as $hook) {
                    if (is_callable($hook->callable)) {

                        if ($hook->lop > 1) {
                            if (count($args) > $hook->lop) {
                                $nargs = array_splice($args, 0, $hook->lop);
                            } else {
                                $nargs = $args;
                            }
                        } else {
                            $nargs = [];
                            $nargs[]  = $args[0];
                        }
                        $return_value = call_user_func_array($hook->callable, $nargs);
                        if (gettype($args[0]) == gettype($return_value)) {
                            $args[0] = $return_value;
                        }

                    }
                }
            }

        }
        return $return_value;
    }

    static function ReadDir($dir, &$plugins = [], $label = 0)
    {
        $label++;
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                if ($label <= 1) {
                    self::ReadDir($file, $plugins, $label);
                }
            } else {
                $data = self::getPluginFileData($file);
                if (!empty($data['Name'])) {
                    $addonInfo = new stdClass();
                    $addonInfo->name = $data['Name'];
                    $addonInfo->description = $data['Description'];
                    $addonInfo->author = $data['Author'];
                    $addonInfo->version = $data['Version'];
                    $addonInfo->authorURI = $data['AuthorURI'];
                    $addonInfo->file_path = str_replace(FCPATH . 'addons/', '', $file);
                    $plugins[] = $addonInfo;
                }
            }
        }
        return $plugins;
    }

    static function getAllAddOns()
    {
        $addons = self::ReadDir(FCPATH . 'addons');
        return $addons;
    }


    /**
     * @return AddonSiteMenu[]
     */
    public static function getSiteLinks()
    {
        return self::$site_links;
    }

    /**
     * @param AddonSiteMenu $AddonSiteMenu
     */
    public static function AddSiteMenu(&$AddonSiteMenu)
    {
        self::$site_links[] = $AddonSiteMenu;
    }

    static function getAllActiveAddons()
    {
        $oldPluginData = Mapp_setting_api::GetSettingsValue("addons", "active_addons", serialize([]));
        return unserialize($oldPluginData);
    }

    static function saveAllActiveAddons($oldPluginData)
    {
        return Mapp_setting_api::UpdateSettingsOrAdd("addons", "active_addons", serialize($oldPluginData), "active addons", 'Y', 'T');
    }

    static function getPluginInfo($file)
    {
        $addonInfo = new stdClass();
        $addonInfo->name = "";
        $addonInfo->description = "";
        $addonInfo->author = "";
        $addonInfo->version = "";
        $addonInfo->authorURI = "";
        $addonInfo->file_path = "";

        $data = self::getPluginFileData($file);
        if (!empty($data['Name'])) {
            $addonInfo = new stdClass();
            $addonInfo->name = $data['Name'];
            $addonInfo->description = $data['Description'];
            $addonInfo->author = $data['Author'];
            $addonInfo->version = $data['Version'];
            $addonInfo->authorURI = $data['AuthorURI'];
            $addonInfo->file_path = str_replace(FCPATH . 'addons/', '', $file);
        }
        return $addonInfo;
    }

    public static function getPluginFileData($file)
    {
        $ext = strtolower(substr($file, -4));
        if ($ext !== '.php') {
            return null;
        }
        $default_headers = array(
            'Name' => 'Name',
            'Description' => 'Description',
            'Author' => 'Author',
            'AuthorURI' => 'Author URI',
            'Version' => 'Version'
        );
        $fp = fopen($file, 'r');
        $file_data = fread($fp, 8192);
        fclose($fp);
        $file_data = str_replace("\r", "\n", $file_data);
        $all_headers = $default_headers;

        foreach ($all_headers as $field => $regex) {
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $file_data, $match)
                && $match[1])
                $all_headers[$field] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            else
                $all_headers[$field] = '';
        }

        return $all_headers;
    }

    function LoadAddOns()
    {
        require_once APPPATH."/helpers/addon_helper.php";
        $actionsaddons = self::getAllActiveAddons();
        foreach ($actionsaddons as $key => $actionsaddon) {
            if (file_exists(FCPATH . "/addons/" . $key)) {
                require_once FCPATH . "/addons/" . $key;
            }
        }
        $this->LoadDefaults();
    }
    function LoadDefaults(){
        $paypal=new APPPaypal();
        $stripe=new APPStripe();
        $paddle=new APPPaddle();
        AppPaymentBase::RegisterPaymentMethod($paypal);
        AppPaymentBase::RegisterPaymentMethod($stripe);
        AppPaymentBase::RegisterPaymentMethod($paddle);
        AddOnManager::DoAction("init");
        AddOnManager::DoAction('register-payment-method');
    }
    function PreController(){

    }
    function PostCallBack()
    {
        $ci=get_instance();
        $dir="";
        if(!empty($ci->router->directory)){
            $dir=$ci->router->directory."_";
        }
        self::CallHook(strtolower($dir.$ci->router->class."_".$ci->router->method));


    }

    static function CallBeforeModuleLoad(){
        $ci=get_instance();
        $dir="";
        if(!empty($ci->router->directory)){
            $dir=$ci->router->directory."_";
        }
        self::CallHook(strtolower($dir.$ci->router->class."_".$ci->router->method."_before_module"));
    }


}