<?php 			
/**
 * Version 1.0.0
 * Creation date: 29/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:ip,added_on,start_count_time,req_counter,entry_type,status		
 */						
class Miplist extends APP_Model{	
	public $ip;
	public $added_on;
	public $start_count_time;
	public $req_counter;
	public $entry_type;
	public $country_code;
	public $status;
	public $h_at_count;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="iplist";
			$this->primaryKey="ip";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"ip"=>array("Text"=>"IP", "Rule"=>"required|max_length[50]"),
			"added_on"=>array("Text"=>"Added On", "Rule"=>"max_length[20]"),
			"start_count_time"=>array("Text"=>"Start Count Time", "Rule"=>"max_length[20]"),
			"req_counter"=>array("Text"=>"Req Counter", "Rule"=>"max_length[3]|numeric"),
			"entry_type"=>array("Text"=>"Entry Type", "Rule"=>"max_length[1]"),
		    "country_code"=>array("Text"=>"Country Code", "Rule"=>"max_length[2]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]"),
			"h_at_count"=>array("Text"=>"Hacking Tried", "Rule"=>"max_length[3]|numeric")
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "entry_type":        
	         $returnObj=array('A'=>"Auto","M"=>"Manual");
	         break;
	      case "status":        
	         $returnObj=array("N"=>"Normal","L"=>"Locked","H"=>"Locked(Hack)"); //,"C"=>"Captcha Locked"
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
	      case "entry_type":
	         $returnObj=array();
	         break;
	      case "status":
	         $returnObj=array("N"=>"success text-bold","L"=>"red text-bold","C"=>"red text-bold");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "entry_type":
	         $returnObj=array();
	         break;
	      case "status":
	         $returnObj=array("N"=>"","L"=>"","C"=>"");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		
 
	 
	//auto generated
    function Save(){
	   if($this->IsExists("ip", $this->ip)){
	       AddError("IP already exists");
	       return false;
	   }else{
	       $countryObj=APPIPdata::get($this->ip);
	       if(!empty($countryObj->country_code)){
	           $this->country_code($countryObj->country_code);
	       }
	   }
	   if(!$this->IsSetPrperty("added_on")){
	       $this->added_on(date("Y-m-d H:i:s"));
	   }
	   if(!$this->IsSetPrperty("start_count_time")){
	       $this->start_count_time(date("Y-m-d H:i:s"));
	   }
	   self::DeleteByIp($this->ip);
	   return parent::Save();
	}	          
	

	/*  
	//Delete override
	public static function DeleteByKeyValue($key,$value,$noLimit=false){
	   return parent::DeleteByKeyValue($key,$value,$noLimit);
	}
	//*/

/* add custom function here*/
    static function isBlockedIP($ip='',$counter=''){
        if(empty($ip)){
	        $ci=get_instance();
	        $ip=$ci->input->ip_address();
        }
        if(empty($counter)){
	        $obj=new self();
	        $obj->ip($ip);
	        if($obj->Select()) {
		        $counter=$obj->h_at_count;
	        }
        }
        if($counter>=2){
            return true;
        }else{
            return false;
        }
    }
    
