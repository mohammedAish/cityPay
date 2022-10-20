<?php 			
/** 
 * @since: 14/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,cat_ids,rule_type,rule_id,status		
 */						
class Mticket_assign_rule extends APP_Model{	
	public $id;
	public $cat_ids;
	public $rule_type;
	public $rule_id;
	public $status;


	    /**
	     *@property id,cat_ids,rule_type,rule_id,status
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="ticket_assign_rule";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"cat_ids"=>array("Text"=>"Cat Ids", "Rule"=>"required|max_length[255]"),
			"rule_type"=>array("Text"=>"Rule Type", "Rule"=>"max_length[1]"),
			"rule_id"=>array("Text"=>"Rule Id", "Rule"=>"required|max_length[2]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}
	public function __call( $func, $args ) {
		if ( $func == "cat_ids" ) {
			$args[0] = preg_replace( '/[^0-9,\*]/', '', $args[0] );
		}
		parent::__call( $func, $args );
	}
	
	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "rule_type":        
	         $returnObj=array("A"=>"Assign","N"=>"Notifiy");
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
            case "rule_type":
                $returnObj = array("A" => "success", "N" => "info");
                break;
            case "status":
                $returnObj = array("A" => "success", "I" => "danger");
                break;
            default:
        }
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
            case "rule_type":
                $returnObj = array("A" => "text-bold fa faa-tada  ap ap-users-check", "N" => "faa-ring fa fa-bell");
                break;
            case "status":
                $returnObj = array("A" => "text-bold fa fa-check-circle-o", "I" => "fa fa-times-circle-o");
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
    static function DeleteByID($id){
        return parent::DeleteByKeyValue("id",$id);
    }
    /**
     * @param $cat_id
     * @return Mticket_assign_rule
     */
    static function GetAssignRuleByCategory($cat_id){
	    $query="SELECT * FROM ticket_assign_rule WHERE status='A' AND rule_type='A' AND FIND_IN_SET('$cat_id', cat_ids)";
	    $obj=new self();
	    $result=$obj->SelectQuery($query);
	    if(!empty($result[0]->id)){
            return $result[0];
        }
	    return null;
    }
	
	/**
	 * @param $cat_id
	 *
	 * @return self []
	 */
	static function GetNotifyRulesByCategory($cat_id){
		$query="SELECT * FROM ticket_assign_rule WHERE status='A' AND rule_type='N' AND FIND_IN_SET('$cat_id', cat_ids)";
		$obj=new self();
		$result=$obj->SelectQuery($query);
		if(count($result)>0){
			return $result;
		}
		return [];
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("cat_ids",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="cat_ids"><?php _e("Choose Category"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("cat_ids");?></span>	*/?>

                    <?php
                    $options_category=Mcategory::getCategoryListHtmlOptionArray('A');
                    ?>
                    <select class="form-control select2" id="cat_ids"  name="cat_idsa[]"       data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Category"));?>" multiple="multiple">
                        <?php $category_selected=$category_selected= PostValue("cat_idsa");
                        if(empty($category_selected) && !empty($mainobj->cat_ids)){
                            $category_selected=explode(",",$mainobj->cat_ids);
                        }
                        GetHTMLOption("*",__("All Category"),(in_array("*",$category_selected)?"*":""));
                        GetHTMLOptionByArray($options_category,$category_selected);
                        ?>
                    </select>
		      	</div>
		      </div> 
		     <?php } ?>


			
			<?php if(!in_array("rule_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="rule_type"><?php _e("Rule Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $rule_type_selected= $mainobj->GetPostValue("rule_type","A");
			            $rule_type_isDisabled=in_array("rule_type", $disabled);

			            GetHTMLRadioByArray("Rule Type","rule_type","rule_type",true,$mainobj->GetPropertyRawOptions("rule_type"),$rule_type_selected,$rule_type_isDisabled,true,"has_depend_fld");
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("rule_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			<div class="fld-rule-type fld-rule-type-a ">
                <?php $selected_role_id= $mainobj->GetPostValue("rule_id");?>
                <?php if(!in_array("rule_id",$except)){ ?>
                    <div class="form-group">
                        <label class="control-label col-md-<?php echo $label_col;?>" for="rule_id_a"><?php _e("Select Role"); ?></label>
                        <div class="col-md-<?php echo $input_col;?>">
                            <?php
                            $roles=Mrole_list::FetchAllKeyValue("role_id","title");
                            ?>
                            <select class="form-control" id="rule_id_a" <?php echo in_array("rule_id", $disabled)?' disabled="disabled" ':' name="rule_id" ';?>    data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Role"));?>">
                                <?php

                                GetHTMLOptionByArray($roles,$selected_role_id); ?>
                            </select>
                            <span class="form-group-help-block text-red"><?php _e("Auto assign equally based on current month assigning");?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
             <div class="fld-rule-type fld-rule-type-n">
                 <?php if(!in_array("rule_id",$except)){ ?>
                     <div class="form-group">
                         <label class="control-label col-md-<?php echo $label_col;?>" for="rule_id_n"><?php _e("Select User"); ?></label>
                         <div class="col-md-<?php echo $input_col;?>">
                             <?php
                             $userlist=Mapp_user::FetchAllKeyValue("id","title");
                             ?>
                             <select class="form-control" id="rule_id_n" <?php echo in_array("rule_id", $disabled)?' disabled="disabled" ':' name="rule_id" ';?>    data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User"));?>">
                                 <?php GetHTMLOptionByArray($userlist,$selected_role_id); ?>
                             </select>
                             <span class="form-group-help-block"><?php _e("Selected agent/supervisor/admin will be notified on new ticket") ; ?></span>
                         </div>
                     </div>
                 <?php } ?>
             </div>


			
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