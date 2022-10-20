<?php 			
/**
 * Version 1.0.0
 * Creation date: 01/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,subject,body,to_user,from_user,last_replied,status		
 */						
class Madmin_message extends APP_Model{	
	public $id;
	public $subject;
	public $body;
	public $to_user;
	public $from_user;
	public $last_replied;
	public $entry_time;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="admin_message";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"subject"=>array("Text"=>"Subject", "Rule"=>"required|max_length[255]"),
			"body"=>array("Text"=>"Body", "Rule"=>"required"),
			"to_user"=>array("Text"=>"To User", "Rule"=>"max_length[255]"),
			"from_user"=>array("Text"=>"From User", "Rule"=>"required|max_length[3]"),
			"last_replied"=>array("Text"=>"Last Replied", "Rule"=>"max_length[3]"),
		    "entry_time"=>array("Text"=>"Last Replied", "Rule"=>"max_length[20]"),
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
			<?php if(!in_array("to_user",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="to_user"><?php _e("To User"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php $options_to_user= Mapp_user::FetchAllKeyValue("id", "title");?>
			        <select class="form-control select2" multiple="multiple" id="to_user" <?php echo in_array("to_user", $disabled)?' disabled="disabled" ':' name="to_usera[]" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("To User"));?>">
			        <?php $to_user_selected= $mainobj->GetPostValue("to_user");
			        $adminData=GetAdminData();
			             if(isset($options_to_user[$adminData->id])){
			                 unset($options_to_user[$adminData->id]);
			             }
			            GetHTMLOptionByArray($options_to_user,$to_user_selected);
			            ?>			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("to_user");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>			
			
			<?php if(!in_array("subject",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="subject"><?php _e("Subject"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("subject");?>" class="form-control" id="subject" <?php echo in_array("subject", $disabled)?' disabled="disabled" ':' name="subject" ';?>     placeholder="<?php _e("Subject"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Subject"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("subject");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("body",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="body"><?php _e("Body"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea  maxlength="255" style="min-height: 200px;"  class="form-control" id="body" <?php echo in_array("body", $disabled)?' disabled="disabled" ':' name="body" ';?>     placeholder="<?php _e("Write Here"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Body"));?>"><?php echo  $mainobj->GetPostValue("body");?></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("body");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			
			<?php 
	}


}
?>