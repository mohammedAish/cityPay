<?php 			
/**
 * Version 1.0.0
 * Creation date: 26/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:ticket_id,log_id,log_by,log_by_type,log_msg,ticket_status,entry_time		
 */						
class Mticket_log extends APP_Model{	
	public $ticket_id;
	public $log_id;
	public $log_by;
	public $log_by_type;
	public $log_msg;
	public $ticket_status;
	public $entry_time;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="ticket_log";
			$this->primaryKey="log_id";
			$this->uniqueKey=array(array("ticket_id","log_id"));	
			$this->multiKey=array(array("ticket_id"));
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"ticket_id"=>array("Text"=>"Ticket Id", "Rule"=>"max_length[11]|integer"),
			"log_id"=>array("Text"=>"Log Id", "Rule"=>"max_length[11]|integer"),
			"log_by"=>array("Text"=>"Log By", "Rule"=>"required|max_length[6]"),
			"log_by_type"=>array("Text"=>"Log By Type", "Rule"=>"max_length[1]"),
			"log_msg"=>array("Text"=>"Log Msg", "Rule"=>"required|max_length[150]"),
			"ticket_status"=>array("Text"=>"Ticket Status", "Rule"=>"max_length[1]"),
			"entry_time"=>array("Text"=>"Entry Time", "Rule"=>"max_length[20]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "log_by_type":        
	         $returnObj=array("A"=>"Staff","U"=>"Ticket User","G"=>"Guest Ticke User");
	         break;
	      case "ticket_status":        
	         $returnObj=array("N"=>"New","C"=>"Closed","P"=>"In Progress","R"=>"Re-Open","W"=>"Waiting For User");
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
	      case "log_by_type":
	         $returnObj=array("A"=>"success","U"=>"success","G"=>"success");
	         break;
	      case "ticket_status":
	         $returnObj=array("N"=>"success","C"=>"success","P"=>"info","R"=>"success","W"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "log_by_type":
	         $returnObj=array("A"=>"fa fa-check-circle-o","U"=>"","G"=>"");
	         break;
	      case "ticket_status":
	         $returnObj=array("N"=>"","C"=>"","P"=>"fa fa-hourglass-1","R"=>"","W"=>"");
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
	static function get_log_user_name_by($ticket_id,$log_id){
		$ticket_log=self::FindBy("ticket_id", $ticket_id,["log_id"=>$log_id]);
		return self::get_log_user_name($ticket_log);
		
	}
	/**
	 * @param Mticket_log $ticket_log
	 */
	static function get_log_user_name($ticket_log){
		$log_user_name="";
		if($ticket_log->log_by_type=="A"){
			$ticket_user=Mapp_user::FindBy("id", $ticket_log->log_by);
			$log_user_name=$ticket_user->title;
		}else{
			$ticket_user=Msite_user::FindBy("id", $ticket_log->log_by);
			$log_user_name=$ticket_user->first_name." ".$ticket_user->last_name;
		}		
		return $log_user_name;	
	}
	static function AddTicketLog($ticket_id,$user_id,$user_type,$msg,$status){
		$obj=new self();
		$obj->ticket_id($ticket_id);
		$obj->log_by($user_id);
		$obj->log_by_type($user_type);
		$obj->log_msg($msg);
		$obj->ticket_status($status);
		return $obj->Save();
	}
	function Save(){
		if(!$this->IsSetPrperty('log_id')){
			$log_id=$this->GetNewIncId("log_id", 1,array("ticket_id"=>$this->ticket_id));
			$this->log_id($log_id);
				
		}
		return parent::Save();
	
	}
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
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("ticket_id");?>" class="form-control" id="ticket_id" <?php echo in_array("ticket_id", $disabled)?' disabled="disabled" ':' name="ticket_id" ';?>     placeholder="<?php _e("Ticket Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php /*if(!in_array("log_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="log_id"><?php _e("Log Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("log_id");?>" class="form-control" id="log_id" <?php echo in_array("log_id", $disabled)?' disabled="disabled" ':' name="log_id" ';?>     placeholder="<?php _e("Log Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Log Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("log_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="log_by"><?php _e("Log By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="6"   value="<?php echo  $mainobj->GetPostValue("log_by");?>" class="form-control" id="log_by" <?php echo in_array("log_by", $disabled)?' disabled="disabled" ':' name="log_by" ';?>     placeholder="<?php _e("Log By"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Log By"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("log_by");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("log_by_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="log_by_type"><?php _e("Log By Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $log_by_type_selected= $mainobj->GetPostValue("log_by_type","A");
			            $log_by_type_isDisabled=in_array("log_by_type", $disabled);
			            GetHTMLRadioByArray("Log By Type","log_by_type","log_by_type",true,$mainobj->GetPropertyRawOptions("log_by_type"),$log_by_type_selected,$log_by_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("log_by_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("log_msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="log_msg"><?php _e("Log Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("log_msg");?>" class="form-control" id="log_msg" <?php echo in_array("log_msg", $disabled)?' disabled="disabled" ':' name="log_msg" ';?>     placeholder="<?php _e("Log Msg"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Log Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("log_msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ticket_status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ticket_status"><?php _e("Ticket Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control" id="ticket_status" <?php echo in_array("ticket_status", $disabled)?' disabled="disabled" ':' name="ticket_status" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Status"));?>">
			        <?php $ticket_status_selected= $mainobj->GetPostValue("ticket_status","P");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("ticket_status",true),$ticket_status_selected);
			            ?>
			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("ticket_status");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("entry_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="entry_time"><?php _e("Entry Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("entry_time");?>" class="form-control" id="entry_time" <?php echo in_array("entry_time", $disabled)?' disabled="disabled" ':' name="entry_time" ';?>     placeholder="<?php _e("Entry Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Entry Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("entry_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>