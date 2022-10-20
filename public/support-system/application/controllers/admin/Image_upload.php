<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_upload extends APP_Controller{
    private $base_path="";
    function __construct(){
        parent::__construct();
        $this->CheckPageAccess();
        //$this->output->unset_template();
        $this->base_path=Mknowledge::get_upload_path();
        $adminData=GetAdminData();
        if(empty($adminData)){
            redirect('error/denied-page','auto');
        }
    }
    
    function upload(){
        $this->output->unset_template();
        $image = !empty($_FILES['file']['name'])?$_FILES['file']['name']:"";
        $response=new stdClass();
        $response->status=false;
        if(!empty($image)){              
            $uploadfile = basename($image);
            if(file_exists($this->base_path.$uploadfile)){
                $uploadfile=time().basename($image);
            }
            if( move_uploaded_file($_FILES['file']['tmp_name'],$this->base_path.$uploadfile)) {
               $response->status=true;
               $response->img_url=base_url("data/knowledge/{$uploadfile}");
               $response->img_base=$uploadfile;
               die(json_encode($response));                
            } 
        }
        die(json_encode($response));
    }
    function upload2(){
        $this->output->unset_template();
        $image = !empty($_FILES['file']['name'])?$_FILES['file']['name']:"";
        if(!empty($image)){
            $base_path=FCPATH. "data/knowledge/";
            if(!is_dir($base_path)){
                app_make_dir($base_path,0777,false);
            }
            $uploadfile = basename($image);
            if(file_exists($base_path.$uploadfile)){
                $uploadfile=time().basename($image);
            }
            if( move_uploaded_file($_FILES['file']['tmp_name'],$base_path.$uploadfile)) {
                echo base_url("data/knowledge/".$uploadfile);
            } else {
                echo ""; // <= nobody is perfect :)
            }
        }
    
    }
    function delete(){
        $this->output->unset_template();
        $img = PostValue('image');
        
        if (file_exists( $this->base_path.$img))
            unlink($this->base_path.$img);
    }
    
    function manager(){       
        if($this->input->is_ajax_request()){
            $this->output->unset_template();
        }
        $this->AddViewData("image_base_path", $this->base_path);
        $this->Display('',false);
    }
}