<?php 			
/**
 * Version 1.0.0
 * Creation date: 30/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,user_id,title,msg,entry_link,is_popup_link,view_time,entry_time,status		
 */						
class Mapp_notificaiton extends APP_Model{	
	public $id;
	public $user_id;
	public $title;
	public $msg;
	public $entry_link;
	public $n_counter;
	public $is_popup_link;
	public $view_time;
	public $entry_time;
	public $entry_type;
    public $item_type;
    public $extra_param;

	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="app_notificaiton";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("user_id"));
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[11]|integer"),
			"user_id"=>array("Text"=>"User Id", "Rule"=>"required|max_length[10]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[100]"),
			"msg"=>array("Text"=>"Msg", "Rule"=>"required|max_length[255]"),
			"entry_link"=>array("Text"=>"Entry Link", "Rule"=>"required|max_length[150]"),
		    "entry_type"=>array("Text"=>"Entry Link", "Rule"=>"required|max_length[1]"), 
		    "n_counter"=>array("Text"=>"Entry Link", "Rule"=>"max_length[2]|integer"),
			"is_popup_link"=>array("Text"=>"Is Popup Link", "Rule"=>"max_length[1]"),
			"view_time"=>array("Text"=>"View Time", "Rule"=>"max_length[20]"),
			"entry_time"=>array("Text"=>"Entry Time", "Rule"=>"max_length[20]"),
            "title_params"=>array("Text"=>"View Time", "Rule"=>"max_length[255]"),
            "item_type"=>array("Text"=>"Entry Time", "Rule"=>"max_length[2]"),
            "extra_param"=>array("Text"=>"View Time", "Rule"=>"max_length[255]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "is_popup_link":        
	         $returnObj=array("Y"=>"Yes","N"=>"No");
	         break;
	      case "status":        
	         $returnObj=array("A"=>"Active","V"=>"Viewed","D"=>"Deleted");
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
	      case "status":
	         $returnObj=array("A"=>"success","V"=>"success","D"=>"danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "status":
	         $returnObj=array("A"=>"fa fa-check-circle-o","V"=>"","D"=>"fa fa-times-circle-o");
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
	static function Add($type,$user_id,$title,$msg,$link,$is_popup=false,$check_same_msg=false,$itemType='',$extraParam='',$status='A'){
	    $obj=new self();
	    $obj->user_id($user_id);
	    $obj->title($title);
	    $obj->entry_type($type);
	    $obj->msg($msg);
	    $obj->entry_link($link);
	    $obj->is_popup_link($is_popup?"Y":"N");
	    $obj->entry_time(date('Y-m-d H:i:s'));
	    $obj->item_type($itemType);
	    $obj->extra_param($extraParam);
	    $obj->status($status);
     
	    if($check_same_msg  && $obj->IsExists("user_id", $user_id,["title"=>$title,"entry_type"=>$type,"entry_link"=>$link,"status"=>"A"])){
	        $ubj=new self();
	        $ubj->entry_time(date('Y-m-d H:i:s'));
	        $ubj->n_counter("n_counter+1",true);
	        $ubj->SetWhereCondition("user_id", $user_id);
	        $ubj->SetWhereCondition("title", $title);
	        $ubj->SetWhereCondition("entry_type", $type); 
	        $ubj->SetWhereCondition("entry_link", $link);
	        $ubj->SetWhereCondition("status", "A");
	        return $ubj->Update();
	    }
	    return  $obj->Save();
	}
	static function Viewed($type,$user_id){
	    $obj=new self();
	    $obj->status("V");
	    $obj->view_time(date('Y-m-d h:i:s'));
	    $obj->SetWhereCondition("user_id", $user_id);
	    $obj->SetWhereCondition("entry_type", $type);
	    $obj->SetWhereCondition("status", "A");	    
	    return  $obj->Update(true);
	}
	static function ViewedByID($id){
	    $obj=new self();
	    $obj->status("V");
	    $obj->view_time(date('Y-m-d h:i:s'));
	    $obj->SetWhereCondition("id", $id);	   
	    $obj->SetWhereCondition("status", "A");
	    return  $obj->Update(true);
	}
	static function AddNotification($user_id,$title,$msg,$link,$is_popup=false,$itemType='',$extraParam='',$status="A"){
	    return self::Add("N", $user_id, $title, $msg, $link,$is_popup,false,$itemType,$extraParam,$status);
	}
	static function AddMessage($user_id,$title,$msg,$link,$is_popup=false,$check_same_msg=false,$itemType='',$extraParam='',$status="A"){
	    return self::Add("M", $user_id, $title, $msg, $link,$is_popup,$check_same_msg,$itemType,$extraParam,$status);
	}
    
    /**
     * @param $user_id
     * @param $likeStr
     * @param string $previous_time
     * @param string $order_by
     * @param string $order
     * @return static[]
     */
    static function GetItemTypeBy($user_id, $likeStr, $previous_time='', $order_by='', $order='',$status=''){
	    $obj=new self();
	    $obj->user_id($user_id);
	    $obj->item_type(" like '$likeStr'",true);
        $obj->entry_type('N');
        
	    if(!empty($previous_time)){
	        $obj->entry_time(">'$previous_time'",true);
        }
        if(!empty($status)){
            $obj->status($status);
        }
        
        return $obj->SelectAllGridData("",$order_by,$order);
	    
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
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user_id"><?php _e("User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("user_id");?>" class="form-control" id="user_id" <?php echo in_array("user_id", $disabled)?' disabled="disabled" ':' name="user_id" ';?>     placeholder="<?php _e("User Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("user_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
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
			
			<?php if(!in_array("entry_link",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="entry_link"><?php _e("Entry Link"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("entry_link");?>" class="form-control" id="entry_link" <?php echo in_array("entry_link", $disabled)?' disabled="disabled" ':' name="entry_link" ';?>     placeholder="<?php _e("Entry Link"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Entry Link"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("entry_link");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("is_popup_link",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_popup_link"><?php _e("Is Popup Link"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_popup_link" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_popup_link","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_popup_link" <?php echo in_array("is_popup_link", $disabled)?' disabled="disabled" ':' name="is_popup_link" ';?>   >
						 
					</label>
					<?php /*<span class="form-group-help-block"><?php _e("is_popup_link");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("view_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="view_time"><?php _e("View Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("view_time");?>" class="form-control" id="view_time" <?php echo in_array("view_time", $disabled)?' disabled="disabled" ':' name="view_time" ';?>     placeholder="<?php _e("View Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("View Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("view_time");?></span>	*/?>
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