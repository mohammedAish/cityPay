<?php 
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Locked_user extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "ap ap-locked-user2 " );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Locked User List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/locked-user-data/locked-user-list"));    	   
    	    $this->Display();
	   }
       
      
    
}
?>