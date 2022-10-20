<?php
class ProviderSession{
    public $id;
    public $name;
    
    public static function set_session_provider(){
       $ci=get_instance();
       $provider_obj=new self();
       $provider_obj->id="P001";
       $provider_obj->name="Provider";
       $ci->session->SetSession("provider_session", $provider_obj);
    } 
     public static function get_session_provider(){
       $ci=get_instance();   
       $provider= $ci->session->GetSession("provider_session");
       if($provider instanceof  self){
           return $provider;
       }
       return NULL;
    }
    public static function get_session_provider_id(){
        return 'AA';
       $ci=get_instance();
       $provider= $ci->session->GetSession("provider_session");
       if($provider instanceof  self){
           return $provider->id;
       }
       return NULL;
    }
    
        
}