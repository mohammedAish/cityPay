<?php
	class APPIPdata
	{
		public $ip; //String
		public $country_code; //String
		public $country_name; //String
		public $region_code; //String
		public $region_name; //String
		public $city; //String
		public $zip_code; //String
		public $time_zone; //String
		public $latitude; //double
		public $longitude; //double
		//public $metro_code; //int
		private static $loadedIpData=[];
		/**
		 * @param string $obj
		 * @return APPIPdata
		 */
		private static function getInstanceByFreegeoipObject($obj=null){
			$robj=new self();
			if(!is_object($obj)){
				return $robj;
			}
			foreach ($obj as $key=>$value){
				//echo $key;
				if(property_exists($robj, $key)){
					$robj->$key=$value;
				}
			}
			return $robj;
		}
		/**
		 * @param string $obj
		 * @return APPIPdata
		 */
		private static function getInstanceByIPAPIObject($obj=null){
			$robj=new self();
			if(!is_object($obj)){
				return $robj;
			}
			if(!empty($obj->query)){
				$robj->ip=$obj->query;
			}
			if(!empty($obj->countryCode)){
				$robj->country_code=$obj->countryCode;
			}
			if(!empty($obj->country)){
				$robj->country_name=$obj->country;
			}
			if(!empty($obj->city)){
				$robj->city=$obj->city;
			}
			if(!empty($obj->lat)){
				$robj->latitude=$obj->lat;
			}
			if(!empty($obj->lon)){
				$robj->longitude=$obj->lon;
			}
			if(!empty($obj->regionName)){
				$robj->region_name=$obj->regionName;
			}
			if(!empty($obj->region)){
				$robj->region_code=$obj->region;
			}
			if(!empty($obj->timezone)){
				$robj->time_zone=$obj->timezone;
			}
			if(!empty($obj->zip)){
				$robj->zip_code=$obj->zip;
			}
			return $robj;
		}
		/**
		 * @param string $obj
		 * @return APPIPdata
		 */
		private static function getInstanceByNekudoObject($obj=null){
			$robj=new self();
			if(!is_object($obj)){
				return $robj;
			}
			if(!empty($obj->query)){
				$robj->ip=$obj->query;
			}
			if(!empty($obj->country->code)){
				$robj->country_code=$obj->country->code;
			}
			if(!empty($obj->country->name)){
				$robj->country_name=$obj->country->name;
			}
			if(!empty($obj->city)){
				$robj->city=$obj->city;
			}
			if(!empty($obj->location->latitude)){
				$robj->latitude=$obj->location->latitude;
			}
			if(!empty($obj->location->longitude)){
				$robj->longitude=$obj->location->longitude;
			}
			/* if(!empty($obj->regionName)){
				 $robj->region_name=$obj->regionName;
			 }*/
			/*if(!empty($obj->region)){
				$robj->region_code=$obj->region;
			}*/
			if(!empty($obj->location->time_zone)){
				$robj->time_zone=$obj->location->time_zone;
			}
			if(!empty($obj->zip)){
				$robj->zip_code=$obj->zip;
			}
			return $robj;
		}
		private static function getInstanceDevelopment(){
			$robj=new self();
			$robj->ip="103.9.115.215";
			$robj->country_code = "BD";
			$robj->country_name = "Bangladesh";
			$robj->region_code="";
			$robj->region_name="";
			$robj->city="";
			$robj->zip_code="";
			$robj->time_zone= "Asia/Dhaka";
			$robj->latitude= 23.7;
			$robj->longitude= 90.375;
			return $robj;
		}
		
		/**
		 * @param string $obj
		 * @return APPIPdata
		 */
		private static function getInstanceByIplocateObject($obj=null){
			$robj=new self();
			if(!is_object($obj)){
				return $robj;
			}
			if(!empty($obj->query)){
				$robj->ip=$obj->query;
			}
			if(!empty($obj->country_code)){
				$robj->country_code=$obj->country_code;
			}
			if(!empty($obj->country)){
				$robj->country_name=$obj->country;
			}
			if(!empty($obj->city)){
				$robj->city=$obj->city;
			}
			if(!empty($obj->latitude)){
				$robj->latitude=$obj->latitude;
			}
			if(!empty($obj->longitude)){
				$robj->longitude=$obj->longitude;
			}
			if(!empty($obj->continent)){
				$robj->region_name=$obj->continent;
			}
			/*if(!empty($obj->region)){
				$robj->region_code=$obj->region;
			}*/
			if(!empty($obj->time_zone)){
				$robj->time_zone=$obj->time_zone;
			}
			if(!empty($obj->postal_code)){
				$robj->zip_code=$obj->postal_code;
			}
			return $robj;
		}
		/**
		 * @param String $ip
		 * @return APPIPdata
		 */
		static function get($ip=""){
			if(empty($ip)){
				if(empty($_SERVER['REMOTE_ADDR'])){
					return new self();
				}
				$ip=$_SERVER['REMOTE_ADDR'];
				if(ENVIRONMENT!="production" && ($ip=="127.0.0.1" ||$ip=="192.168.1.100"|| $ip=="::1" ||$ip=="192.168.10.71" || $ip=="192.168.10.1")){
					return self::getInstanceDevelopment();
					
				}
			}
			if(!empty(self::$loadedIpData[$ip])){
				
				return self::$loadedIpData;
			}
			//method1
			/*$freegeoip=@file_get_contents("http://freegeoip.net/json/{$ip}");
			if(!empty($freegeoip)){
				$freegeoip=@json_decode($freegeoip);
			}
			if(!empty($freegeoip->country_code)){
				$ipData=self::getInstanceByFreegeoipObject($freegeoip);
				self::$loadedIpData[$ip]=$ipData;
				return $ipData;
			}*/
			//**/
			//New method1
			/* $ip_api=@file_get_contents("http://geoip.nekudo.com/api/$ip");
			 if(!empty($ip_api)){
				 $ip_api=@json_decode($ip_api);
				 $ipData=self::getInstanceByNekudoObject($ip_api);
				 self::$loadedIpData[$ip]=$ipData;
				 return $ipData;
			 }*/
			
			
			
			//method2
			$ip_api=@file_get_contents("http://ip-api.com/json/$ip");
			if(!empty($ip_api)){
				$ip_api=@json_decode($ip_api);
				$ipData=self::getInstanceByIPAPIObject($ip_api);
				self::$loadedIpData[$ip]=$ipData;
				return $ipData;
			}
			
			//New method3
			$ip_api=@file_get_contents("https://www.iplocate.io/api/lookup/{$ip}");
			if(!empty($ip_api)){
				$ip_api=@json_decode($ip_api);
				$ipData=self::getInstanceByIplocateObject($ip_api);
				self::$loadedIpData[$ip]=$ipData;
				return $ipData;
			}
			return new self();
		}
		
	}

