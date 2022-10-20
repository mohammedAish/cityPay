<?php 
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Admin_message extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "fa fa-envelope " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("My Message");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/admin-message-data/admin-message-list"));    	   
    	    $this->Display();
	   }
	   function sent(){	   
    	    $this->SetTitle("Sent Message By Me");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/admin-message-data/admin-message-sent"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Admin Message");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
           
            $admindata=GetAdminData();
            if(IsPostBack){            
                $nobject=new Madmin_message();  
                $tousera=PostValue("to_usera");
                $nobject->from_user($admindata->id);
                //if($nobject->SetFromPostData(true)){
                    if(is_array($tousera)){
                        $isOk=true;
                        foreach ($tousera as $tu){
                            $nobjectn=new Madmin_message();
                            $nobjectn->to_user(trim($tu));
	                        $nobjectn->from_user($admindata->id);
	                        if($nobjectn->SetFromPostData(true)) {
		                        if ( $nobjectn->Save() ) {
			                        Mapp_notificaiton::AddMessage( $nobjectn->to_user, __( "%s sent a message to you", $admindata->title ), _( "Subject" ) . " : " . $nobjectn->subject, site_url( "admin/admin-message/details/{$nobjectn->id}" ) );
		                        } else {
			                        $isOk = false;
		                        }
	                        }else{
		                        $isOk = false;
	                        }
                        }
                        if($isOk){                            
                            AddInfo("Successfully sent to ".count($tousera)." user(s)");
                            AddLog("A","sent multiple msg","l001","");
                            $this->DisplayPOPUPMsg();
                            return ;
                        }
                    }
                }           
            //}
            $mainobj=new Madmin_message();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->DisplayPOPUP();
       }
       /*function edit($param_id=""){
           
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }           
            $this->SetTitle("Edit Admin Message");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );             
            if(IsPostBack){
                    $uobject=new Madmin_message();
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
            $mainobj=new Madmin_message();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "subject,body,to_user,from_user,last_replied,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/admin_message/add");
       }    */
       
       function details($id=''){
           $this->SetTitle("Message Details");
           if(empty($id)){
                $this->DisplayMSGOnly("Invalid message information.");
                return;
           }
           $msg=Madmin_message::FindBy("id", $id);
           $replies=Madmin_message_reply::FindAllBy("msg_id", $id,[],'entry_time','ASC');
           $this->AddViewData("mainobj", $msg);
           $this->AddViewData("replies", $replies);
           $this->Display();
       }
    
}
?>