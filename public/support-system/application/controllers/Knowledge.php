<?php
class Knowledge extends APP_Controller {
	
	public function index()
	{
		$this->SetTitle("Knowledge");
		AddModule("search_module",APP_Output::MODULE_CONTENT_TOP,["css_class"=>"text-left"]);		
		$this->Display();
	}
	
	public function details($id='',$slug='')
	{
		$this->output->UnsetModule("content_header");
		$this->AddBreadCrumb("Knowledge", site_url('knowledge'),"fa fa-graduation-cap");
		$loginType=GetCurrentUserType();
		if(!empty($id)){		
		    if($loginType=="AD"){
		        $knowledge=Mknowledge::FindBy("id", $id);
		    }else{	
			     $knowledge=Mknowledge::FindBy("id", $id,array("status"=>"P"));
		    }
			if($knowledge){
				Mknowledge::increase_view_count($knowledge->id);
				$this->SetTitle($knowledge->title);
					
				$knowledge->category_name="";
				if(!empty($knowledge->cat_id)){
					$category=Mcategory::FindBy("id",$knowledge->cat_id);
					if($category){
						$knowledge->category_name=$category->title;
					}
				}
				$knowledge->added_by_name="";
				if(!empty($knowledge->added_by)){
					$appuser=Mapp_user::FindBy("id",$knowledge->added_by);
					if($appuser){
						$knowledge->added_by_name=$appuser->title;
					}
				}
				$this->AddMetaData("keywords", $knowledge->k_tag);
				$src_decription=substr(strip_tags($knowledge->k_body), 0,150);
				$src_decription.=" ...";
				$this->AddMetaData("description", $src_decription);
				//facebook
				$this->AddMetaPropertyData("og:url", current_url());
				$this->AddMetaPropertyData("og:type", $knowledge->category_name);
				$this->AddMetaPropertyData("og:title", $knowledge->title);
				$this->AddMetaPropertyData("og:description", $src_decription);
				$url=Mknowledge::get_feature_url($knowledge->id);
				if(!empty($url)){
				    $this->AddMetaPropertyData("og:image", $url);
				}else{
				    $this->AddMetaPropertyData("og:image", base_url("images/icon-logo/logo.png"));
				}
			}else{
				$this->SetTitle("Not Found");
			}			
			 $this->AddViewData("knowledge", $knowledge);
			 
			
		}
		if($this->input->is_ajax_request()){
		    $this->SetPOPUPColClass("col-md-11");
		    $this->DisplayPOPUP();
		}else{
		  $this->Display();
		}
	}
	public function counter($type="",$id=""){
		$this->output->unset_template();
		$con=new AjaxConfirmResponse();
		if(empty($type) || empty($id)){
			$con->DisplayResponse(false, "Invalid request");
		}
		$type=strtolower($type);
		if($type=="like"){
			$msg="Unknown Error";
			$status=Mknowledge::increase_like_count($id,$msg);
			$con->DisplayResponse($status, $msg);			
		}elseif($type=="dislike"){
			$msg="Unknown Error";
			$status=Mknowledge::increase_dislike_count($id,$msg);
			$con->DisplayResponse($status, $msg);			
		}
		
		//detaild
		$con->DisplayResponse(false, "Invalid request");
		
	}
	public function search_result($src_str=''){
	   // AddModule("right_module",APP_Output::MODULE_RIGHT);
	    $this->SetTitle("Search Result");
        $src_str=urldecode($src_str);
	    $src_str=CleanSearchString($src_str);
	    $result=Mknowledge::Search($src_str,false);
	   // GPrint($result);
	    $this->AddViewData("knowledges", $result->data);
	    $this->Display();
	}
	
	
}