<?php 
/**
 * Version 1.0.0
 * Creation date: 23/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Elements extends APP_Controller{    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
      
	         
       function index(){	   
    	     
    	    $this->Display();
	   }
	   function AddIntoPageList(){
	       
	   }       
    
}
?>