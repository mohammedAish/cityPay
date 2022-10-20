<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class App_setting extends APP_Controller{
    
        function __construct(){
            parent::__construct();
            $this->CheckPageAccess();
            if(IsPostBack){
                $this->checkDemoMode();
            }
        }	
        protected function checkDemoMode(){
            if(ISDEMOMODE){
                $this->SetConfirmResponse(false,"The update has been disabled in DEMO MODE",null,false,"Demo Mode","puzzle-piece");
                $this->DisplayConfirmResponse();
                return false;
            }
        }         
       function index(){	   
    	    $this->SetTitle("Setting List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", admin_url("app_setting-data/app_setting-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Setting");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );
           
            if(IsPostBack){            
                $nobject=new Mapp_setting();            
                if($nobject->SetFromPostData()){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","App_setting");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mapp_setting();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->DisplayPOPUP();
       }
       function edit($param_id=""){
           
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayMSGOnly();
                return;
            }           
            $this->SetTitle("Edit Setting");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );             
            if(IsPostBack){
                    $uobject=new Mapp_setting();
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("s_key",$param_id);
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","App_setting","App_setting");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
            }
            $mainobj=new Mapp_setting();
            $mainobj->s_key($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayMSGOnly();
                return;
            }
            OldFields($mainobj, "s_title,s_val,s_type,s_option,s_auto_load");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/app_setting/add");
       }    
    
}
?>