<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_update extends APP_Controller{
    public $current_version="0";
    function __construct(){
        parent::__construct();
        $this->load->helper('directory');
        $this->current_version=$this->config->item("app_version");
        $this->CheckPageAccess('site_info,rate_it');
        $this->SetNoNotificaitonAndMessage();
        
    }
    function rate_it(){
        $this->SetTitle("Please Rate it !!");
        $this->SetPOPUPColClass ( "col-md-7 col-sm-10" );
        if(IsPostBack){
            Mapp_setting::UpdateSettingsOrAdd("_rate_status","a");
            $this->DisplayPOPUP("admin/system_update/rating");
            return;
        }
        $this->DisplayPOPUP();
    }
    function thank_you()
    {
        $this->SetTitle("Please Rate it !!");
        $this->SetPOPUPColClass("col-md-7 col-sm-10");
        $this->DisplayPOPUP();
    }
    function rate_status($status='')
    {
        $status=strtolower($status);
        if($status=="a"){ //already
            Mapp_setting::UpdateSettingsOrAdd("_rate_status","a");
        }elseif($status=="r"){ //remind me
            Mapp_setting::UpdateSettingsOrAdd("_rate_status","r");
            Mapp_setting::UpdateSettingsOrAdd("_rate_time",strtotime("+ 1 DAYS"));
        }
    }
    function index(){      
       $this->AddBreadCrumb("Admin Settings", admin_url("admin-settings/general") );
       $this->SetTitle("System Update");
       $json=Mapp_setting_api::GetSettingsValue("SYSTEM", "update_json");
       if(!empty($json)){
           $json=json_decode($json);
           if(!empty($json->new_version)){
               if(version_compare($json->new_version, $this->current_version,"<=")){
                   $json=null;
               }
           }
       }
       if(!empty($json->sections->changelog)){
         Mapp_setting_api::UpdateSettingsOrAdd("system","nvcl", $json->sections->changelog);   
       }
	   
       $this->AddViewData("updateObj", $json);
       $this->Display();
    }
    public function site_info(){
        $this->output->unset_template();
        $this->SetTitle("Site Info");       
        $this->DisplayPOPUPIframe();
    }
    function re_check(){
        Mapp_setting::DeleteSettingsValue("up_last_tried");
        redirect("admin/system-update");
    }
    function updating(){
       $this->SetTitle("System Updating");
       $this->Display();
    }
    
    function process_update($step=1){
        $this->SetTitle("Process Update");
        
        switch ($step){
            case 1:
                $this->step1();
                break;
            case 2:
                $this->step2();
                break;
            case 3:
                $this->step3();
                break;
            case 4:
                $this->step4();
                break;
            case 5:
                $this->step5();
                break;
           default:
               $this->step1();
        }
        
    }
    private function get_update_obj(){
        $json=Mapp_setting_api::GetSettingsValue("SYSTEM", "update_json");
        if(!empty($json)){
            $json=json_decode($json);
            if(!empty($json->new_version)){
                if(version_compare($json->new_version, $this->current_version,"<=")){
                    $json=null;
                }
            }
        }
        return $json;
    }
    private function step1(){
        $isUp=Mapp_setting::GetSettingsValue("sysupp", "N")=="Y";
        $userobj=GetAdminData();
        if($isUp){
            $upUser=Mapp_setting::GetSettingsValue("sysupp_user", $userobj->id);
            if(!empty($upUser) && $upUser!=$userobj->id){
                redirectAdmin("system-update/updating");
            }            
        }
        $json=$this->get_update_obj();
        if(empty($json)){
            redirectAdmin("system-update");
        }
        $this->session->SetSession("up_obj", $json);
        $this->AddViewData("updateObj", $json);
        
        Mapp_setting::UpdateSettingsOrAdd("sysupp", "Y","-");      
        Mapp_setting::UpdateSettingsOrAdd("sysupp_user", $userobj->id,"-");
        Mapp_setting::UpdateSettingsOrAdd("sysupp_time", time(),"-");
        $this->Display();
    } 
    private function get_file_path(){
        $userdata=GetAdminData();
        $fullpath=FCPATH."tmp/user_".$userdata->id."/";
        if(!is_dir($fullpath)){
            app_make_dir($fullpath,0777,true);
        }
       
        return $fullpath;
    }
    
    private function step2(){        
        //downloading
       $this->output->unset_template();
       $isUp=Mapp_setting::GetSettingsValue("sysupp", "N")=="Y";
       $response=new AjaxConfirmResponse();
       if($isUp){         
           $obj=$this->session->GetSession("up_obj");
           $url=$obj->download_link;           
           $fullpath=$this->get_file_path();
           $filename=$fullpath."/app-update.zip";
           if(file_exists($filename)){
            unlink($filename);
           }
           if(file_put_contents($filename, fopen($url, 'r'))===FALSE){              
               Mapp_setting::DeleteSettingsValue("sysupp");              
               $this->session->UnsetSession("up_obj");
               $response->DisplayResponse(false, "Update download failed",50);
               return;
           }else{
            $response->DisplayResponse(true, "completed",50);
           }
       }else{
           redirect("system-update/process_update");
       } 
    }
    private function step3(){
        //unzipping updating      
       $this->output->unset_template();
       $isUp=Mapp_setting::GetSettingsValue("sysupp", "N")=="Y";
       $response=new AjaxConfirmResponse();
       if($isUp){                   
           $fullpath=$this->get_file_path();
           $filename=$fullpath."/app-update.zip";
           $zip = new ZipArchive();
           if ($zip->open($filename) === TRUE)
           {
               $zip->extractTo($fullpath."/app-update");
               $zip->close();
               unlink($filename);
           }else{
               Mapp_setting::DeleteSettingsValue("sysupp");             
               $this->session->UnsetSession("up_obj");
               $response->DisplayResponse(false, "Unzip process failed",50);
               return;
           }
           $response->DisplayResponse(true, "completed",65);
       }else{
           redirect("system-update/process_update");
       };
    } 
    private function step4(){
        //database updating       
       $this->output->unset_template();
       $isUp=Mapp_setting::GetSettingsValue("sysupp", "N")=="Y";
       $response=new AjaxConfirmResponse();
       $sqlss="";
       if($isUp){
           $fullpath=$this->get_file_path();
           $mainDirPath=$fullpath."app-update/";
           if(is_dir($mainDirPath)){
               if(file_exists($mainDirPath."update.json")){
                   $upjson=file_get_contents($mainDirPath."update.json");
                   if(!empty($upjson)){
                       $upjson=json_decode($upjson);
                       if(!empty($upjson->sql) && count($upjson->sql)>0){
                           foreach ($upjson->sql as $sq){
                               if(!empty($sq->queries) && is_array($sq->queries) && count($sq->queries)>0 && version_compare($this->current_version, $sq->version,"<")){
                                   //process
                                   $sqobj=new Msystem_msg();
                                   foreach ($sq->queries as $q){
                                       $sqlss=$q.";";
                                       $isOk=$sqobj->GetSelectDB()->query($q);
                                       if(!$isOk){
                                           $error=$sqobj->GetSelectDB()->error();                                           
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
               if(file_exists($mainDirPath."upquery.sql")){
                   if(file_exists(APPPATH."libraries/AppDBFile.php")){
                        $obj=new AppDBFile();
                	    if(@$obj->processSQLFile($mainDirPath."upquery.sql")){
                	       
                	    }
                   }
               }
           }
           $response->DisplayResponse(true, $sqlss,80);
       }else{
           redirect("system-update/process_update");
       };
    }
    private function step5(){
        //finished
        sleep(5);
       $this->output->unset_template();
       $isUp=Mapp_setting::GetSettingsValue("sysupp", "N")=="Y";
       $response=new AjaxConfirmResponse();
       if($isUp){
           $fullpath=$this->get_file_path();
           $mainDirPath=$fullpath."/app-update/";
           if(is_dir($mainDirPath)){
               $this->process_update_from_path($mainDirPath);
           }
           Mapp_setting::DeleteSettingsValue("sysupp");
           app_delete_folder($mainDirPath);
           Msystem_msg::DismissByTag("UPDATE");
           Mapp_setting::DeleteSettingsValue("up_last_tried");
           Mapp_setting_api::DeleteSettingsValue("SYSTEM", "update_json");
           Mapp_setting::SetInitialSettings();
           $this->session->UnsetSession("up_obj");
           $response->DisplayResponse(true, "completed",100);
           
       }else{
           redirect("system-update/process_update");
       };
    }
    function test(){
       /* $fullpath=$this->get_file_path();
        $mainDirPath=$fullpath."app-update/";
        $this->process_update_from_path($mainDirPath);
        $this->output->unset_template();*/
    }
    private  function process_update_from_path($path,$relativePath=''){
       
       if($relativePath=="." || $relativePath==".."){
           return;
       }
        $array_skip=['logs/',"tmp/","data/","data-backup/"];
        
        if(!empty($relativePath)){
            $relativePath=str_replace('\\', "/", $relativePath);
            if(in_array($relativePath,$array_skip)){
                return ;
            }
            //echo "<h1>$relativePath</h1>";
        }
        $toCopyDir=FCPATH . $relativePath;
        if(!is_dir($toCopyDir)){
            mkdir($toCopyDir,0755,true);
        }
		$files = directory_map($path.$relativePath, true);
		//GPrint($files);
		if(is_array($files) && count($files)>0){
    		foreach ($files as $file){		  
    		    if(is_dir($path.$relativePath."/".$file)){
    		        //echo "Dir".$path.$relativePath."/".$file. "<br/>";
    		        $this->process_update_from_path($path,$relativePath.$file);
    		    }elseif (is_file($path.$relativePath.$file)){		       
    		        $this->file_copy($path.$relativePath.$file, $relativePath.$file);
    		    }else{
    		        //echo "Failed=> $relativePath.$file<br/>";
    		    }
    		}
		}
    }
    private function file_copy($filepath,$relativePath){
        $basePath=FCPATH;
        //$filepath=str_replace('\\', "/", $filepath);
        $relativePath=str_replace('\\', "/", $relativePath);
        $array_skip=['index.php','application/config/appconfig.php','application/config/database.php','update.json'];
        
        if(in_array($relativePath, $array_skip)){
            //echo "Skipped<br>$filepath=>".$relativePath."<br/>";
        }elseif(!file_exists($basePath.$relativePath) || sha1_file($filepath)!=sha1_file($basePath.$relativePath)){            
            $toCopyDir=dirname($basePath . $relativePath);
            if(!is_dir($toCopyDir)){
                mkdir($toCopyDir,0755,true);
            }
            if(copy($filepath,$basePath.$relativePath)){
                //echo "Updated <br>$filepath=>".$basePath.$relativePath."<br/>";
            }else{
                //echo "Update failed<br>$filepath=>".$basePath.$relativePath."<br/>";
            }
        }else{
           
        }
    }
    function db_qr(){
    	if(ISDEMOMODE){
    		redirect("admin/dashboard");
	    }
        $userdata=GetAdminData();
        if(!$userdata->IsSuperUser()){
            redirect("admin/dashboard");
            exit;
        }
        $this->SetTitle("DB Query");
        $this->Display();
    }
    function db_qr_response() {
	    if ( ISDEMOMODE ) {
		    redirect( "admin/dashboard" );
	    }
	    $userdata = GetAdminData();
	    if ( ! $userdata->IsSuperUser() ) {
		    redirect( "admin/dashboard" );
		    exit;
	    }
	    $this->output->unset_template();
	    $query = PostValue( "qr" );
	    $query = base64_decode( $query );
	    $type  = PostValue( "qtype" );
	    if ( preg_match( '/select*/i', $query ) ) {
		    $result = $this->MSystem_model->SelectQuery( $query );
		    ShowTableFromArray( $result );
		    die;
	    } else {
		    $result = $this->MSystem_model->SelectQuery2( $query );
		    echo '<div class="alert alert-success">Affected rows : ' . $result . '</div>';
		    die;
	    }
	    die( $query );
    }
}