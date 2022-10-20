<?php 
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Addons extends APP_Controller
{

    private $addon_display_type = '';

    function __construct()
    {
        parent::__construct();
        $this->CheckPageAccess();
    }
    function SetDisplayType($type){
        $type=strtolower($type);
        $this->addon_display_type=$type;
    }
    function index()
    {
        $this->SetTitle("Addons");
        $addons = AddOnManager::getAllAddOns();
        $oldPluginData = Mapp_setting_api::GetSettingsValue("addons", "active_addons", serialize([]));
        $oldPluginData = unserialize($oldPluginData);
        foreach ($addons as &$addon) {
            $addon->status = isset($oldPluginData[$addon->file_path]);
        }
        $this->AddViewData('addons', $addons);
        $this->Display();
    }
    function addon_market(){
        $this->SetTitle("Addons You can install");

        $this->Display();
    }

    function action($slug = '', $action_name = '')
    {
        $htmlData = AddOnManager::CallAction('admin_' . $slug, $action_name);
        $this->AddViewData('action_html', $htmlData);
        switch ($this->addon_display_type) {
            case "p":
                $this->DisplayPOPUP('admin/addons/actionpopup');
                break;
            case "m":
                $this->DisplayPOPUPMsg();
                break;
            case "i":
                $this->DisplayPOPUPIframe();
                break;
            default:
                $this->Display('',false);
        }
    }
    public function admin_page($action='',...$args){
        $action=strtolower($action);
        ob_start();
        AddOnManager::DoAction('admin-page-'.$action,$this,$args);
        $this->AddViewData("addon_html",ob_get_clean());
        $this->Display();
    }
    public function admin_ajax($action='',...$args)
    {
        $this->output->unset_template();
        AddOnManager::DoAction('admin-ajax-' . $action, $this, $args);
    }


}
