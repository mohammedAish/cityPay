<?php 			
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,msg,start_date,end_date,msg_for,added_by,status		
 */						
class Mnotice extends APP_Model{	
	public $id;
	public $title;
	public $msg;
	public $start_date;
	public $end_date;
	public $msg_for;
	public $added_by;
	public $added_on;
	public $status;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="notice";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[50]"),
			"msg"=>array("Text"=>"Msg", "Rule"=>"required"),
			//"start_date"=>array("Text"=>"Start Date", "Rule"=>""),
			//"end_date"=>array("Text"=>"End Date", "Rule"=>""),
			"msg_for"=>array("Text"=>"Msg For", "Rule"=>"max_length[1]"),
			"added_by"=>array("Text"=>"Added By", "Rule"=>"required|max_length[2]"),
		    "added_on"=>array("Text"=>"Added By", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "msg_for":        
	         $returnObj=array("B"=>"Both","S"=>"Site","A"=>"Admin Panel");
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
	      case "msg_for":
	         $returnObj=array("B"=>"success","S"=>"success","A"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "msg_for":
	         $returnObj=array("B"=>"","S"=>"","A"=>"");
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
	static function DeleteById($id)
    {
     return parent::DeleteByKeyValue("id",$id);
    }
/* end custom function */
	 function GetAddForm($label_col=4,$input_col=8,$mainobj=null,$except=array(),$disabled=array()){
		
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
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<span class="form-group-help-block"><?php _e("It won't show any where, It is just for track");?></span>
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg"><?php _e("Notice Text"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea   class="form-control app-html-editor" id="msg" <?php echo in_array("msg", $disabled)?' disabled="disabled" ':' name="msg" ';?>     placeholder="<?php _e("Write here"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Notice text"));?>"><?php echo  $mainobj->GetPostValue("msg");?></textarea>
		      	</div>
		      </div> 
		     <?php } 
		     $label_col_bk=$label_col;
		     $input_col_bk=$input_col;
		     $label_col=(int)$label_col*2;
		     $input_col=12-$label_col;
		     ?>
			<div class="row">
    			<div class=" col-md-6">
    			<?php if(!in_array("start_date",$except)){ ?>
    			 <div class="form-group">
    		      	<label class="control-label col-md-<?php echo $label_col;?>" for="start_date"><?php _e("Start Date"); ?></label>
    		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
    		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("start_date");?>" class="form-control app-date-picker" id="start_date" <?php echo in_array("start_date", $disabled)?' disabled="disabled" ':' name="start_date" ';?>     placeholder="<?php _e("Start Date"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Start Date"));?>">
    			     		<?php /*<span class="form-group-help-block"><?php _e("start_date");?></span>	*/?>
    		      	</div>
    		      </div> 
    		     <?php } ?>			
    			
    			</div>
    			<div class=" col-md-6">
    			<?php if(!in_array("end_date",$except)){ ?>
    			 <div class="form-group">
    		      	<label class="control-label col-md-<?php echo $label_col;?>" for="end_date"><?php _e("End Date"); ?></label>
    		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
    		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("end_date");?>" class="form-control app-date-picker" id="end_date" <?php echo in_array("end_date", $disabled)?' disabled="disabled" ':' name="end_date" ';?>     placeholder="<?php _e("End Date"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("End Date"));?>">
    			     		<?php /*<span class="form-group-help-block"><?php _e("end_date");?></span>	*/?>
    		      	</div>
    		      </div> 
    		     <?php } ?>
    			</div>
			</div>
			<?php 
			
			$label_col=$label_col_bk;
			$input_col=$input_col_bk;
			if(!in_array("msg_for",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_for"><?php _e("Notice For"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $msg_for_selected= $mainobj->GetPostValue("msg_for","B");
			            $msg_for_isDisabled=in_array("msg_for", $disabled);
			            GetHTMLRadioByArray("Msg For","msg_for","msg_for",true,$mainobj->GetPropertyRawOptions("msg_for"),$msg_for_selected,$msg_for_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("msg_for");?></span>	*/?>
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
					<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>