<?php 
/**
 * Version 1.0.0
 * Creation date: 19/Jun/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Email_templates extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Email Templates List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/email_templates-data/email_templates-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Email Templates");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-star " );
            AddAppHTMLEditor();
            if(IsPostBack){            
                $nobject=new Memail_templates();            
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","Email_templates");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Memail_templates();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->DisplayPOPUP();
       }
       function edit($keyword=""){
        AddAppHTMLEditor();
        $mainobj = new Memail_templates();
        if (!empty($keyword)){
            $template_updated = false;
            $this->SetTitle("Update Email Template");
            $this->AddBreadCrumb("Home",admin_url("dashboard/index"));
            $this->AddBreadCrumb("Template List",admin_url("email-template/index"));

            if (IsPostBack){
                $content = $this->input->post("app_des_html",false);

                $template = new Memail_templates();              
                $template->k_word($keyword);
                if ($template->Select())
                {
                    if ($mainobj->SetFromPostData()){                        
                        $mainobj->SetWhereUpdate("k_word", $keyword);
                        $mainobj->content($content);
                        if($mainobj->Update()){
                            $template_updated = true;
                        }
                    }

                    if ($template_updated){
                        AddInfo("Email Template updated successfully", true);
                        AddLog("U","-", "l002","Email template for  {$keyword}",$keyword);
                    }else{
                        AddError("Whoops failed! Nothing found to update");
                    }
                }
                else
                {
                    AddError("Template not found");
                }

            }

            $mainobj = new Memail_templates();    
            $mainobj->k_word($keyword);
            if(!$mainobj->Select()){
                AddError("invalid information");
                return;
            }

            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);
            $this->Display("admin/email_templates/add");
        }
    }    
    
}
?>