<?php 			
/**
 * Version 1.0.0
 * Creation date: 19/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:payment_id,ticket_payment_id,amount_cr,amount_dr,first_2_digit,last_4_digit,transaction_id,process_time,transaction_time,update_time,result,result_msg,note,response_reason,status,transation_type,paid_by,pp_payer_email,name_on_card,country,approval_code,ref_transaction_id		
 */						
class Mpayment_log extends APP_Model{	
	public $payment_id;
	public $ticket_payment_id;
	public $amount_cr;
	public $amount_dr;
	public $first_2_digit;
	public $last_4_digit;
	public $transaction_id;
	public $process_time;
	public $transaction_time;
	public $update_time;
	public $result;
	public $result_msg;
	public $note;
	public $response_reason;
	public $status;
	public $transation_type;
	public $paid_by;
	public $pp_payer_email;
	public $name_on_card;
	public $country;
	public $approval_code;
	public $ref_transaction_id;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="payment_log";
			$this->primaryKey="";
			$this->uniqueKey=array();	
			$this->multiKey=array(array("ticket_payment_id"),array("payment_id","transaction_id"));
			$this->autoIncField=array();	
		}
			

	function SetValidation(){
		$this->validations=array(
			"payment_id"=>array("Text"=>"Payment Id", "Rule"=>"required|max_length[14]"),
			"ticket_payment_id"=>array("Text"=>"Ticket Payment Id", "Rule"=>"max_length[10]|integer"),
			"amount_cr"=>array("Text"=>"Amount Cr", "Rule"=>"max_length[6]|numeric"),
			"amount_dr"=>array("Text"=>"Amount Dr", "Rule"=>"max_length[6]|numeric"),
			"first_2_digit"=>array("Text"=>"First 2 Digit", "Rule"=>"required|max_length[2]"),
			"last_4_digit"=>array("Text"=>"Last 4 Digit", "Rule"=>"required|max_length[4]"),
			"transaction_id"=>array("Text"=>"Transaction Id", "Rule"=>"required|max_length[60]"),
			//"process_time"=>array("Text"=>"Process Time", "Rule"=>""),
			"transaction_time"=>array("Text"=>"Transaction Time", "Rule"=>"required|max_length[22]"),
			//"update_time"=>array("Text"=>"Update Time", "Rule"=>""),
			"result"=>array("Text"=>"Result", "Rule"=>"max_length[1]"),
			"result_msg"=>array("Text"=>"Result Msg", "Rule"=>"max_length[150]"),
			"note"=>array("Text"=>"Note", "Rule"=>"required|max_length[150]"),
			"response_reason"=>array("Text"=>"Response Reason", "Rule"=>"required|max_length[3]"),
			"status"=>array("Text"=>"Status", "Rule"=>"required|max_length[1]"),
			"transation_type"=>array("Text"=>"Transation Type", "Rule"=>"max_length[1]"),
			"paid_by"=>array("Text"=>"Paid By", "Rule"=>"max_length[2]"),
			"pp_payer_email"=>array("Text"=>"Pp Payer Email", "Rule"=>"max_length[150]|valid_email"),
			"name_on_card"=>array("Text"=>"Name On Card", "Rule"=>"required|max_length[80]"),
			"country"=>array("Text"=>"Country", "Rule"=>"required|max_length[2]"),
			"approval_code"=>array("Text"=>"Approval Code", "Rule"=>"required|max_length[50]"),
			"ref_transaction_id"=>array("Text"=>"Ref Transaction Id", "Rule"=>"max_length[60]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "paid_by":        
	         $returnObj=array("PP"=>"Paypal","AU"=>"Authorize","ST"=>"Stripe");
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
	      case "paid_by":
	         $returnObj=array("PP"=>"success","AU"=>"success","ST"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "paid_by":
	         $returnObj=array("PP"=>"","AU"=>"","ST"=>"");
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
	static public function get_new_payment_id($try=5){
	    $orderid="P".date("ymdHi").rand(0, 9).rand(10, 99);
	   
	    $obj=new self();	   
	    if(!$obj->IsExists("payment_id", $orderid)){
	        return $orderid;
	    }
	    $try--;
	    if($try>0){
	        return self::get_new_payment_id($try);
	    }
	    return NULL;
	
	}
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("payment_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="payment_id"><?php _e("Payment Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="14"   value="<?php echo  $mainobj->GetPostValue("payment_id");?>" class="form-control" id="payment_id" <?php echo in_array("payment_id", $disabled)?' disabled="disabled" ':' name="payment_id" ';?>     placeholder="<?php _e("Payment Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Payment Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("payment_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ticket_payment_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ticket_payment_id"><?php _e("Ticket Payment Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("ticket_payment_id");?>" class="form-control" id="ticket_payment_id" <?php echo in_array("ticket_payment_id", $disabled)?' disabled="disabled" ':' name="ticket_payment_id" ';?>     placeholder="<?php _e("Ticket Payment Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Payment Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("ticket_payment_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("amount_cr",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="amount_cr"><?php _e("Amount Cr"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="6"   value="<?php echo  $mainobj->GetPostValue("amount_cr");?>" class="form-control" id="amount_cr" <?php echo in_array("amount_cr", $disabled)?' disabled="disabled" ':' name="amount_cr" ';?>     placeholder="<?php _e("Amount Cr"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Amount Cr"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("amount_cr");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("amount_dr",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="amount_dr"><?php _e("Amount Dr"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="6"   value="<?php echo  $mainobj->GetPostValue("amount_dr");?>" class="form-control" id="amount_dr" <?php echo in_array("amount_dr", $disabled)?' disabled="disabled" ':' name="amount_dr" ';?>     placeholder="<?php _e("Amount Dr"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Amount Dr"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("amount_dr");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("first_2_digit",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="first_2_digit"><?php _e("First 2 Digit"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("first_2_digit");?>" class="form-control" id="first_2_digit" <?php echo in_array("first_2_digit", $disabled)?' disabled="disabled" ':' name="first_2_digit" ';?>     placeholder="<?php _e("First 2 Digit"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("First 2 Digit"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("first_2_digit");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("last_4_digit",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="last_4_digit"><?php _e("Last 4 Digit"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"   value="<?php echo  $mainobj->GetPostValue("last_4_digit");?>" class="form-control" id="last_4_digit" <?php echo in_array("last_4_digit", $disabled)?' disabled="disabled" ':' name="last_4_digit" ';?>     placeholder="<?php _e("Last 4 Digit"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Last 4 Digit"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("last_4_digit");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("transaction_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="transaction_id"><?php _e("Transaction Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="60"   value="<?php echo  $mainobj->GetPostValue("transaction_id");?>" class="form-control" id="transaction_id" <?php echo in_array("transaction_id", $disabled)?' disabled="disabled" ':' name="transaction_id" ';?>     placeholder="<?php _e("Transaction Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Transaction Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("transaction_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("process_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="process_time"><?php _e("Process Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("process_time");?>" class="form-control" id="process_time" <?php echo in_array("process_time", $disabled)?' disabled="disabled" ':' name="process_time" ';?>     placeholder="<?php _e("Process Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Process Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("process_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("transaction_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="transaction_time"><?php _e("Transaction Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="22"   value="<?php echo  $mainobj->GetPostValue("transaction_time");?>" class="form-control" id="transaction_time" <?php echo in_array("transaction_time", $disabled)?' disabled="disabled" ':' name="transaction_time" ';?>     placeholder="<?php _e("Transaction Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Transaction Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("transaction_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("update_time",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="update_time"><?php _e("Update Time"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength=""   value="<?php echo  $mainobj->GetPostValue("update_time");?>" class="form-control" id="update_time" <?php echo in_array("update_time", $disabled)?' disabled="disabled" ':' name="update_time" ';?>     placeholder="<?php _e("Update Time"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Update Time"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("update_time");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("result",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="result"><?php _e("Result"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("result");?>" class="form-control" id="result" <?php echo in_array("result", $disabled)?' disabled="disabled" ':' name="result" ';?>     placeholder="<?php _e("Result"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Result"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("result");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("result_msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="result_msg"><?php _e("Result Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("result_msg");?>" class="form-control" id="result_msg" <?php echo in_array("result_msg", $disabled)?' disabled="disabled" ':' name="result_msg" ';?>     placeholder="<?php _e("Result Msg"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Result Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("result_msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("note",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="note"><?php _e("Note"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("note");?>" class="form-control" id="note" <?php echo in_array("note", $disabled)?' disabled="disabled" ':' name="note" ';?>     placeholder="<?php _e("Note"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Note"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("note");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("response_reason",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="response_reason"><?php _e("Response Reason"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="3"   value="<?php echo  $mainobj->GetPostValue("response_reason");?>" class="form-control" id="response_reason" <?php echo in_array("response_reason", $disabled)?' disabled="disabled" ':' name="response_reason" ';?>     placeholder="<?php _e("Response Reason"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Response Reason"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("response_reason");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("status");?>" class="form-control" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>     placeholder="<?php _e("Status"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Status"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("transation_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="transation_type"><?php _e("Transation Type"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"   value="<?php echo  $mainobj->GetPostValue("transation_type");?>" class="form-control" id="transation_type" <?php echo in_array("transation_type", $disabled)?' disabled="disabled" ':' name="transation_type" ';?>     placeholder="<?php _e("Transation Type"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Transation Type"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("transation_type");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("paid_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="paid_by"><?php _e("Paid By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $paid_by_selected= $mainobj->GetPostValue("paid_by","PP");
			            $paid_by_isDisabled=in_array("paid_by", $disabled);
			            GetHTMLRadioByArray("Paid By","paid_by","paid_by",true,$mainobj->GetPropertyRawOptions("paid_by"),$paid_by_selected,$paid_by_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("paid_by");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("pp_payer_email",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="pp_payer_email"><?php _e("Pp Payer Email"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("pp_payer_email");?>" class="form-control" id="pp_payer_email" <?php echo in_array("pp_payer_email", $disabled)?' disabled="disabled" ':' name="pp_payer_email" ';?>     placeholder="<?php _e("Pp Payer Email"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Pp Payer Email"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("pp_payer_email");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("name_on_card",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="name_on_card"><?php _e("Name On Card"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="80"   value="<?php echo  $mainobj->GetPostValue("name_on_card");?>" class="form-control" id="name_on_card" <?php echo in_array("name_on_card", $disabled)?' disabled="disabled" ':' name="name_on_card" ';?>     placeholder="<?php _e("Name On Card"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Name On Card"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("name_on_card");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("country",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"   value="<?php echo  $mainobj->GetPostValue("country");?>" class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>     placeholder="<?php _e("Country"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("country");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("approval_code",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="approval_code"><?php _e("Approval Code"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("approval_code");?>" class="form-control" id="approval_code" <?php echo in_array("approval_code", $disabled)?' disabled="disabled" ':' name="approval_code" ';?>     placeholder="<?php _e("Approval Code"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Approval Code"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("approval_code");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("ref_transaction_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ref_transaction_id"><?php _e("Ref Transaction Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="60"   value="<?php echo  $mainobj->GetPostValue("ref_transaction_id");?>" class="form-control" id="ref_transaction_id" <?php echo in_array("ref_transaction_id", $disabled)?' disabled="disabled" ':' name="ref_transaction_id" ';?>     placeholder="<?php _e("Ref Transaction Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ref Transaction Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("ref_transaction_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>