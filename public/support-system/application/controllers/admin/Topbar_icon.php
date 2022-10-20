<?php 
/**
 * Version 1.0.0
 * Creation date: 28/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Topbar_icon extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            add_icon_picker();
            $this->SetPOPUPIconClass ( "fa fa-ellipsis-h " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Topbar Icon List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/topbar-icon-data/topbar-icon-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Topbar Icon");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            //$this->SetPOPUPIconClass ( "fa fa-star " );
           
            if(IsPostBack){            
                $nobject=new Mtopbar_icon();            
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mtopbar_icon();
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
            $this->SetTitle("Edit Topbar Icon");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
                         
            if(IsPostBack){
                    $uobject=new Mtopbar_icon();
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("id",$param_id);
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
            }
            $mainobj=new Mtopbar_icon();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "title,sub_title,icon_class,icon_order,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/topbar_icon/add");
       }    
    
}
?>