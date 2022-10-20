<?php 			
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:s_api_name,s_key,s_title,s_val,s_type,s_option,s_auto_load		
 */						
class Mapp_setting_api extends APP_Model{	
	public $s_api_name;
	public $s_key;
	public $s_title;
	public $s_val;
	public $s_type;
	public $s_option;
	public $s_auto_load;
	private static $loaded_settings=NULL;
	private static $isShowError=FALSE;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="app_setting_api";
			$this->primaryKey="s_key";
			$this->uniqueKey=array(array("s_api_name","s_key"));	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"s_api_name"=>array("Text"=>"S Api Name", "Rule"=>"required|max_length[50]"),
			"s_key"=>array("Text"=>"S Key", "Rule"=>"max_length[30]"),
			"s_title"=>array("Text"=>"S Title", "Rule"=>"max_length[100]"),
			"s_val"=>array("Text"=>"S Val", "Rule"=>""),
			"s_type"=>array("Text"=>"S Type", "Rule"=>"max_length[1]"),
			"s_option"=>array("Text"=>"S Option", "Rule"=>"max_length[255]"),
			"s_auto_load"=>array("Text"=>"S Auto Load", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "s_type":        
	         $returnObj=array("T"=>"Textbox","A"=>"Textarea","B"=>"Boolean","D"=>"Dropdown","R"=>"Radio","Z"=>"Timezone");
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
	      case "s_type":
	         $returnObj=array("T"=>"success","A"=>"success","B"=>"success","D"=>"danger","R"=>"success","Z"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "s_type":
	         $returnObj=array("T"=>"","A"=>"fa fa-check-circle-o","B"=>"","D"=>"fa fa-times-circle-o","R"=>"","Z"=>"");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		

	 
	//auto generated
    /*function Save(){
	   if(!$this->IsSetPrperty("s_val")){
	   		$this->s_val("");
	   }
	   return parent::Save();
	}	*/          
	

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

/* add custom function here*/
	static function UpdateSettingsOrAdd($api_name,$key,$value,$title=NULL,$autoLoad=NULL,$type=NULL,$options=NULL){
	    $isUpdate=self::UpdateSettings($api_name, $key, $value,$title,$autoLoad,$type,$options);
	    if(!$isUpdate){
	        return self::AddSettings($api_name, $key, $value,$title,$autoLoad,$type,$options);
	    }
	    return $isUpdate;
	}
	static function UpdateSettings($api_name,$key,$value,$title=NULL,$autoLoad=NULL,$type=NULL,$options=NULL){
		//T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio
		$obj=new self();
		if($title){
			$obj->s_title($title);
		}
		$obj->s_val($value);
		if($autoLoad!=NULL){
			if($autoLoad){
				$obj->s_auto_load('Y');
			}else{
				$obj->s_auto_load('N');
			}
		}
		if($title){
			$obj->s_type($type);
		}
		$option_json_base="";
		if(is_array($options)){
			$option_json_base=base64_encode(json_encode($options));
			$obj->s_option($option_json_base);
		}
		$obj->SetWhereCondition("s_api_name", $api_name);
		$obj->SetWhereCondition("s_key", $key);
		if( $obj->IsSetDataForSaveUpdate()){
			$isValueset=$obj->IsSetPrperty('s_val');
			$result=$obj->Update();
			if($result && $isValueset){
				if(!empty(self::$loaded_settings[$api_name][$key]) && is_object(self::$loaded_settings[$api_name][$key])){
					self::$loaded_settings[$api_name][$key]->s_val=$obj->s_val;
				}
			}
			return $result;
		}
		return false;
		 
	}
	static function AddSettings($api_name,$key,$value,$title,$autoLoad=false,$type="T",$options=NULL,$is_initial=false){
		//T=Textbox,A=Textarea,B=Boolean,D=Dropdown,R=Radio
		if(isset(self::$loaded_settings[$api_name][$key])){
			if(self::$isShowError)AddError("Key(%s) is already exists",$key);
			return false;
		}
		$obj=new self();
		$obj->s_api_name($api_name);
		if($title){
			$obj->s_title($title);
		}
		$obj->s_val($value);
		if($autoLoad){
			$obj->s_auto_load("Y");
		}else{
			$obj->s_auto_load("N");
		}
		$obj->s_type($type);
		$option_json_base="";
		if(is_array($options) && count($options)>0){
			$option_json_base=base64_encode(json_encode($options));
			$obj->s_option($option_json_base);
		}
		$obj->s_key($key);
		if(!$obj->IsExists("s_api_name",$api_name,array("s_key"=>$key))){
			if($obj->IsValidForm()){
				$isSaved=$obj->Save();
				if($isSaved){
					self::$loaded_settings[$key]=$obj;
					return true;
				}
			}
		}else{
		    if(!$is_initial){
			 return self::UpdateSettings($api_name, $key, $value,$title,$autoLoad,$type,$options);
		    }
		}
		return false;
	
	}
	static function AddSettingsInitial($api_name,$key,$value,$title,$autoLoad=false,$type="T",$options=NULL){
	   return self::AddSettings($api_name, $key, $value, $title,$autoLoad,$type,$options,true);
	
	}
	static function GetSettingsValue($api_name,$key,$default=null){		
	    if(self::$loaded_settings===NULL){
	        self::LoadSettings();
	    }
		if (!empty(self::$loaded_settings[$api_name][$key]) && is_object(self::$loaded_settings[$api_name][$key])) {
			//GPrint(self::$loaded_settings[$key])
			return self::$loaded_settings[$api_name][$key]->s_val;
		} else {
			$obj = new self();
			$obj->s_api_name($api_name);
			$obj->s_key($key);
			if ($obj->Select()) {
				self::$loaded_settings[$api_name][$key] = $obj;				
				return $obj->s_val;
			}
		}
	
		return $default;
	}
	static function GetSettingsValueNoEmpty($api_name,$key,$default=null){
		$value=self::GetSettingsValue($api_name,$key,$default);
		if(!empty($value)){
		    return $value;
        }
		return $default;
	}
	static function DeleteSettingsValue($api_name,$key){
	        $thisobj=new static();			
			$thisobj->GetUpdateDB()->where("s_api_name", $api_name);
			$thisobj->GetUpdateDB()->where("s_key", $key);
			$thisobj->GetUpdateDB()->limit(1);					
			if ($thisobj->GetUpdateDB ()->delete($thisobj->tableName)) {
				if($thisobj->GetUpdateDB()->affected_rows()>0){					
					return true;
				}
			}				
			return false;
	}
	static function LoadSettings($isAll=false){
		$obj=new self();
		if(!$isAll){
			$obj->s_auto_load('Y');
		}
		$result=$obj->SelectAll("s_api_name,s_key,s_val");
		if(count($result)>0){ 
    		
    		foreach ($result as $r){
    		    self::$loaded_settings[$r->s_api_name][$r->s_key]=$r;
    		}
		}else{
		    self::$loaded_settings=[];
		}
		/*if(count(self::$loaded_settings)==0){
			//self::SetInitialSettings();
		}*/
	}
	static function HasSettings($api_name,$key){
	     return isset(self::$loaded_settings[$api_name][$key]);
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("s_api_name",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_api_name"><?php _e("S Api Name"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("s_api_name");?>" class="form-control" id="s_api_name" <?php echo in_array("s_api_name", $disabled)?' disabled="disabled" ':' name="s_api_name" ';?>     placeholder="<?php _e("S Api Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Api Name"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php /*if(!in_array("s_key",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_key"><?php _e("S Key"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="30"   value="<?php echo  $mainobj->GetPostValue("s_key");?>" class="form-control" id="s_key" <?php echo in_array("s_key", $disabled)?' disabled="disabled" ':' name="s_key" ';?>     placeholder="<?php _e("S Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Key"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("s_title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_title"><?php _e("S Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("s_title");?>" class="form-control" id="s_title" <?php echo in_array("s_title", $disabled)?' disabled="disabled" ':' name="s_title" ';?>     placeholder="<?php _e("S Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("s_val",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_val"><?php _e("S Val"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("s_val");?>" class="form-control" id="s_val" <?php echo in_array("s_val", $disabled)?' disabled="disabled" ':' name="s_val" ';?>     placeholder="<?php _e("S Val"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Val"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("s_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_type"><?php _e("S Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control" id="s_type" <?php echo in_array("s_type", $disabled)?' disabled="disabled" ':' name="s_type" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Type"));?>">
			        <?php $s_type_selected= $mainobj->GetPostValue("s_type","T");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("s_type",true),$s_type_selected);
			            ?>
			        
			        </select>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("s_option",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_option"><?php _e("S Option"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("s_option");?>" class="form-control" id="s_option" <?php echo in_array("s_option", $disabled)?' disabled="disabled" ':' name="s_option" ';?>     placeholder="<?php _e("S Option"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("S Option"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("s_auto_load",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="s_auto_load"><?php _e("S Auto Load"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="s_auto_load" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("s_auto_load","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="s_auto_load" <?php echo in_array("s_auto_load", $disabled)?' disabled="disabled" ':' name="s_auto_load" ';?>   > 
					</label>
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>