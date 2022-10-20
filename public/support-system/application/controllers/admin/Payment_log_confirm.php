<?php 
/**
 * Version 1.0.0
 * Creation date: 06/Jan/2018
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Payment_log_confirm extends APP_ConfirmController{  
    function __construct(){
        parent::__construct();            
        $this->CheckPageAccess();
    } 
}
?>