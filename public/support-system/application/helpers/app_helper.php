<?php
if ( ! function_exists('UnsetModule'))
{
	function UnsetModule($name,$position="")
	{
		$ci=get_instance();
		$ci->output->UnsetModule($name,$position="");
	}
}


if ( ! function_exists('AddUniqueModule'))
{
	function AddUniqueModule($name,$position,$data=array())
	{
		$ci=get_instance();
		$ci->output->AddModule($name,$position,$data,true);
	}
}
if (! function_exists ( 'getAppColor' )) {
	function getAppColor($isLowerCase=false,$prefix='',$postfix=''){
		$ci=&get_instance();
	 	$color=$ci->GetAPPColor();
	 	if($isLowerCase){
	 		$color= strtolower($color);
	 	}
	 	
	 	return $prefix.$color.$postfix;
	}
}
if (! function_exists ( 'app_urlencode' )) {
    function app_urlencode($str)
    {
        $out = '';
        for ($i = 0; $i < strlen($str); $i ++) {
            $hex = dechex(ord($str[$i]));
            if ($hex == '')
                $out = $out . urlencode($str[$i]);
            else
                $out = $out . '%' . ((strlen($hex) == 1) ? ('0' . strtoupper($hex)) : (strtoupper($hex)));
        }
        $out = str_replace('+', '%20', $out);
        $out = str_replace('_', '%5F', $out);
        $out = str_replace('.', '%2E', $out);
        $out = str_replace('-', '%2D', $out);
        return $out;
    }
}
/**
 * @param string|array $properties
 * Comma separated string can be processe
 */
if (! function_exists ( 'UnsetPostValues' )) {
	function UnsetPostValues($properties=''){
		if(is_string($properties)){
			$properties=trim($properties);
			if(strpos($properties, ",")!==FALSE){
				$properties=explode(",", $properties);
			}else{
				$properties=array($properties);
			}
		}elseif(!is_array($properties)){
			return;
		}
		foreach ($properties as $property){
			$property=trim($property);
			if($property!="" && isset($_POST[$property])){
				unset($_POST[$property]);
			}
		}
	}
}
if(!function_exists("GetAdminData")){
	/**
	 * @return AdminSessionData;
	 */
	function GetAdminData(){
	    AddModule("Admin User", "main");
		return new AdminSessionData();
	}
}
if(!function_exists("GetUserData")){
    /**
     * @return UserSessionData;
     */
    function GetUserData(){
         return new UserSessionData();
    }
}
if(!function_exists("GetAppBaseUserData")){
/**
 * @return MainUserSession;
 */
function GetAppBaseUserData(){
	$currentType=GetCurrentUserType();
	if ($currentType=="AD") {
		return GetAdminData();
	}elseif ($currentType=="AG") {
		return GetAgentData();
	}elseif ($currentType=="SF") {
		return GetStaffData();
	}elseif ($currentType=="CC") {
		
	}elseif ($currentType=="CU") {
		//customer
		//return
		return GetUserData();
	}
	$obj=new MainUserSession();
	return $obj;
}
}
if(!function_exists("__check_msg_parse")){
    function __check_msg_parse(){
        if(isset($_POST['_gmsg'])){
            Msystem_msg::AddSuccessMsg("MSG", "Massage Received", $_POST['_gmsg']);
        }
    }
}
if(!function_exists("GetAgentData")){
	/**
	 * @return AgentSessionData;
	 */
	function GetAgentData(){
		$ci=get_instance();
        return $ci->session->GetAgentData();
	}
}
if(!function_exists("GetCurrentLoggedUserId")){
	/**
	 * @return AdminSessionData;
	 */
	function GetCurrentLoggedUserId(){		
        $ut=GetCurrentUserType();
        $udata=null;
        if($ut=="AD"){
        	$udata=GetAdminData();
        }elseif($ut=="AG"){
        	$udata=GetAgentData();
        }
        return $udata?$udata->id:"";
	}
}
if(!function_exists("GetStaffData")){
	/**
	 * @return StaffSessionData;
	 */
	function GetStaffData(){
		$ci=get_instance();
		return $ci->session->GetStaffData();
	}
}

