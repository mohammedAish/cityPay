<?php 			
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:user_id,hit_date,ip		
 */						
class Mhistory_misslogin extends APP_Model{	
	public $user_id;
	public $hit_date;
	public $ip;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="history_misslogin";
			$this->primaryKey="user_id";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("user_id"));
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"user_id"=>array("Text"=>"User Id", "Rule"=>"max_length[2]"),
			"hit_date"=>array("Text"=>"Hit Date", "Rule"=>"max_length[20]"),
			"ip"=>array("Text"=>"Ip", "Rule"=>"required|max_length[20]")
			
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
    function Save(){
	    if(!$this->IsSetPrperty("user_id")){
	        $user_id=$this->GetNewIncId("user_id","AA");
	        $this->user_id($user_id);
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
	static function is_ok_history_login($user_id){
	    if(!is_cli()){
	       $obj=new self();
	       $isEnabled=Mapp_setting::GetSettingsValue("app_user_scq","N")=="Y";
	       if($isEnabled){
    	       $interval_min=Mapp_setting::GetSettingsValue("appuser_sec_min");
    	       $misslogin_times=Mapp_setting::GetSettingsValue("appuser_sec_tried");
    	       
    	       $start_time=date('Y-m-d H:i:s',strtotime("-{$interval_min} MINUTES"));
    	       $end_time=date('Y-m-d H:i:s');
    	       $obj->user_id($user_id);
    	       $obj->hit_date("BETWEEN '{$start_time}' and '{$end_time}'",true);
    	       $total=$obj->CountALL();
    	       if($total>=$misslogin_times){
    	           return false;
    	       }elseif($total===0){
    	           self::clear_history_by($user_id);
    	       }	
	       }       
	    }
	    return true;
	    
	}
	static function add($user_id){
	    
        $inc=new self();
        $ip=$inc->input->ip_address();
        $inc->user_id($user_id);
        $inc->hit_date(date('Y-m-d H:i:s'));
        $inc->ip($ip);
        return $inc->Save();	    
	}
	static function clear_history_by($user_id){
	    return parent::DeleteByKeyValue("user_id", $user_id,true);
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user_id"><?php _e("User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("user_id");?>" class="form-control" id="user_id" <?php echo in_array("user_id", $disabled)?' disabled="disabled" ':' name="user_id" ';?>     placeholder="<?php _e("User Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("hit_date",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="hit_date"><?php _e("Hit Date"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("hit_date");?>" class="form-control" id="hit_date" <?php echo in_array("hit_date", $disabled)?' disabled="disabled" ':' name="hit_date" ';?>     placeholder="<?php _e("Hit Date"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Hit Date"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("hit_date");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ip",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ip"><?php _e("Ip"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("ip");?>" class="form-control" id="ip" <?php echo in_array("ip", $disabled)?' disabled="disabled" ':' name="ip" ';?>     placeholder="<?php _e("Ip"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ip"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("ip");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>