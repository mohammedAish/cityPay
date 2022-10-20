<?php
register_shutdown_function("error_handler");
class Check_php extends CI_Controller{
    function __construct(){
        parent::__construct();
        error_reporting(E_ALL);     
        register_shutdown_function("error_handler");
    }
    function index($addon_name=''){  
        ob_start();      
        if(!empty($addon_name) && file_exists(FCPATH."addons/".$addon_name)){
            require FCPATH."addons/".$addon_name;
            //echo shell_exec("php -V ".FCPATH."addons/".$addon_name);
        }
        $ob=ob_get_clean();
        if(empty($ob)){
            die("NO SYNTEXT ERROR");
        }else{
            //die($ob);
        }
    }
   
}
function error_handler(){

    print_r(error_get_last());
    /*echo "<b>Error:</b> [$errno] $errstr<br>";
     echo "Ending Script";*/
    die();
}