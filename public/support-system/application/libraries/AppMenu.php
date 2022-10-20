<?php
class AppMenu{
	/**
	 * @var AppMenu
	 */
	private static $menus=array();
	public static $currentUrl="";
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
	private static $request_url="";
	private static $url_suffix;
	public static $internalMenu=[];
	public static $isMenuLoaded=false;
	function __construct(){
		if(empty(self::$currentUrl)){
			$ci=get_instance();
			self::$currentUrl=$ci->router->directory.$ci->router->class."/".$ci->router->method;
			self::$currentUrl=str_replace("_", "-", self::$currentUrl);
			$url_suffix=$ci->config->item("url_suffix");
			$currenturl=parse_url(current_url());
			if(!empty($currenturl['scheme']) && !empty($currenturl['host']) && !empty($currenturl['path'])){
				$currenturl=$currenturl['scheme']."://".$currenturl['host'].$currenturl['path'];			
				$currenturl=str_replace(array(base_url(),$url_suffix), "", $currenturl);
				self::$request_url=str_replace("_", "-", $currenturl);
			}
			self::$url_suffix=$url_suffix;
				
		}
		
	}
	public static function AddInternalMenu($menutype,$title,$url="",$icon="",$SelectedPageList=array(),$cssClass="",$rightText="",$color="",$isGrupMenu=false){
			$param="";
			if(strpos($url, "?")!==FALSE){
				$param=substr($url, strpos($url, "?"));
				$url=substr($url,0, strpos($url, "?"));
			}
			if(!$isGrupMenu && !ACL::HasPermission($url) && !self::checkParentAccess($url)){
				return null;
			}
			$menu=new self();
			$menu->title=__($title);
			$menu->url=site_url($url).$param;
			$menu->cssClass=$cssClass;
			$menu->iconClass=$icon;
			$menu->isSelected=self::$currentUrl==$url || self::$currentUrl==$url."/index" ||in_array(self::$currentUrl, $SelectedPageList) ;
			$menu->privilige=$title;
			$menu->isGroupMenu=$isGrupMenu;
			$menu->isGroupViewable=!empty($url);
			$menu->rightText=$rightText;
			$menu->rightTextColor=$color;
			$menu->type="M";
			self::$internalMenu[$menutype][]=$menu;
			return $menu;
	}

    public static function AddAddonMenu($menutype,$title,$url="",$icon="",$SelectedPageList=array(),$cssClass="",$rightText="",$color="",$isGrupMenu=false){
        $param="";
        if(strpos($url, "?")!==FALSE){
            $param=substr($url, strpos($url, "?"));
            $url=substr($url,0, strpos($url, "?"));
        }
        $menu=new self();
        $menu->title=__($title);
        $menu->url=site_url($url).$param;
        $menu->cssClass=$cssClass;
        $menu->iconClass=$icon;
        $menu->isSelected=self::$currentUrl==$url || self::$currentUrl==$url."/index" ||in_array(self::$currentUrl, $SelectedPageList) ;
        $menu->privilige=$title;
        $menu->isGroupMenu=$isGrupMenu;
        $menu->isGroupViewable=!empty($url);
        $menu->rightText=$rightText;
        $menu->rightTextColor=$color;
        $menu->type="M";
        self::$internalMenu[$menutype][]=$menu;
        return $menu;
    }

