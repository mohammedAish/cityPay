<?php 			
/** 
 * @since: 10/Aug/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,user_id,custom_id,fld_title,fld_type,fld_value,fld_value_text,is_api_based,api_name,api_data		
 */						
class Msite_user_custom_field extends APP_Model{	
	public $id;
	public $user_id;
	public $custom_id;
	public $fld_title;
	public $fld_type;
	public $fld_value;
	public $fld_value_text;
	public $is_api_based;
	public $api_name;
	public $api_data;


	    /**
	     *@property id,user_id,custom_id,fld_title,fld_type,fld_value,fld_value_text,is_api_based,api_name,api_data
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="site_user_custom_field";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[11]|integer"),
			"user_id"=>array("Text"=>"User Id", "Rule"=>"max_length[10]|integer"),
			"custom_id"=>array("Text"=>"Custom Id", "Rule"=>"required|max_length[2]"),
			"fld_title"=>array("Text"=>"Fld Title", "Rule"=>"required|max_length[100]"),
			"fld_type"=>array("Text"=>"Fld Type", "Rule"=>"max_length[1]"),
			"fld_value"=>array("Text"=>"Fld Value", "Rule"=>"max_length[100]"),
			"fld_value_text"=>array("Text"=>"Fld Value Text", "Rule"=>"max_length[100]"),
			"is_api_based"=>array("Text"=>"Is Api Based", "Rule"=>"max_length[1]"),
			"api_name"=>array("Text"=>"Api Name", "Rule"=>"max_length[50]"),
			"api_data"=>array("Text"=>"Api Data", "Rule"=>"")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "fld_type":        
	         $returnObj=array("T"=>"Textbox","N"=>"Numeric","D"=>"Dropdown","A"=>"Date","R"=>"Radio");
	         break;
	      case "is_api_based":        
	         $returnObj=array("Y"=>"Yes","N"=>"No");
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
	      case "fld_type":
	         $returnObj=array("T"=>"success","N"=>"success","D"=>"danger","A"=>"success","R"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "fld_type":
	         $returnObj=array("T"=>"","N"=>"","D"=>"fa fa-times-circle-o","A"=>"fa fa-check-circle-o","R"=>"");
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
	/**
	 * @param $data
	 * @param Mcustom_field $customes
	 */
	static function bindGridCustomFieldData(&$data,$customes){
		$ids="(";
		foreach ($customes as $fld){
			$data->{"custom_".$fld->id}="";
			$ids.="'".$fld->id."',";
		}
		$ids=rtrim($ids,",").")";
		$msu=new Msite_user_custom_field();
		$msu->user_id($data->id);
		$msu->custom_id("in $ids",true);
		$cdata=$msu->SelectAllGridData();
		foreach ($cdata as $cds){
			$data->{"custom_".$cds->custom_id}=$cds->fld_value_text;
		}
    }
    static function SaveExtraCustomProperties($user_id,$customs_fields=[]) {
	    foreach ( $customs_fields as $key => $customs_field ) {
	        if(!is_array($customs_field) && !is_object($customs_field)) {
		        $cfld = Mcustom_field::get_user_custom_using_title( $key );
		        if ( $cfld ) {
		            $oob=new self();
		            if($oob->IsExists("user_id",$user_id,["custom_id"=>$cfld->id])){
			            $ticketCustomObject = new self();
			            //$ticketCustomObject->user_id( $user_id );
			           // $ticketCustomObject->custom_id( $cfld->id );
			            $ticketCustomObject->fld_title( $cfld->title );
			            $ticketCustomObject->fld_type( $cfld->type );
			            $ticketCustomObject->fld_value( $customs_field );
			            $ticketCustomObject->fld_value_text( $customs_field );
			            $ticketCustomObject->is_api_based( $cfld->is_api_based );
			            $ticketCustomObject->api_name( $cfld->api_name );
			            $ticketCustomObject->api_data( '' );
			            $ticketCustomObject->SetWhereUpdate("user_id",$user_id);
			            $ticketCustomObject->SetWhereUpdate("custom_id",$cfld->id);
			            $ticketCustomObject->Update();
                    }else {
			            $ticketCustomObject = new self();
			            $ticketCustomObject->user_id( $user_id );
			            $ticketCustomObject->custom_id( $cfld->id );
			            $ticketCustomObject->fld_title( $cfld->title );
			            $ticketCustomObject->fld_type( $cfld->type );
			            $ticketCustomObject->fld_value( $customs_field );
			            $ticketCustomObject->fld_value_text( $customs_field );
			            $ticketCustomObject->is_api_based( $cfld->is_api_based );
			            $ticketCustomObject->api_name( $cfld->api_name );
			            $ticketCustomObject->api_data( '' );
			            $ticketCustomObject->Save();
		            }
		        }
	        }
	    }
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
			
			<?php if(!in_array("user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user_id"><?php _e("User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("user_id");?>" class="form-control" id="user_id" <?php echo in_array("user_id", $disabled)?' disabled="disabled" ':' name="user_id" ';?>     placeholder="<?php _e("User Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("user_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("custom_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="custom_id"><?php _e("Custom Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("custom_id");?>" class="form-control" id="custom_id" <?php echo in_array("custom_id", $disabled)?' disabled="disabled" ':' name="custom_id" ';?>     placeholder="<?php _e("Custom Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Custom Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("custom_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("fld_title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="fld_title"><?php _e("Fld Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("fld_title");?>" class="form-control" id="fld_title" <?php echo in_array("fld_title", $disabled)?' disabled="disabled" ':' name="fld_title" ';?>     placeholder="<?php _e("Fld Title");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Fld Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("fld_title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("fld_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="fld_type"><?php _e("Fld Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $fld_type_selected= $mainobj->GetPostValue("fld_type","T");
			            $fld_type_isDisabled=in_array("fld_type", $disabled);
			            GetHTMLRadioByArray("Fld Type","fld_type","fld_type",true,$mainobj->GetPropertyOptions("fld_type"),$fld_type_selected,$fld_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("fld_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("fld_value",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="fld_value"><?php _e("Fld Value"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("fld_value");?>" class="form-control" id="fld_value" <?php echo in_array("fld_value", $disabled)?' disabled="disabled" ':' name="fld_value" ';?>     placeholder="<?php _e("Fld Value");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Fld Value"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("fld_value");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("fld_value_text",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="fld_value_text"><?php _e("Fld Value Text"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("fld_value_text");?>" class="form-control" id="fld_value_text" <?php echo in_array("fld_value_text", $disabled)?' disabled="disabled" ':' name="fld_value_text" ';?>     placeholder="<?php _e("Fld Value Text");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Fld Value Text"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("fld_value_text");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("is_api_based",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_api_based"><?php _e("Is Api Based"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_api_based" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_api_based","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_api_based" <?php echo in_array("is_api_based", $disabled)?' disabled="disabled" ':' name="is_api_based" ';?>   >
						 
					</label>
					<?php /*<span class="form-group-help-block"><?php _e("is_api_based");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("api_name",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="api_name"><?php _e("Api Name"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("api_name");?>" class="form-control" id="api_name" <?php echo in_array("api_name", $disabled)?' disabled="disabled" ':' name="api_name" ';?>     placeholder="<?php _e("Api Name");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Api Name"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("api_name");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("api_data",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="api_data"><?php _e("Api Data"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("api_data");?>" class="form-control" id="api_data" <?php echo in_array("api_data", $disabled)?' disabled="disabled" ':' name="api_data" ';?>     placeholder="<?php _e("Api Data");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Api Data"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("api_data");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>