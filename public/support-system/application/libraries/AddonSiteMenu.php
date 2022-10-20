<?php
class AddonSiteMenu {
    public $title;
    public $url;
    public $cssClass;
    public $iconClass;
    public $privilige;
    public $isSelected=false;
    public $isSubmenuSelected=false;
    public $isGroupMenu=false;
    public $isGroupViewable=true;
    public $rightText="";
    public $rightTextColor="";
    public $type="m";
    public $isDisabled=false;
    public $submenus=array();
    public $addonObj=null;

    public static function AddMenu($addonObj,$title,$url="",$icon="",$SelectedPageList=array(),$cssClass="",$rightText="",$color="",$isGrupMenu=false){
        $param="";
        if(strpos($url, "?")!==FALSE){
            $param=substr($url, strpos($url, "?"));
            $url=substr($url,0, strpos($url, "?"));
        }
        $ci=get_instance();
        $url_suffix=$ci->config->item("url_suffix");
        $currenturl=parse_url(current_url());
        if(!empty($currenturl['scheme']) && !empty($currenturl['host']) && !empty($currenturl['path'])){
            $currenturl=$currenturl['scheme']."://".$currenturl['host'].$currenturl['path'];
            $currenturl=str_replace(array(base_url(),$url_suffix), "", $currenturl);
            $currenturl=str_replace("_", "-", $currenturl);
        }
        $menu=new self();
        $menu->addonObj=$addonObj;
        $menu->title=__($title);
        $menu->url=site_url($url).$param;
        $menu->cssClass=$cssClass;
        $menu->iconClass=$icon;
        $menu->isSelected=$currenturl==$url || $currenturl==$url."/index" ||in_array($currenturl, $SelectedPageList) ;
        $menu->isGroupMenu=$isGrupMenu;
        $menu->isGroupViewable=!empty($url);
        $menu->rightText=$rightText;
        $menu->rightTextColor=$color;
        $menu->type="M";
        return $menu;
    }
}