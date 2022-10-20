<?php
/**
 * Author: SM Sarwar Hasan
 * @property  MAddonManagerModel MAddonManagerModel
 */

class APPAddOns
{
    /* @var Site*/
    public $controller;
    /* @var MAddonManagerModel*/
    protected $addonModel;
    protected $plugin_file_path;
    protected $plugin_file;
    protected $textDomain;

    /**
     * APPAddOns constructor.
     */
    public function __construct()
    {
        $this->controller=get_instance();
        $this->controller->load->model("MAddonManagerModel");
        $this->addonModel=new MAddonManagerModel();

    }
    function SetTitle($title, $parameter = null, $_ = null)
    {
        $args = func_get_args();
        $title=call_user_func_array([$this,'__'], $args);
	    $this->AddViewData('_title',$title);
    }
    public function AddViewData($key,$value){
        $this->controller->AddViewData($key,$value);
    }
    function SetPopupFromMutipart($isSet=true){
        $this->controller->SetPopupFromMutipart($isSet);
    }
    public function loadModel($modelname)
    {
        $path=$this->plugin_file_path."/models/".$modelname.".php";
        if(file_exists($path)){
            require_once $path;
        }else{
            show_error("Model file doesn't exists:".$path);
        }

    }
    public function ShowLoginPanel()
    {
        $this->controller->SetDisplayType('l');
    }
    public function setPluginPath($file){
        $this->plugin_file=$file;
        $this->plugin_file_path=dirname($file)."/";
    }
    function CheckACL($action,$isReturn=false){
        if(!ACL::HasPermission($this->getACLSLug($action))) {
            if($isReturn){
                return false;
            }
            redirect('error/denied-page','auto');
            die;
        }
        return true;
    }
    function HasPermission($action){
        if(!ACL::HasPermission($this->getACLSLug($action))) {
           return false;
        }
        return true;
    }
    function DisplayPOPUPMsg()
    {
        $this->controller->SetDisplayType('m');
    }
    function DisplayMSGOnly($message='',$redirect_page='',$time=10,$is_success=false)
    {
        $this->controller->SetDisplayType('e');
        $this->controller->setOutputParam([
            "msg" => $message,
            'redirect_page' => $redirect_page,
            'time' => $time,
            'is_success' => $is_success
        ]);
    }
    function Display($viewName='index'){
        $viewName=strtolower($viewName);
        $dir=strtolower(get_class( $this ));
        extract($this->controller->getViewData());
        $output="";
        $dir=strtolower($dir);
        $path=$this->plugin_file_path . "views/". $viewName . ".php";
        if(file_exists($path)){
            ob_start();
            include $path;
            echo ob_get_clean();
        }else{
            show_error("File not exists:".$path);
        }
    }

    /**
     * @param $hook_name
     * @param callable $func
     * Hooks : OnActivate, OnDeactivate, OnAppInit,OnNewTicketOpen,OnNewTicketReply
     */
    final function RegisterHook($hook_name, $func){
        AddOnManager::RegisterHook($hook_name,$func);
    }
	
	/**
	 * @param $action_name
	 * @param callable $func
	 */
	final function RegisterSiteAction($action_name, $func){
       AddOnManager::RegisterAction("site_".$this->getPluginSlug(),$action_name,$func);
    }

    /**
     * @param $action_name
     * @param callable $func
     */
    final function RegisterAdminAction($action_name, $func){
        AddOnManager::RegisterAction("admin_".$this->getPluginSlug(),$action_name,$func);
    }

