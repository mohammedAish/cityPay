<?php 
/**
 * Version 1.0.0
 * Creation date: 21/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Canned_msg extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "fa fa-stack-exchange" );
            AddAppHTMLEditor();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Canned Message List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/canned-msg-data/canned-msg-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
           
        	$this->SetTitle("New Canned Message");        
            $this->SetPOPUPColClass ( "col-md-10 col-sm-12" );
           
           
            if(IsPostBack){       
                $canned_msg=PostValue("app_des_html");     
                $nobject=new Mcanned_msg();
                $nobject->canned_type("T");
                $nobject->canned_msg($canned_msg);          
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mcanned_msg();
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
            $this->SetTitle("Edit Canned Message");
            $this->SetPOPUPColClass ( "col-md-10 col-sm-12" );           
            if(IsPostBack){
                    $uobject=new Mcanned_msg();
                    $canned_msg=PostValue("app_des_html");
                    $uobject->canned_msg($canned_msg);
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("id",$param_id);
                        $uobject->SetWhereUpdate("canned_type","T");
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","Canned Message");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
            }
            $mainobj=new Mcanned_msg();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "user_id,title,canned_msg,entry_date,added_by,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/canned_msg/add");
       }    
    
}
?>