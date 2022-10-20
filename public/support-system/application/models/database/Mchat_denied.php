<?php 			
/** 
 * @since: 25/May/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,chat_id,app_user_id,entry_time		
 */						
class Mchat_denied extends APP_Model{	
	public $id;
	public $chat_id;
	public $app_user_id;
	public $entry_time;


	    /**
	     *@property id,chat_id,app_user_id,entry_time
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="chat_denied";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[11]|integer"),
			"chat_id"=>array("Text"=>"Chat Id", "Rule"=>"max_length[11]|integer"),
			"app_user_id"=>array("Text"=>"App User Id", "Rule"=>"required|max_length[2]"),
			"entry_time"=>array("Text"=>"Entry Time", "Rule"=>"max_length[20]")
			
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
    static function setDeniedByMe($chat_id){
        if(empty($chat_id)){
            return false;
        }
        $adminUser=GetAdminData();
        $chat_id=(int)$chat_id;
        if(!empty($adminUser)){
            $cbj=new self();
            if(!$cbj->IsExists("chat_id",$chat_id,["app_user_id"=>$adminUser->id])){
                $ubj=new self();
                $ubj->chat_id($chat_id);
                $ubj->app_user_id($adminUser->id);
                return $ubj->Save();
            }else{
                return true;
            }

        }
        return false;

    }
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
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("chat_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="chat_id"><?php _e("Chat Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("chat_id");?>" class="form-control" id="chat_id" <?php echo in_array("chat_id", $disabled)?' disabled="disabled" ':' name="chat_id" ';?>     placeholder="<?php _e("Chat Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("chat_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("app_user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="app_user_id"><?php _e("App User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("app_user_id");?>" class="form-control" id="app_user_id" <?php echo in_array("app_user_id", $disabled)?' disabled="disabled" ':' name="app_user_id" ';?>     placeholder="<?php _e("App User Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("App User Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("app_user_id");?></span>	*/?>
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