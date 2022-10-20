<?php
class App_assets extends CI_Controller{
    
    function index(){
        echo "yes";
    }
    
    function js($param=""){
        header('Content-Type: text/javascript; charset=utf-8');
        if(!empty($param)){ 
            $filename=basename($param);
            if(file_exists(APPPATH."/cache/js/{$param}")){           
               die(file_get_contents(APPPATH."/cache/js/{$param}"));
            }
        }else{
            echo "console.log(".current_url()." \nRequest file not found in cache);";
        }
    }

    function css($param=""){
        header('Content-Type: text/css; charset=utf-8');
        if(!empty($param)){
            $filename=basename($param);
            if(file_exists(APPPATH."/cache/css/{$param}")){
                die(file_get_contents(APPPATH."/cache/css/{$param}"));
            }
        }else{
            echo "console.log(".current_url()." \nRequest file not found in cache);";
        }
    }
    
    function chat_css(){
        header('Content-Type: text/css; charset=utf-8');
        ?>
        @font-face {
        font-family: 'for-chat-only';
        src:  url('<?php echo base_url('app-assets/chat-fonts/for-chat-only.eot?ife74r'); ?>');
        src:  url('<?php echo base_url('app-assets/chat-fonts/for-chat-only.eot?ife74r#iefix');?>') format('embedded-opentype'),
        url('<?php echo base_url('app-assets/chat-fonts/for-chat-only.ttf?ife74r');?>') format('truetype'),
        url('<?php echo base_url('app-assets/chat-fonts/for-chat-only.woff?ife74r');?>') format('woff'),
        url('<?php echo base_url('app-assets/chat-fonts/for-chat-only.svg?ife74r#for-chat-only');?>') format('svg');
        font-weight: normal;
        font-style: normal;
        font-display: block;
        }
        <?php
        echo file_get_contents(FCPATH."/plugins/apsbd-chat/css/style-2.css");
    }
	function chat_js(){
		header('Content-Type: text/javascript; charset=utf-8');
		echo file_get_contents(FCPATH."/plugins/apsbd-chat/js/appsbd-chat.min.js")."\n\n";
		get_default_chat_script();
	}
	function chat_fonts($fontname=''){
        $file=FCPATH."/plugins/apsbd-chat/css/fonts/$fontname";
        if (file_exists($file)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: inline; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));
            header('Access-Control-Allow-Origin: *');
            header("Cache-Control: max-age=2592000");
            readfile($file);
            exit;
        }
    }
}