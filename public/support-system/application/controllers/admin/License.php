<?php
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
if(!class_exists("License")){
class License extends APP_Controller {


    function __construct(){
        parent::__construct();
        $this->CheckPageAccess("update");
        $this->SetNoNotificaitonAndMessage();
    }
    function index(){  
        if(ISDEMOMODE){
            redirect("admin/dashboard");
            return;
        }     
        if(ACL::HasPermission("admin/license/update")){
            $obj= get_license_info();
            if(!$obj->status){
                redirectAdmin("license/update");
                return;
            }
        }
        if(Mapp_setting::GetSettingsValue("is_first_run","Y")=="Y"){
            Mapp_setting::UpdateSettingsOrAdd("is_first_run", "N");
            Mapp_setting::SetInitialSettings();
            redirectAdmin("admin-setting/general");
        }
        $this->SetTitle("License Info");
        GetMsg();
       // $this->output->unset_template();
       $this->AddViewData("licinfo", get_license_info());
       $this->Display();
    }
    function update(){
        $obj= get_license_info();
        if($obj->status){
            redirectAdmin("license");
            return;
        }
        $cu=GetCurrentUserType();
        if($cu!="AD"){
            $currentUrl=current_url();
            $currentUrl=urlencode($currentUrl);
            if(!empty($currentUrl)){
                $currentUrl='_ru='.$currentUrl;
            }
            redirect('admin/user/login?'.$currentUrl,'auto');
        }
        $this->SetTitle("Enter License Info");
       if(IsPostBack){
           $pcode=PostValue("lic_key");
           if(!empty($pcode)){
              Mapp_setting::UpdateSettingsOrAdd("__isf_check", "Y","-","Y","B");
              Mapp_setting::UpdateSettingsOrAdd("licstr",$pcode,"-","Y");
              redirectAdmin("license");               
           }
       }
       $this->AddViewData("lic_key", Mapp_setting::GetSettingsValue("licstr",""));
       $this->Display();
    }
    function remove(){
       $this->output->unset_template();
       if(ISDEMOMODE){
          redirectAdmin("license");
       }
       if(__remove_licnese()){
           redirectAdmin("license/update");
       }else{
           AddError("Remove failed try again",true);
           redirectAdmin("license");
       }
    }
}
}