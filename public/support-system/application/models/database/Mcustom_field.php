<?php 			
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,cat_id,title,help_text,type,opt_json_base,is_required,default_value,is_api_based,api_name,on_submit_api_check,status		
 */						
class Mcustom_field extends APP_Model{
	
	
	public $id;
	public $cat_id;
	public $title;
	public $help_text;
	public $type;
	public $opt_json_base;
	public $is_required;
	public $default_value;
	public $is_api_based;
	public $is_private;
	public $api_name;
	public $on_submit_api_check;
	public $is_on_grid;
	public $status;
	public $fld_order;
	private static $is_error_added=[];
	/** @var self [] */
	private static $customfieldAllCategories;

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="custom_field";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[2]"),
			"cat_id"=>array("Text"=>"Catagory", "Rule"=>"max_length[255]"),
			"title"=>array("Text"=>"Label", "Rule"=>"required|max_length[100]"),
			"help_text"=>array("Text"=>"Help Text", "Rule"=>"max_length[255]"),
			"type"=>array("Text"=>"Type", "Rule"=>"max_length[1]"),
			"opt_json_base"=>array("Text"=>"Options", "Rule"=>"max_length[255]"),
			"is_required"=>array("Text"=>"Is Required", "Rule"=>"max_length[1]"),
			"default_value"=>array("Text"=>"Default Value", "Rule"=>"max_length[255]"),
			"is_api_based"=>array("Text"=>"Is Api Based", "Rule"=>"max_length[1]"),
			"is_private"=>array("Text"=>"Is Private", "Rule"=>"max_length[1]"),
            "is_on_grid"=>array("Text"=>"Is On Grid", "Rule"=>"max_length[1]"),
			"api_name"=>array("Text"=>"Api Name", "Rule"=>"max_length[50]"),
			"on_submit_api_check"=>array("Text"=>"On Submit Api Check", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]"),
			"fld_order"=>array("Text"=>"Field Order", "Rule"=>"max_length[3]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "type":        
	         $returnObj=array("T"=>"Textbox","N"=>"Numeric","A"=>"Date","O"=>"Switch" , "R"=>"Radio","D"=>"Dropdown","L"=>"Text/Instruction","U"=>"URL Input");
	         break;
	     case "is_required":        
	         $returnObj=array("Y"=>"Yes","N"=>"No");
	         break;
	      case "is_api_based":        
	         $returnObj=array("Y"=>"Yes","N"=>"No");
	         break;
	      case "on_submit_api_check":        
	         $returnObj=array("Y"=>"Yes","N"=>"No");
	         break;
	      case "status":        
	         $returnObj=array("A"=>"Active","I"=>"Inactive");
	         break;
	      case "is_private":
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
			case "type":
				$returnObj = array(
					"T" => "success",
					"N" => "success",
					"D" => "success",
					"A" => "success",
					"R" => "success"
				);
				break;
			case "status":
				$returnObj = array( "I" => "danger", "A" => "success" );
				break;
			case "is_private":
				$returnObj = array( "N" => "danger", "Y" => "success" );
				break;
			case "is_on_grid":
				$returnObj = array( "N" => "No", "Y" => "Yes" );
				break;
			default:
		}
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "type":
	         $returnObj=array("T"=>"ion-android-textsms","N"=>"fa fa-sort-numeric-asc","D"=>"ion-ios-box-outline","A"=>"fa fa-calendar","R"=>"fa fa-dot-circle-o","O"=>"fa fa-toggle-on");
	         break;
         case "is_private":
         	$returnObj=array("N"=>"fa fa-unlock","Y"=>"fa fa-lock");
         	break;
	      default:
	    }
        return $returnObj;
	
	}		

	 
	//auto generated
   /* public function force_set_pk_for_update( $isClean = true ) {
	    if($this->type=="L" && empty($this->opt_json_base)){
		    AddError("Text or Instruction is requried");
		    return false;
	    }
	    parent::force_set_pk_for_update( $isClean );
    }*/
	
	function Save(){
	    if(!$this->IsSetPrperty("id")){
	        $id=$this->GetNewIncId("id","AA");
	        $this->id($id);
	    }
	    if($this->type=="L" && empty($this->opt_json_base)){
	        AddError("Text or Instruction is requried");
	        return false;
        }
	    $totalFild=$this->GetNewIncId("fld_order",1);
	    $this->fld_order($totalFild);
	    return parent::Save();
	}	          
	

	//*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	public static function changeOrder($id,$type) {
	    $currentField=Mcustom_field::FindBy("id",$id);
	    if($currentField) {
		    $preOrPost = new self();
		    if ( strtolower( $type ) == "u" ) {
			    //up
			   
			    $preOrPost->fld_order( "<" . $currentField->fld_order ,true);
			    $fields=$preOrPost->SelectAll('','fld_order','DESC',1);
		    } else {
			    //down
			    $preOrPost->fld_order( ">" . $currentField->fld_order ,true);
			    $fields=$preOrPost->SelectAll('','fld_order','ASC',1);
		    }
		   
		
		    if ( !empty($fields[0]) ) {
			    $preOrPost=$fields[0];
			    $nfirst = new self();
			    $nfirst->fld_order( $preOrPost->fld_order );
			    $nfirst->SetWhereCondition( "id", $currentField->id );
			    if ( $nfirst->Update() ) {
				    $nprevious = new self();
				    $nprevious->fld_order( $currentField->fld_order );
				    $nprevious->SetWhereCondition( "id", $preOrPost->id );
				    return $nprevious->Update();
			    }
		    }
	    }
	    return false;
		
	}
	public static function ResetOrder(){
	    $flds=Mcustom_field::FetchAll('','id','ASC');
	    $order=1;
		foreach ( $flds as $fld ) {
            $uobj=new self();
            $uobj->fld_order($order);
            $uobj->SetWhereCondition("id",$fld->id);
            if($uobj->Update(false,false)){
            
            }
			$order++;
	    }
	    
    }
	//*/

