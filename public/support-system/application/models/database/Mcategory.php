<?php 			
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,title,parent_category,parent_category_path,status		
 */						
class Mcategory extends APP_Model{	
	public $id;
	public $title;
	public $parent_category;
	public $parent_category_path;
	public $show_on;
	public $status;
	private static $categories_key_value=[];
	private static $categories_key_value_is_loaded=false;
	private static $loaded_ctg_list=[];
	private static $ctg_knowledges=null;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="category";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
	static function &getAllCategoriesKeyValue($isForceLoad=false){
		if($isForceLoad || !self::$categories_key_value_is_loaded){
			$objs=self::FetchAll();
			foreach ($objs as $obj){
				$cat=new stdClass();
				$cat->id=$obj->id;
				$cat->title=$obj->title;
				$cat->parent_category=$obj->parent_category;
				$cat->parent_category_path=$obj->parent_category_path;
				self::$categories_key_value[$obj->id]=$cat;	
				self::$categories_key_value_is_loaded=true;							
			}
		}
		return self::$categories_key_value;
	} 
	static function getAllCategoriesKeyTitle($isForceLoad=false){
	    $final_category=[];
	    $ctgs=self::getAllCategoriesKeyValue();
	    foreach ($ctgs as $c_id=>$ctg){
	        $final_category[$c_id]=$ctg->title;
	    }
	    return $final_category;
	}
	static function getAllChildCategory($fromBaseParentCategoryId, $order_by='id',$order='asc'){
	    $query="select * from category where id<>{$fromBaseParentCategoryId} and  (parent_category='{$fromBaseParentCategoryId}' or parent_category_path like '%-{$fromBaseParentCategoryId}-%')";
	    $obj=new self();
	    $obj->id("<>{$fromBaseParentCategoryId}",true);
	    $obj->parent_category("='$fromBaseParentCategoryId' or parent_category_path like '%-{$fromBaseParentCategoryId}-%'  or parent_category_path like '%-{$fromBaseParentCategoryId}%'",true);
	    //$obj->parent_category_path("like '%-{$fromBaseParentCategoryId}-%'",true);	    
	    return $obj->SelectAll('',$order_by,$order);    
	
	}
	static function getParentStr($fromBaseParentCategoryId,$isLinkable=false,$parent_str='',$divider_icon=' &raquo; ',$length=1){
		if(empty($fromBaseParentCategoryId) || $length>10){
			return '-';
		}			
		$cat_list=self::getAllCategoriesKeyValue();
		if(!empty($cat_list[$fromBaseParentCategoryId])){		
		    $currentTitle=$cat_list[$fromBaseParentCategoryId]->title;	
		    if($isLinkable){		        
		        $currentTitle='<a href="'.(site_url("category/details/{$fromBaseParentCategoryId}/{$currentTitle}")).'">'.$currentTitle."</a>";
		    }
			if(!empty($parent_str)){			
				$parent_str=$currentTitle.$divider_icon.$parent_str;
			}else{
				$parent_str=$currentTitle;
			}
			if(!empty($cat_list[$fromBaseParentCategoryId]->parent_category)){
				$catid=$cat_list[$fromBaseParentCategoryId]->parent_category;
				$parent_str=self::getParentStr($catid,$isLinkable,$parent_str,$divider_icon,$length+1);
			}
			
		}
		return $parent_str;
		
	}	
	static function getCategoryStr($cat_id,$class="",$isLinkable=false,$is_no_prefix=false){
		if(empty($cat_id)){
			return '-';
		}
		$cat_list=self::getAllCategoriesKeyValue();
		$category_str="";
		if(!empty($cat_list[$cat_id])){
			$category_str=$cat_list[$cat_id]->title;
				
		}
		if($is_no_prefix){
		    return $category_str;
		}
		return "<span class='tooltip2 cat-tool {$class}' title='".self::getParentStr($cat_id)."'><i class='fa fa-exclamation-circle'></i> ".$category_str."</span>";
	
	}	
	static function getCategoryListOptionArray($status='',$icon='&raquo;'){
		$obj=new self();
		if(!empty($status)){
			$obj->status('A');
		}
		$result=$obj->SelectAllGridData('',['parent_category_path'=>'ASC','title'=>'ASC']);
		$ares=[];
		foreach ($result as $newobj){
			self::process_option_array($ares, $newobj,0,$icon);
		}
		return $ares;
	}
	static function getCategoryListHtmlOptionArrayOnlyTicket($status='',$icon='&raquo;'){
		    $resultarray=[];
		    return self::getCategoryListHtmlOptionArray($status,null,$resultarray,$icon,"T");
	}
	static function getCategoryListHtmlOptionArrayOnlyKnowledge($status='',$icon='&raquo;'){
		$resultarray=[];
		return self::getCategoryListHtmlOptionArray($status='',null,$resultarray,$icon,"K");
	}
	static function getCategoryListHtmlOptionArray($status='',$data=null,&$resultarray=[],$icon='&raquo;',$for=""){
		if(!$data){
			$data=self::getCategoryListOptionArray($status,$icon);
		}
		foreach ($data as $d){	
			if(empty($d->id)){				
				continue;
			}
			$skip=false;
			if(!empty($for)){
			    if($d->show_on!=$for && $d->show_on!="B"){
				    $skip=true;
			    }
			}
			if(!$skip) {
				$resultarray[ $d->id ] = $d->full_title;
			}
			if(count($d->childs)){
				self::getCategoryListHtmlOptionArray($status,$d->childs,$resultarray,$icon,$for);				
			}
		}
		return $resultarray;
		
	}
	static function getTicketCategoryListHtmlOptionArray($status='',$data=null,&$resultarray=array(),$icon='&raquo;'){
		return self::getCategoryListHtmlOptionArray($status,$data,$resultarray,$icon,'T');		
	}
	static function getKnowledgeCategoryListHtmlOptionArray($status='',$data=null,&$resultarray=array(),$icon='&raquo;'){
	    return self::getCategoryListHtmlOptionArray($status,$data,$resultarray,$icon,'K');
	}
	static function getTicketCategories($limit=10,$start=0,$order="DESC",$is_no_parent=false,$icon='&raquo;'){
	    $order_by_str="";
	    if(!empty($order)){
	        $order_by_str=" ORDER BY total {$order} ";
	    }else{
	        $order_by_str=" ORDER BY cat_id  ASC ";
	    }
	    if($limit==0){
	       $query="SELECT knowledge.cat_id,count(*) as total FROM knowledge WHERE `status`='p' GROUP BY knowledge.cat_id $order_by_str";
	    }else{
		  $query="SELECT knowledge.cat_id,count(*) as total FROM knowledge WHERE `status`='p' GROUP BY knowledge.cat_id $order_by_str LIMIT $start,$limit";
	    }
	    //die($query);
		$q_id=md5($query);
		if(isset(self::$loaded_ctg_list[$q_id])){
		    return self::$loaded_ctg_list[$q_id];
		}
		$obj=new self();
		$result=$obj->SelectQuery($query);
		
		if($is_no_parent){
		  $ctgs=self::getAllCategoriesKeyTitle();
		}else{
		    $result_ctg=[];
		  $ctgs=Mcategory::getCategoryListHtmlOptionArray('A',null,$result_ctg,$icon);
		}		
		if(count($result)>0){
		    foreach ($result as $key=>&$item){
		        if($item->cat_id==="0"){
		            unset($result[$key]);
		            continue;
		        }
		        $item->title=getTextByKey($item->cat_id,$ctgs);
		    }
		    self::$loaded_ctg_list[$q_id]=$result;
		    return $result;
		}else{
		    return [];
		}
		
	}
	static function getTicketActiveCategories($limit=10,$start=0,$order="DESC",$is_no_parent=false,$icon='&raquo;'){
	    $order_by_str="";
	    if(!empty($order)){
	        $order_by_str=" ORDER BY total {$order} ";
	    }else{
	        $order_by_str=" ORDER BY cat_id  ASC ";
	    }
	    $query="SELECT knowledge.cat_id,count(*) as total FROM knowledge JOIN category on category.id=cat_id WHERE category.`status`='A' AND knowledge.`status`='p' GROUP BY knowledge.cat_id $order_by_str";
	    if($limit!=0){
		  $query.=" LIMIT $start,$limit";
	    }
	    //die($query);
		$q_id=md5($query);
		if(isset(self::$loaded_ctg_list[$q_id])){
		    return self::$loaded_ctg_list[$q_id];
		}
		$obj=new self();
		$result=$obj->SelectQuery($query);
		
		if($is_no_parent){
		  $ctgs=self::getAllCategoriesKeyTitle();
		}else{
		    $result_ctg=[];
		  $ctgs=Mcategory::getCategoryListHtmlOptionArray('',null,$result_ctg,$icon);
		}
		if(count($result)>0){
		    foreach ($result as $key=>&$item){
		        if($item->cat_id==="0"){
		            unset($result[$key]);
		            continue;
		        }
		        $item->title=getTextByKey($item->cat_id,$ctgs);
		    }
		    self::$loaded_ctg_list[$q_id]=$result;
		    return $result;
		}else{
		    return [];
		}
		
	}
	
