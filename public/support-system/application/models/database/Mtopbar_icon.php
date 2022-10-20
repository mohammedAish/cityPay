<?php 			
/**
 * Version 1.0.0
 * Creation date: 28/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,title,sub_title,icon_class,icon_order,status		
 */						
class Mtopbar_icon extends APP_Model{	
	public $id;
	public $title;
	public $sub_title;
	public $icon_class;
	public $icon_order;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="topbar_icon";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");				
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[50]"),
			"sub_title"=>array("Text"=>"Sub Title", "Rule"=>"required|max_length[150]"),
			"icon_class"=>array("Text"=>"Icon Class", "Rule"=>"required|max_length[30]"),
			"icon_order"=>array("Text"=>"Icon Order", "Rule"=>"max_length[2]|integer"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "status":        
	         $returnObj=array("Y"=>"Active","N"=>"Inactive");
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
	         $returnObj=array("Y"=>"success","N"=>"danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}
    
	   

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
			


/* add custom function here*/
	public static function DeleteById($id){
	    return parent::DeleteByKeyValue("id", $id);
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
				$orderinc=$mainobj->GetNewIncId("icon_order", 0);
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
		      		<input type="text" maxlength="50" autofocus="autofocus"  value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("sub_title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="sub_title"><?php _e("Sub Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("sub_title");?>" class="form-control" id="sub_title" <?php echo in_array("sub_title", $disabled)?' disabled="disabled" ':' name="sub_title" ';?>     placeholder="<?php _e("Sub Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Sub Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("sub_title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("icon_class",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="icon_class"><?php _e("Icon Class"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="30"   value="<?php echo  $mainobj->GetPostValue("icon_class");?>" class="form-control app-iconpicker" id="icon_class" <?php echo in_array("icon_class", $disabled)?' disabled="disabled" ':' name="icon_class" ';?>     placeholder="<?php _e("Icon Class"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Icon Class"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("icon_class");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("icon_order",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="icon_order"><?php _e("Icon Order"); ?></label>
		      	<div class="col-md-3">                   			     	
		      		<input type="number" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("icon_order",$orderinc);?>" class="form-control" id="icon_order" <?php echo in_array("icon_order", $disabled)?' disabled="disabled" ':' name="icon_order" ';?>     placeholder="<?php _e("Icon Order"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Icon Order"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("icon_order");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="status" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","Y") == "Y" ? "checked" : ""?>  value="Y" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   >
						 
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