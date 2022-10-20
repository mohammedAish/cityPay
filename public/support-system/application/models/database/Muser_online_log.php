<?php 			
/**
 * Version 1.0.0
 * Creation date: 29/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:user_id,u_type,last_time		
 */						
class Muser_online_log extends APP_Model{	
	public $user_id;
	public $u_type;
	public $last_time;
    private static $user_data=[];

		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="user_online_log";
			$this->primaryKey="user_id";
			$this->uniqueKey=array(array("user_id","u_type"));	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"user_id"=>array("Text"=>"User Id", "Rule"=>"max_length[10]"),
			"u_type"=>array("Text"=>"U Type", "Rule"=>"max_length[1]"),
			"last_time"=>array("Text"=>"Last Time", "Rule"=>"max_length[20]")
			
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
	    if(!$this->IsSetPrperty("user_id")){
	        $user_id=$this->GetNewIncId("user_id","AAAAAAAAAA");
	        $this->user_id($user_id);
	    }
	    return parent::Save();
	}*/	          
	

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

/* add custom function here*/
	static function user_is_onine($user_id,$type){	   
	    if(!isset(self::$user_data[$user_id."_".$type])){
    	   $obj=self::FindBy("user_id", $user_id,["u_type"=>$type]);
    	   if($obj){
    	       self::$user_data[$user_id."_".$type]=true;
    	   }else{
    	       self::$user_data[$user_id."_".$type]=false;
    	   }
	    }
	    return self::$user_data[$user_id."_".$type];
	}
    static function DeleteMeFromOnline(){
	    $utype=GetCurrentUserType();
        $userdata=NULL;
        $type="";
	    if($utype=="AD"){
            $userdata=GetAdminData();
            $type="A";
        }elseif($utype=="CU"){
            $userdata=GetUserData();
            $type="U";
        }

	    if(!empty($userdata->id)){
            $user_id=$userdata->id;
        }else{
	        return ;
        }
        if(!empty($user_id)){
	        self::DeleteFromOnline($user_id,$type);
        }

    }
    static function DeleteFromOnline($user_id,$type){
        $thisobj=new self();
        $thisobj->GetUpdateDB()->where("user_id", $user_id);
        $thisobj->GetUpdateDB()->where("u_type", $type);
        if ($thisobj->GetUpdateDB ()->delete($thisobj->tableName)) {
            if($thisobj->GetUpdateDB()->affected_rows()>0){
                return true;
            }
        }
        return false;
    }
    static function UpdateUserOnline($user_id,$type){
	   self::UpdateOrADDUserOnline($user_id, $type);
	}
	static function DeleteOldLoginUser(){
        $previous_date=date('Y-m-d H:i:s',strtotime("- 1 MINUTES"));
        $obj=new self();
        return $obj->SelectQuery2('DELETE FROM '.$obj->tableName." WHERE last_time < '$previous_date'");
    }
	static function UpdateOrADDUserOnline($user_id,$type){
	    $obj=new self();
	    $obj->last_time(date('Y-m-d H:i:s'));
	    $obj->SetWhereCondition("user_id", $user_id);
	    $obj->SetWhereCondition("u_type", $type);
	    if(!$obj->Update()){
	        $obj2=new self();
	        $obj2->user_id($user_id);
	        $obj2->u_type( $type);
	        $obj2->last_time(date('Y-m-d H:i:s'));
	        if(!$obj2->IsExists("user_id", $user_id,["u_type"=>$type])){
	            self::DeleteFromOnline($user_id,$type);
	            return $obj2->Save();
	        }
	    }else{
	        return true;
	    }
	    return false;
	}
	static function CheckOnlineStatus(){
	   //if( Mapp_setting::GetSettingsValue("is_check_online")=="Y"){
	    $type=GetCurrentUserType();
	    if($type=="AD"){
	        $adminData=GetAdminData();
	        self::UpdateUserOnline($adminData->id, "A");	        
	    }elseif($type=="CU"){
	        $userData=GetUserData();
	        self::UpdateUserOnline($userData->id, "U");
	    }
        self::DeleteOldLoginUser();
	   //}
	   return true;
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("user_id");?>" class="form-control" id="user_id" <?php echo in_array("user_id", $disabled)?' disabled="disabled" ':' name="user_id" ';?>     placeholder="<?php _e("User Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("u_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="u_type"><?php _e("U Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("u_type");?>" class="form-control" id="u_type" <?php echo in_array("u_type", $disabled)?' disabled="disabled" ':' name="u_type" ';?>     placeholder="<?php _e("U Type"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("U Type"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("u_type");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("last_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="last_time"><?php _e("Last Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("last_time");?>" class="form-control" id="last_time" <?php echo in_array("last_time", $disabled)?' disabled="disabled" ':' name="last_time" ';?>     placeholder="<?php _e("Last Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Last Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("last_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>