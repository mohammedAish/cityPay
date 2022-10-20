<?php
class APP_email extends CI_Email {
	public $tls_verify=true;
	public $subject_str="";
	public $bk_config=[];
	function __construct(array $config = array()){			
		$name="";
		if(!empty($config['from_email'])){
			if(!empty($config['from_name'])){
				$name=$config['from_name'];
			}			
			$this->from($config['from_email'],$name);			
		}	
		if(isset($config['tls_verify'])){
			$this->tls_verify=$config['tls_verify'];
		}		
		parent::__construct($config);
		$this->bk_config=$config;
			
	}
	public function reinitialize(){
	    $this->initialize($this->bk_config);
	}
	public function valid_email($str)
	{
		if (function_exists('idn_to_ascii') && preg_match('#\A([^@]+)@(.+)\z#', $str, $matches)) {
			$domain = defined('INTL_IDNA_VARIANT_UTS46')
				? idn_to_ascii($matches[2], 0, INTL_IDNA_VARIANT_UTS46)
				: idn_to_ascii($matches[2]);
			$str = $matches[1] . '@' . $domain;
		}
		return (bool)filter_var($str, FILTER_VALIDATE_EMAIL);
	}
	
	protected function _validate_email_for_shell(&$email)
	{
		if (function_exists('idn_to_ascii') && strpos($email, '@'))
		{
			list($account, $domain) = explode('@', $email, 2);
			$domain =defined('INTL_IDNA_VARIANT_UTS46')
				? idn_to_ascii($domain, 0, INTL_IDNA_VARIANT_UTS46)
				: idn_to_ascii($domain);
			$email = $account.'@'.$domain;
		}
		
		return (filter_var($email, FILTER_VALIDATE_EMAIL) === $email && preg_match('#\A[a-z0-9._+-]+@[a-z0-9.-]{1,253}\z#i', $email));
	}
	public function initialize(array $config = array())
	{	
		
		$name="";
		$config['charset']='utf-8';
		$config['from_name']=Mapp_setting::GetSettingsValue("out_email_name",get_app_title());
		$config['from_email']=Mapp_setting::GetSettingsValue("out_email_from");
		$config['reply_to']=Mapp_setting::GetSettingsValue("out_reply_to_email");
		$config['protocol']=Mapp_setting::GetSettingsValue("out_email_protocol");
		if(empty($config['from_email'])){
		    $config['from_email']=Mapp_setting::GetSettingsValue("app_email");					
		}	
		if(Mapp_setting::GetSettingsValue("out_email_protocol","sendmail")=="sendmail"){
		    $config['mailpath'] = Mapp_setting::GetSettingsValue("mailpath",'/usr/sbin/sendmail');
		}elseif(Mapp_setting::GetSettingsValue("out_email_protocol","sendmail")=="smtp"){
		    $config['smtp_host'] = Mapp_setting::GetSettingsValue("smtp_host");
		    $config['smtp_user'] = Mapp_setting::GetSettingsValue("smtp_user");
		    $config['smtp_pass'] = Mapp_setting::GetSettingsValue("smtp_pass");
		    $config['smtp_port'] = Mapp_setting::GetSettingsValue("smtp_port");
		    if(Mapp_setting::GetSettingsValue("smtp_is_secure","Y")=="Y"){
		    	if(strpos( $config['smtp_host'],'tls://')!==false){
				    $config['smtp_crypto'] = 'tls';//tls or ssl
				    $config['smtp_host']=str_replace('tls://','',$config['smtp_host']);
			    }else{
		    		$ssltype=Mapp_setting::GetSettingsValue("smtp_secure_type","ssl");
		    		if(!empty($ssltype) && in_array($ssltype,['ssl','tls'])){
					    $config['smtp_crypto'] = $ssltype;//tls or ssl
				    }else{
					    $config['smtp_crypto'] = 'ssl';//tls or ssl
				    }
			    }
		     
		    }else{
		        $config['smtp_crypto']='';
		    }		   
		}	
		$reuslt=parent::initialize($config);
		$this->set_newline("\r\n");
		$this->from($config['from_email'],$config['from_name']);
		if(!empty($config['reply_to'])) {
			$this->reply_to( $config['reply_to'], $config['from_name'] );
		}
		if(isset($config['tls_verify'])){
			$this->tls_verify=$config['tls_verify'];
		}
		//GPrint($config);
		//die;
		return $reuslt;
	}	
	protected function _smtp_connect()
	{
		if (is_resource($this->_smtp_connect))
		{
			return TRUE;
		}
	
		$ssl = ($this->smtp_crypto === 'ssl') ? 'ssl://' : '';
	
		$this->_smtp_connect = fsockopen($ssl.$this->smtp_host,
				$this->smtp_port,
				$errno,
				$errstr,
				$this->smtp_timeout);
	
		if ( ! is_resource($this->_smtp_connect))
		{
			$this->_set_error_message('lang:email_smtp_error', $errno.' '.$errstr);
			return FALSE;
		}
	
		stream_set_timeout($this->_smtp_connect, $this->smtp_timeout);
		$this->_set_error_message($this->_get_smtp_data());
	
		if ($this->smtp_crypto === 'tls')
		{
			$this->_send_command('hello');
			$this->_send_command('starttls');
			if(!$this->tls_verify){
				stream_context_set_option($this->_smtp_connect, 'ssl', 'verify_host', FALSE);
				stream_context_set_option($this->_smtp_connect, 'ssl', 'verify_peer_name', FALSE);
				stream_context_set_option($this->_smtp_connect, 'ssl', 'verify_peer', FALSE);
			}
			$crypto = stream_socket_enable_crypto($this->_smtp_connect, TRUE, STREAM_CRYPTO_METHOD_TLS_CLIENT);
	
			if ($crypto !== TRUE)
			{
				$this->_set_error_message('lang:email_smtp_error', $this->_get_smtp_data());
				return FALSE;
			}
		}
	
		return $this->_send_command('hello');
	}
	
