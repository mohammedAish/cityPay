<?php 
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Custom_field extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Custom Field List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/custom-field-data/custom-field-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Custom Field");        
            $this->SetPOPUPColClass ( "col-md-7 col-sm-11" );
            $this->SetPOPUPIconClass ( "fa fa-tasks " );
           
            if(IsPostBack){            
                $nobject=new Mcustom_field();
	            $_POST['cat_id']=implode(",",AppSecurity::RawPostValue('cat_id'));
                if($nobject->SetFromPostData(true)){
                	if($nobject->type=="L"){
		                $nobject->opt_json_base(PostValue("opt_json_base2"));
	                }
	                if($nobject->IsSetPrperty("help_text")){
		                $nobject->help_text(AppSecurity::RawPostValue("help_text"));
	                }
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mcustom_field();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->DisplayPOPUP();
       }
       function edit($param_id=""){
           
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }           
            $this->SetTitle("Edit Custom Field");
            $this->SetPOPUPColClass ( "col-md-7 col-sm-11" );
            $this->SetPOPUPIconClass ( "fa fa-tasks " );             
            if(IsPostBack){
                    $uobject=new Mcustom_field();
	                $_POST['cat_id']=implode(",",AppSecurity::RawPostValue('cat_id'));
	                $type=PostValue("type");
	                $isSetData=false;
	                if($type=="L"){
		                $uobject->opt_json_base(PostValue("opt_json_base2"));
		                $isSetData=true;
	                }
                    if($uobject->SetFromPostData(false) || $isSetData ){
                        $uobject->SetWhereUpdate("id",$param_id);
                        if($uobject->IsSetPrperty("help_text")){
                        	$uobject->help_text(AppSecurity::RawPostValue("help_text"));
                        }
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
            }
            $mainobj=new Mcustom_field();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "cat_id,title,help_text,type,opt_json_base,is_required,default_value,is_api_based,api_name,on_submit_api_check,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/custom_field/add");
       }    
    
}
?>