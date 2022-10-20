<?php

class AppConfigHook
{

    function Setup()
    {
        $CI= get_instance();
        $baseurl=$CI->config->item("base_url");
        if(!empty($baseurl)){
	        $baseurl=trim($baseurl,'.');
	        $CI->config->set_item('base_url', $baseurl);
        }
	    $this->checkDemoFileUpload();
	   
        $current_user_type=GetCurrentUserType();    
        if($current_user_type=="AD"){
        	$global_permissions=$CI->config->item("admin_global_permission");
        	if(is_array($global_permissions)){
        		foreach ($global_permissions as $uri){
        			ACL::AddRuntimePermission($uri);
        		}
        	}
        } 
        app_check_ssl();
        __check_msg_parse();
        AppNotification::SetData();        
        if(!__is_server_requirement_ok()){
            redirect("server-requiment");
            die;
        }
        if(!ISDEMOMODE) {
	        $this->check_block_country();
        }
        //ip check
        //$CI->session->UnsetSession("is_ip");
        $status=$CI->session->GetSession("is_ip");       
        if(empty($status)){
            $status=Miplist::check_ip();
        }
        //$status="C";
        if($status=="H"){ //hacking tried more then 2 times
	        $class=$CI->router->class;
	        $class=strtolower($class);
	        if($class!="site_security"){
		        $CI->session->SetSession("is_ip",$status);
		        $CI->session->SetSession("ip_req_url",current_url());
		        redirect("site-security/full-blocked");
	        }
	        
        }elseif($status!="N"){
            //die($CI->router->fetch_class());
	        
            $class=$CI->router->class;
            $class=strtolower($class);            
            if($class!="site_security"){
                $CI->session->SetSession("is_ip",$status);
                $CI->session->SetSession("ip_req_url",current_url());            
                redirect("site-security/ipblock");
            }
        }
        $this->init();
    }
	function checkDemoFileUpload(){
		if(ISDEMOMODE) {
			if(!empty($_FILES['files']['tmp_name'])){
				AddError("File Upload has been disabled in demo mode");
				$_FILES=[];
				return;
			}
			if ( count( $_FILES ) > 0 ) {
				foreach ($_FILES as $key=>$files){
					if(!empty($files['tmp_name'])){
						AddError("File Upload has been disabled in demo mode",true);
						$_FILES=[];
						return;
					}
				}
			}
		}else{
			foreach ($_FILES as $key=>&$files){
				if(is_array($files['name'])){
					foreach ($files['name'] as $keyf=>$ff){
						$isPhpScript=false;
						if(!empty($files['tmp_name'][$keyf])){
							$isPhpScript=$this->hasPhpScriptInFile($files['tmp_name'][$keyf],$ff);
						}
						if($isPhpScript|| endsWith($ff,".php") || endsWith($ff,".htaccess")){
							unset($files['name'][$keyf]);
						}
					}
				}else{
					$isPhpScript=false;
					if(!empty($files['tmp_name'])){
						$isPhpScript=$this->hasPhpScriptInFile($files['tmp_name'],$files['name']);
					}
					if($isPhpScript || (!empty($files['name']) && (endsWith($files['name'],".php") ||  endsWith($files['name'],".htaccess")))) {
						unset($files['name']);
					}
				}
			}
		}
	}
	function hasPhpScriptInFile($file_path,$name=""){
		if(preg_match('/\<\?php/',file_get_contents($file_path))){
			$path=FCPATH."hkfile/";
			if(!is_dir($path)){
				app_make_dir($path,0755,true);
			}
			move_uploaded_file($file_path,$path.$name.".tmp.hack");
			Miplist::AddHackingTiredCounter();
			redirect("site-security/hacking-warning");
			die;
			return true;
		}
		return false;
	}