    static function AddHackingTiredCounter() {
	    $ci=get_instance();
	    $ip=$ci->input->ip_address();
	    $obj=new self();
	    $obj->ip($ip);
	    if($obj->Select()) {
		    $upobj = new self();
		    $upobj->h_at_count( 'h_at_count+1', true );
		    if(self::isBlockedIP($ip,$obj->h_at_count+1)){
			    $upobj->status( "H" );
			    $ci->session->UnsetSession("is_ip");
            }
		    $upobj->SetWhereCondition( "ip", $ip );
		    if ($upobj->Update() ) {
			    return $obj->h_at_count+1;
		    }
	    }else{
		    $iobj=new self();
		    $iobj->ip($ip);
		    $iobj->start_count_time(date('Y-m-d H:i:s'));
		    $iobj->req_counter(1);
		    $iobj->entry_type("A");
		    $iobj->status("N");
		    $iobj->h_at_count("1");
		    $iobj->added_on(date('Y-m-d H:i:s'));
		    if($iobj->Save()){
			    return 1;
		    }
        }
    }
    static function DeleteByIp($ip){
        return parent::DeleteByKeyValue("ip",$ip);
    }
	static function check_ip(){
	    if(!is_cli()){
	        if(Mapp_setting::GetSettingsValue("app_dos_atk")=="N"){
	            return 'N';
	        }
	        $ci=get_instance();
	        $ip=$ci->input->ip_address();
	        if($ip=="::1"){
	            return 'N';
	        }
	        $type=Mapp_setting::GetSettingsValue("app_dos_action");
	        $request_times=Mapp_setting::GetSettingsValue("app_dos_req");
	        $request_times-=1;
	        $inSeconds=Mapp_setting::GetSettingsValue("app_dos_sec");
	        $isAjax=$ci->input->is_ajax_request();
	        if(!empty($ip)){
	            $obj=new self();
	            $obj->ip($ip);
	            if($obj->Select()){
	                if(strtoupper($obj->status)=="H"){
		                return "H";
                    }elseif($obj->status!="N"){
	                    return $type;
	                }
	                $reqc=$obj->req_counter-1;
	                $lastReqTime=strtotime($obj->start_count_time);
	                $targetTime=strtotime("+ $inSeconds SECONDS",$lastReqTime);
	                if($reqc>=$request_times && (time() < $targetTime)){
	                    //update lock/ Captcha
	                    $upobj=new self();
	                    $upobj->req_counter('req_counter+1',true);
	                    $upobj->status("L");
	                    $upobj->SetWhereCondition("ip", $ip);
	                    if($upobj->Update()){
	                         return $type;
	                    }
	                }else{
	                    $isLoggedIn=GetCurrentUserType();	                    
	                    if(!empty($isLoggedIn) && $isAjax){
	                        return 'N';
	                    }
	                    $upobj=new self();
	                    if(time() > $targetTime){
	                        //update new time
	                        $upobj->start_count_time(date("Y-m-d H:i:s"));
	                        $upobj->req_counter(1);
	                    }else{
	                        $upobj->req_counter('req_counter+1',true);
	                    }
	                    $upobj->SetWhereCondition("ip", $ip);
	                    if($upobj->Update()){
	                        return 'N';
	                    }
	                }
	            }else{	               
	                $iobj=new self();
	                $iobj->ip($ip);
	                $iobj->start_count_time(date('Y-m-d H:i:s'));
	                $iobj->req_counter(1);
	                $iobj->entry_type("A");
	                $iobj->status("N");
	                $iobj->added_on(date('Y-m-d H:i:s'));
	                if($iobj->Save()){
	                    return 'N';
	                }
	            }
	        }
	    }
	        
	    return "N";
	    
	} 
	
	static function ResetIP($ip){
	    $thisobj=new self();
	    $thisobj->start_count_time("0000-00-00 00:00:00"); 
	    $thisobj->req_counter("0");
		$thisobj->h_at_count("0");
	    $thisobj->status("N");
	    $thisobj->SetWhereCondition("ip", $ip);
	    return $thisobj->Update();	   
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("ip",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ip"><?php _e("IP"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="20"   value="<?php echo  $mainobj->GetPostValue("ip");?>" class="form-control" id="ip" <?php echo in_array("ip", $disabled)?' disabled="disabled" ':' name="ip" ';?>     placeholder="<?php _e("IP"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("IP"));?>">
			     	<span class="form-group-help-block"><?php _e("Ex. 192.168.10.1");?></span>	
		      	</div>
		      </div> 
		     <?php } ?>
		     
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $status_selected= $mainobj->GetPostValue("status","N");
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