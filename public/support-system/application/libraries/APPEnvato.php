<?php
class APPEnvato {
	private $bearerToken="";
	function __construct($token=""){
		//"oVi4yPxk1bJ64Y2qOsLJ2D2ZlC3FpK4L";
		if(!empty($token)){
			$this->SetToken($token);
		}
	}
	function SetToken($token){
		$this->bearerToken=$token;
	}
	function getSales(){
		$url='https://api.envato.com/v3/market/author/sales?page=1';
		$data=$this->apicall($url);
		$i=1;
		foreach ($data as $d){
			unset($d->item->description);
			unset($d->item->attributes);
			unset($d->item->previews);
			GPrint($d);
			//echo $i++."---".$d->item->id." ".$d->amount." ".$d->sold_at."<br/>";
			break;
		}
	}
	function getInfo(){
		$url='https://api.envato.com/v1/market/private/user/account.json';
		echo $this->apicall($url);
	}
	function getCodeCanyonPurchaseKey($purchase_code){
		$purchase_code=urlencode($purchase_code);
		//$url="https://api.envato.com/v1/market/private/user/verify-purchase:'.$purchase_code.'.json";		
		$url="https://api.envato.com/v3/market/author/sale?code=$purchase_code";
		$data=$this->apicall($url);
		//GPrint($data);
	}
	public function getCodeCanyonPurchaseKey2($purchase_Key){			
			$url='http://marketplace.envato.com/api/edge/appsbd/we/verify-purchase:'.urlencode($purchase_Key).'.json';
			echo $this->apiRequest($url);	
	}
	function apiRequest($url, $data=array())
	{
	
		$useragent="Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36";
	
		$req = curl_init();
		curl_setopt($req, CURLOPT_URL, $url);
		curl_setopt($req, CURLOPT_RETURNTRANSFER,1);
		if(count($data)){
			curl_setopt($req, CURLOPT_POST, true);
			curl_setopt($req, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($req, CURLOPT_USERAGENT,$useragent);
		curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
		$result = trim(curl_exec($req));
		curl_close($req);
		return $result;
	}
	private function apicall($url,$postarray=array()){
		$headers=array('Authorization: Bearer '.$this->bearerToken);
		//GPrint($headers);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);			
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		if(count($postarray)>0){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postarray);
		}
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		//print_r($info);		
		curl_close($ch);
		if(!empty($output)){
			$output=json_decode($output);
		}
		return $output;
	
	}
}