/* add custom function here*/
	/**
	 * @param string $type
	 *
	 * @return static[]
	 */
	static function getGridColumn($type="") {
	    $custom_field = new self();
	    if ( empty( $type ) ) {
		    $custom_field->cat_id( "!='R'" ,true);
	    } else {
		    $custom_field->cat_id( $type );
	    }
	    $custom_field->is_on_grid("Y");
		$custom_field->status('A');
	    return $custom_field->SelectAllGridData();
	    
    }
	
	/**
	 * @param $title
	 *
	 * @return Mcustom_field
	 */
	static function get_user_custom_using_title($title){
	    $obj=new self();
	    $obj->title($title);
	    if($obj->Select()){
	        //found;
            return $obj;
        }else{
	        $no=new self();
	        $no->title($title);
	        $no->status("I");
	        $no->is_api_based('N');
	        $no->cat_id('R');
	        $no->on_submit_api_check('N');
	        $no->is_required('N');
	        $no->is_on_grid('N');
	        $no->is_private('N');
	        $no->type('T');
	        if($no->Save()){
	            return $no;
            }
            
        }
        return null;
    }
	
	/**
	 * @param Mcustom_field $cfld
	 * @param array $customFieldsNeedToBeSave
	 * @param bool $isTicketFld
	 * @param bool $isForUpdate
	 * @param bool $OldValueForUpdate
	 *
	 * @return bool
	 */
	static function is_ok_custom_value($cfld,&$customFieldsNeedToBeSave=[],$isTicketFld=true,$isForUpdate=false,$OldValueForUpdate=false){
	    if(isset(self::$is_error_added[$cfld->id])){
	        return self::$is_error_added[$cfld->id];
        }
	    
	    $posted_value=PostValue("custom_".$cfld->id,"");
		if($isTicketFld) {
			$ticketCustomObject = new Mticket_custom_field();
		}else{
			$ticketCustomObject = new Msite_user_custom_field();
        }
        if($OldValueForUpdate !==false){
	        if($posted_value==$OldValueForUpdate){
	            return true;
            }
        }
		$ticketCustomObject->custom_id($cfld->id);
		$ticketCustomObject->fld_title($cfld->title);
		$ticketCustomObject->fld_value($posted_value);
		$ticketCustomObject->fld_value_text($posted_value);
		$ticketCustomObject->is_api_based($cfld->is_api_based);
		if($cfld->type=="L"){
		    return true;
        }
		if($cfld->is_required=="Y"){
			if(empty($posted_value)){
				self::$is_error_added[$cfld->id]=false;
				AddError(__("%s is required",$cfld->title));
				return false;
			}
		}
		/*if(($cfld->is_api_based!="R" || $cfld->is_api_based!="D")){
			$opt=explode(",", $cfld->opt_json_base);
			$ticketCustomObject->fld_value_text(getTextByKey($posted_value)); // no need
		}else*/
		
		if($cfld->type=="O"){
			
			$ticketCustomObject->fld_value_text($posted_value=="Y"?"Yes":"No");
		}
		if(!empty($posted_value) && ($cfld->is_api_based!="R" || $cfld->is_api_based!="D" || $cfld->is_api_based!="O") &&  $cfld->is_api_based=="Y" && !empty($cfld->api_name)){
			$apiObj=APP_API::get_api_object($cfld->api_name);
			if($apiObj){
				
				$msg="";
				$apidata=$apiObj->get_api_response($posted_value);
				if($cfld->on_submit_api_check=="Y" && !$apidata->status){
					self::$is_error_added[$cfld->id]=false;
					AddError($apidata->msg);
					return false;
				}
				$ticketCustomObject->api_name($cfld->api_name);
				$ticketCustomObject->api_data(base64_encode(json_encode($apidata)));
				
			}
		}
		$ticketCustomObject->ticket_id("0");
		if(!$ticketCustomObject->IsValidForm()){
			self::$is_error_added[$cfld->id]=false;
			return false;
		}
		if($isForUpdate && !empty($cfld->id)){
		    if($OldValueForUpdate===false){
			    $ticketCustomObject->is_new=true;
            }
			$customFieldsNeedToBeSave[$cfld->id] = $ticketCustomObject;
		}else {
			$customFieldsNeedToBeSave[] = $ticketCustomObject;
		}
		self::$is_error_added[$cfld->id]=true;
		return true;
	}
	static function getCustomFieldsByCategory($cat_id,&$fieldsNeedTObeCheck=[],$added_category=[]){
		$customfield=new Mcustom_field();
		if(self::$customfieldAllCategories==NULL) {
			$customfield->status("A");
			self::$customfieldAllCategories = $customfield->SelectAllGridData();
		}
		//$fieldsNeedTObeCheck=[];
		foreach (self::$customfieldAllCategories as $fld){
			$cats=explode(",",$fld->cat_id);
			if(in_array($fld->id,$added_category)){
			    continue;
            }
			if(in_array($cat_id,$cats) || in_array('0',$cats)){
				$fieldsNeedTObeCheck[]=$fld;
				$added_category[]=$fld->id;
			}
		}
		$category=Mcategory::FindBy("id",$cat_id);
		if(isset($category->parent_category) && $category->parent_category!=0){
		   // echo "Need to check parent ".$category->parent_category."<br/>";
		    self::getCustomFieldsByCategory($category->parent_category,$fieldsNeedTObeCheck,$added_category);
        }
		return $fieldsNeedTObeCheck;
		
    }
	static function CheckValidCustomField($cat_id,&$customFieldsNeedToBeSave){
		$customfield=new Mcustom_field();
		$fieldsNeedTObeCheck=self::getCustomFieldsByCategory($cat_id);
		$isOk=true;
		foreach ($fieldsNeedTObeCheck as $cfld){
			if(!$customfield->is_ok_custom_value($cfld,$customFieldsNeedToBeSave)){
				$isOk=false;
			}
        }
		return $isOk;
    }
	