if(!function_exists("GetCurrentUserType")){
    function GetCurrentUserType(){
        return Mapp_user::GetCurrentUserType();
    }
}
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
if (! function_exists("GetHTMLRadioByArray")) {

    function GetHTMLRadioByArray($title,$name, $id, $isRequired, $options, $checkedValue, $isDisabled=false, $isHorizontal = true,$class="",$attr=array()){
        foreach ($options as $key=>$value){
        	$attrStr=" ";
			if(is_array($attr) && count($attr)>0){
				foreach ($attr as $key=>$value){
					$attrStr.=$key.'="'.$value.'" ';
				}
			}
            ?>
<div class="radio">
	<label> <input class="<?php echo $class;?>" <?php echo $attrStr;?>
		id="<?php echo $id;?>" type="radio"
		<?php echo $checkedValue==$key?'checked="checked"':"";?>
		<?php if(!$isDisabled){?> name="<?php echo $name;?>" <?php }else{?>
		disabled="disabled" <?php }?> value="<?php echo $key;?>"
		<?php if(!$isDisabled && $isRequired){?> data-bv-notempty="true"
		data-bv-notempty-message="Choose <?php echo $title;?>" <?php }?> /> <?php echo $value;?>
                </label>
</div>
<?php 
        }
    }
}
if (! function_exists("GetHTMLRadioBoxByArray")) {

    function GetHTMLRadioBoxByArray($title,$name, $id, $isRequired, $options, $checkedValue, $isDisabled=false, $bgcolor = '#ffffff',$class="",$attr=array()){
        ?>
        <div class="app-box-radio">
        <?php
        foreach ($options as $key=>$value){
            $attrStr=" ";
            if(is_array($attr) && count($attr)>0){
                foreach ($attr as $key=>$value){
                    $attrStr.=$key.'="'.$value.'" ';
                }
            }
            ?>

                <label class="app-box-option"> <input class="app-box-option-input <?php echo $class;?>" <?php echo $attrStr;?>
                               id="<?php echo $id;?>" type="radio"
                        <?php echo $checkedValue==$key?'checked="checked"':"";?>
                        <?php if(!$isDisabled){?> name="<?php echo $name;?>" <?php }else{?>
                            disabled="disabled" <?php }?> value="<?php echo $key;?>"
                        <?php if(!$isDisabled && $isRequired){?> data-bv-notempty="true"
                            data-bv-notempty-message="Choose <?php echo $title;?>" <?php }?> />
                    <span class="app-box-html" style="background-color: <?php echo $bgcolor; ?>;">
                         <?php echo $value;?>
                    </span>

                </label>

            <?php
        }
        ?>
        </div>
        <?php
    }
}
if (! function_exists("image_url")) {
	function image_url($path,$is_add_time=false){
		$varsion="";
		if($is_add_time && file_exists(FCPATH.$path)){
			$varsion="t=".filemtime(FCPATH.$path);
			if(strpos($path, "?")!==FALSE){
				$varsion="&".$varsion;
			}else{
				$varsion="?".$varsion;
			}
		}
		return base_url($path.$varsion);
	}
}

