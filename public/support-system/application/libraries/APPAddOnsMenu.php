<?php
/**
 * Author: SM Sarwar Hasan
 * @property  MAddonManagerModel MAddonManagerModel
 */

class APPAddOnsMenu
{
    /* @var AppMenu*/
    public $currentMenu;
    /* @var APPAddOns*/
    private $addonObj;
    public function __construct()
    {

    }

    /**
     * @param APPAddOns $addonObj
     * @param $action
     * @param $title
     * @param string $icon
     * @param bool $isGrupMenu
     * @param string $cssClass
     * @param string $menutype
     * @param string $rightText
     * @param string $color
     * @return APPAddOnsMenu
     */
    static function AddAdminMenu(&$addonObj, $title,$icon,$action,$uriParam=[],$param=[], $isGrupMenu=false, $cssClass="", $menutype='ADA', $rightText="", $color=""){

        $thisObj=new self();
        $thisObj->addonObj=$addonObj;
        $url=!empty($action)?$addonObj->getAdminActionURI($action,$uriParam,$param):"";
        $thisObj->currentMenu=AppMenu::AddAddonMenu($menutype,$title,$url,$icon,[],$cssClass,$rightText,$color,$isGrupMenu);
        if(!$isGrupMenu && !empty($url)){
            $thisObj->addonObj->AddResourcePageForACL($action,$title);
        }
        return $thisObj;

    }

    /**
     * @param $privilige
     * @param $title
     * @param $url
     * @param string $icon
     * @param string $cssClass
     * @param array $SelectedPageList
     */
    function AddSubMenu($title,$icon="",$action,$uriParam=[],$param=[], $cssClass="", $menutype='ADA'){
        $url=!empty($action)?$this->addonObj->getAdminActionURI($action,$uriParam,$param):"";
        if(ACL::HasPermission($this->addonObj->getACLSLug($action))){
            $this->currentMenu->AddSubMenu($menutype, $title, $url, $icon, $cssClass, []);
            $this->addonObj->AddResourcePageForACL($action,$title);
        }
    }



}