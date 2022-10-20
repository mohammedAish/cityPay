<?php 
/**
 * Version 1.0.0
 * Creation date: 09/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Client extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "fa fa-user-circle" );
        }
      
	         
       function index(){
           add_css("plugins/dropmenu/css/dropmenu.css");
           add_js("plugins/dropmenu/js/dropmenu.js");
    	    $this->SetTitle("Client List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/client-data/client-list"));    	   
    	    $this->Display();
	   }
       
       function add() {
	       $this->SetTitle( "New Client" );
	       $this->SetPOPUPColClass( "col-md-6 col-sm-6" );
	       $custom_fields =Mcustom_field::getCustomFieldsByCategory('R');
	
	       if ( IsPostBack ) {
		       $isOk=true;
		       $customFieldsNeedToBeSave=[];
		       foreach ($custom_fields as $cf){
			       if(!Mcustom_field::is_ok_custom_value($cf,$customFieldsNeedToBeSave,false)){
				       $isOk=false;
			       }
		       }
		       $nobject = new Msite_user();
		       if ( $isOk && $nobject->SetFromPostData( true ) ) {
			       $nobject->login_type( "N" );
			       if ( $nobject->SaveWithRandomPassword() ) {
				       $is_saved_all_ok=true;
				       foreach ($customFieldsNeedToBeSave as $customTicketObj){
					       //$customTicketObj=new Msite_user_custom_field();
					       $customTicketObj->user_id($nobject->id);
					       if(!$customTicketObj->Save()){
						       $is_saved_all_ok=false;
					       }
				       }
				       AddInfo( "Successfully added" );
				       AddLog( "A", $nobject->settedPropertyforLog(), "l001", "" );
				       $this->DisplayPOPUPMsg();
				
				       return;
			       }
		       }
	       }
	       $mainobj = new Msite_user();
	       //$this->SetPopupFromMutipart();
	       $this->AddViewData( "custom_fields", $custom_fields );
	       $this->AddViewData( "mainobj", $mainobj );
	       $this->AddViewData( "isUpdate", false );
	       $this->DisplayPOPUP();
       }
       function edit($param_id=""){
           
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }           
            $this->SetTitle("Edit Client");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
	       $custom_fields =Mcustom_field::getCustomFieldsByCategory('R');
	       $custom_values=Msite_user_custom_field::FindAllByIdentiry("user_id",$param_id,"custom_id");
	       foreach ($custom_fields as &$ccf){
		       $ccf->saved_value =isset($custom_values[$ccf->id])?$custom_values[$ccf->id]->fld_value:false;
	       }
            if(IsPostBack){
	       	    $isOk=true;
	            $customFieldsNeedToBeSave=[];
	            foreach ($custom_fields as $cf){
		            if(!Mcustom_field::is_ok_custom_value($cf,$customFieldsNeedToBeSave,false,true,$cf->saved_value)){
			            $isOk=false;
		            }
	            }
	            
	            $isUpdated=false;
	            $stringUpdate="";
                $uobject=new Msite_user();
                if($isOk && $uobject->SetFromPostData(false)){
                    $uobject->SetWhereUpdate("id",$param_id);
                    if($uobject->Update()){
	                    $stringUpdate=$uobject->settedPropertyforLog();
	                    $isUpdated=true;
                    }
                }
	            $is_saved_all_ok=true;
	            foreach ($customFieldsNeedToBeSave as $key=>$customTicketObj){
		            //$customTicketObj=new Msite_user_custom_field();
		            //id,user_id,custom_id,fld_title,fld_type,fld_value,fld_value_text,is_api_based,api_name,api_data
		            if(empty($customTicketObj->is_new)) {
			            $customTicketObj->UnsetAllExcepts( "fld_type,fld_value,fld_value_text,is_api_based,api_name,api_data" );
			            $customTicketObj->SetWhereCondition( "user_id", $param_id );
			            $customTicketObj->SetWhereCondition( "custom_id", $key );
			            if ( ! $customTicketObj->Update() ) {
				            $is_saved_all_ok = false;
			            } else {
				            $isUpdated = true;
			            }
		            }else{
			            $customTicketObj->user_id($param_id);
			            if(!$customTicketObj->Save()){
				            $is_saved_all_ok=false;
			            }else{
				            $isUpdated = true;
			            }
		            }
	            }
	            
                if($is_saved_all_ok && $isUpdated){
	                AddLog("U",$stringUpdate,"l002","");
	                AddInfo("Successfully updated");
	                $this->DisplayPOPUPMsg();
	                return;
                }else{
	            	AddError("No change for update");
                }
            }
            $mainobj=new Msite_user();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "firstName,lastName,username,email,password,is_verified_email,gender,phone,address,region,city,zip,country,dob,profile_url,photo_url,age,login_type,join_date,tzone");
            //$this->SetPopupFromMutipart();
	       $this->AddViewData( "custom_fields", $custom_fields );
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/client/add");
       }   
       function profile($param_id=""){            
           if(empty($param_id)){
               AddError("Invalid request");
               $this->DisplayPOPUPMsg();
               return;
           }
           $this->SetTitle("Client Profile");
           $this->SetPOPUPColClass ( "col-md-10 col-sm-12" );           
           $mainobj=new Msite_user();
           $mainobj->id($param_id);
           if(!$mainobj->Select()){
               AddError("Invalid request");
               $this->DisplayPOPUPMsg();
               return;
           }    
           $tickets=Mticket::FindAllBy("ticket_user", $param_id,[],"last_reply_time","DESC");
           $this->AddViewData("mainobj", $mainobj); 
           $this->AddViewData("tickets", $tickets);          
           $this->DisplayPOPUP("admin/client/profile");
       } 
    
}
?>