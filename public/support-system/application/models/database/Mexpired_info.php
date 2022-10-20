<?php 			
/**
 * Version 1.0.0
 * Creation date: 10/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:key,date		
 */						
class Mexpired_info extends APP_Model{	
	public $key;
	public $date;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="expired_info";
			$this->primaryKey="key";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"key"=>array("Text"=>"Key", "Rule"=>"max_length[32]"),
			"date"=>array("Text"=>"Date", "Rule"=>"max_length[20]")
			
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
	    if(!$this->IsSetPrperty("key")){
	        $key=$this->GetNewIncId("key","AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
	        $this->key($key);
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
	
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("key",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="key"><?php _e("Key"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="32"   value="<?php echo  $mainobj->GetPostValue("key");?>" class="form-control" id="key" <?php echo in_array("key", $disabled)?' disabled="disabled" ':' name="key" ';?>     placeholder="<?php _e("Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Key"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("date",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="date"><?php _e("Date"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("date");?>" class="form-control" id="date" <?php echo in_array("date", $disabled)?' disabled="disabled" ':' name="date" ';?>     placeholder="<?php _e("Date"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Date"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("date");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>