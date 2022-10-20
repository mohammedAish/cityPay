<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class CORE_Router extends CI_Router{
	function get_route_unique_id($uri=""){		
		if(empty($uri)){
			$uri=$this->directory.$this->class."/".$this->method;
		}
		$uri=strtolower($uri);
		$uri=str_replace("_", "-", $uri);		
		/*if(!empty($uri) && strpos($uri, '/')===FALSE){
			$uri.="/index";			
		}*/
		//echo $uri; die;	
	
		return hash("crc32b",$uri);
		
	}
	function get_route_all_method_unique_id(){		
		return $this->get_route_unique_id($this->directory.$this->class."/*");		
	}
	
	
	/*protected function _set_request($segments = array())
	{	
		$segments = $this->_validate_request($segments);
		print_r($segments);
		die;		
		/*if ($this->translate_uri_dashes === TRUE)
		{
			$segments[0] = str_replace('-', '_', $segments[0]);
			
		}
		parent::_set_request($segments);
		
	}*/
	

}
