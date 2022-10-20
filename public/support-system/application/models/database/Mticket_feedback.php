<?php 			
/**
 * Version 1.0.0
 * Creation date: 10/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:ticket_id,f_type,f_msg		
 */						
class Mticket_feedback extends APP_Model{	
	public $ticket_id;
	public $f_type;
	public $f_msg;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="ticket_feedback";
			$this->primaryKey="ticket_id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"ticket_id"=>array("Text"=>"Ticket Id", "Rule"=>"required|max_length[10]|integer"),
			"f_type"=>array("Text"=>"F Type", "Rule"=>"max_length[1]"),
			"f_msg"=>array("Text"=>"F Msg", "Rule"=>"max_length[255]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "f_type":        
	         $returnObj=array("P"=>"Positive","N"=>"Nagative");
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
	      case "f_type":
	         $returnObj=array("P"=>" label label-success","N"=>" label label-danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "f_type":
	         $returnObj=array("P"=>"fa fa-plus-circle","N"=>"fa  fa-minus-circle");
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
    static function DeleteByTicketId($ticket_id)
    {
        return parent::DeleteByKeyValue("ticket_id", $ticket_id, true);
    }
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("ticket_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ticket_id"><?php _e("Ticket Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("ticket_id");?>" class="form-control" id="ticket_id" <?php echo in_array("ticket_id", $disabled)?' disabled="disabled" ':' name="ticket_id" ';?>     placeholder="<?php _e("Ticket Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("f_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="f_type"><?php _e("F Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $f_type_selected= $mainobj->GetPostValue("f_type","P");
			            $f_type_isDisabled=in_array("f_type", $disabled);
			            GetHTMLRadioByArray("F Type","f_type","f_type",true,$mainobj->GetPropertyRawOptions("f_type"),$f_type_selected,$f_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("f_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("f_msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="f_msg"><?php _e("F Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("f_msg");?>" class="form-control" id="f_msg" <?php echo in_array("f_msg", $disabled)?' disabled="disabled" ':' name="f_msg" ';?>     placeholder="<?php _e("F Msg"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("F Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("f_msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>