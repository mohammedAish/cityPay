<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Knowledge extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            AddAppHTMLEditor();
        }
      
	         
       function index(){	   
          
    	    $this->SetTitle("Knowledge List ");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/knowledge-data/knowledge-list"));    	   
    	    $this->Display();
	   }
       private function process_attached_file($id){
	        $isUploaded=false;
           if(isset($_FILES['upload_files'])){
               $base_path = Mknowledge::get_upload_path($id, true);
               foreach ($_FILES['upload_files']['error'] as $key=>$af) {
                   if($af==0){
                       if(file_exists($base_path . $_FILES['upload_files']['name'][$key])){
                           unlink($base_path . $_FILES['upload_files']['name'][$key]);
                       }
                       if (move_uploaded_file($_FILES['upload_files']['tmp_name'][$key], $base_path . $_FILES['upload_files']['name'][$key])) {
                           $isUploaded=true;
                       }
                   }

               }
           }
           return $isUploaded;
       }
       function add(){
         
        	$this->SetTitle("New Knowledge");        
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa-star " );
            //AddCKEdittor();
            if(IsPostBack) {
                $nobject = new Mknowledge();
                $adminData = GetAdminData();
                $nobject->added_by($adminData->id);

                if ($nobject->SetFromPostData(true)) {
                    $kbody = $this->input->post("k_body");
                    $nobject->k_body($kbody);
                    if ($nobject->Save()) {
                        if (isset($_FILES['featured_img']) && empty($_FILES['featured_img']['error'])) {
                            $base_path = Mknowledge::get_upload_path($nobject->id);
                            if (move_uploaded_file($_FILES['featured_img']['tmp_name'], $base_path . "featured.png")) {

                            }
                        }
                        $this->process_attached_file($nobject->id);
                        AddInfo("Successfully added", true);
                        AddLog("A", $nobject->settedPropertyforLog(), "l001", "");
                        redirectAdmin("knowledge/edit/{$nobject->id}");
                        return;
                    }
                }
            }
            $mainobj=new Mknowledge();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->Display();
       }
       function edit($param_id=""){

    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayMSGOnly();
                return;
            }   
            $addButton=' <a href="'.admin_url('knowledge/add').'" style="margin-top:-10px;" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i> Add New</a>';
            $this->SetTitle("Edit Knowledge ");
            $this->SetSubtitle($addButton);
            $this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
            $this->SetPOPUPIconClass ( "fa fa fa-star " );             
            if(IsPostBack){
                    $uobject=new Mknowledge();
                    $isUpdated=false;
                    if($uobject->SetFromPostData(false)){
                        $kbody=$this->input->post("k_body");
                        $uobject->k_body($kbody);
                    	$uobject->UnsetAllExcepts('featured_video_link,title,cat_id,k_body,is_stickey,k_tag,status');
                        $uobject->SetWhereUpdate("id",$param_id);
                        $isUploaded=$this->process_attached_file($param_id);
                        if($uobject->Update()){                            
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            $isUpdated=true;
                            AddInfo("Successfully updated",true);
                            //$this->DisplayPOPUPMsg();
                           // return;
                        }
                    }
                    
                    if(isset($_FILES['featured_img']) && empty($_FILES['featured_img']['error'])){
                        $base_path=Mknowledge::get_upload_path($param_id);
                        if(file_exists($base_path."featured.png")){
                            unlink($base_path."featured.png");
                        }
                        if( move_uploaded_file($_FILES['featured_img']['tmp_name'],$base_path."featured.png")) {
                            AddInfo("Image uploaded successfully",true);
                            $isUpdated=true;
                        }
                    }
                    if( $isUploaded || $isUpdated){
                        redirect(current_url());
                        return;
                    }
            }
            $mainobj=new Mknowledge();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayMSGOnly();
                return;
            }
            OldFields($mainobj, "title,k_body,is_stickey,k_tag,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->Display("admin/knowledge/add");
       }    
     
    
}
?>