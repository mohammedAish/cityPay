<?php 
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Admin_report extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPIconClass ( "fa fa-bar-chart-o " );
        }
      
	         
       function index(){	   
        	$adminData=Mapp_user::GetAdminData();		
    		$this->SetTitle("Admin Dashboard");		
    		$this->SetPOPUPIconClass ( "fa fa-th " );
    		$this->load->library("chart/APPChartJS");
    		$totalTicketInfo=Mticket::getTicketStat("","");		
    		//$monthTicketInfo=Mticket::getTicketStat(date("Y-m-d"),date("Y-m-d"),$adminData->id);
    		//GPrint($totalTicketInfo);
    		//die;
    		$mapu=new Mapp_user();
    		$mapu->status('A');
    		$totalTicketInfo->active_member=$mapu->CountALL();
    		$myinfo=Mapp_user::FindBy("id", $adminData->id);
    		$this->AddViewData("myprof", $myinfo);
    		$this->AddViewData("totalTicketInfo", $totalTicketInfo);
    		//$this->AddViewData("monthTicketInfo", $monthTicketInfo);
    		$this->Display();
	   }	  
    
}
?>