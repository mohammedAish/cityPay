<?php 			
/**
 * Version 1.0.0
 * Creation date: 21/Dec/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,user_id,title,canned_msg,entry_date,added_by,status		
 */						
class Mcanned_msg extends APP_Model{	
	public $id;
	public $user_id;
	public $title;
	public $canned_msg;
	public $entry_date;
	public $added_by;
    public $canned_type;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="canned_msg";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
			$this->htmlInputField=array("canned_msg");
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"user_id"=>array("Text"=>"User Id", "Rule"=>"max_length[3]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[150]"),
			"canned_msg"=>array("Text"=>"Canned Msg", "Rule"=>"required"),
			"entry_date"=>array("Text"=>"Entry Date", "Rule"=>"max_length[20]"),
			"added_by"=>array("Text"=>"Added By", "Rule"=>"max_length[3]"),
            "canned_type"=>array("Text"=>"Canned Type", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[255]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
            case "status":
                $returnObj = array("A" => "Active", "I" => "Inactive");
                break;
            case "canned_type":
                $returnObj = array("T" => "For Ticket", "C" => "For Chat");
                break;
            default:
        }
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;
		
	}

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
        if(!$this->IsSetPrperty("added_by")){
            $adminData=GetAdminData();
            if(!empty($adminData->id)){
                $this->added_by($adminData->id);
            }
        }		   
	    return parent::Save();
	}
			


/* add custom function here*/
	public static function DeleteById($id){
	    return parent::DeleteByKeyValue("id", $id);
	}
	public static function getParamList(){
	    $return_obj=array();
	    $return_obj["site_name"]="Your site name";
	    $return_obj["site_url"]="Your Site URL";
	    $return_obj["ticket_user"]="The user who has opened ticket";
	    $return_obj["ticket_title"]="Ticket title";	
	    $return_obj["ticket_priroty"]="Ticket priroty";	
	    $return_obj["reply_user"]="Reply user name";
	    $return_obj["reply_user_grp"]="Reply user group";
	    
	    return $return_obj;
	}
	public static function getParamListClearData(){
	    $return_obj=self::getParamList();
	    $return_obj=array_map(function($value){
	        $value="";
	    }, $return_obj);
	    $return_obj["site_name"]=get_app_title();
	    $return_obj["site_url"]=base_url();
	    return $return_obj;
	}
	static function get_real_msg($params,$str){
	    if(count($params)>0){
    	    $search=array();
    	    $replace=array();
    	    foreach ($params as $key=>$value){
    	        $search[]="{{".$key."}}";
    	        $replace[]=$value;
    	    }    	   
    	    return str_replace($search, $replace, $str);
	    }
	    return $str;
	} 
	/**
	 * @param Mticket $ticketObj
	 * @return multitype:
	 */
	public static function get_canned_msgs($ticketObj,$canned_type="T"){
	    if($ticketObj instanceof Mticket){
	        $response_obj=[];
	        $allCannedMsg=self::FindAllBy("status", "A",["canned_type"=>$canned_type]);
	        if(count($allCannedMsg)>0){
	            $param=self::getParamListClearData();
	            $ticket_user=Msite_user::FindBy("id", $ticketObj->ticket_user);
    	        $param["ticket_user"]=$ticket_user->first_name." ". $ticket_user->last_name;
    	        $param["ticket_title"]=$ticketObj->title;
    	        $param["ticket_priroty"]=$ticketObj->getTextByKey("priroty");
    	        $currentUser=GetAdminData();
    	        if(!empty($currentUser->title) && !empty($currentUser->role_title)){
    	           $param["reply_user"]=$currentUser->title;
    	           $param["reply_user_grp"]=$currentUser->role_title;
    	        }
    	        foreach ($allCannedMsg as $msg){
    	            $msg->canned_msg=self::get_real_msg($param, $msg->canned_msg);
    	            $response_obj[$msg->id]=$msg;
    	        }
    	        return $response_obj;    	        
	        }
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>	
		     
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("canned_msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="canned_msg"><?php _e("Message"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea maxlength=""   class="form-control" id="canned_msg" <?php echo in_array("canned_msg", $disabled)?' disabled="disabled" ':' name="canned_msg" ';?>    data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Canned Msg"));?>"><?php echo  $mainobj->GetPostValue("canned_msg");?></textarea>
		      	</div>
		      </div> 
		     <?php } ?>
		
			
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