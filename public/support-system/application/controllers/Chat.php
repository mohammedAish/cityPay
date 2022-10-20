<?php
class Chat extends APP_Controller {
    function __construct(){
        parent::__construct();
        $this->output->unset_template();
    }
	public function index()
	{
		$this->output->unset_template();
		if(ChatLib::HasOrigin()) {
			header( 'Access-Control-Allow-Origin: *' );
		}else{
			echo "This Site is not valid";
			exit;
		}
        ChatLib::handle_request();
	}
	public function dl($chat_id='')
    {
        $this->output->unset_template();
        $this->load->helper('download');
        $filename = GetValue("f");
        $filesession = GetValue("sk");
        $isAdmin=GetCurrentUserType()=="AD";

        if ($isAdmin ||(!empty($filesession) && $filesession == ChatLib::getChatKey())) {
            $chatStatus=$this->session->GetSession("chatses".$chat_id);
            if(!empty($chatStatus)){
                $chatobj=Mchat::FindBy("id",$chat_id);
                if($chatobj){
                    $chatStatus=$chatobj->status;
                    $this->session->SetSession("chatses".$chat_id,$chatStatus);
                }else{
                    $chatStatus="C";
                    $this->session->SetSession("chatses".$chat_id,$chatStatus);
                }
            }
            $chatStatus=strtoupper($chatStatus);
            if($isAdmin || $chatStatus !="C"){
                $filePath = FCPATH . "data" . DIRECTORY_SEPARATOR . "chat_file" . DIRECTORY_SEPARATOR . "$chat_id" . DIRECTORY_SEPARATOR . $filename;
                if (file_exists($filePath)) {
                    //echo "I am here $filePath";
                    force_download($filePath, NULL);
                    return;
                }
            }
        }
        force_download($filename . ".txt", "No file found", "text/plain");


    }

}