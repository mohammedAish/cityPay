<?php 			
/**
 * Version 1.0.0
 * Creation date: 23/Oct/2016
 * @Written By: S.M. Sarwar Hasan
 * Appsbd
 * DB Properties:pvid,role_id,title,status		
 */						
class Muser_role extends APP_Model{	
	public $pvid;
	public $role_id;
	public $title;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="user_role";
			$this->primaryKey="role_id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->pvid=$this->role_id=$this->title=$this->status=null;

	}



	function SetValidation(){
		$this->validations=array(
			"pvid"=>array("Text"=>"Pvid", "Rule"=>"required|max_length[4]"),
			"role_id"=>array("Text"=>"Role Id", "Rule"=>"required|max_length[2]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[50]"),
			"status"=>array("Text"=>"Status", "Rule"=>"")
			
		);
	}

	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("pvid",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="pvid"><?php _e("Pvid"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"  value="<?php echo  $mainobj->GetPostValue("pvid");?>" class="form-control" id="pvid" name="pvid" placeholder="<?php _e("Pvid"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Pvid"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("role_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="role_id"><?php _e("Role Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("role_id");?>" class="form-control" id="role_id" name="role_id" placeholder="<?php _e("Role Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Role Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"  value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" name="title" placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("status");?>" class="form-control" id="status" name="status" placeholder="<?php _e("Status"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Status"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>