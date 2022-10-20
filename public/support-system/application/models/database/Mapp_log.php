<?php 			
/**
 * Version 1.0.0
 * Creation date: 23/May/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:user_id,user_type,user_role,changed_page,changed_type,changed_value,msg_code,msg_param,ip,date_time,tag,member_id,agent_id		
 */						
class Mapp_log extends APP_Model{	
	public $user_id;
	public $user_type;
	public $user_role;
	public $changed_page;
	public $changed_type;
	public $changed_value;
	public $msg_code;
	public $msg_param;
	public $ip;
	public $date_time;
	public $tag;
	public $member_id;
	public $agent_id;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="app_log";
			$this->primaryKey="";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("user_id"),array("agent_id"),array("member_id"));
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->user_id=$this->user_type=$this->user_role=$this->changed_page=$this->changed_type=null;
		$this->changed_value=$this->msg_code=$this->msg_param=$this->ip=$this->date_time=null;
		$this->tag=$this->member_id=$this->agent_id=null;

	}



	function SetValidation(){
		$this->validations=array(
			"user_id"=>array("Text"=>"User Id", "Rule"=>"required|max_length[25]"),
			"user_type"=>array("Text"=>"User Type", "Rule"=>"required|max_length[2]"),
			"user_role"=>array("Text"=>"User Role", "Rule"=>"max_length[2]"),
			"changed_page"=>array("Text"=>"Changed Page", "Rule"=>"required|max_length[150]"),
			"changed_type"=>array("Text"=>"Changed Type", "Rule"=>"max_length[1]"),
			"changed_value"=>array("Text"=>"Changed Value", "Rule"=>"max_length[250]"),
			"msg_code"=>array("Text"=>"Msg Code", "Rule"=>"required|max_length[4]"),
			"msg_param"=>array("Text"=>"Msg Param", "Rule"=>"max_length[100]"),
			"ip"=>array("Text"=>"Ip", "Rule"=>"required|max_length[50]"),
			"date_time"=>array("Text"=>"Date Time", "Rule"=>"max_length[20]"),
			"tag"=>array("Text"=>"Tag", "Rule"=>"max_length[10]"),
			"member_id"=>array("Text"=>"Member Id", "Rule"=>"max_length[4]"),
			"agent_id"=>array("Text"=>"Agent Id", "Rule"=>"max_length[4]")
			
		);
	}

	static function AddLog($changed_type,$changed_value,$msg_code,$msg_param="",$member_id="",$agent_id="",$tag="",$user="",$role=""){
		$admindata=null;
	    $current_user_type=GetCurrentUserType();
	    if(!empty($msg_param)){
	        $msg_param=__($msg_param);
	    }
	   
	    $n=new self();
	    if(!empty($current_user_type)){
	    	$n->user_type($current_user_type);
	    }else{
	    	$n->user_type("-");
	    }
	    if(!empty($user)){
	        $n->user_id($user);
	    }elseif($current_user_type=="AD"){
	    	$admindata=GetAdminData();
	    	if(!empty($admindata)){
	        	$n->user_id($admindata->user);	        	
	    	}
	    }elseif($current_user_type=="AG"){
	    	$agentdata=GetAgentData();
	    	if(!empty($agentdata)){
	        	$n->user_id($agentdata->id);
	    	}
	    }else{
	        $n->user_id("SYSTEM");
	    }
	    if(!empty($role)){
	        $n->user_role($role);
	    }elseif($admindata){
	        $n->user_role($admindata->role);
	    }else{
	        $n->user_id("S");
	    }
	    //$n->account_id();
	    $changed_url=current_url();
	    $changed_url=strlen($changed_url)>147?substr($changed_url, 0,147)."...":$changed_url;
	    $n->changed_page($changed_url);
	    $n->changed_type($changed_type);
	    $n->changed_value($changed_value);
	    $n->msg_code($msg_code);
	    $n->msg_param($msg_param);
	    if(strlen($member_id)<=4){
	    	$n->member_id($member_id);
	    }
	    if(strlen($agent_id)<=4){
	    	$n->agent_id($agent_id);
	    }
	    $n->ip(!empty($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"-");
	    $n->date_time(date('Y-m-d H:i:s'));
	    if(strlen($tag)>10){
	        $tag=substr($tag, 0,10);
	    }
	    $n->tag($tag);
	    return $n->Save();
	
	
	}
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("pv_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="pv_id"><?php _e("Pv Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"  value="<?php echo  $mainobj->GetPostValue("pv_id");?>" class="form-control" id="pv_id" name="pv_id" placeholder="<?php _e("Pv Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Pv Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("user_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user_id"><?php _e("User Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="25"  value="<?php echo  $mainobj->GetPostValue("user_id");?>" class="form-control" id="user_id" name="user_id" placeholder="<?php _e("User Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("user_role",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="user_role"><?php _e("User Role"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("user_role");?>" class="form-control" id="user_role" name="user_role" placeholder="<?php _e("User Role"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Role"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("changed_page",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="changed_page"><?php _e("Changed Page"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"  value="<?php echo  $mainobj->GetPostValue("changed_page");?>" class="form-control" id="changed_page" name="changed_page" placeholder="<?php _e("Changed Page"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Changed Page"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("changed_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="changed_type"><?php _e("Changed Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("changed_type");?>" class="form-control" id="changed_type" name="changed_type" placeholder="<?php _e("Changed Type"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Changed Type"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("changed_value",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="changed_value"><?php _e("Changed Value"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="250"  value="<?php echo  $mainobj->GetPostValue("changed_value");?>" class="form-control" id="changed_value" name="changed_value" placeholder="<?php _e("Changed Value"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Changed Value"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("msg_code",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_code"><?php _e("Msg Code"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"  value="<?php echo  $mainobj->GetPostValue("msg_code");?>" class="form-control" id="msg_code" name="msg_code" placeholder="<?php _e("Msg Code"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg Code"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("msg_param",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="msg_param"><?php _e("Msg Param"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"  value="<?php echo  $mainobj->GetPostValue("msg_param");?>" class="form-control" id="msg_param" name="msg_param" placeholder="<?php _e("Msg Param"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Msg Param"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ip",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ip"><?php _e("Ip"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="15"  value="<?php echo  $mainobj->GetPostValue("ip");?>" class="form-control" id="ip" name="ip" placeholder="<?php _e("Ip"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ip"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("date_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="date_time"><?php _e("Date Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""  value="<?php echo  $mainobj->GetPostValue("date_time");?>" class="form-control" id="date_time" name="date_time" placeholder="<?php _e("Date Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Date Time"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("tag",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="tag"><?php _e("Tag"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="3"  value="<?php echo  $mainobj->GetPostValue("tag");?>" class="form-control" id="tag" name="tag" placeholder="<?php _e("Tag"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Tag"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>