	public function send($auto_clear = TRUE){
		if(parent::send($auto_clear)){
			return true;
		}else{
			//$this->print_error_log();
		    $log=$this->print_debugger(array('headers'))	;
		    $log=htmlspecialchars_decode($log);
			Mdebug_log::AddEmailLog("Email Send failed, subject:".$this->subject_str, Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$log);
			return false;
		}
	}
	public function subject($subject)
	{
	    $this->subject_str = $subject;	    
	    return parent::subject($subject);
	}
	public function print_error_log(){
		$path = APPPATH."logs".DIRECTORY_SEPARATOR;
		if(!is_dir($path)){
			mkdir($path,0740,true);
		}
		
		//if (is_writable($filename)) {
		if(file_exists($path) && filesize($path) > (1024 * 500)){
			unlink($path);
		}
		$log=$this->print_debugger(array('headers'))	;	
		$log=htmlspecialchars_decode($log);
		
		if(!empty($log) && is_writable($path)){
			$log= preg_replace('/\<br(\s*)?\/?\>/i', "\n", $log);
			$log= str_replace(array("<pre>","</pre>"), "\n", $log);
			$path.="email_send_error.txt";
			$fh = fopen($path, 'a+');
			if($fh){
				fwrite($fh, "#--".date('Y-m-d h:i:s A')."-------------------------Start--------------------".current_url()."------\n");
				fwrite($fh, $log);				
				fwrite($fh, "#---------------------------end------------------------------------------------------------------------\n\n\n");
				fclose($fh);
			}
		}else{
			echo "Failed to write log";
		}
		
	}
	function sendTestEmail($toEmailAddress){
		$this->to($toEmailAddress);
		$this->subject("Test Email");
		$this->message("This a test email");
		return $this->send(true);
	}
}