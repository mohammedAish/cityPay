<?php 
/** 
 * @since: 19/Sep/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Page extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-star " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Page List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/page-data/page-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
	       $this->SetTitle("New Knowledge");
	       AddAppHTMLEditor();
            if(IsPostBack){            
                $nobject=new Mcustom_page();            
                if($nobject->SetFromPostData(true)){
                	$nobject->page_body(AppSecurity::RawPostValue("page_body"));
                    if($nobject->Save()){                    
                        AddInfo("Successfully added",true);
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        redirectAdmin("page/edit/{$nobject->id}");
                        return;
                    }
                }           
            }
            $mainobj=new Mcustom_page();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->Display();
       }
       function edit($param_id=""){
	       AddAppHTMLEditor();
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }           
            $this->SetTitle("Edit Page");
            if(IsPostBack){
                    $uobject=new Mcustom_page();
                    if($uobject->SetFromPostData(false)){
                    	if($uobject->IsSetPrperty("page_body")){
		                    $uobject->page_body(AppSecurity::RawPostValue("page_body"));
	                    }
                        $uobject->SetWhereUpdate("id",$param_id);
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated",true);
	                        redirectAdmin("page/edit/{$param_id}");
	                        return;
                        }
                    }
            }
            $mainobj=new Mcustom_page();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->Display();
                return;
            }
            OldFields($mainobj, "slag_title,title,page-body,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->Display("admin/page/add");
       }    
    
}
?>