/* end custom function */
	 function GetAddForm($label_col=3,$input_col=9,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
		      	</div>
		      </div> 
		     <?php } */?>
			
			
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Field Label"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Field Label"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Label"));?>">
		      		<span class="form-group-help-block"><?php _e("Its the field label");?></span>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("help_text",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="help_text"><?php _e("Help Text"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
                    <textarea type="text" maxlength="255"   class="form-control" id="help_text" <?php echo in_array("help_text", $disabled)?' disabled="disabled" ':' name="help_text" ';?>     placeholder="<?php _e("Help Text"); ?>" ><?php echo  $mainobj->GetPostValue("help_text");?></textarea>
		      		 <span class="form-group-help-block"><?php echo __("The text will be show like this text after the field")."<br/>".__("You can also use link in this box (Use class popupformWIF or popupform to show in modal)");?> </span>
		      	</div>
		      </div> 
		     <?php } ?>
		     
			<?php if(!in_array("cat_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="cat_id"><?php _e("Choose Type or Category"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<?php $options_cat_ids= Mcategory::getCategoryListHtmlOptionArray();
		      		?>
			        <select class="form-control select2" multiple="multiple" id="cat_id" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Label"));?>" <?php echo in_array("cat_id", $disabled)?' disabled="disabled" ':' name="cat_id[]" ';?> >
			        <?php $cat_id_selected= $mainobj->GetPostValue("cat_id");
				        $cat_id_selected=explode(",",$cat_id_selected);
				        print_r($cat_id_selected);
			        	GetHTMLOption("", "Select");
			        	
			        	?>
			        	<optgroup label="<?php _e("In Form") ; ?>">
			        	<?php GetHTMLOption("R", "Registration Form",in_array('R',$cat_id_selected)?'R':'');?>
			        	<?php //GetHTMLOption("L", "Login Form",$cat_id_selected);?>
			        	</optgroup>
			        	<optgroup label="<?php _e("On Ticket Opening Form Category") ; ?>">
			        	<?php 
			        	
			        	GetHTMLOption("0", "All Category",in_array(0,$cat_id_selected)?'0':'');
			        	foreach ( $options_cat_ids as $cat_id_k=>$options_cat_id ) {
					        GetHTMLOption($cat_id_k, $options_cat_id,in_array($cat_id_k,$cat_id_selected)?$cat_id_k:'');
			        	}
			            ?>
			            </optgroup>			        
			        </select>
			        <span class="form-group-help-block"><?php _e("If you choose this then this field will be displayed on choosen category only");?></span>
		      	</div>
		      </div> 
		     <?php } ?>
		     
			<?php if(!in_array("type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="type"><?php _e("Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $type_selected= $mainobj->GetPostValue("type","T");
			            $type_isDisabled=in_array("type", $disabled);
			            GetHTMLRadioByArray("Type","type","type",true,$mainobj->GetPropertyRawOptions("type"),$type_selected,$type_isDisabled,true,"has_depend_fld");
			            ?>
			        
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("opt_json_base",$except)){ ?>
			 <div class="form-group fld-type fld-type-d fld-type-r">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="opt_json_base">
                   <span class="fld-type fld-type-d fld-type-r"> <?php _e("Options"); ?></span>
                </label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("opt_json_base");?>" class="form-control app-tags" id="opt_json_base" <?php echo in_array("opt_json_base", $disabled)?' disabled="disabled" ':' name="opt_json_base" ';?>     placeholder="" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Options"));?>">
		      		<span class="form-group-help-block"><?php _e("Comma( , ) separated. Ex: OptionA,OptionB,OptionC");?></span>
		      		
		      	</div>
		      </div>
		      <?php } ?>
		 <?php if(!in_array("opt_json_base2",$except)){ ?>
             <div class="form-group fld-type fld-type-l">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="opt_json_base2">
                     <span > <?php _e("Text/Instruction"); ?></span>
                 </label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <textarea maxlength="255" class="form-control" id="opt_json_base2" <?php echo in_array("opt_json_base", $disabled)?' disabled="disabled" ':' name="opt_json_base2" ';?>     placeholder="" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Text or Instruction"));?>"
                     ><?php echo PostValue("opt_json_base2",($mainobj->type=="L")?$mainobj->GetPostValue("opt_json_base"):""); ?></textarea>
                     <span class="form-group-help-block"><?php _e("Maximum 255 character");?></span>
                 </div>
             </div>
		 <?php } ?>
		
         <div class="form-group">
			      	<label class="control-label col-md-3" for="is_required"><?php _e("Is Required"); ?></label>
			      	<div class="col-md-2">                   			     	
			      		
				     <div class="togglebutton ">
					    <input  name="is_required" value="N" type="hidden">
						<label> 
						<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_required","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_required" <?php echo in_array("is_required", $disabled)?' disabled="disabled" ':' name="is_required" ';?>   > 
						</label>
					</div>	
					</div>		         
				    <label class="control-label col-md-1" for="status"><?php _e("Status"); ?></label>
			      	<div class="col-md-3">                   			     	
			      		
				     <div class="togglebutton ">
					    <input  name="status" value="I" type="hidden">
						<label> 
						<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","A") == "A" ? "checked" : ""?>  value="A" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   > 
						</label>
					</div>	
			      	</div>    
			 
			      </div> 
			     
		     
			<?php if(false && !in_array("is_private",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="is_private"><?php _e("Is Private"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">

                     <div class="togglebutton ">
                         <input  name="is_private" value="N" type="hidden">
                         <label>
                             <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_private","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_private" <?php echo in_array("is_private", $disabled)?' disabled="disabled" ':' name="is_private" ';?>   >

                         </label>
                         <span class="form-group-help-block"><?php _e("If you enable this then the value of this field is always be private");?></span>
                     </div>

                 </div>
             </div>
		 <?php } ?>
   
		 <?php if(!in_array("is_on_grid",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="is_on_grid"><?php _e("Show on Table Data List"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">

                     <div class="togglebutton ">
                         <input  name="is_on_grid" value="N" type="hidden">
                         <label>
                             <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_on_grid","N") == "Y" ? "checked" : ""?>  value="Y" class="has_depend_fld" id="is_on_grid" <?php echo in_array("is_private", $disabled)?' disabled="disabled" ':' name="is_on_grid" ';?>   >

                         </label>
                         <span class="form-group-help-block ">
                             <span class="text-bold cat_id_r"><?php _e("If you enable this then it field show client list as column in admin panel");?></span>
                             <span class="cat_id_nr"><?php _e("If you enable this then it field show in All Ticket list as column in admin panel");?></span>
                             <br/><span class="text-yellow text-bold fld-is-on-grid fld-is-on-grid-y"><i class="fa fa-exclamation-triangle faa-flash animated"></i> <?php _e("Do not enable, if you don't need. Cause it will increase your server process") ; ?></span>
                         </span>
                         <span class="form-group-help-block "></span>
                         <script type="text/javascript">
                             $(function () {
                                $("#cat_id").on("change",function(e){
                                    setOngridMessage();
                                }) ;
                                 setOngridMessage();
                             });
                             function setOngridMessage(){
                                 var v=$("#cat_id").val();
                                 if(v=="R"){
                                     $(".cat_id_r").show();
                                     $(".cat_id_nr").hide();
                                 }else{
                                     $(".cat_id_r").hide();
                                     $(".cat_id_nr").show();
                                 }
                             }
                         </script>
                     </div>

                 </div>
             </div>
		 <?php } ?>
   
			<?php if(!in_array("is_api_based",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_api_based"><?php _e("Enable API Validation"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_api_based" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_api_based","N") == "Y" ? "checked" : ""?>  value="Y" data-class-prefix="api-fld" class="has_depend_fld" id="is_api_based" <?php echo in_array("is_api_based", $disabled)?' disabled="disabled" ':' name="is_api_based" ';?>   > 
					</label>
					<span class="form-group-help-block"><?php _e("If you enable this then the field will be check using selected API");?></span>
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("api_name",$except)){ ?>
			 <div class="form-group api-fld api-fld-y">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="api_name"><?php _e("Choose API"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">
		      		 <select class="form-control" id="api_name" <?php echo in_array("api_name", $disabled)?' disabled="disabled" ':' name="api_name" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("API Name"));?>">
			        <?php $api_id_selected= $mainobj->GetPostValue("api_name");
			            $options_api_list=APP_API::get_loaded_api_list(APP_API::$API_TYPE_FIELD);
			            GetHTMLOption("", "Select",$api_id_selected);
			            foreach ($options_api_list as $api){
			            	GetHTMLOption($api->get_name(), $api->get_menu_title(),$api_id_selected);
			            }			           
			            ?>			        
			        </select>
			        <span class="form-group-help-block"><?php _e("Choose API from available APIs");?></span>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("on_submit_api_check",$except)){ ?>
			 <div class="form-group api-fld api-fld-y">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="on_submit_api_check"><?php _e("Check On Submit"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="on_submit_api_check" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("on_submit_api_check","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="on_submit_api_check" <?php echo in_array("on_submit_api_check", $disabled)?' disabled="disabled" ':' name="on_submit_api_check" ';?>   > 
					</label>
					<span class="form-group-help-block"><?php _e("If you enable this, the field value need to be valid on form submission. Otherwise you will get a button to check manually");?></span>
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>			
		    
			<?php 
	}


}
?>