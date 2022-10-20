<?php
class Server_requiment extends APP_Controller {

    public function index()
    {
        $this->SetTitle("Server Requirment Failed");       
        $this->Display();
    }
    public function resource_missmatch(){
        $this->SetTitle("Resource Missmatch");
        show_error("some resource may be change or removed");
    }
}