	public static function SetInternalMenuByType($menutype) {
		if(!empty(self::$internalMenu[$menutype])){
			foreach (self::$internalMenu[$menutype] as $me){
				self::$menus[]=$me;
			}
		}
	}
	
	
	/**
	 * @param String $privilige | AD,CC,CU,ALL
	 * @param String $title
	 * @param String $url
	 * @param String $icon
	 * @param String $cssClass
	 * @param String $SelectedPageList
	 * @return AppMenu;
	 */
	public static function AddMenu($privilige,$title,$url="",$icon="",$SelectedPageList=array(),$cssClass="",$rightText="",$color="",$isGrupMenu=false){
		$param="";
		if(strpos($url, "?")!==FALSE){
			$param=substr($url, strpos($url, "?"));
			$url=substr($url,0, strpos($url, "?"));
		}
		$privilige=strtoupper($privilige);
		if(!$isGrupMenu && !ACL::HasPermission($url)){
			return null;
		}
		$menu=new self();
		$menu->title=__($title);
		$menu->url=site_url($url).$param;
		$menu->cssClass=$cssClass;
		$menu->iconClass=$icon;			
		$menu->isSelected=self::$currentUrl==$url || self::$currentUrl==$url."/index" ||in_array(self::$currentUrl, $SelectedPageList) ;
		$menu->privilige=$title;
		$menu->isGroupMenu=$isGrupMenu;
		$menu->isGroupViewable=!empty($url);
		$menu->rightText=$rightText;
		$menu->rightTextColor=$color;
		$menu->type="M";
		self::$menus[]=&$menu;		
		return $menu;
	}
	public static function AddGroupMenu($title,$icon="",$cssClass="",$rightText="",$color=""){
		$privilige="ALL";
		$url="";
		self::AddMenu($privilige, $title,$url,$icon,array(),$cssClass,$rightText,$color,true);
	}
	public static function AddMenuLabel($label){		
		$menu=new self();
		$menu->title=strtoupper($label);
		$menu->title=__($menu->title);
		$menu->type="L";
		self::$menus[]=&$menu;
		return $menu;
	}
	private function isSelectedUrl($url){
		$ccurl=current_url();
		$ccurl=str_replace(array(base_url(),self::$url_suffix), "", $ccurl);
		if($ccurl==$url){
			return true;
		}
		$url=str_replace("_","-", $url);
		return $url==self::$request_url;
	}
	function Disable(){
		$this->isDisabled=true;
	}
	function Enable(){
		$this->isDisabled=false;
	}
	static function checkParentAccess($uri){
        $uris=explode('/',$uri);
        if(count($uris)>3){
            unset($uris[3]);
            $uri=implode('/',$uris);
        }
        return ACL::HasPermission($uri);
    }
	/**
	 * @param String $privilige | AD,CC,CU,ALL
	 * @param String $title
	 * @param String $url
	 * @param String $icon
	 * @param String $cssClass
	 * @param String $SelectedPageList
	 * @return AppMenu;
	 */
	function AddSubMenu($privilige,$title,$url,$icon="fa-circle-o",$cssClass="",$SelectedPageList=array(),$isDontCheckACL=false){
			$param="";
			if(strpos($url, "?")!==FALSE){
				$param=substr($url, strpos($url, "?"));
				$url=substr($url,0, strpos($url, "?"));
			}
			$url=str_replace("_", "-", $url);
			if(count($this->submenus)==0){
				$this->isGroupViewable=false;
			}

			if(!$isDontCheckACL && (!ACL::HasPermission($url) && !ACL::HasPermission($url."/index") && !self::checkParentAccess($url))){
				return null;
			}			
			$menu=new self();
			$menu->title=__($title);
			$menu->url=site_url($url).$param;
			$menu->cssClass=$cssClass;
			$menu->iconClass=$icon;
			/*$menu->currentUrl=self::$currentUrl;
			$menu->uriurl=$url;*/
			$menu->isSelected=self::$currentUrl==$url ||$this->isSelectedUrl($url)||self::$currentUrl==$url."/index" ||in_array(self::$currentUrl, $SelectedPageList) ;			
			$menu->privilige=$title;
			$this->submenus[]=&$menu;
			$menu->type="M";
			if($menu->isSelected){
				$this->isSelected=true;
				$menu->isSubmenuSelected=true;
			}
			$this->isGroupViewable=true;
			return $menu;
	}	
	/**
	 * @return AppMenu[]
	 */
	public static function &GetMenus(){
		self::$isMenuLoaded=true;
		//GPrint(self::$menus); die;
		return self::$menus;
	}
	public static function Clear(){
	    self::$isMenuLoaded=false;
	    //GPrint(self::$menus); die;
	    self::$menus=[];
	}
}

