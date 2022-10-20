<?php 
/** 
 * @since: 10/Aug/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Work_log extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-4 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-clock-o " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Work Log List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/work-log-data/work-log-list"));    	   
    	    $this->Display();
	   }
       
       function add($ticket_id=''){
        	$this->SetTitle("New Work Log");
        	if(empty($ticket_id)){
        		AddError("Invalid parameter");
        		$this->DisplayPOPUPMsg();
	        }
	        $userData=GetAdminData();
            if(IsPostBack){            
                $nobject=new Mwork_log();
	            $nobject->ticket_id($ticket_id);
	            $nobject->user_id($userData->id);
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Mwork_log();
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
            $this->SetTitle("Edit Work Log");
            if(IsPostBack){
                    $uobject=new Mwork_log();
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
            $mainobj=new Mwork_log();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "ticket_id,user_id,note,w_time,entry_date");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/work_log/add");
       }
	
	function get_notes($ticket_id=""){
		echo getAdminWorkLog($ticket_id); die;
	}
}
?>