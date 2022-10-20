<?php
class APPEncryptionLib {
    public $key="TEST";
    private $cipher="AES-256-CBC";
	function __construct(){
	    $ci=get_instance();
	    $this->key=$ci->config->item("app_enc_key");
	}
	
	function encrypt($plaintext){
	    $plaintext=rand(10, 99).$plaintext.rand(10, 99);
	    $ivlen = openssl_cipher_iv_length($this->cipher);
	    $ivstr=hash('sha256',$this->key);
	    if($ivlen>64 && $ivlen <=128){
	        $ivstr.=hash('sha256',$ivstr);
	    }elseif($ivlen>256 && $ivlen <=512){
	        $ivstr.=hash('sha256',$ivstr);
	        $ivstr.=$ivstr;
	    }	  
	    $iv=substr($ivstr, 0,$ivlen);
	    $key=get_app_title();
	    $key=md5($key);	      
	    $ciphertext_raw = openssl_encrypt($plaintext, $this->cipher, $key, OPENSSL_RAW_DATA, $iv);
	    $ciphertext = base64_encode($ciphertext_raw );	    
	   return $ciphertext;
	}
	function decrypt($ciphertext){
	    $ivlen = openssl_cipher_iv_length($this->cipher);
	    $ivstr=hash('sha256',$this->key);	     
	    if($ivlen>64 && $ivlen <=128){
	        $ivstr.=hash('sha256',$ivstr);
	    }elseif($ivlen>256 && $ivlen <=512){
	        $ivstr.=hash('sha256',$ivstr);
	        $ivstr.=$ivstr;
	    }
	   
	    $iv=substr($ivstr, 0,$ivlen);
	    $key=get_app_title();
	    $key=md5($key);	
	    $c = base64_decode($ciphertext);	
	    $original_plaintext = openssl_decrypt($c, $this->cipher, $key, OPENSSL_RAW_DATA, $iv);	
	    $original_plaintext=substr($original_plaintext, 2,-2);
	   return $original_plaintext; 	
	}	
	function encryptObj($obj){
	   $text=serialize($obj);
	   return $this->encrypt($text);
	}
	function decryptObj($ciphertext){
	    $text=$this->decrypt($ciphertext);
	    return unserialize($text);
	}
}