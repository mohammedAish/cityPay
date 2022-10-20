<?php
class Category extends APP_Controller {
	
	public function index()
	{
		$this->SetTitle("Categories");
		//$this->AddBreadCrumb("Knowledge", site_url('knowledge'),"fa fa-graduation-cap");
		AddModule("search_module",APP_Output::MODULE_CONTENT_TOP,["css_class"=>"text-left"]);
		$this->Display();
	}
	
	public function details($id='',$slug='')
	{
		$this->output->UnsetModule("content_header");
		$this->AddBreadCrumb("Categories", site_url('category'),"fa fa-th-large");
		//Mcategory::getParentStr($cat_id)
		if(!empty($id)){			
			$categoryObj=Mcategory::FindBy("id", $id,array("status"=>"A"));
			if($categoryObj){	
			    if(!empty($categoryObj->parent_category_path)){			
			     $parents=explode("-", $categoryObj->parent_category_path);
			     foreach ($parents as $pcid){
			         $ptitle=Mcategory::getCategoryStr($pcid,'',false,true);
			         $urltitle=app_slag_refine($ptitle);
			         $this->AddBreadCrumb($ptitle, site_url("category/details/{$pcid}/{$urltitle}"),"");
			     }
			    }			    
				$this->SetTitle($categoryObj->title);					
				$src_decription=get_app_title()." ".$categoryObj->title;	
				$knowledges=Mknowledge::FindAllBy("cat_id", $id,["status"=>"P"],"id");
				$child_ctgs=Mcategory::getAllChildCategory($id,"parent_category_path","asc");
				$keys=[];
				if(count($child_ctgs)>0){
    				$finalCategory=[];    				
    				foreach ($child_ctgs as $ct){
    				    $ct->kn_list=[];
    				    $keys[]=$ct->id;
    				    $finalCategory[$ct->id]=$ct;
    				}
    				
    				$keystr="('".implode("','", $keys)."')";
    				$cn=new Mknowledge();
    				$cn->cat_id("in $keystr",true);
    				$cn->status("P");
    				$cresult=$cn->SelectAll('','id','asc');
    				if(count($cresult)){
        				foreach ($cresult as $kn){
        				    if(isset($finalCategory[$kn->cat_id])){
        				        $finalCategory[$kn->cat_id]->kn_list[]=$kn;
        				    }
        				}
    				}
    				$this->AddViewData("childKnowledge", $finalCategory);
				}
				$keys[]=$id;
				$this->AddViewData("cat_ids", $keys);
				$this->AddViewData("knowledges", $knowledges);
				$this->AddViewData("category", $categoryObj);
				$this->AddMetaData("keywords", $categoryObj->title);				
				$this->AddMetaData("description", $src_decription);
				//facebook
				$this->AddMetaPropertyData("og:url", current_url());
				$this->AddMetaPropertyData("og:type", $categoryObj->title);
				$this->AddMetaPropertyData("og:title", $categoryObj->title);
				$this->AddMetaPropertyData("og:description", $src_decription);
				$this->AddMetaPropertyData("og:image", base_url("images/icon-logo/logo.png"));
			}else{
				$this->SetTitle("Not Found");
			}			
			 $this->AddViewData("knowledge", $categoryObj);
			 
			
		}
		$this->Display();
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
	    $src_str=CleanStringNumber($src_str);
	    $result=Mknowledge::Search($src_str);
	   // GPrint($result);
	    $this->AddViewData("knowledges", $result->data);
	    $this->Display();
	}
	
	
}