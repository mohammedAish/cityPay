<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."hooks/AddOnManager.php";
/**
 * Security Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Security
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/security.html
 */
class APP_Security extends CI_Security {

	public $is_csrf_verified=true;
	public $_csrf_hash_ajax=NULL;
	public $isAjaxRequest=false;
	public $isCssSkipped=false;
	
	function __construct(){
		parent::__construct();
		$this->isAjaxRequest=!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	/**
	 * CSRF Verify
	 *
	 * @return	CI_Security
	 */
	public function csrf_verify()
	{

	    // Check if URI has been whitelisted from CSRF checks
	    if ($exclude_uris = config_item('csrf_exclude_uris'))
	    {
            AddOnManager::DoFilter('csrf-exclude-uris',$exclude_uris);
	        $uri = load_class('URI', 'core');
	        foreach ($exclude_uris as $excluded)
	        {
	            $excluded=trim($excluded);
	            $hasAll=substr($excluded, -1);
	            $mainExc= substr($excluded, 0,-1);
	            if ($hasAll=="*"&& strpos($uri->uri_string(),$mainExc )!==FALSE)
	            {
	                return $this;
	            }
	        }
	    }
	    if((!empty($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT']=="appsbd") || is_cli()){
	    	return $this;	    	
	    }elseif ($this->isAjaxRequest) {	    	   	
			return $this->csrf_verify_ajax();
		}else{		   
			return parent::csrf_verify();
		}
	}
	
	public function csrf_verify_ajax()
	{
		
		// If it's not a POST request we will set the CSRF cookie
		if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST')
		{
			return $this->csrf_set_cookie_ajax();
		}
	
		// Check if URI has been whitelisted from CSRF checks
		if ($exclude_uris = config_item('csrf_exclude_uris'))
		{
			$uri = load_class('URI', 'core');
			foreach ($exclude_uris as $excluded)
			{
				if (preg_match('#^'.$excluded.'$#i'.(UTF8_ENABLED ? 'u' : ''), $uri->uri_string()))
				{
					return $this;
				}
			}
		}
	
		// Do the tokens exist in both the _POST and _COOKIE arrays?
		if ( ! isset($_POST[$this->_csrf_token_name."_ajax"], $_COOKIE[$this->_csrf_cookie_name."_ajax"])
				OR $_POST[$this->_csrf_token_name."_ajax"] !== $_COOKIE[$this->_csrf_cookie_name."_ajax"]) // Do the tokens match?
		{			
			$this->csrf_show_error_ajax();
		}
	
		// We kill this since we're done and we don't want to polute the _POST array
		unset($_POST[$this->_csrf_token_name."_ajax"]);
	
		// Regenerate on every submission?
		if (config_item('csrf_regenerate'))
		{
			// Nothing should last forever
			unset($_COOKIE[$this->_csrf_cookie_name."_ajax"]);
			$this->_csrf_hash_ajax = NULL;
		}
	
		$this->_csrf_set_hash_ajax();
		$this->csrf_set_cookie_ajax();
	
		log_message('info', 'CSRF token verified');
		return $this;
	}
	public function get_csrf_hash_ajax()
	{
		return $this->_csrf_hash_ajax;
	}
	public function csrf_show_error()
	{
		$this->is_csrf_verified=false;	
		if($this->isAjaxRequest){
			$this->csrf_show_error_ajax();
		}	
		show_error('The action you have requested is not allowed.', 403);
	}
	public function csrf_show_error_ajax()
	{
		$this->is_csrf_verified=false;		
		include_once  APPPATH."libraries".DIRECTORY_SEPARATOR."AjaxConfirmResponse.php";
		$er=new AjaxConfirmResponse();
		$er->SetResponse(false, 'The action you have requested is not allowed.',null,false,"Security Error","user-times");
		header('HTTP/1.0 403 Forbidden');
		die(json_encode($er));
	}
	
	protected function _csrf_set_hash()
	{
		$this->_csrf_set_hash_ajax();
		return parent::_csrf_set_hash();
	}
	/**
	 * Set CSRF Hash and Cookie
	 *
	 * @return	string
	 */
	protected function _csrf_set_hash_ajax()
	{
		if ($this->_csrf_hash_ajax === NULL)
		{
			// If the cookie exists we will use its value.
			// We don't necessarily want to regenerate it with
			// each page load since a page could contain embedded
			// sub-pages causing this feature to fail
			if (isset($_COOKIE[$this->_csrf_cookie_name."_ajax"]) && is_string($_COOKIE[$this->_csrf_cookie_name."_ajax"])
					&& preg_match('#^[0-9a-f]{32}$#iS', $_COOKIE[$this->_csrf_cookie_name."_ajax"]) === 1)
			{
				return $this->_csrf_hash_ajax = $_COOKIE[$this->_csrf_cookie_name."_ajax"];
			}
	
			$rand = $this->get_random_bytes(16);
			$this->_csrf_hash_ajax = ($rand === FALSE)
			? md5(uniqid(mt_rand(), TRUE))
			: bin2hex($rand);
		}
	
		return $this->_csrf_hash_ajax;
	}
	public function csrf_set_cookie()
	{
		$this->csrf_set_cookie_ajax();
		return parent::csrf_set_cookie();
	}
	
	
	/**
	 * CSRF Set Cookie
	 *
	 * @codeCoverageIgnore
	 * @return	CI_Security
	 */
	public function csrf_set_cookie_ajax()
	{
		$expire = time() + $this->_csrf_expire;
		$secure_cookie = (bool) config_item('cookie_secure');
	
		if ($secure_cookie && ! is_https())
		{
			$secure_cookie=FALSE;
		}
	
		setcookie(
		$this->_csrf_cookie_name."_ajax",
		$this->_csrf_hash_ajax,
		$expire,
		config_item('cookie_path'),
		config_item('cookie_domain'),
		$secure_cookie,
		config_item('cookie_httponly')
		);
		
		log_message('info', 'CRSF cookie sent');
	
		return $this;
	}
	
	/**
	 * Sanitize Naughty HTML
	 *
	 * Callback method for xss_clean() to remove naughty HTML elements.
	 *
	 * @used-by	CI_Security::xss_clean()
	 * @param	array	$matches
	 * @return	string
	 */
	protected function _sanitize_naughty_html($matches)
	{
		static $naughty_tags    = array(
			'alert', 'area', 'prompt', 'confirm', 'applet', 'audio', 'basefont', 'base', 'behavior', 'bgsound',
			'blink', 'body', 'embed', 'expression', 'form', 'frameset', 'frame', 'head', 'html', 'ilayer',
			'iframe', 'input', 'button', 'select', 'isindex', 'layer', 'link', 'meta', 'keygen', 'object',
			'plaintext', 'script', 'textarea', 'title', 'math', 'video', 'svg', 'xml', 'xss'
		);
		
		static $evil_attributes = array(
			'on\w+', 'xmlns', 'formaction', 'form', 'xlink:href', 'FSCommand', 'seekSegmentTime'
		);
		if(!$this->isCssSkipped){
			$naughty_tags[]='style';
			$evil_attributes[]='style';
		}
		
		// First, escape unclosed tags
		if (empty($matches['closeTag']))
		{
			return '&lt;'.$matches[1];
		}
		// Is the element that we caught naughty? If so, escape it
		elseif (in_array(strtolower($matches['tagName']), $naughty_tags, TRUE))
		{
			return '&lt;'.$matches[1].'&gt;';
		}
		// For other tags, see if their attributes are "evil" and strip those
		elseif (isset($matches['attributes']))
		{
			// We'll store the already fitlered attributes here
			$attributes = array();
			
			// Attribute-catching pattern
			$attributes_pattern = '#'
			                      .'(?<name>[^\s\042\047>/=]+)' // attribute characters
			                      // optional attribute-value
			                      .'(?:\s*=(?<value>[^\s\042\047=><`]+|\s*\042[^\042]*\042|\s*\047[^\047]*\047|\s*(?U:[^\s\042\047=><`]*)))' // attribute-value separator
			                      .'#i';
			
			// Blacklist pattern for evil attribute names
			$is_evil_pattern = '#^('.implode('|', $evil_attributes).')$#i';
			
			// Each iteration filters a single attribute
			do
			{
				// Strip any non-alpha characters that may precede an attribute.
				// Browsers often parse these incorrectly and that has been a
				// of numerous XSS issues we've had.
				$matches['attributes'] = preg_replace('#^[^a-z]+#i', '', $matches['attributes']);
				
				if ( ! preg_match($attributes_pattern, $matches['attributes'], $attribute, PREG_OFFSET_CAPTURE))
				{
					// No (valid) attribute found? Discard everything else inside the tag
					break;
				}
				
				if (
					// Is it indeed an "evil" attribute?
					preg_match($is_evil_pattern, $attribute['name'][0])
					// Or does it have an equals sign, but no value and not quoted? Strip that too!
					OR (trim($attribute['value'][0]) === '')
				)
				{
					$attributes[] = 'xss=removed';
				}
				else
				{
					$attributes[] = $attribute[0][0];
				}
				
				$matches['attributes'] = substr($matches['attributes'], $attribute[0][1] + strlen($attribute[0][0]));
			}
			while ($matches['attributes'] !== '');
			
			$attributes = empty($attributes)
				? ''
				: ' '.implode(' ', $attributes);
			return '<'.$matches['slash'].$matches['tagName'].$attributes.'>';
		}
		return $matches[0];
	}
	public static function xss_clean_keep_css($str, $is_image = FALSE) {
		$ci=get_instance();
		$ci->security->isCssSkipped=true;
		$html=$ci->security->xss_clean($str,$is_image);
		$ci->security->isCssSkipped=false;
		return $html;
	}
	
	
	// --------------------------------------------------------------------
	
	
	

}
