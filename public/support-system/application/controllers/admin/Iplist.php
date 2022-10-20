<?php 
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Iplist extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "ap ap-ip " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("IP List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/iplist-data/iplist-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New IP");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
          
           
            if(IsPostBack){            
                $nobject=new Miplist(); 
                $nobject->entry_type("M");
                $nobject->added_on(date('Y-m-d H:i:s'));
                $nobject->start_count_time(date('Y-m-d H:i:s'));
                $nobject->req_counter('0');
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){                    
                        AddInfo("Successfully added");
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");
                        $this->DisplayPOPUPMsg();
                        return;
                    }
                }           
            }
            $mainobj=new Miplist();
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
            $this->SetTitle("Edit IP");
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );                      
            if(IsPostBack){
                    $uobject=new Miplist();
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("ip",$param_id);
                        if($uobject->Update()){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated");
                            $this->DisplayPOPUPMsg();
                            return;
                        }
                    }
            }
            $mainobj=new Miplist();
            $mainobj->ip($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "added_on,start_count_time,req_counter,entry_type,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/iplist/add");
       }  
       function detials($param_id=""){
            
           if(empty($param_id)){
               AddError("Invalid request");
               $this->DisplayPOPUPMsg();
               return;
           }
           $ipinfo=$obj=APPIPdata::get($param_id);
           if(empty($ipinfo)){
               AddError("Empty IP Information");
               $this->DisplayPOPUPMsg();
               return;
           }
           $this->SetTitle("Details info of IP($param_id)");
           $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
           $this->AddViewData("ipinfo", $ipinfo);
           $this->DisplayPOPUP();
       }
    
}
?>