<?php 			
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,msg_id,reply_text,entry_time,status		
 */						
class Madmin_message_reply extends APP_Model{	
	public $id;
	public $msg_id;
	public $reply_text;
	public $replied_by;
	public $entry_time;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="admin_message_reply";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("msg_id"));
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"msg_id"=>array("Text"=>"Msg Id", "Rule"=>"max_length[11]|integer"),
			"reply_text"=>array("Text"=>"Reply Text", "Rule"=>"required"),
		    "replied_by"=>array("Text"=>"Reply By", "Rule"=>"required|max_length[3]"),
		    "entry_time"=>array("Text"=>"Reply Text", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "status":        
	         $returnObj=array("N"=>"New","R"=>"Read","D"=>"Deleted");
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
	         $returnObj=array("N"=>"success","R"=>"success","D"=>"danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "status":
	         $returnObj=array("N"=>"","R"=>"","D"=>"fa fa-times-circle-o");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		
	    	
	//auto generated
    /*function Save(){			   
	    return parent::Save();
	}*/
			


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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("msg_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_id"><?php _e("Msg Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("msg_id");?>" class="form-control" id="msg_id" <?php echo in_array("msg_id", $disabled)?' disabled="disabled" ':' name="msg_id" ';?>     placeholder="<?php _e("Msg Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("msg_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_text",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_text"><?php _e("Reply Text"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("reply_text");?>" class="form-control" id="reply_text" <?php echo in_array("reply_text", $disabled)?' disabled="disabled" ':' name="reply_text" ';?>     placeholder="<?php _e("Reply Text"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply Text"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("reply_text");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $status_selected= $mainobj->GetPostValue("status","N");
			            $status_isDisabled=in_array("status", $disabled);
			            GetHTMLRadioByArray("Status","status","status",true,$mainobj->GetPropertyRawOptions("status"),$status_selected,$status_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>