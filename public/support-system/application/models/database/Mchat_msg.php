<?php 			
/** 
 * @since: 21/Apr/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:chat_id,msg_id,temp_id,reply_user_type,reply_user_id,msg,form_id,entry_time		
 */						
class Mchat_msg extends APP_Model{	
	public $chat_id;
	public $msg_id;
	public $temp_id;
	public $reply_user_type;
	public $reply_user_id;
	public $msg;
	public $form_id;
	public $entry_time;


	    /**
	     *@property chat_id,msg_id,temp_id,reply_user_type,reply_user_id,msg,form_id,entry_time
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="chat_msg";
			$this->primaryKey="msg_id";
			$this->uniqueKey=array(array("chat_id","msg_id"));	
			$this->multiKey=array(array("chat_id"));
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"chat_id"=>array("Text"=>"Chat Id", "Rule"=>"required|max_length[10]|integer"),
			"msg_id"=>array("Text"=>"Msg Id", "Rule"=>"max_length[4]"),
			"temp_id"=>array("Text"=>"Temp Id", "Rule"=>"max_length[32]"),
			"reply_user_type"=>array("Text"=>"Reply User Type", "Rule"=>"max_length[1]"),
			"reply_user_id"=>array("Text"=>"Reply User Id", "Rule"=>"max_length[10]"),
			"msg"=>array("Text"=>"Msg", "Rule"=>"required"),
			"form_id"=>array("Text"=>"Form Id", "Rule"=>"max_length[2]"),
			"entry_time"=>array("Text"=>"Entry Time", "Rule"=>"max_length[20]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "reply_user_type":        
	         $returnObj=array("S"=>"System","U"=>"User","A"=>"Admin","N"=>"No User");
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
	      case "reply_user_type":
	         $returnObj=array("S"=>"success","U"=>"success","A"=>"success","N"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "reply_user_type":
	         $returnObj=array("S"=>"fa fa-check-circle-o","U"=>"","A"=>"fa fa-check-circle-o","N"=>"");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		

	 
	//auto generated
    function Save(){
	    if(!$this->IsSetPrperty("msg_id")){
	        $msg_id=$this->GetNewIncId("msg_id","AAAA",["chat_id"=>$this->chat_id]);
	        $this->msg_id($msg_id);
	    }
	    return parent::Save();
	}	          
	

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

/* add custom function here*/
	
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("chat_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="chat_id"><?php _e("Chat Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("chat_id");?>" class="form-control" id="chat_id" <?php echo in_array("chat_id", $disabled)?' disabled="disabled" ':' name="chat_id" ';?>     placeholder="<?php _e("Chat Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php /*if(!in_array("msg_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_id"><?php _e("Msg Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"   value="<?php echo  $mainobj->GetPostValue("msg_id");?>" class="form-control" id="msg_id" <?php echo in_array("msg_id", $disabled)?' disabled="disabled" ':' name="msg_id" ';?>     placeholder="<?php _e("Msg Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("temp_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="temp_id"><?php _e("Temp Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="32"   value="<?php echo  $mainobj->GetPostValue("temp_id");?>" class="form-control" id="temp_id" <?php echo in_array("temp_id", $disabled)?' disabled="disabled" ':' name="temp_id" ';?>     placeholder="<?php _e("Temp Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Temp Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("temp_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_user_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_user_type"><?php _e("Reply User Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $reply_user_type_selected= $mainobj->GetPostValue("reply_user_type","N");
			            $reply_user_type_isDisabled=in_array("reply_user_type", $disabled);
			            GetHTMLRadioByArray("Reply User Type","reply_user_type","reply_user_type",true,$mainobj->GetPropertyRawOptions("reply_user_type"),$reply_user_type_selected,$reply_user_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("reply_user_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_user_id"><?php _e("Reply User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("reply_user_id");?>" class="form-control" id="reply_user_id" <?php echo in_array("reply_user_id", $disabled)?' disabled="disabled" ':' name="reply_user_id" ';?>     placeholder="<?php _e("Reply User Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply User Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("reply_user_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg"><?php _e("Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("msg");?>" class="form-control" id="msg" <?php echo in_array("msg", $disabled)?' disabled="disabled" ':' name="msg" ';?>     placeholder="<?php _e("Msg");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("form_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="form_id"><?php _e("Form Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("form_id");?>" class="form-control" id="form_id" <?php echo in_array("form_id", $disabled)?' disabled="disabled" ':' name="form_id" ';?>     placeholder="<?php _e("Form Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Form Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("form_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("entry_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="entry_time"><?php _e("Entry Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("entry_time");?>" class="form-control" id="entry_time" <?php echo in_array("entry_time", $disabled)?' disabled="disabled" ':' name="entry_time" ';?>     placeholder="<?php _e("Entry Time");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Entry Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("entry_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>