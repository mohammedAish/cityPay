<?php 			
/**
 * Version 1.0.0
 * Creation date: 04/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,cat_id,title,k_body,v_count,l_count,d_count,is_stickey,added_by,k_tag,k_soundex,entry_time,last_update_time,status		
 */						
class Mknowledge extends APP_Model{	
	public $id;
	public $slug_id;
	public $cat_id;
	public $title;
	public $k_body;
	public $v_count;
	public $l_count;
	public $d_count;
	public $is_stickey;
	public $added_by;
	public $k_tag;
	public $featured_video_link;
	public $k_soundex;	
	public $entry_time;
	public $last_update_time;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="knowledge";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("is_stickey","status"),array("k_soundex"));
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"slug_id"=>array("Text"=>"Slug Id", "Rule"=>"max_length[100]"),
			"cat_id"=>array("Text"=>"Cat Id", "Rule"=>"max_length[10]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[200]"),
			//"k_body"=>array("Text"=>"K Body", "Rule"=>""),
			"v_count"=>array("Text"=>"V Count", "Rule"=>"max_length[10]|integer"),
			"l_count"=>array("Text"=>"L Count", "Rule"=>"max_length[11]|integer"),
			"d_count"=>array("Text"=>"D Count", "Rule"=>"max_length[11]|integer"),
			"is_stickey"=>array("Text"=>"Is Stickey", "Rule"=>"max_length[1]"),
			"added_by"=>array("Text"=>"Added By", "Rule"=>"required|max_length[2]"),
			"k_tag"=>array("Text"=>"K Tag", "Rule"=>"required|max_length[100]"),
			"featured_video_link"=>array("Text"=>"Featured Video", "Rule"=>"max_length[255]"),
		    "k_soundex"=>array("Text"=>"K Soundex", "Rule"=>"max_length[100]"),
			"entry_time"=>array("Text"=>"Entry Time", "Rule"=>"max_length[20]"),
			"last_update_time"=>array("Text"=>"Last Update Time", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "status":        
	         $returnObj=array("P"=>"Published","U"=>"Unpublished");
	         break;
	         case "is_stickey":
	             $returnObj=array("Y"=>"Yes","N"=>"No");
	             break;
	      default:
	    }	
	            	   
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;
		
	}

	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      case "status":
	         $returnObj=array("P"=>"success","U"=>"red");
	         break;
	      case "is_stickey":
	         $returnObj=array("Y"=>"success","N"=>"red");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "status":
	         $returnObj=array("P"=>"fa fa-check-circle-o","U"=>"fa fa-times-circle-o");
	         break;
	      default:
	    }
        return $returnObj;
	
	}	
	private static function increase_property($id,$property){
		$obj=new self();
		$obj->$property("{$property}+1",true);
		$obj->SetWhereCondition("id", $id);
		return $obj->Update();
	}		
	static function increase_view_count($id){
		$ci=get_instance(); 
		$kn=$ci->session->GetSession("k_views");
		if(empty($kn)){
			$kn=[];
		}
		if(in_array($id, $kn)){
			return true;
		}
		if(self::increase_property($id, "v_count")){
			$kn[]=$id;
			$ci->session->SetSession("k_views", $kn);
		}
		return true;
	}
	static function increase_like_count($id,&$msg=null){
		
		$kn=self::get_like_dislike_kn_ids();		
		if(isset($kn[$id])){
			$msg=__("You have already ".$kn[$id]=="l"?"liked":"disliked");
			return true;
		}
		if(self::increase_property($id, "l_count")){
			$kn[$id]="L";
			self::set_like_dislike_kn_ids($kn);
		}
		$msg=__("Thank you for your feedback");
		return true;
	}
	static function increase_dislike_count($id,&$msg=null){
	
		$kn=self::get_like_dislike_kn_ids();
		if(isset($kn[$id])){
			$msg=__("You have already ".$kn[$id]=="l"?"liked":"disliked");
			return true;
		}
		if(self::increase_property($id, "d_count")){
			$kn[$id]="D";
			self::set_like_dislike_kn_ids($kn);
		}
		$msg=__("Thank you for your feedback");
		return true;
	}
	static function get_like_dislike_kn_ids(){
		$ci=get_instance();
		$kn=$ci->session->GetSession("l_count");
		if(empty($kn)){
			$kn=[];
		}
		return $kn;
	}
	static function get_liked_dislike_type($id){
		$ci=get_instance();
		$kn=$ci->session->GetSession("l_count");
		if(empty($kn)){
			return 'N';
		}
		if(isset($kn[$id])){
			return $kn[$id];
		}
		return 'N';
	}
	static function set_like_dislike_kn_ids($knlist){
		$ci=get_instance();
		$ci->session->SetSession("l_count", $knlist);
		
	}
	public static function is_pre_text_match($source_text,$match_text){
	    if(preg_match('/^'.$match_text.'/i', $source_text)){
	        return true;
	    }
	    return false;
	}
	public static function is_exact_in_match($source_text,$match_text){
		if(preg_match('/'.$match_text.'/i', $source_text)){
			return true;
		}
		return false;
	}
	/**
	 * @param $source_text
	 * @param $match_text
	 *
	 * @return bool
	 */
	public static function is_text_match($source_text,$match_text){
	    if(soundex($source_text)==soundex($match_text)){
	        return true;
	    }
	    $matchpoint=similar_text($source_text, $match_text,$p);
	    //echo "$source_text = $match_text $matchpoint,$p%<br/>";
	    if($p>70 ){
	        return true;
	    }
	    $allword=explode(" ", $source_text);
	    if(count($allword)>0){
	        foreach ($allword as $wrd){
	            $matchpoint=similar_text($wrd, $match_text,$p);
	            //echo "$wrd = $match_text $matchpoint,$p%<br/>";
	            if($p>70 ){
	                return true;
	            }
	        }
	    }
	    return false;
	}
	static function Search($str,$limit=10,$start=0){
	    $str=trim($str);
	    $strar=explode(" ", $str);
	    $soundax="";
	    $mainkey="";
	    foreach ($strar as &$st){
	        $soundax.=soundex($st)."* ";
	        $mainkey.="{$st}* ";
	    }


        $query="SELECT k.id,k.slug_id,k.cat_id,k.title,k.v_count,k.l_count,k.d_count,k.last_update_time
            FROM knowledge AS k WHERE k.title like '%$str%' OR ( MATCH (k.title, k.k_body, k.k_tag, k.k_soundex) AGAINST ('{$mainkey} {$soundax}' IN BOOLEAN MODE))";


	    $response=new stdClass();
	    $response->total=0;
	    $response->data=[];
	    $response->full_url=site_url("knowledge/search-result/{$str}");
	    //die($query);
	    $obj=new self();
	    $data=$obj->SelectQuery($query);
	    $categories=Mcategory::getKnowledgeCategoryListHtmlOptionArray();
	    if(count($data)){
    	    $data=self::Sort($str, $data);
    	    foreach ($data as &$d){
    	        $d->cat_link=__("Uncategories");
    	        if($d->cat_id>0){
        	        if(!empty($categories[$d->cat_id])){
        	            $urltitle=($categories[$d->cat_id]); //app_urlencode
        	            $d->cat_link='<a class="src-category" href="'.site_url("category/details/{$d->cat_id}/{$urltitle}").'">'.$categories[$d->cat_id].'</a>';;
        	        }
    	        }
    	        $d->href=site_url("knowledge/details/{$d->id}/{$d->slug_id}");
    	        $d->is_stickey="N";
    	    }
    	    
    	    $counter_query="SELECT count(*) as total FROM knowledge AS k WHERE k.title like '%tast%' OR ( MATCH (k.title, k.k_body, k.k_tag, k.k_soundex) AGAINST ('{$mainkey} {$soundax}' IN BOOLEAN MODE))";
    	     
    	    $counterObj=$obj->SelectQuery($counter_query);
    	    if(!empty($counterObj[0]->total)){
    	        $response->total=$counterObj[0]->total;
    	    }
    	    
	    }
	    if($limit && $limit>0){
            $response->data=array_slice($data, 0, $limit);
        }else{
            $response->data=$data;
        }
	    return $response;
	}
	private static function Sort($src_txt,$data){
	    $serached_array=[];
	    $serached_array_title=[];
		$serached_exact_array_title=[];
	    $lessdata=[];
	    $preg=preg_replace("/[\s]+/", "|", $src_txt);	    
	    foreach ($data as $value){
	        if(self::is_pre_text_match($value->title, $src_txt)){
	            $value->title=preg_replace('/('.$preg.')/i', "<span class='src-text'>\${1} </span>", $value->title);
	            $serached_array[]=$value;
	        }elseif(self::is_exact_in_match($value->title, $src_txt)){
		        $value->title=preg_replace('/('.$preg.')/i', "<span class='src-text'>\${1} </span>", $value->title);
		        $serached_exact_array_title[]=$value;
	        } elseif(self::is_text_match($value->title, $src_txt)){
	           $value->title=preg_replace('/('.$preg.')/i', "<span class='src-text'>\${1} </span>", $value->title);
	           $serached_array_title[]=$value;
	        }else{
	           $value->title=preg_replace('/('.$preg.') /i', "<span class='src-text'>\${1} </span>", $value->title);
	           $lessdata[]=$value;
	        }
	        
	      
	    }
	    return array_merge($serached_array,$serached_exact_array_title,$serached_array_title,$lessdata);
	    
	}
	function get_last_update_time(){
		return $this->last_update_time!='0000-00-00 00:00:00'?$this->last_update_time:$this->entry_time;
	}
	static function update_soundex_by_id($id){
		$knowledge=self::FindBy("id", $id);
		$uobj=new self();
		$uobj->k_soundex($knowledge->get_soundex_values());
		$uobj->SetWhereCondition("id", $knowledge->id);
		$uobj->Update();
	}
	function get_soundex_values(){
		$keyindex=array(); //Bangladesh
		$str="";
		$product_names=explode(" ", $this->title);
		$previous="";
		$keyindex[]=soundex($this->title);
		$str.=soundex($this->title)." ";
		foreach ($product_names as $n){
			$sd=soundex($n);
			if(!in_array($sd, $keyindex)){
				$keyindex[]=$sd;
				$str.=$sd." ";
			}
			if(!empty($previous)){
				$sd=soundex($previous." ".$n);
				if(!in_array($sd, $keyindex)){
					$keyindex[]=$sd;
					$str.=$sd." ";
				}
				$previous=$n;
			}
				
		}
		$keywords=explode(",", $this->k_tag);
		foreach ($keywords as $k){
			$sd=soundex($k);
			if(!in_array($sd, $keyindex)){
				$keyindex[]=$sd;
				$str.=$sd." ";
			}
		}
		//category		
		$keywords=Mcategory::getParentStr($this->cat_id,false,'',',');
		if(!empty($keywords)){
		    $keywords=explode(",", $keywords);		    
		    foreach ($keywords as $k){
		        $sd=soundex($k);
		        if(!in_array($sd, $keyindex)){
		            $keyindex[]=$sd;
		            $str.=$sd." ";
		        }
		    }
		}
		$str=trim($str);
		return $str;
	}  
	static function DeleteById($value,$noLimit=false){
	    return parent::DeleteByKeyValue("id", $value,$noLimit);
	} 
	static function get_upload_path($id='', $isAttachment=false){
	    $base_path=FCPATH."data/knowledge/";
	    if(!is_dir($base_path)){
	        app_make_dir($base_path,0755,true,true);
	    }
	    if(!empty($id)){
	        $base_path.="$id/";
	        if($isAttachment){
                $base_path.="files/";
            }
    	    if(!is_dir($base_path)){
    	        app_make_dir($base_path,0755);
    	    }
	    }
	    return $base_path;
	}
    static function get_attach_url($id='', $filename){
       return base_url("data/knowledge/{$id}/files/{$filename}");
    }
	static function  getAttachedFile($id)
    {
        $path=self::get_upload_path($id,true);
        $response=[];
        foreach (glob($path."*.*",GLOB_BRACE) as $item) {
            $filename=basename($item);
            if($filename!="index.html"){
                $obj=new stdClass();
                $obj->file=$filename;
                $obj->full_path=$item;
                $response[]=$obj;
            }

        }
        return $response;
    }
	static function get_feature_url($id){
	    $path=self::get_upload_path($id)."featured.png";
	    if(file_exists($path)){
	        return image_url("data/knowledge/{$id}/featured.png");
	    }
	    return '';	    
	}
	static function delete_feature_img($id){
	    $path=self::get_upload_path($id)."featured.png";
	    if(file_exists($path)){
	       return unlink($path);
	    }else{
	        return true;
	    }
	    return false;
	}
    static function delete_attached_file($id,$filename){
        $path=self::get_upload_path($id,true).$filename;
        if(file_exists($path)){
            return unlink($path);
        }else{
            return true;
        }
        return false;
    }
	function get_slug($tired=0){
        $slag_str=strtolower($this->title);
        $slag_str = preg_replace("/\\s+/iu", '-', $slag_str);
        $slag_str = preg_replace('/[\\\\*\$\'"\(\)&@]/u', '-', $slag_str);
        $slag_str=preg_replace('/[-]+/','-',$slag_str);
        return trim($slag_str, '- ');
	} 	
	//auto generated
    function Save(){	
    	$slug=$this->get_slug();
    	if(empty($slug)){
    		//AddError("Please change title. This tile is matched with 5 knowledges");
    		return false;
    	}
    	if(!$this->IsSetPrperty("entry_time")){
    	    $this->entry_time(date("Y-m-d H:i:s"));
    	}
    	if(!$this->IsSetPrperty("last_update_time")){
    	    $this->last_update_time(date("Y-m-d H:i:s"));
    	}
    	$this->slug_id($slug);
    	$this->k_soundex($this->get_soundex_values());
    	$this->k_body(CleanHTMLtoText($this->k_body));
	    return parent::Save();
	}
	function Update($notLimit = false, $isShowMsg = true,$dontProcessIdWhereNotset=true){
		$isNeedToUpdate=false;
		$id="";
		if($this->IsSetPrperty("title") || $this->IsSetPrperty("k_tag")||$this->IsSetPrperty("cat_id")){
			$isNeedToUpdate=true;
			if($this->IsSetWherePrperty("id")){
				$id=$this->getWherePrperty("id");
			}
		}
        if($this->IsSetPrperty("title")){
            $slug=$this->get_slug();
		    $this->slug_id($slug);
        }
        if($this->IsSetPrperty("title") || $this->IsSetPrperty("k_tag")||$this->IsSetPrperty("cat_id")||$this->IsSetPrperty("k_body")) {

            $this->last_update_time(date('Y-m-d H:i:s'));
        }
		if($this->IsSetPrperty("k_body")) {
			$this->k_body(CleanHTMLtoText($this->k_body));
		}
		$isUpdate=parent::Update($notLimit, $isShowMsg,$dontProcessIdWhereNotset);
		if($isUpdate && $isNeedToUpdate && !empty($id)){
			self::update_soundex_by_id($id);
		}
		return $isUpdate;
	}
	
			


