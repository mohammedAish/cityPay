<?php 
/** 
 * @since: 14/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Ticket_assign_rule extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "ap ap-users-check" );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Ticket Assign Rule List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/ticket-assign-rule-data/ticket-assign-rule-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Ticket Assign Rule");        
            
            if(IsPostBack){            
                $nobject=new Mticket_assign_rule();
                $catidsa=PostValue("cat_idsa",[]);
	            if(is_array($catidsa)) {
		            foreach ( $catidsa as &$p ) {
			            $p = strip_tags( $p );
		            }
	            }
                $nobject->cat_ids(implode(",",$catidsa));
                if($nobject->SetFromPostData(true)){

                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mticket_assign_rule();
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
            $this->SetTitle("Edit Ticket Assign Rule");
            
            if(IsPostBack) {
                $uobject = new Mticket_assign_rule();
                $catidsa = PostValue("cat_idsa", []);
	            $catidsa=PostValue("cat_idsa",[]);
	            if(is_array($catidsa)) {
		            foreach ( $catidsa as &$p ) {
			            $p = strip_tags( $p );
		            }
	            }
                $uobject->cat_ids(implode(",", $catidsa));
                
                if ($uobject->SetFromPostData(false)) {
                    $uobject->SetWhereUpdate("id", $param_id);
                    if ($uobject->Update()) {
                        AddLog("U", $uobject->settedPropertyforLog(), "l002", "");
                        AddInfo("Successfully updated");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }
            }
            $mainobj=new Mticket_assign_rule();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "cat_ids,rule_type,rule_id,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/ticket_assign_rule/add");
       }    
    
}
?>