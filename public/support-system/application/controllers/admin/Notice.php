<?php 
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Notice extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "fa fa-bullhorn " );
        }
      
	         
       function index(){
           AddAppHTMLEditor();
    	    $this->SetTitle("Announcements List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/notice-data/notice-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Announcements");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );

           $adminData=GetAdminData();
            if(IsPostBack){            
                $nobject=new Mnotice();     
                $nobject->added_by($adminData->id);
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mnotice();
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
            $this->SetTitle("Edit Announcements");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );             
            if(IsPostBack){
                    $uobject=new Mnotice();
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
            $mainobj=new Mnotice();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "msg,start_date,end_date,msg_for,added_by,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/notice/add");
       }    
    
}
?>