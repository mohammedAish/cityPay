<?php 			
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:pv_id,role_id,title,grade		
 */						
class Mrole_list extends APP_Model{	
	public $pv_id;
	public $role_id;
	public $title;
	public $grade;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="role_list";
			$this->primaryKey="role_id";
			$this->uniqueKey=array(array("pv_id","role_id"));	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->pv_id=$this->role_id=$this->title=$this->grade=null;

	}



	function SetValidation(){
		$this->validations=array(
			"pv_id"=>array("Text"=>"Pv Id", "Rule"=>"max_length[4]"),
			"role_id"=>array("Text"=>"Role Id", "Rule"=>"required|max_length[2]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[20]"),
			"grade"=>array("Text"=>"Grade", "Rule"=>"max_length[1]")
			
		);
	}

	 
	//auto generated
    function Save(){
	    if(!$this->IsSetPrperty("role_id")){
	        $role_id=$this->GetNewIncId("role_id","A");
	        $this->role_id($role_id);
	    }
	    $this->pv_id("AA");
	    return parent::Save();
	}	          
	static function DeleteByKeyValue($key,$value,$noLimit=false){
		return parent::DeleteByKeyValue($key, $value,$noLimit);
	}

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("pv_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="pv_id"><?php _e("Pv Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"   value="<?php echo  $mainobj->GetPostValue("pv_id");?>" class="form-control" id="pv_id" <?php echo in_array("pv_id", $disabled)?' disabled="disabled" ':' name="pv_id" ';?>     placeholder="<?php _e("Pv Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Pv Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php /*if(!in_array("role_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="role_id"><?php _e("Role Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("role_id");?>" class="form-control" id="role_id" <?php echo in_array("role_id", $disabled)?' disabled="disabled" ':' name="role_id" ';?>     placeholder="<?php _e("Role Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Role Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php /*if(!in_array("grade",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="grade"><?php _e("Grade"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="range" min="1" max="9" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("grade");?>" class="form-control" id="grade" <?php echo in_array("grade", $disabled)?' disabled="disabled" ':' name="grade" ';?>     placeholder="<?php _e("Grade"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Grade"));?>">
		      	</div>
		      </div> 
		     <?php }*/ ?>
		     
		     <?php if(!in_array("grade",$except)){ ?>		      
		       <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Is Super User Group?"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="grade" value="5" type="hidden">
					<label> 					
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("grade","5") == "0" ? "checked" : ""?>  value="0" class="" id="grade" <?php echo in_array("grade", $disabled)?' disabled="disabled" ':' name="grade" ';?>   > 
					</label>
				</div>	
				<div class="help-block f-d text-yellow" ><?php _e("Don't enable this if you don't want to give full access") ; ?></div>		         
			         
		      	</div>
		      </div> 
		      
		      
		     <?php } ?>
		     
		     
			
			<?php 
	}


}
?>