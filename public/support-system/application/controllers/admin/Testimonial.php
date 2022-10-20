<?php 
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Testimonial extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-thumbs-up " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Testimonial List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/testimonial-data/testimonial-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Testimonial");
            if(IsPostBack){            
                $nobject=new Mtestimonial();            
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
	                    Mtestimonial::upload_testimonial_photo("user_img",$nobject->id);
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mtestimonial();
            $this->SetPopupFromMutipart();
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
            $this->SetTitle("Edit Testimonial");
	       
            if(IsPostBack){
	            $isImgUploaded=Mtestimonial::upload_testimonial_photo("user_img",$param_id);
                    $uobject=new Mtestimonial();
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("id",$param_id);
                        if($uobject->Update(false,!$isImgUploaded)){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
                    if($isImgUploaded){
	                    AddInfo("Successfully updated");
	                    $this->DisplayPOPUPMsg();
                    }
                    
            }
            $mainobj=new Mtestimonial();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "name,designation,testimonial,status");
            $this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/testimonial/add");
       }    
    
}
?>