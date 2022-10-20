<?php
/**
 * @since: 24/04/2018
 * @author: Sarwar Hasan
 * @version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_chat extends APP_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->CheckPageAccess();
        $this->SetPOPUPIconClass("ap ap-images");
    }
    function index(){
        add_css("plugins/apsbd-chat/css/appsbd-chat-admin.css");
        if(ENVIRONMENT=="development"){
            add_js("plugins/apsbd-chat/js/appsbd-chat-admin.js");
        }else{
            add_js("plugins/apsbd-chat/js/appsbd-chat-admin.min.js");
        }

        add_js("plugins/apsbd-chat/js/init-admin.js");
        $this->SetTitle("Chat Panel");
        $this->Display();
    }
    function dashboard(){
        $this->SetTitle("Chat Panel");
        $this->Display();
    }
    function chat_response(){
        $this->output->unset_template();
        ChatAdminLib::handle_request();
    }



}