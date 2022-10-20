<?php 
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Admin_note extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Admin Note List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/admin-note-data/admin-note-list"));    	   
    	    $this->Display();
	   }
       
       function add($user_id='',$ticket_id=''){
        	$this->SetTitle("New Admin Note");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-star " );
            $userdata=GetAdminData();
           if(empty($user_id) || empty($ticket_id)){
               AddError("Parameter error");
               $this->DisplayPOPUPMsg();
               return;
           }
            if(IsPostBack){            
                $nobject=new Madmin_note();

                if($nobject->SetFromPostData(true)){
                    if($nobject->ref_type=="T"){
                        $nobject->ref_id($ticket_id);
                    }else{
                        $nobject->ref_id($user_id);
                    }
                    if(!empty($userdata->id)){
                        $nobject->user_id($userdata->id);
                    }
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Madmin_note();
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
            $this->SetTitle("Edit Admin Note");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );             
            if(IsPostBack){
                    $uobject=new Madmin_note();
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
            $mainobj=new Madmin_note();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "ref_id,ref_type,user_id,note,entry_date");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/admin_note/add");
       }
       function get_notes($user_id="",$ticket_id=""){
	        echo getAdminNotes($user_id,$ticket_id); die;
       }
    
}
?>