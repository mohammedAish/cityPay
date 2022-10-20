<?php
class APPFirebase{
    private $google_firebase_api_key;
    private $google_firebase_url="https://fcm.googleapis.com/fcm/send";
    function __construct(){
        $CI=get_instance();
        $CI->config->load("firebase");
        $this->google_firebase_api_key=$CI->config->item("google_firebase_api_key");        
    }
    
    function PushNotification($reg_id_or_topic, $data) {
        $isLog=true;        
        $this->google_firebase_url="https://fcm.googleapis.com/fcm/send";
        $sendMessage=is_string($data)?array("message"=>$data):(is_array($data)?$data:array("message"=>"Invalid request"));
    
        $fields = array(
            'priority'					=> "high",
            'data'              =>$sendMessage,
        );
        if(is_array($reg_id_or_topic)){
            $fields['registration_ids'] = $reg_id_or_topic;
        }else{
            $fields['to'] = $reg_id_or_topic;
        }
        if($isLog && function_exists("AddFileLog")){
            AddFileLog("GCM Request".json_encode($fields),true,"gcm.log");
        }
        	
        $headers = array(
            'Authorization: key=' . $this->google_firebase_api_key,
            'Content-Type: application/json'
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->google_firebase_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
        $result = curl_exec($ch);
        if ($result === FALSE) {
             if($isLog && function_exists("AddFileLog")){
                AddFileLog('Problem occurred: ' . curl_error($ch),true,"gcm.log",false);
            }
            return FALSE;
        }
    
        curl_close($ch);
         if($isLog && function_exists("AddFileLog")){
            AddFileLog('GCM Result: ' .$result,true,"gcm.log",false);
        }
            
        return $result;
    }
    
    function register_client_topic($client_token,$topic){
        $isLog=true;
        $topic_url="https://iid.googleapis.com/iid/v1/{$client_token}/rel/topics/{$topic}";
        /*$sendMessage=is_string($data)?array("message"=>$data):(is_array($data)?$data:array("message"=>"Invalid request"));
        
        $fields = array(
            'priority'					=> "high",
            'data'              =>$sendMessage,
        );*/
        /*if(is_array($reg_id_or_topic)){
            $fields['registration_ids'] = $reg_id_or_topic;
        }else{
            $fields['to'] = $reg_id_or_topic;
        }*/
        /*if($isLog && function_exists("AddFileLog")){
            AddFileLog("GCM Request".json_encode($fields),true,"gcm.log");
        }*/
        $fields=array();
        $headers = array(
            'Authorization: key=' . $this->google_firebase_api_key,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $topic_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
        if ($result === FALSE) {
            if($isLog && function_exists("AddFileLog")){
                AddFileLog('Problem occurred: ' . curl_error($ch),true,"gcm.log",false);
            }
            return FALSE;
        }
        
        curl_close($ch);
        if($isLog && function_exists("AddFileLog")){
            AddFileLog('GCM Result: ' .$result,true,"gcm.log",false);
        }
        
        return $result;
    }
    function get_subscription_list($client_token){
        $isLog=true;
        //$topic_url="https://iid.googleapis.com/iid/v1/{$client_token}/rel/topics/{$topic}";
        $topic_url="https://iid.googleapis.com/iid/info/{$client_token}?details=true";
        /*$sendMessage=is_string($data)?array("message"=>$data):(is_array($data)?$data:array("message"=>"Invalid request"));
    
        $fields = array(
        'priority'					=> "high",
        'data'              =>$sendMessage,
        );*/
        /*if(is_array($reg_id_or_topic)){
         $fields['registration_ids'] = $reg_id_or_topic;
         }else{
         $fields['to'] = $reg_id_or_topic;
         }*/
        /*if($isLog && function_exists("AddFileLog")){
         AddFileLog("GCM Request".json_encode($fields),true,"gcm.log");
         }*/
        $fields=array();
        $headers = array(
            'Authorization: key=' . $this->google_firebase_api_key,
            'Content-Type: application/json'
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $topic_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
        $result = curl_exec($ch);
        if ($result === FALSE) {
            if($isLog && function_exists("AddFileLog")){
                AddFileLog('Problem occurred: ' . curl_error($ch),true,"gcm.log",false);
            }
            return FALSE;
        }
    
        curl_close($ch);
        if($isLog && function_exists("AddFileLog")){
            AddFileLog('GCM Result: ' .$result,true,"gcm.log",false);
        }
    
        return $result;
    }
}
?>