    function AddResourcePageForACL($action_name, $title){
        //$status, $directory, $controller, $method, $title, $controller_title, $panel="A"){
        $hasAddedResouce=Mapp_setting::GetSettingsValue("adr_".$this->getPluginSlug(),"N")=="Y";
        if(!$hasAddedResouce) {
            Mapp_setting::UpdateSettingsOrAdd("adr_".$this->getPluginSlug(),"Y","ADONREs","Y","B");
            Mpage_list::AddUpdatePage('A', "admin", "addon_" . $this->getPluginSlug(), $action_name, $title, $this->getAddonTitle(), 'A');
        }
    }
    final function getACLSLug($action_name){
        return "addon_".$this->getPluginSlug()."/".$action_name;
    }
    function getPluginSlug(){
        return strtoupper(get_class($this));
    }
    function getAddonTitle(){
        return strtoupper(get_class($this));
    }
    function getSiteActionLink($actionname,$uriParam=[],$param=[]){
        return site_url($this->getSiteActionURI($actionname,$uriParam,$param));
    }
    function getSiteActionURI($actionname,$uriParam=[],$param=[]){
        $uriparamstr="";
        if(!empty($uriParam)) {
            if (is_string($uriParam)) {
                $uriparamstr = '/' . $uriParam;
            } else {
                $uriparamstr = '/' . implode('/', $uriParam);
            }
        }
        $paramstr=!empty($param)?'?'.http_build_query($param):"";
        return 'a/'.$this->getPluginSlug()."/$actionname".$uriparamstr.$paramstr;
    }
    function getAdminActionURI($actionname,$uriParam=[],$param=[]){
        $uriparamstr="";
        if(!empty($uriParam)) {
            if (is_string($uriParam)) {
                $uriparamstr = '/' . $uriParam;
            } else {
                $uriparamstr = '/' . implode('/', $uriParam);
            }
        }
        $paramstr=!empty($param)?'?'.http_build_query($param):"";
        return 'admin/addons/action/'.$this->getPluginSlug()."/$actionname".$uriparamstr.$paramstr;
    }
    function getAdminActionLink($actionname,$uriParam=[],$param=[]){
        return site_url($this->getAdminActionURI($actionname,$uriParam,$param));
    }
    final function __OnActivate()
    {
        $this->OnActivate();
    }
    function OnActivate(){

    }
    function OnInit(){

    }
	function __($string, $parameter = null, $_ = null)
	{
		$args=func_get_args();
		if(empty($this->textDomain)){
			return call_user_func_array("__",$args);
		}else{
			array_unshift($args,$this->textDomain);
			return  call_user_func_array("__a",$args);
		}
	}
    function _e($string, $parameter = null, $_ = null) {
	    $args = func_get_args();
	    echo call_user_func_array( [ $this, "__" ], $args );
	
    }
    final function __OnDelete()
    {
        Mpage_list::DeleteAddonResources("addon_".$this->getPluginSlug());
        $this->OnDelete();
    }
    function OnDelete(){

    }
    final function __OnDeactivate()
    {
        Mapp_setting::UpdateSettingsOrAdd("adr_".$this->getPluginSlug(),"N","ADONREs","Y","B");
        $this->OnDeactivate();
    }
    function OnDeactivate(){

    }
    final function AddCustomFieldValidation($filePath){
        if(empty($this->plugin_file_path)){
            AddError($this->getAddonTitle()." base path doesn't set");
            return false;
        }

        return APP_API::AddAPIByFilePath($this->plugin_file_path.$filePath,'h');
    }
	
	/**
	 * @param mixed $textDomain
	 */
	public function setTextDomain( $textDomain ) {
		$this->textDomain = $textDomain;
		if(is_dir($this->plugin_file_path."/language/")) {
			APPLanguage::loadDomain( $textDomain, $this->plugin_file_path . "/language/" );
		}
	}
	
	protected function SetPOPDisplay($viewName='',$isAjaxContentFirst=true){

    }
    function AddAdminMenuGroup($title,$icon="",$cssClass='', $menutype='ADA', $rightText='', $color=''){
        return self::AddAdminMenu($title,$icon,"",[], [],true, $cssClass, $menutype, $rightText, $color);
    }
    /**
     * @param $menutype
     * @param $title
     * @param string $url
     * @param string $icon
     * @param array $SelectedPageList
     * @param string $cssClass
     * @param string $rightText
     * @param string $color
     * @param bool $isGrupMenu
     * @return APPAddOnsMenu
     */
    function AddAdminMenu($title,$icon,$action,$uriParam=[],$param=[], $isGrupMenu=false, $cssClass="", $menutype='ADA', $rightText="", $color=""){
        return APPAddOnsMenu::AddAdminMenu($this,$title,$icon,$action,$uriParam,$param, $isGrupMenu, $cssClass, $menutype, $rightText, $color);
    }

    function AddSiteMenu($title,$icon,$action,$uriParam=[],$param=[], $isGrupMenu=false, $cssClass="", $rightText="", $color=""){
        $url=!empty($action)?$this->getSiteActionURI($action,$uriParam,$param):"";
        $menu=AddonSiteMenu::AddMenu($this,$title,$url,$icon,[], $cssClass, $rightText, $color,$isGrupMenu);
        AddOnManager::AddSiteMenu($menu);
        return $menu;
    }

    /**
     * @param $table_name
     * @param $query
     */
    function create_table($table_name, $query)
    {
        if(empty($this->addonModel)){
            $this->addonModel=new MAddonManagerModel();
        }
        return $this->addonModel->create_table($table_name,$query);

    }

}