/* add custom function here*/
	
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
				$label_col=$input_col="";
					?>
			<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label  <?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class=" <?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
		     <div class="row">
				<div class="col-md-6">
				<?php if(!in_array("title",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label  <?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
			      	<div class=" <?php echo $input_col;?>">                   			     	
			      		<input type="text" maxlength="200" value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			      	</div>
			      </div> 
			     <?php } ?>
				</div>
				<div class="col-md-3">
					<?php if(!in_array("is_stickey",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label  <?php echo $label_col;?>" for="is_stickey"><?php _e("Is Sticky/Pinned ?"); ?></label>
				      	<div class=" <?php echo $input_col;?>">                   			     	
				      		
					     <div class="togglebutton ">
						    <input  name="is_stickey" value="N" type="hidden">
							<label> 
							<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_stickey","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_stickey" <?php echo in_array("is_stickey", $disabled)?' disabled="disabled" ':' name="is_stickey" ';?>   > 
							</label>
						</div>			         
					         
				      	</div>
				      </div> 
				     <?php } ?>	
				</div>
				<div class="col-md-3">
					<?php if(!in_array("status",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label  <?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
				      	<div class=" <?php echo $input_col;?>">                   			     	
				      		<div class="inline radio-inline">
					        <?php 
					            $status_selected= $mainobj->GetPostValue("status","U");
					            $status_isDisabled=in_array("status", $disabled);
					            GetHTMLRadioByArray("Status","status","status",true,$mainobj->GetPropertyRawOptions("status"),$status_selected,$status_isDisabled);
					            ?>
					        
					       </div> 
				      	</div>
				      </div> 
				     <?php } ?>
				</div>
			</div>
			
			
			
			
			<?php if(!in_array("cat_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label <?php echo $label_col;?>" for="cat_id"><?php _e("Category"); ?></label>
		      	<div class="<?php echo $input_col;?>">  
		      		<?php 		      		
		      		$options_category=Mcategory::getKnowledgeCategoryListHtmlOptionArray('A');
		      		?>
			        <select class="form-control" id="cat_id" <?php echo in_array("cat_id", $disabled)?' disabled="disabled" ':' name="cat_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Category"));?>">
			        <?php $category_selected= $mainobj->GetPostValue("cat_id");
			            GetHTMLOption("0", "All",$category_selected);
			            GetHTMLOptionByArray($options_category,$category_selected);
			            ?>			        
			        </select>
		      	</div>
		      </div> 
		     <?php } ?>
			
			
			<div class="row">
				<div class="col-md-9">
				<?php if(!in_array("k_body",$except)){ ?>
    			 <div class="form-group">
    		      	<label class="control-label " for="k_body"><?php _e("Body"); ?></label>
    		      	<div class="">                   			     	
    		      		<textarea   class="form-control app-html-editor" data-image-up-path="<?php echo admin_url("image-upload/manager")?>" style="min-height: 200px;" id="k_body" <?php echo in_array("k_body", $disabled)?' disabled="disabled" ':' name="k_body" ';?>  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Body"));?>"    placeholder="<?php _e("Body"); ?>" ><?php echo  $mainobj->GetPostValue("k_body","",false);?></textarea>
    		      	</div>
    		      </div> 
    		     <?php } ?>
				</div>
				<div class="col-md-3 md-p-l-0">
					<?php if(!in_array("featured_video_link",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label  <?php echo $label_col;?>" for="featured_video_link"><?php _e("Featured video"); ?> <small style="font-style: italic;">(YouTube,Daily Motion,etc)</small></label>
			      	<div class=" <?php echo $input_col;?>">                   			     	
			      		<textarea  maxlength="250"  class="form-control" id="featured_video_link" <?php echo in_array("featured_video_link", $disabled)?' disabled="disabled" ':' name="featured_video_link" ';?>     placeholder="<?php _e("Featured Video"); ?>"><?php echo  $mainobj->GetPostValue("featured_video_link");?></textarea>
			      		<span class="form-group-help-block text-red"><?php _e("Keep empty if you don't want show any video");?></span>
			      	</div>
			      </div> 
			     <?php } ?>
				<div class="form-group">
				   
                		<label style="" class="control-label " for="app_logo"><?php _e("Featured Image"); ?></label>
                		<div class="" >
                		
                		 <div class="panel panel-default">				      
    				      <div class="panel-body text-center" style="position: relative;">
                    		     
                    		  <?php 
                    		      $basePath=Mknowledge::get_upload_path($mainobj->id);
                    		      $isExistImg=false;
                    		      if(!empty($mainobj->id) && file_exists($basePath."featured.png")){
                    		          $_featured_image=base_url("data/knowledge/{$mainobj->id}/featured.png?v=".filemtime($basePath."featured.png"));
                    		          $isExistImg=true;
                    		      }else{
                    		          $_featured_image=base_url("images/no-image-2.png?t=".time());
                    		      }
                    		  ?>         		
                    		 	<img id="featured-img-tag" class="app-image-input img-thumbnail" data-name="featured_img" src="<?php echo $_featured_image;?>" style="max-width:170px;background: rgb(217, 220, 220); width: 100%"/>
                    		 	<?php if($isExistImg){?>
                    		 	<a class="btn btn-xs btn-danger ConfirmAjaxWR delete-feature-img" style="top: 28px; right: 28px;position: absolute;" href="<?php echo admin_url("knowledge-confirm/delete-feature/{$mainobj->id}")?>" data-msg="<?php _e("Are you sure to delete feature image?") ; ?>" data-on-complete="delete_completed"><i class="fa fa-trash"></i></a>
                    		 	<?php }?>
                    		 	<span class="form-group-help-block"><?php _e("Click on the Image to change or upload.");?></span>
                    		 	<span class="form-group-help-block text-red"><?php _e("Don't upload if you don't want");?></span>
                    		 	</div>
    				    </div>
                		</div>
                		
                	</div>                	
				</div>
			</div>
         <?php if(!in_array("k_tag",$except)){ ?>
             <div class="form-group">
                 <label class="control-label  <?php echo $label_col;?>" for="k_tag"><?php _e("Tag"); ?></label>
                 <div class=" <?php echo $input_col;?>">
                     <input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("k_tag");?>" class="form-control app-tags" id="k_tag" <?php echo in_array("k_tag", $disabled)?' disabled="disabled" ':' name="k_tag" ';?>     placeholder="<?php _e("Tag"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Tag"));?>">
                 </div>
             </div>
         <?php } ?>
         <?php
         $filesizeinmb=GetServerMaxUploadSize();
         $file_extensions="";

         ?>

         <?php
         $hasAttachedFile=false;
         if(!empty($this->id)) {
             $afiles = self::getAttachedFile($this->id);
             $hasAttachedFile=count($afiles)>0;
             if($hasAttachedFile) {?>
                 <label for=""><?php _e("Attached"); ?></label>
                 <div class="row">
                     <ul class="a-files">
                         <?php
                         foreach ($afiles as $f) {
                             $type = mime_content_type($f->full_path);
                             $isImage = substr(strtolower($type), 0, 3) == "ima";
                             $afileName = strlen($f->file) > 15 ? substr($f->file, 0, 3) . ".." . substr($f->file, -10) : $f->file;
                             $icolor = "";
                             $iclass = "";
                             if ($isImage) {
                                 $typeTitle = $type;
                             } elseif ($type == "application/x-zip-compressed" || $type == "application/zip") {
                                 $typeTitle = "Zip File";
                                 $iclass = "fa-file-zip-o";
                                 $icolor = "#fbb847";
                             } elseif ($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $type == "application/msword") {
                                 $typeTitle = "Word File";
                                 $iclass = "fa-file-word-o";
                                 $icolor = "#2C5990";
                             } elseif ($type == "application/pdf") {
                                 $typeTitle = "PDF File";
                                 $iclass = "fa-file-pdf-o";
                                 $icolor = "#E42101";
                             } else {
                                 $iclass = "fa-file-o";
                                 $typeTitle = $type;
                                 $icolor = "#CCCCCC";
                             }
                             $fileurl = urlencode($f->file);
                             ?>
                             <li class="">
                                 <div class="a-file-item">
                                     <a data-msg="<?php _e("Are you sure to delete attached file (%s)?", $afileName); ?>"
                                        data-on-complete="delete_attach_completed"
                                        href="<?php echo admin_url("knowledge-confirm/del-attach-file/{$this->id}/{$fileurl}") ?>"
                                        class="rm-a-f ConfirmAjaxWR">
                                         <i class="fa fa-trash-o"></i>
                                     </a>
                                     <div class="a-filename"> <?php echo $afileName; ?></div>
                                     <i class="fa <?php echo $iclass . " " . ($isImage ? "hidden" : ""); ?>"
                                        style="color:<?php echo $icolor ?>;"></i>
                                     <?php if ($isImage) { ?>
                                         <img class="img-responsive"
                                              src="<?php echo self::get_attach_url($this->id, $f->file); ?>"
                                              alt="<?php echo $afileName; ?>">
                                     <?php } ?>
                                     <div class="f-size-c"><?php printf("%.2f MB", filesize($f->full_path) / 1048576); ?></div>
                                 </div>

                             </li>
                         <?php } ?>
                     </ul>

                 </div>
                 <?php
             }
         }
         ?>
         <label for=""><?php $hasAttachedFile?_e("Attach more file"):_e("Attach file") ; ?></label>
         <div id="file-container" class="row">
             <div id="main_file_btn" class="col-md-6 form-group app-file-main-container">
                 <div class="panel panel-default m-b-5">
                     <div class="panel-body app-file-upload-container">
                         <div class="row">
                             <div class="col-md-7 col-sm-6 col-xs-9 app-file-input-conteiner">
                                 <?php echo get_file_upload_button("upload_files[]",$file_extensions,"upload_files","app-ticket-file");?>
                                 <span class="form-group-help-block"><?php _e("Max file size is %s MB",$filesizeinmb);?></span>
                                 <button type="button" class="btn btn-xs btn-danger app-btn-file-reset hidden"><i class="fa fa-trash-o"></i> <?php _e("Remove") ; ?></button>
                             </div>
                             <div class="col-md-5 col-sm-6 col-xs-3">
                                 <div class="row file-preview-img hidden">
                                     <div class="u-file-dtls col-sm-8 hidden-xs">
                                         <dl class="dl-horizontal">
                                             <dt><?php _e("File Type") ; ?></dt>
                                             <dd><span class="u-file-type"></span></dd>
                                             <dt><?php _e("File Size") ; ?></dt>
                                             <dd><span class="u-file-size"></span></dd>
                                         </dl>
                                     </div>
                                     <div class="u-file-preview col-sm-4 col-xs-12 text-right">
                                         <i class="fa fa-file-o pull-right"></i>
                                         <img  class="img-responsive pull-right" src="" alt="" />
                                     </div>
                                 </div>
                             </div>

                         </div>


                     </div>
                 </div>

             </div>
         </div>
         <button data-target="main_file_btn" data-clone-inc="true" data-container="#file-container" class="add-cloner-button btn btn-xs btn-info m-b-15 "><i class="fa fa-plus-circle"></i> <?php _e("Add Another File") ; ?></button>
         <script type="text/javascript">
             function resetFile(obj){
                 var parentBodyElem=obj.closest(".app-file-upload-container");
                 var previewWindowElem=parentBodyElem.find(".file-preview-img");
                 previewWindowElem.addClass("hidden");
                 parentBodyElem.find("input[type=file]").val("");
                 obj.addClass("hidden");
             }
             $(function(){
                 $('body').on("click",".app-btn-file-reset",function(e){
                     e.preventDefault();
                     $(this).closest(".app-file-main-container").fadeOut('fast',function(){
                         $(this).remove();
                     });

                 });
                 $('body').on("click",".app-btn-file-reset-2",function(e){
                     e.preventDefault();
                     $(this).closest(".panel").fadeOut('fast',function(){
                         $(this).remove();
                     });

                 });
                 $("body").on("change",".app-ticket-file", function() {

                     var parentBodyElem=$(this).closest(".app-file-upload-container");
                     var resetInput=parentBodyElem.find(".app-btn-file-reset");
                     var previewWindowElem=parentBodyElem.find(".file-preview-img");
                     var fileTypeElem=previewWindowElem.find(".u-file-type");
                     var fileSizeElem=previewWindowElem.find(".u-file-size");
                     var fileIconElem=previewWindowElem.find(".u-file-preview > i");
                     var fileImgElem=previewWindowElem.find(".u-file-preview > img");

                     //this.files[0].size gets the size of your file. u-file-dtls>u-file-type+u-file-size,
                     <?php

                     $filesizeinbyte=2048;
                     if($filesizeinmb){
                         $filesizeinbyte=$filesizeinmb*1048576;
                     }
                     ?>
                     var maxfilezone=<?php echo $filesizeinbyte;?>;
                     var fileExtension=this.files[0].name.substr(-4);
                     var fileAccepts=$(this).attr("accept");
                     var isExtensionOk=fileAccepts.indexOf(fileExtension)!=-1;
                     if(maxfilezone<this.files[0].size){
                         $(this).val("");
                         resetFile(resetInput);
                         ShowGritterMsg("<?php _e("Max file size is  %s MB",$filesizeinmb) ;?>",false,false,"Large File Error",'times-circle-o');
                     }else{
                         var isImg=this.files[0].type.substr(0,3).toLowerCase();
                         if(isImg=="ima"){
                             var fr=new FileReader();
                             // when image is loaded, set the src of the image where you want to display it
                             fr.onload = function(e) {
                                 fileIconElem.addClass("hidden")
                                 fileImgElem.attr("src",this.result);
                                 fileImgElem.removeClass("hidden");
                                 previewWindowElem.removeClass("hidden");
                             };
                             fr.readAsDataURL(this.files[0]);
                         }else{
                             fileImgElem.addClass("hidden");
                             previewWindowElem.removeClass("hidden");
                             fileIconElem.removeClass("hidden");

                         }

                         var type=typeTitle=this.files[0].type;
                         if(type=="application/x-zip-compressed"){
                             typeTitle=type="Zip File"
                             fileIconElem.attr("class","fa fa-file-zip-o pull-right");
                             fileIconElem.css("color","#fbb847");
                         }else if(type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||type=="application/msword"){
                             typeTitle=type="Word File"
                             fileIconElem.attr("class","fa fa-file-word-o pull-right");
                             fileIconElem.css("color","#2C5990");
                         }else if(type=="application/pdf"){
                             typeTitle=type="PDF File"
                             fileIconElem.attr("class","fa fa-file-pdf-o pull-right");
                             fileIconElem.css("color","#E42101");
                         }else{
                             if(type.length>20){
                                 type=type.substr(0,17)+"...";
                             }
                             fileIconElem.attr("class","fa fa-file-o pull-right").css("color","#CCCCCC");;
                         }
                         fileTypeElem.text(type).attr("title",typeTitle);;
                         fileSizeElem.text(((this.files[0].size/(1024*1024)).toFixed(2))+" MB");
                         resetInput.removeClass("hidden");
                     }

                 });
             });

		      function delete_completed(rdata,thisobj){
		    	   swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
		    	   if(rdata.status){
			    	   var noImgPath="<?php echo base_url("images/no-image-2.png?t=".time());?>";
			    	   $("#featured-img-tag").attr("src",noImgPath);
			    	   thisobj.remove();
		    	   }
		      }
		      function delete_attach_completed(rdata,thisobj){
                 swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
                 if(rdata.status){
                    thisobj.closest("li").fadeOut('slow',function(){
                       $(this).remove();
                    });
                 }
             }


		     </script>	
			<?php 
	}


}
?>