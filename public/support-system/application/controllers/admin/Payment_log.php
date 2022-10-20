<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Payment_log extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Paid Transaction List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/payment-log-data/payment-log-list"));    	   
    	    $this->Display();
	   }       
    
}
?>