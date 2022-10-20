<?php 			
/** 
 * @since: 10/Aug/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,ticket_id,user_id,note,w_time,entry_date		
 */						
class Mwork_log extends APP_Model{	
	public $id;
	public $ticket_id;
	public $user_id;
	public $note;
	public $w_time;
	public $entry_date;


	    /**
	     *@property id,ticket_id,user_id,note,w_time,entry_date
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="work_log";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"ticket_id"=>array("Text"=>"Ticket Id", "Rule"=>"max_length[10]|integer"),
			"user_id"=>array("Text"=>"User Id", "Rule"=>"required|max_length[2]"),
			"note"=>array("Text"=>"Note", "Rule"=>"required|max_length[255]"),
			"w_time"=>array("Text"=>"W Time", "Rule"=>"max_length[4]|numeric"),
			"entry_date"=>array("Text"=>"Entry Date", "Rule"=>"max_length[20]")
			
		);
	}

    /*
	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      default:
	    }	        	   
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;
		
	}  
    */
	   

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
		
		 <?php if(!in_array("note",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="note"><?php _e("Note"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <textarea maxlength="255" class="form-control" id="note" <?php echo in_array("note", $disabled)?' disabled="disabled" ':' name="note" ';?>     placeholder="<?php _e("Note");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Note"));?>"><?php echo  $mainobj->GetPostValue("note");?></textarea>
					 <?php /*<span class="form-group-help-block"><?php _e("note");?></span>	*/?>
                 </div>
             </div>
		 <?php } ?>
			
			<?php if(!in_array("w_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="w_time"><?php _e("Work Time"); ?></label>
		      	<div class="col-md-5">

                    <div class="input-group">
                        <input type="text" maxlength="4"   value="<?php echo  $mainobj->GetPostValue("w_time");?>" class="form-control text-right" id="w_time" <?php echo in_array("w_time", $disabled)?' disabled="disabled" ':' name="w_time" ';?>     placeholder="<?php _e("0");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("W Time"));?>">
                        <span class="input-group-addon" id="basic-addon1">MIN</span>
                    </div>
                    
                    
			     		<?php /*<span class="form-group-help-block"><?php _e("w_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			
			<?php 
	}


}
?>