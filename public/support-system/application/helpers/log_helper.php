<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('AddLog'))
{	
	function AddFullLog($uri = '',$version='',$protocol = NULL)
	{
		
	}
}
if ( ! function_exists('AddLog'))
{
	function AddLog($changed_type,$changed_value,$msg_code,$msg_param="",$member_id="",$agent_id="",$user="",$role="",$tag="")
	{
	    $changed_value=strlen($changed_value)>250?substr($changed_value, 0,247)."...":$changed_value;
		return Mapp_log::AddLog($changed_type, $changed_value, $msg_code,$msg_param,$member_id,$agent_id,$tag,$user,$role);
	}
}
if (! function_exists ( 'alluser_url' )) {
	/**
	 * Admin URL
	 *
	 * Create a local URL based on your basepath. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @param string $uri
	 * @param string $protocol
	 * @return string
	 */
	function alluser_url($uri = '', $protocol = NULL) {
		$uri = "alluser/" . $uri;
		return site_url ( $uri, $protocol );
	}
}
if ( ! function_exists('AddFileLog'))
{
	function AddFileLog($str,$isAddLog=true,$log_file_name="app_log.log",$dont_add_time=false)
	{
		if(!$isAddLog){
			return;
		}
		if(!is_string($str)){
			$str=print_r($str,true);
		}
		$path = APPPATH."logs".DIRECTORY_SEPARATOR;
		if(!is_dir($path)){
		    mkdir($path,0740,true);
		}
		if(is_writable($path)){			
			$path.=$log_file_name;
			//if (is_writable($filename)) {
			if(file_exists($path) && filesize($path) > (1024 * 500)){
				unlink($path);
			}
			if(!empty($str)){
				$fh = fopen($path, 'a');
				if($fh){
					$wrata="";
					if(!$dont_add_time){				
					$wrata="-----------".(date('Y-m-d h:i:s A'))."------------\n";
					}
					$wrata.="{$str}\n";
					
					fwrite($fh, $wrata);
					fclose($fh);
				}
			}
		}
	}
}
if ( ! function_exists('AddFileDebugLog'))
{
	function AddFileDebugLog($str,$dont_add_time=true)
	{
		if(ENVIRONMENT=="production"){
			return;
		}
		$log_file_name="debug_log.log";
		if(!is_string($str)){
			$str=print_r($str,true);
		}
		$path = APPPATH."logs".DIRECTORY_SEPARATOR;
		if(!is_dir($path)){
			mkdir($path,0740,true);
		}
		if(is_writable($path)){
			$path.=$log_file_name;
			//if (is_writable($filename)) {
			if(file_exists($path) && filesize($path) > (1024 * 500)){
				unlink($path);
			}
			if(!empty($str)){
				$fh = fopen($path, 'a');
				if($fh){
					$wrata="";
					if(!$dont_add_time){
						$wrata="-----------".(date('Y-m-d h:i:s A'))."------------\n";
					}
					$wrata.="{$str}\n";
						
					fwrite($fh, $wrata);
					fclose($fh);
				}
			}
		}
	}
}

