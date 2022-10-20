<?php 			
/** 
 * @since: 19/Sep/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,slag_title,title,page_body,added_on,status		
 */						
class Mcustom_page extends APP_Model{	
	public $id;
	public $slag_title;
	public $title;
	public $page_body;
	public $added_on;
	public $status;


	    /**
	     *@property id,slag_title,title,page_body,added_on,status
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="custom_page";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"slag_title"=>array("Text"=>"Slag Title", "Rule"=>"max_length[255]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[255]"),
			//"page_body"=>array("Text"=>"Page Body", "Rule"=>""),
			"added_on"=>array("Text"=>"Added On", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
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

    /*
	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      default:
	    }       
        return $returnObj;
	
	}
    */
	   

    /*
	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      default:
	    }
        return $returnObj;
	
	}
    */
    static function DeleteById($id) {
	    return parent::DeleteByKeyValue( "id", $id, false );
    }
	
	function get_slug($tired=0){
		$slag_str=preg_replace('/[^a-zA-Z0-9\-]/',"-",$this->title);
		$slag_str=preg_replace('/[\-]+/',"-",$slag_str);
		return strtolower($slag_str);
	}
	//auto generated
    function Save(){
	    $slug=$this->get_slug();
	    if(empty($slug)){
		    //AddError("Please change title. This tile is matched with 5 knowledges");
		    return false;
	    }
	    $this->slag_title($slug);
	    if($this->IsSetPrperty("page_body")) {
		    $this->page_body(CleanHTMLtoText($this->k_body));
	    }
	    return parent::Save();
	}
	function Update($notLimit = false, $isShowMsg = true,$dontProcessIdWhereNotset=true){
		
		if($this->IsSetPrperty("title")){
			$slug=$this->get_slug();
			$this->slag_title($slug);
		}
		if($this->IsSetPrperty("page_body")) {
			$this->page_body(CleanHTMLtoText($this->page_body));
		}
		return parent::Update($notLimit, $isShowMsg,$dontProcessIdWhereNotset);;
	}

/* add custom function here*/
	
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
				?>
			
			
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("page_body",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="page_body"><?php _e("Page Body"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea   class="form-control app-html-editor" style="min-height: 250px;" id="page_body" <?php echo in_array("page_body", $disabled)?' disabled="disabled" ':' name="page_body" ';?>     placeholder="<?php _e("Page Body");?>" ><?php echo  $mainobj->GetPostValue("page_body");?></textarea>
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
					<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>