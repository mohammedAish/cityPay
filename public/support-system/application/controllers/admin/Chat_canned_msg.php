<?php 
/** 
 * @since: 27/May/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Chat_canned_msg extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "ap ap-chat3" );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Chat Canned Message");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/chat-canned-msg-data/chat-canned-msg-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Chat Canned Message");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            if(IsPostBack){            
                $nobject=new Mcanned_msg();            
                if($nobject->SetFromPostData(true)){
                    $nobject->canned_type("C");
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
            $this->SetTitle("Edit Chat Canned Message");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );

            if(IsPostBack){
                    $uobject=new Mcanned_msg();
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("id",$param_id);
                        $uobject->SetWhereUpdate("canned_type","C");
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
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
            $this->DisplayPOPUP("admin/chat_canned_msg/add");
       }    
    
}
?>