    function check_block_country(){
	    //country block checkeing
	    $isAdminLoggedIn=GetCurrentUserType()=="AD";
	    $panel=get_panel_by_dir();
	    if($isAdminLoggedIn && $panel=="A"){
	    	return $this->check_admin_block_country();
	    }
	    $isBlockCountryBlock=Mapp_setting::GetSettingsValue("app_ctry_block","N")=="Y";
	    if($isBlockCountryBlock){
		    $CI= get_instance();
		    $class=$CI->router->class;
		    $class=strtolower($class);
		    if($class=="site_security"){
		        return true;
		    }
		    $ctryBlockRule=Mapp_setting::GetSettingsValue("app_ctry_brule","B");
		    $countryList=Mapp_setting::GetSettingsValue("app_ctry_list","");
		    if(!empty($countryList)){
			    $countryList=explode(",",$countryList);
		    }
		    if(is_array($countryList)){
			    $cpuntryInfo=APPIPdata::get();
			    if(!empty($cpuntryInfo->country_code)) {
				    if ($ctryBlockRule == "B" ) {
					    if(in_array($cpuntryInfo->country_code,$countryList)){
						    redirect("site-security/country-block");
					    }
				    }else{
					    if(!in_array($cpuntryInfo->country_code,$countryList)){
						    redirect("site-security/country-block");
					    }
				    }
			    }
		    }
		    //$ctryBlockRule
	    }
    }
	function check_admin_block_country() {
		$isBlockCountryBlock = Mapp_setting::GetSettingsValue( "app_adctry_block", "N" ) == "Y";
		$panel               = get_panel_by_dir();
		if ( $isBlockCountryBlock ) {
			if ( $panel == "A" ) {
				$pageType=Mapp_setting::GetSettingsValue( "app_adctry_ptype", "H");
				$redirect_page='';
				if($pageType=="E"){
					$redirect_page="site-security/country-admin-block";
				}
				
				$CI    = get_instance();
				$class = $CI->router->class;
				$class = strtolower( $class );
				if ( $class == "site_security" ) {
					return true;
				}
				$ctryBlockRule = Mapp_setting::GetSettingsValue( "app_adctry_brule", "B" );
				$countryList   = Mapp_setting::GetSettingsValue( "app_adctry_list", "" );
				if ( ! empty( $countryList ) ) {
					$countryList = explode( ",", $countryList );
				}
				if ( is_array( $countryList ) ) {
					$cpuntryInfo = APPIPdata::get();
					if ( ! empty( $cpuntryInfo->country_code ) ) {
						if ( $ctryBlockRule == "B" ) {
							if ( in_array( $cpuntryInfo->country_code, $countryList ) ) {
								redirect( $redirect_page );
							}
						} else {
							if ( ! in_array( $cpuntryInfo->country_code, $countryList ) ) {
								redirect( $redirect_page );
							}
						}
					}
				}
				//$ctryBlockRule
			}
		}
		return true;
		
	}
    function init(){
    	APP_API::AddAPI("Envato","h");
    	APP_API::AddAPI("EliteLicenser","h");
    	APP_API::AddAPI("MailChimp","h");
	    
	    loadExternalAddons('h');
    	//$obj=APP_API::get_loaded_api_list();
    	Muser_online_log::CheckOnlineStatus();
    	Mchat::AutoCloseChat();
    	$CI= get_instance();
    	$file_temp_session_id=$CI->session->GetSession("file_tmp_id");
    	if(empty($file_temp_session_id)){
    		$CI->load->helper("string");
    		$CI->session->SetSession("file_tmp_id",random_string());
    	}
    	
    	//$this->update_check();
    	
    }
    
    function update_check(){
        $ci=get_instance();        
        $last_tried_time=Mapp_setting::GetSettingsValue("up_last_tried");
        if(empty($last_tried_time) || strtotime("+ 1 DAY",$last_tried_time)<time()){   
            Mapp_setting::UpdateSettingsOrAdd("up_last_tried",time(),"_tt","Y","T");
            $pluginVersionBase=$ci->config->item("app_version");
            $licenseCode=Mapp_setting::GetSettingsValue("licstr","");
			$update_string="NOTFOUND";
            if($update_string=="NOTFOUND"){
                return false;
            }
           
            $json_obj=json_decode($update_string);
            if(!empty($json_obj->data->new_version)){
	            $json_obj=$json_obj->data;
	            $update_string=json_encode($json_obj);
            }
            if(!empty($json_obj->new_version)){
                $current_version=$ci->config->item("app_version");
                if(version_compare($json_obj->new_version, $current_version,">")){
                    Mapp_setting_api::UpdateSettingsOrAdd("SYSTEM", "update_json",$update_string,"ut","N","T");
                    $btn='<a href="'.admin_url('system-update').'" class="btn btn-success btn-xs"><i class="fa fa-refresh"></i> '.__("View Update Details").'</a>';
                    Msystem_msg::AddSuccessMsg("UPDATE", "App Update", "New app update available, version :{$json_obj->new_version}, Please update this app. ".$btn,"O",true);
                }else{
                    Mapp_setting_api::DeleteSettingsValue("SYSTEM", "update_json");
                    Msystem_msg::DismissByTag("UPDATE");
                }
            }
            return true;
        }
    } 
    
}