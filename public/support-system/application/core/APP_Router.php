<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."core".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."CORE_Router.php";
class APP_Router extends CORE_Router{
    function __construct(){
        parent::__construct();
    }
}
