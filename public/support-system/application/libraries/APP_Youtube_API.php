<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once dirname(__FILE__)."/gapi/Google_Client.php";
//require_once dirname(__FILE__)."/gapi/service/Exception.php";
//require_once dirname(__FILE__)."/gapi/service/YouTube.php";
//require_once dirname(__FILE__)."/Google/autoload.php";
class APP_Youtube_API {
	/**
	 * @var Google_Client
	 */
	static $gClient=null;
	/**
	 * @var Google_Oauth2Service
	 */
	static $google_oauthV2=null;
	static $hasAccessToken=false;
	function __construct(){
		if(!self::$gClient){
			$ci=get_instance();
			$apikey=Mapp_setting::GetSettingsValue("_g_api_key");
			$client_id=Mapp_setting::GetSettingsValue("_g_client_id");
			$client_secret=Mapp_setting::GetSettingsValue("_g_client_secret");			
			self::$gClient = new Google_Client();
			self::$gClient->setApplicationName($ci->config->item('app_name'));
			self::$gClient->setClientId($client_id);
			self::$gClient->setClientSecret($client_secret);
			self::$gClient->setApprovalPrompt ("force");//auto
			self::$gClient->setAccessType('offline');
			self::$gClient->setDeveloperKey($apikey);
			self::$gClient->setScopes(array('https://www.googleapis.com/auth/youtube.force-ssl', 'https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
			self::$google_oauthV2 = new Google_Service_Oauth2(self::$gClient);
			
			//self::$gClient->getHttpClient()->setDefaultOption('verify', false);
			//self::$gClient->getHttpClient()->setDefaultOption('headers', array('verify' => false));
			$guzzleClient = new \GuzzleHttp\Client(['verify' => dirname(__FILE__)."/ssl/cacert.pem"]);
			self::$gClient->setHttpClient($guzzleClient);
		}
	}
	
	static function GetYoutubeUserInfo($code){
	    $response=new stdClass();
	    $response->status=false;;
	    $response->access_token="";
	    $response->email="";
	    $response->name="";
	    try{
    	    self::$gClient->authenticate($code);
    	    $access_token = self::$gClient->getAccessToken();	
    	    if(!empty($access_token)){	
        	    self::$gClient->setAccessToken($access_token);
        		$Info=self::$google_oauthV2->userinfo->get();
        	    if(!empty($Info['email'])){
            		$response->status=true;
            		$response->access_token=$access_token;
            		$response->email=$Info['email'];
            		$response->name=$Info['name'];
        	    }
    	    }
	    }catch(Exception $ex){
	        AddError($ex->getMessage());
	    }
		return $response;
	}
	static function GetYoutubeUserInfoByToken($access_token){
	    $response=new stdClass();
	    $response->status=false;;
	    $response->access_token="";
	    $response->email="";
	    $response->name="";	 
	    try{
	    if(!empty($access_token)){	
    	    self::$gClient->setAccessToken($access_token);
    		$Info=self::$google_oauthV2->userinfo->get();    		
    	    if(!empty($Info['email'])){
        		$response->status=true;
        		$response->access_token=$access_token;
        		$response->email=$Info['email'];
        		$response->name=$Info['name'];
    	    }
	    }
	    }catch(Exception $ex){
	        AddError($ex->getMessage());
	    }
	    
		return $response;
	}
	static function search($keyword = "", $channel_id = "", $page = ""){
	    $cache_id=md5($keyword ."_". $channel_id."_".$page);
	    
	    $result=get_cache_data($cache_id);
	    if($result){
	        return $result;
	    }
	    
	    
	    
	    $apikey=Mapp_setting::GetSettingsValue("_g_api_key");	   
	    $youtube = new APP_YoutubeSearch(array('key' => $apikey));
	    $params = array( 'q' => $keyword, 'type' => 'video', 'part' => 'id, snippet', 'maxResults' => 50 );
	    if($channel_id != ""){
	        $params['channelId'] = $channel_id;
	    }
	  
	    $nextToken = "";
	    $prevToken = "";
	    $totalResults = "";
	    $resultsPerPage = "";
	    if($page != ""){
	        $search = $youtube->paginateResults($params, $page);
	    }else{
	        $search = $youtube->searchAdvanced($params, true);
	    }
	    if (isset($search['info']['nextPageToken'])) {
	        $nextToken = $search['info']['nextPageToken'];
	    }
	    if (isset($search['info']['nextPageToken'])) {
	        $prevToken = $search['info']['prevPageToken'];
	    }
	    if (isset($search['info']['totalResults'])) {
	        $totalResults = $search['info']['totalResults'];
	    }
	    if (isset($search['info']['resultsPerPage'])) {
	        $resultsPerPage = $search['info']['resultsPerPage'];
	    }
	    $ids = array();
	    if(!empty($search) && isset($search['results']) && !empty($search['results'])){
	        foreach ($search['results'] as $key => $row) {
	            $ids[] = $row->id->videoId;
	        }
	    }
	    if(!empty($ids)){
	        $search = $youtube->getVideosInfo($ids);
	        $results = array( 'data' => $search, 'nextToken' => $nextToken, 'prevToken' => $prevToken, 'resultsPerPage' => $resultsPerPage, 'totalResults' => $totalResults );
	        save_cache_data($cache_id, $results,600);
	        return $results;
	    }else{
	        return false;
	    }
	}
	static function Comment($access_token, $videoId, $text_comment ,&$videoCommentInsertResponse=null){
	    try{	       
	       
	        $service = new Google_Service_YouTube(self::$gClient);	
	        $new_acdessToken=self::$gClient->setAccessToken($access_token);
	        if(self::$gClient->isAccessTokenExpired()){
	            
	        }
	        if($service != false){
	            $commentSnippet = new Google_Service_YouTube_CommentSnippet();
	            $commentSnippet->setTextOriginal($text_comment);
	            $topLevelComment = new Google_Service_YouTube_Comment();
	            $topLevelComment->setSnippet($commentSnippet);
	            $commentThreadSnippet = new Google_Service_YouTube_CommentThreadSnippet();
	            $commentThreadSnippet->setTopLevelComment($topLevelComment);
	            $commentThread = new Google_Service_YouTube_CommentThread();
	            $commentThread->setSnippet($commentThreadSnippet);
	            $commentThreadSnippet->setVideoId($videoId);
	            $videoCommentInsertResponse = $service->commentThreads->insert('snippet', $commentThread);
	            return true;
	        }
	    }
	    catch (Google_Service_Exception $e) {
	        return false;
	    }
	}
}