	static function getCategoriesKnowledges($limit=5,$limitStart=0,$order_by="",$order="",$icon=''){
	    if(!empty(self::$ctg_knowledges["kn_{$limit}_{$limitStart}_{$order_by}_{$order}"])){
	        return self::$ctg_knowledges["kn_{$limit}_{$limitStart}_{$order_by}_{$order}"];
	    }
	    $inNonParent=empty($icon);
	   $categs=self::getTicketActiveCategories(0,0,"",$inNonParent,$icon);
	   $finalCategories=[];
	   $keys=[];
	   foreach ($categs as $ctg){
	       $keys[]=$ctg->cat_id;
	       $mkn=new Mknowledge();
	       $mkn->cat_id($ctg->cat_id);
	       $mkn->status("P");
	       $ctg->knData=$mkn->SelectAll('id,cat_id,title,v_count,l_count,d_count,is_stickey,entry_time,last_update_time,status',$order_by,$order,$limit,$limitStart);
	       $finalCategories[$ctg->cat_id]=$ctg;
	   }
	   self::$ctg_knowledges["kn_{$limit}_{$limitStart}_{$order_by}_{$order}"]=$finalCategories;
	   return $finalCategories;
	
	}



	/**
	 * @param multitype:Mcategory $optarray
	 * @param Mcategory $newobj
	 * @return multitype:Mcategory 
	 */
	static function process_option_array(&$optarray ,  $newobj,$rootid=0,$icon='&raquo;'){
		$newobj->childs=[];
		if($newobj->parent_category==$rootid){
			$newobj->full_title=$newobj->title;
			$optarray[$newobj->id]=$newobj;
			return true;
		}
		foreach ($optarray as $oldobj){			
			if($oldobj->id==$newobj->parent_category){		
				$newobj->full_title=$oldobj->full_title." $icon ".$newobj->title;//&#xf101; 
				$oldobj->childs[$newobj->id]=$newobj;
				return true;
			}else{
				if(strpos($newobj->parent_category_path, $oldobj->id)!==FALSE){
					if(self::process_option_array($oldobj->childs, $newobj,$oldobj->id,$icon)){
						continue;
					}
				}
			}
		}
		
	}

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[150]"),
			"parent_category"=>array("Text"=>"Parent Category", "Rule"=>"max_length[10]|integer"),
			"parent_category_path"=>array("Text"=>"Parent Category Path", "Rule"=>"max_length[50]"),
		    "show_on"=>array("Text"=>"Show On", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

 
	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
	    switch ($property) {
	        case "show_on":
	            $returnObj=array("B"=>"Both","K"=>"Only On Knowledge","T"=>"Only on Ticket");
	            break;
	        case "status":
	            $returnObj=array("A"=>"Active","I"=>"Inactive");
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
			case "show_on":
				$returnObj = array( "B" => "success", "K" => "info", "T" => "success" );
				break;
			case "status":
				$returnObj = array( "A" => "success", "I" => "danger" );
				break;
			default:
		}
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "show_on":
	         $returnObj=array("B"=>"fa fa-star","K"=>"fa fa-graduation-cap","T"=>"fa fa-ticket");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
		return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	function getParentPathStr($from_parent_id){
		$obj=Mcategory::FindBy("id", $from_parent_id);
		if(!empty($obj->parent_category_path)){
			return $obj->parent_category_path."-".$from_parent_id;
		}
		return $from_parent_id;
	}


/* add custom function here*/
	function Update($notLimit = false, $isShowMsg = true,$dontProcessIdWhereNotset=true) {
		if($this->IsSetPrperty("parent_category")){
			$this->parent_category_path($this->getParentPathStr($this->parent_category));
		}
		return  parent::Update($notLimit,$isShowMsg,$dontProcessIdWhereNotset);
	}
	function Save(){
		if($this->IsSetPrperty("parent_category")){
			$this->parent_category_path($this->getParentPathStr($this->parent_category));
		}
		return  parent::Save();
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("parent_category",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="parent_category"><?php _e("Parent Category"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php 
		      		$options_parent_category= ["0"=>"No Parent"];
		      		$cat_list=Mcategory::getAllCategoriesKeyValue();
		      		foreach ($cat_list as $id=>$cat){
		      			if($mainobj->id == $id){
		      				continue;
		      			}
		      			$options_parent_category[$id]=Mcategory::getParentStr($cat->id);
		      		}
		      		?>
			        <select class="form-control" id="parent_category" <?php echo in_array("parent_category", $disabled)?' disabled="disabled" ':' name="parent_category" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Parent Category"));?>">
			        <?php $parent_category_selected= $mainobj->GetPostValue("parent_category");
			            GetHTMLOptionByArray($options_parent_category,$parent_category_selected);
			            ?>			        
			        </select>
		      	</div>
		      </div> 
		     <?php } ?>			
			<?php if(!in_array("show_on",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="show_on"><?php _e("Show On"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $show_on_selected= $mainobj->GetPostValue("show_on","B");
			            $show_on_isDisabled=in_array("show_on", $disabled);
			            GetHTMLRadioByArray("Show On","show_on","show_on",true,$mainobj->GetPropertyRawOptions("show_on"),$show_on_selected,$show_on_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("show_on");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="status" value="I" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","A") == "A" ? "checked" : ""?>  value="A" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   > 
					</label>
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>