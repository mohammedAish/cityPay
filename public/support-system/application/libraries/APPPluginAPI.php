<?php
class APPPluginAPI {
	
	static function ResetLicense($lic,$url,$msg="License Removed"){
		# Reset License Key
		# ----------------------------
		$param=array(
			"apbd"=>1,
			"act"=>"r",
			"l"=>hash("crc32b",md5($lic)),
			"m"=>$msg,
			"l"=>hash("crc32b",md5($lic))
		);		
		return self::ProcessRequest($url, $param);
		
	}
	/**
	 * Set APT Param
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function SetParam($lic,$url,$key,$value){		
		$param=array(
		"apbd"=>1,
		"act"=>"ps",
		"pk"=>"$key",
		"pv"=>"$value",
		"l"=>hash("crc32b",md5($lic))
		);
		return self::ProcessRequest($url, $param);
	}
	/**
	 * Del APT Param
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function DelParam($lic,$url,$key){
		$param=array(
				"apbd"=>1,
				"act"=>"pd",
				"pk"=>"$key",
				"l"=>hash("crc32b",md5($lic))
				
		);
		return self::ProcessRequest($url, $param);
	}
	
	/**
	 * Show APT Param
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function ShowParam($lic,$url,$key){
		$param=array(
				"apbd"=>1,
				"act"=>"ph",
				"pk"=>"$key",
				"l"=>hash("crc32b",md5($lic))
	
		);
		return self::ProcessRequest($url, $param);
	}
	
	/**
	 * Deactive APT Param
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function DeactiveParam($lic,$url){
		$param=array(
				"apbd"=>1,
				"act"=>"dp",
				"l"=>hash("crc32b",md5($lic))
		);
		return self::ProcessRequest($url, $param);
	}
	/**
	 * Send Notification
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function SendNotification($lic,$url,$msg,$icon,$time=""){
		$time=empty($time)?time():$time;
		$param=array(
				"apbd"=>1,
				"act"=>"sn",
				"m"=>"$msg",
				"i"=>"$icon",
				"t"=>"$time",
				"l"=>hash("crc32b",md5($lic))
		);
		return self::ProcessRequest($url, $param);
	}
	/**
	 * Send Notification
	 * -----------------------------
	 * @param String $url
	 * @param String $lic
	 */
	static function SendMessage($lic,$url,$msg,$title,$time=""){
		$time=empty($time)?time():$time;
		$param=array(
				"apbd"=>1,
				"act"=>"sm",
				"m"=>"$msg",
				"tl"=>"$title",
				"t"=>"$time",
				"l"=>hash("crc32b",md5($lic))
		);
		return self::ProcessRequest($url, $param);
	}
	
	
	static function ProcessRequest($url,$postparm){
		if(empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
			return;
		}		
		$url=trim($url);
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt( $ch, CURLOPT_POSTREDIR, 3);
		//curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postparm );
		// Execute post
		$result = curl_exec($ch);
		// Close connection
		curl_close($ch);
		if(!empty($result)){
			$result=json_decode($result);
			if($result){
				return $result;
			}
		}		
		return NULL;
	}
	
	
	
}