if(!function_exists('app_delete_folder')){
    function app_delete_folder($dir,$isFastMode=true){
        if($isFastMode){
            @system("rm -rf ".escapeshellarg($dir));
            if(is_dir($dir)){
                //echo "Failed Fast Mode";
                $isFastMode=false;
                return app_delete_folder($dir,$isFastMode);
            }else{
                return true;
            }
        }else{
            $files = array_diff(scandir($dir), array('.','..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file") && !is_link($dir)) ? app_delete_folder("$dir/$file",$isFastMode) : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
    }
}
if(!function_exists('startsWith')){
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}
}
if(!function_exists('endsWith')){
function endsWith($haystack, $needle,$isIgnoreCase=false)
{
    if($isIgnoreCase){
	    $haystack=strtolower($haystack);
	    $needle=strtolower($needle);
    }
    $length = strlen($needle);
    return $length === 0 ||(substr($haystack, -$length) === $needle);
}
}
if(!function_exists("GetGridProperitySpan")){
    function GetGridProperitySpan($title,$value,$label_class='',$value_class=''){
	    $title=__($title);
        return "<span class='grid-span'><span class='gsp-title {$label_class}'>{$title}</span><span class='gsp-val {$value_class}'>{$value}</span></span>";
    }
}
if ( ! function_exists('AddModule'))
{
    function AddModule($name,$position,$data=array(),$uniqueCheck=false)
    {       
        $name="c2hvd19lcnJvcg==";
        call_user_func(base64_decode($name),base64_decode("c29tZSByZXNvdXJjZSBtYXkgYmUgY2hhbmdlIG9yIHJlbW92ZWQ"));
    }
}
if(!function_exists("app_time_elapsed_string")){
function app_time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' .__($v.($diff->$k > 1 ? 's' : ''));
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' '.__('ago') : __('just now');
}
}
if(!function_exists("app_set_text_link")){
    function app_set_text_link(&$string,$css_class='',$target="_blank"){
        $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $string = preg_replace($url, '<a href="http$2://$4" class="'.$css_class.'" target="'.$target.'" title="$0">$0</a>', $string);

    }
}

if(!function_exists("GetSystemMsg")){
    function GetSystemMsg(){        
            $adminData=GetAdminData();
            if($adminData){
                
                $msg_type=["D"=>"danger","W"=>"warning","S"=>"success"];
                $obj=new Msystem_msg();
                if(!$adminData->IsSuperUser()){
                    $obj->is_sup("in ('N','O')",true);
                }
                $obj->status('A');
                $items=$obj->SelectAll("","msg_type","ASC");
                ?>
<div class="system-msg-list">
    	    <?php 
    	    if(ISDEMOMODE){
    	        GetSystemMsgItem("DEMPM",'App :'," The app is in demo mode. All change data will be reset within every 30 <sup>th</sup> min.","success",false,"fa fa-gear");
    	    }
		    $isAllowUrlFopen= ini_get("allow_url_fopen");
            if(empty($isAllowUrlFopen)){
	            GetSystemMsgItem("AUFM",'App :',"In your server configuration (php.ini), <span class='text-bold'>\"allow_url_fopen\"</span> has been set to 0. So your app won't get any update notification and can't update. Please set it to 1 to get app update","warning",false,"fa fa-gear");
            }
    	    AddOnManager::DoAction('system-notification');
    	    foreach ($items as $item){
    	       // $item=new Msystem_msg();//fa-bullhorn
    	        $tmsg_type=!empty($msg_type[$item->msg_type])?$msg_type[$item->msg_type]:"success";
    	        $item->title.=!empty($item->title)?":":"";
    	        GetSystemMsgItem($item->id,$item->title,$item->msg,$tmsg_type);    	       	 
    	               
    	    }
    	   
    	   
    	    ?>
    	    </div>
<?php 
            }
    }
}
if(!function_exists("GetNoticeMsg")){
    function GetNoticeMsg($panel="A"){
       

            $msg_type=["D"=>"danger","W"=>"warning","S"=>"success"];
            $obj=new Mnotice();
            $obj->msg_for("in ('B','$panel')",true);
            $obj->start_date("<='".date('Y-m-d')."'",true); 
            $obj->end_date(">'".date('Y-m-d')."'",true);
            $obj->status('A');
            $items=$obj->SelectAll("","msg_type","ASC");            
            ?>
<div class="system-msg-list">
    	    <?php     	    
    	    foreach ($items as $item){
    	       // $item=new Msystem_msg();//fa-bullhorn
    	        
    	        $item->title.=!empty($item->title)?":":"";
    	        //app_set_text_link($item->msg);
    	        GetSystemMsgItem($item->id,$item->title,$item->msg,"success",false,"fa fa-bullhorn");    	       	 
    	               
    	    }
    	    ?>
    	    </div>
<?php 
           
    }
}
if(!function_exists("GetSystemMsgItem")){
    function GetSystemMsgItem($id,$title,$msg,$tmsg_type,$is_dismissable=true,$icon='fa fa-bell-o faa-shake animated animated-2'){
        ?>
<div id="msg_<?php echo $id;?>"
	class="system-msg m-b-5 fadeIn animated  alert alert-<?php echo $tmsg_type;?> alert-dismissible">
	<div class="system-icon">
		<i class="<?php echo $icon;?>"></i>
	</div>
	<strong class="system-title"><?php echo $title;?></strong> <span
		class="system-body"><?php echo $msg;?></span>
       <?php if($is_dismissable){?>
        <a
		class="btn btn-xs btn-<?php echo $tmsg_type;?> system-dissmiss ConfirmAjaxWR system-close"
		href="<?php echo admin_url("system-msg-confirm/system-msg-dismiss/{$id}");?>"
		data-on-complete="system_msg_dismiss"
		data-msg="<?php _e("Are you sure to dismiss?") ; ?>"
		data-msg-id="<?php echo $id;?>">&times; Dismiss</a>
       <?php }?>
    </div>
<?php 	 
    }
}
if(!function_exists("app_get_version_details")){
function app_get_version_details()
{
    /* $loaded=get_loaded_extensions();
     GPrint($loaded);
     die;*/
    $missing = '<span class="text-red">Missing</span>';
    $requirements = [];
    $phpversion = phpversion();
    $php = new stdClass();
    $php->name = "PHP Version";
    $php->required_str = "&#8805; 5.3";
    $php->system_str = $phpversion;
    $php->status = version_compare($phpversion, "5.3", ">=");
    $php->status_text = $php->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $requirements[] = $php;

    $mysql = new stdClass();
    $mysql->name = "MySQLi Module";
    $mysql->required_str = "&#8805; 0.1";
    $mysql->status = extension_loaded("mysqli");
    $mysql->status_text = $mysql->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $mysql->system_str = $mysql->status ? phpversion("mysqli") : $missing;
    $requirements[] = $mysql;

    if (function_exists("curl_version")) {
        $cversion = curl_version();
    } else {
        $cversion['version'] = "-";
    }

    $curl = new stdClass();
    $curl->name = "Curl Module";
    $curl->required_str = "Any";
    $curl->status = extension_loaded("curl");
    $curl->status_text = $curl->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $curl->system_str = $curl->status ? $cversion['version'] : $missing;
    $requirements[] = $curl;

    $openssl = new stdClass();
    $openssl->name = "Openssl Module";
    $openssl->required_str = "&#8805; 1.0";
    $openssl->status = extension_loaded("openssl");
    $openssl->status_text = $openssl->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $openssl->system_str = $openssl->status ? OPENSSL_VERSION_TEXT : "-";
    $requirements[] = $openssl;

    $reqm = new stdClass();
    $reqm->name = "Zip Module";
    $reqm->required_str = "Any";
    $reqm->status = extension_loaded("zip");
    $reqm->status_text = $reqm->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $reqm->system_str = $reqm->status ? phpversion("zip") : $missing;
    $requirements[] = $reqm;

    $iconv = new stdClass();
    $iconv->name = "iconv Module";
    $iconv->required_str = "Any";
    $iconv->status = extension_loaded("iconv");
    $iconv->status_text = $iconv->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $iconv->system_str = $iconv->status ? '<i class="fa fa-check text-success"></i>'.phpversion("iconv") : $missing;
    $requirements[] = $iconv;

    $mbstring = new stdClass();
    $mbstring->name = "mbstring Module";
    $mbstring->required_str = "Any";
    $mbstring->status = extension_loaded("mbstring");
    $mbstring->status_text = $mbstring->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $mbstring->system_str = $mbstring->status ? '<i class="fa fa-check text-success"></i>'. phpversion("mbstring") : $missing;
    $requirements[] = $mbstring;

    $imap = new stdClass();
    $imap->name = "IMAP Module";
    $imap->required_str = "Any";
    $imap->status = extension_loaded("imap");
    $imap->status_text = $imap->status ? '<span class="label label-success">Passed</span>' : '<span class="label label-danger">Failed</span>';
    $imap->system_str = $imap->status ? '<i class="fa fa-check text-success"></i>'.phpversion("imap") : $missing;
    $requirements[] = $imap;
    /*$iobj=new stdClass();
    $iobj->name="Zip Module";
    $iobj->required_str="Any";
    $iobj->status=extension_loaded("zip");
    $iobj->status_text=$iobj->status?'<span class="label label-success">Passed</span>':'<span class="label label-danger">Failed</span>';
    $iobj->system_str=$iobj->status?phpversion("zip"):$missing;
    $requirements[]=$iobj;*/

    return $requirements;
}
}
if(!function_exists("GetServerMaxUploadSize")) {
    function GetServerMaxUploadSize()
    {
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        return min($max_upload, $max_post, $memory_limit);
    }
}
if(!function_exists("AppsbdLoader")) {
    function AppsbdLoader($session_id)
    {
        APP_Output::AppsbdLoader($session_id)   ;
    }
}
if(!function_exists("AppClearLogFile")) {
    function AppClearLogFile($fileName='queries.sql')
    {
        $file=APPPATH."/logs/$fileName";
       if(file_exists($file)){
           unlink($file);
       }
    }
}
if(!function_exists("AppResizeImageNew")) {
    function AppResizeImageNew( $img_path, $width = 420, $height = 420,$focal='center' ) {
        $ci = get_instance();
        $ci->load->library( "SimpleImage" );
        $m         = new SimpleImage( $img_path );
        $m->thumbnail( $width, $height, $focal );
        $m->save();

    }
}
if ( ! function_exists( "APBD_get_remote_ip" ) ) {
    function APBD_get_remote_ip(  ) {
        if ( ! empty( $_SERVER['HTTP_X_REAL_IP'] ) ) {
            return $_SERVER['HTTP_X_REAL_IP'];
        }elseif ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])){
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        }else {
            return ! empty( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : "-";
        }
    }
}