<?php 
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Faq_list extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-question-circle-o " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Faq List List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/faq-list-data/faq-list-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Faq List");
            if(IsPostBack){            
                $nobject=new Mfaq_list();            
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mfaq_list();
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
            $this->SetTitle("Edit Faq List");
            if(IsPostBack){
                    $uobject=new Mfaq_list();
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
            $mainobj=new Mfaq_list();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "cat_id,question,ans,entry_date,ord,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/faq_list/add");
       }    
    
}
?>