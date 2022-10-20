<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Ticket_payment extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Ticket Payment List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/ticket-payment-data/ticket-payment-list"));    	   
    	    $this->Display();
	   }
	   function details($id=''){
	       $this->SetTitle("Ticket Payment Details");
	       $this->SetSubtitle("");
	       $this->SetPOPUPColClass("col-md-10");
	       
	       $paymentDetails=Mticket_payment::FindBy("id", $id);
	       $ticketObj=null;
	       if($paymentDetails){
	           $ticketObj=Mticket::FindBy("id", $paymentDetails->ticket_id);
    	       if($ticketObj){
    	           $ticket_user = Msite_user::FindBy ( "id", $ticketObj->ticket_user ); 
    	           $this->AddViewData("ticket_user", $ticket_user);
    	           if(!empty($paymentDetails->payment_id)){
    	               $ticket_payment = Mpayment_log::FindBy ( "payment_id", $paymentDetails->payment_id );
    	               $this->AddViewData("ticket_payment_log", $ticket_payment);
    	           }
    	       }
    	    }
    	   $this->AddViewData("paymentDetails", $paymentDetails);
	       $this->AddViewData("ticketObj", $ticketObj);
	       $this->DisplayPOPUP();
	   }       
       
    
}
?>