<?php 
/** 
 * @since: 21/Feb/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0		
 */	
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Remote_server extends APP_Controller{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
            $this->SetPOPUPColClass ( "col-md-7 col-sm-6" );
            $this->SetPOPUPIconClass ( "ap ap-remote-login" );
        }
      
	         
       function index(){	   
    	    $this->SetTitle("Remote Login List");
    	    $this->SetSubtitle("");
    	    $this->AddBreadCrumb("home", base_url());
    	    $this->load->library("jQGrid");
    	    $this->AddViewData("grid_url", site_url("admin/remote-server-data/remote-server-list"));    	   
    	    $this->Display();
	   }
       
       function add(){
        	$this->SetTitle("New Remote Login"); 
           
            if(IsPostBack){
                
                       
                $nobject=new Mremote_server();            
                if($nobject->SetFromPostData(true)){
                    if($nobject->Save()){ 
                       $path= FCPATH."data/login_button_img/";
                        if(!is_dir($path)){
                            app_make_dir($path,0755,true,true);
                        }   
                        if(is_dir($path)){
                            if($_FILES['button_logo']["error"]==0 &&  move_uploaded_file($_FILES['button_logo']['tmp_name'], $path.$nobject->id.".png")){
                                AddInfo("Log uploaded");
                            }
                        }                                 
                        AddInfo("Successfully saved",true);
                        AddLog("A",$nobject->settedPropertyforLog(),"l001","");                     
                        redirect("admin/remote-server/edit/{$nobject->id}");
                        return;
                    }
                }       
            }
            $this->SetPopupFromMutipart();
            $mainobj=new Mremote_server();
            //$this->SetPopupFromMutipart();      
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", false);           
            $this->DisplayPOPUP();
       }
       function edit($param_id=""){
           
    	   if(empty($param_id)){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }           
            $this->SetTitle("Edit Remote Login");
                       
            if(IsPostBack){
                    $isFIleDeleted=PostValue("file_deleted","N")=="Y";
                    $uobject=new Mremote_server();
                    $isUpdated=true;
                    if($uobject->SetFromPostData(false)){
                        $uobject->SetWhereUpdate("id",$param_id);
                        if($isFIleDeleted){
                            if(!$uobject->delete_file($param_id)){
                                $isUpdated=false;
                            }
                        }
                        $path= FCPATH."data/login_button_img/";
                        if(!is_dir($path)){
                            app_make_dir($path,0755,true,true);
                        }
                        if(is_dir($path)){
                            if($_FILES['button_logo']["error"]==0 &&  move_uploaded_file($_FILES['button_logo']['tmp_name'], $path.$param_id.".png")){
                                AddInfo("Button image updated successfully");
                            }
                        }
                        
                        if($uobject->IsSetDataForSaveUpdate() && !$uobject->Update()){
                            $isUpdated=false;                            
                        }
                        
                        if($isUpdated){
                            AddLog("U",$uobject->settedPropertyforLog(),"l002","");
                            AddInfo("Successfully updated",true);
                            redirect("admin/remote-server/edit/{$param_id}");
                            return;
                        }
                    }
            }
            $this->SetPopupFromMutipart();
            $mainobj=new Mremote_server();
            $mainobj->id($param_id);
            if(!$mainobj->Select()){
                AddError("Invalid request");
                $this->DisplayPOPUPMsg();
                return;
            }
            OldFields($mainobj, "name,login_url,valid_url,button_text_color,button_color,button_txt,server_type,status");
            //$this->SetPopupFromMutipart();
            $this->AddViewData("mainobj", $mainobj);
            $this->AddViewData("isUpdate", true);           
            $this->DisplayPOPUP("admin/remote_server/add");
       }    
    
}
?>