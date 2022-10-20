<?php 			
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,cat_id,question,ans,entry_date,ord,status		
 */						
class Mfaq_list extends APP_Model{	
	public $id;
	public $cat_id;
	public $question;
	public $ans;
	public $entry_date;
	public $ord;
	public $status;


	    /**
	     *@property id,cat_id,question,ans,entry_date,ord,status
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="faq_list";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
			
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"cat_id"=>array("Text"=>"Cat Id", "Rule"=>"required|max_length[10]|integer"),
			"question"=>array("Text"=>"Question", "Rule"=>"max_length[255]"),
			"ans"=>array("Text"=>"Ans", "Rule"=>"max_length[255]"),
			"entry_date"=>array("Text"=>"Entry Date", "Rule"=>"max_length[20]"),
			"ord"=>array("Text"=>"Ord", "Rule"=>"max_length[10]|integer"),
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
	   		
	    	
	//auto generated
    /*function Save(){			   
	    return parent::Save();
	}*/
			

    static function DeleteByID($id)
    {
        return parent::DeleteByKeyValue("id", $id);
    }

    /* add custom function here*/
	
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("cat_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="cat_id"><?php _e("Category"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php $options_cat_id= Mfaq_category::FetchAllKeyValue("id", "name");?>
			        <select class="form-control" id="cat_id" <?php echo in_array("cat_id", $disabled)?' disabled="disabled" ':' name="cat_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Category"));?>">
			        <?php $cat_id_selected= $mainobj->GetPostValue("cat_id");
			            GetHTMLOption("","Select");
			            GetHTMLOptionByArray($options_cat_id,$cat_id_selected);
			            ?>			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("cat_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("question",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="question"><?php _e("Question"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
                    <textarea type="text" maxlength="255"  class="form-control" id="question" <?php echo in_array("question", $disabled)?' disabled="disabled" ':' name="question" ';?>     placeholder="<?php _e("Question");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Question"));?>"><?php echo  $mainobj->GetPostValue("question");?></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("question");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ans",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ans"><?php _e("Answer"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
                    <textarea type="text" maxlength="255"  class="form-control" id="ans" <?php echo in_array("ans", $disabled)?' disabled="disabled" ':' name="ans" ';?>     placeholder="<?php _e("Ans");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Answer"));?>"><?php echo  $mainobj->GetPostValue("ans");?></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("ans");?></span>	*/?>
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
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","'A'") == "A" ? "checked" : ""?>  value="A" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   >
						 
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