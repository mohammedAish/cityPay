<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."core".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."CORE_Loader.php";
class APP_Loader extends CORE_Loader {
    function __construct(){
        parent::__construct();
    }
    function  resource($param=''){
	   parent::resource($param);
	   APPLanguage::load_po_file($param);
	}
}

