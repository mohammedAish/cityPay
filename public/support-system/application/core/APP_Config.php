<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APP_Config extends CI_Config {

	/**
	 * CSS URL
	 *
	 * Returns base_url . index_page [. uri_string]
	 *
	 * @uses	CI_Config::_uri_string()
	 *
	 * @param	string|string[]	$uri	URI string or an array of segments
	 * @param	string	$protocol
	 * @return	string
	 */
	public function custom_url($uri = '',$suffix="",$protocol = NULL)
	{
		$base_url = $this->slash_item('base_url');
	
		if (isset($protocol))
		{
			$base_url = $protocol.substr($base_url, strpos($base_url, '://'));
		}
	
		if (empty($uri))
		{
			return $base_url.$this->item('index_page');
		}
	
		$uri = $this->_uri_string($uri);
	
		if ($this->item('enable_query_strings') === FALSE)
		{
				
			if ($suffix !== '')
			{
				if (($offset = strpos($uri, '?')) !== FALSE)
				{
					$uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
				}
				else
				{
					$uri .= $suffix;
				}
			}
	
			return $base_url.$this->slash_item('index_page').$uri;
		}
		elseif (strpos($uri, '?') === FALSE)
		{
			$uri = '?'.$uri;
		}
	
		return $base_url.$this->item('index_page').$uri;
	}
	public function template_url($uri = '',$suffix="",$protocol = NULL)
	{
		$base_url = $this->slash_item('base_url');
		$template=$this->slash_item('theme');
		return $base_url.$template.$uri.$suffix;
	}
	public function check_live(&$uri){
		$panel = get_panel_by_dir();
		if($panel == "C" && function_exists('GetAdminData')) {
			$ci=get_instance();
			if(empty($ci->session)){
				return;
			}
			$adminData = GetAdminData();
			if ( ! empty( $adminData ) && $adminData->IsSuperUser() ) {
				
				if ( ! empty( $_GET['live'] ) && strpos( $uri, 'live=' ) === false ) {
					if ( strpos( $uri, "?" ) === false ) {
						$uri .= '?live=1';
					} else {
						$uri .= '&live=1';
					}
				}
			}
		}
	}
	public function site_url($uri = '', $protocol = NULL)
	{
		
		if(empty($uri)){
			
			$uri= parent::site_url( $uri, $protocol );
			$this->check_live($uri);
			return $uri;
		}else{
			$this->check_live($uri);
		}
		
		return parent::site_url( $uri, $protocol );
	}
	
	
	
}
