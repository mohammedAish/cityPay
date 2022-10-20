<?php 			
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,title,msg,is_sup,added_on,added_by,msg_type,status		
 */						
class Msystem_msg extends APP_Model{	
	public $id;
	public $tag;
	public $title;
	public $msg;
	public $is_sup;
	public $added_on;
	public $added_by;
	public $msg_type;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="system_msg";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"tag"=>array("Text"=>"Tag", "Rule"=>"max_length[10]"),
			"title"=>array("Text"=>"Title", "Rule"=>"max_length[100]"),
			"msg"=>array("Text"=>"Msg", "Rule"=>"required|max_length[255]"),
			"is_sup"=>array("Text"=>"Is Sup", "Rule"=>"max_length[1]"),
			"added_on"=>array("Text"=>"Added On", "Rule"=>"max_length[20]"),
			"added_by"=>array("Text"=>"Added By", "Rule"=>"max_length[100]"),
			"msg_type"=>array("Text"=>"Msg Type", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "is_sup":        
	         $returnObj=array("Y"=>"Yes","N"=>"No;");
	         break;
	      case "msg_type":        
	         $returnObj=array("D"=>"Danger","W"=>"Warning","S"=>"Success");
	         break;
	      case "status":        
	         $returnObj=array("A"=>"Active","D"=>"Dissmised");
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
	      case "msg_type":
	         $returnObj=array("D"=>"danger","W"=>"success","S"=>"success");
	         break;
	      case "status":
	         $returnObj=array("A"=>"success","D"=>"danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "msg_type":
	         $returnObj=array("D"=>"fa fa-times-circle-o","W"=>"","S"=>"fa fa-check-circle-o");
	         break;
	      case "status":
	         $returnObj=array("A"=>"fa fa-check-circle-o","D"=>"fa fa-times-circle-o");
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
	static function IsTagExist($tag,$status="A"){
	    $extraParam=[];
	    if(!empty($status)){
	        $extraParam=["status"=>"A"];
	    }
	    $obj=new self();
	    return $obj->IsExists("tag", $tag,$extraParam);	    
	}
	static function Add($tag,$title,$msg,$msg_type,$status='A',$is_sup='N',$is_check_old=false){
	    $obj=new self();
	    if($is_check_old){
	        if($obj->IsExists("tag", $tag,["status"=>"A"])){
	            $upobj=new self();
	            $upobj->title($title); 
        	    $upobj->msg($msg);
        	    $upobj->tag($tag);
        	    $upobj->is_sup($is_sup);
        	    $upobj->msg_type($msg_type);
        	    $upobj->status($status);
        	    $upobj->added_on(date('Y-m-d H:i:s'));
	            $upobj->SetWhereCondition("tag", $tag);
	            $upobj->SetWhereCondition("status", "A");
	            return $upobj->Update();	            
	        }
	    }
	   
	    $obj->title($title); 
	    $obj->msg($msg);
	    $obj->tag($tag);
	    $obj->msg_type($msg_type);
	    $obj->is_sup($is_sup);
	    $obj->status($status);
	    $obj->added_on(date('Y-m-d H:i:s'));
	    //$user_id="";
	    $adminData=GetAdminData();
	    if(!empty($adminData)){
	        $obj->added_by($adminData->id);
	    }
	    //$obj->added_by();
	    return $obj->Save();
	}
	static function AddSuccessMsg($tag,$title,$msg,$is_sup='N',$is_check_old=false){
	    return self::Add($tag, $title, $msg, "S","A",$is_sup,$is_check_old);
	}
	static function AddDangerMsg($tag,$title,$msg,$msg_type,$status='A',$is_sup='N',$is_check_old=false){
	    return self::Add($tag, $title, $msg, "D","A",$is_sup,$is_check_old);
	}
	static function AddWarningMsg($tag,$title,$msg,$msg_type,$status='A',$is_sup='N',$is_check_old=false){
	    return self::Add($tag, $title, $msg, "W","A",$is_sup,$is_check_old);
	}
	static function Dismiss($id){
	    $smg=Msystem_msg::FindBy("id", $id);
	    $adminUser=GetAdminData();
	    if($smg->is_sup=="O" && !$adminUser->IsSuperUser()){
	        AddError("It dismissible by only superuser group users");
	        return false;
	    }
        $obj=new self();
        $obj->status("D");
        $obj->SetWhereCondition("id", $id);
        return $obj->Update();
	}
	static function DismissByTag($tag){	   
	    $obj=new self();
	    $obj->status("D");
	    $obj->SetWhereCondition("tag", $tag);
	    return $obj->Update(true);
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg"><?php _e("Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("msg");?>" class="form-control" id="msg" <?php echo in_array("msg", $disabled)?' disabled="disabled" ':' name="msg" ';?>     placeholder="<?php _e("Msg"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("is_sup",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_sup"><?php _e("Is Sup"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_sup" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_sup","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_sup" <?php echo in_array("is_sup", $disabled)?' disabled="disabled" ':' name="is_sup" ';?>   >
						 
					</label>
					<?php /*<span class="form-group-help-block"><?php _e("is_sup");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("added_on",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="added_on"><?php _e("Added On"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("added_on");?>" class="form-control" id="added_on" <?php echo in_array("added_on", $disabled)?' disabled="disabled" ':' name="added_on" ';?>     placeholder="<?php _e("Added On"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Added On"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("added_on");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("added_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="added_by"><?php _e("Added By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("added_by");?>" class="form-control" id="added_by" <?php echo in_array("added_by", $disabled)?' disabled="disabled" ':' name="added_by" ';?>     placeholder="<?php _e("Added By"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Added By"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("added_by");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("msg_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_type"><?php _e("Msg Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $msg_type_selected= $mainobj->GetPostValue("msg_type","S");
			            $msg_type_isDisabled=in_array("msg_type", $disabled);
			            GetHTMLRadioByArray("Msg Type","msg_type","msg_type",true,$mainobj->GetPropertyRawOptions("msg_type"),$msg_type_selected,$msg_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("msg_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $status_selected= $mainobj->GetPostValue("status","A");
			            $status_isDisabled=in_array("status", $disabled);
			            GetHTMLRadioByArray("Status","status","status",true,$mainobj->GetPropertyRawOptions("status"),$status_selected,$status_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>