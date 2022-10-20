<?php 			
/**
 * Version 1.0.0
 * Creation date: 16/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,ticket_id,reply_id,amount,payment_currency,payment_des,payment_id,created_by,refund_msg,payment_method,status		
 */						
class Mticket_payment extends APP_Model{	
	public $id;
	public $ticket_id;
	public $reply_id;
	public $amount;
	public $payment_currency;
	public $payment_des;
	public $payment_id;
	public $created_by;
	public $refund_msg;
	public $payment_method;
	public $create_date;
	public $process_date;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="ticket_payment";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"ticket_id"=>array("Text"=>"Ticket Id", "Rule"=>"required|max_length[10]|integer"),
			"reply_id"=>array("Text"=>"Reply Id", "Rule"=>"required|max_length[11]|integer"),
			"amount"=>array("Text"=>"Amount", "Rule"=>"required|max_length[8]|numeric"),
			"payment_currency"=>array("Text"=>"Payment Currency", "Rule"=>"required|max_length[3]"),
			"payment_des"=>array("Text"=>"Payment Des", "Rule"=>"required|max_length[255]"),
			"payment_id"=>array("Text"=>"Trans Id", "Rule"=>"max_length[14]"),
			"created_by"=>array("Text"=>"Created By", "Rule"=>"required|max_length[3]"),
			"refund_msg"=>array("Text"=>"Refund Msg", "Rule"=>"max_length[255]"),
			"payment_method"=>array("Text"=>"Payment Method", "Rule"=>"max_length[1]"),
		    "create_date"=>array("Text"=>"Create Date", "Rule"=>"max_length[20]"),
		    "process_date"=>array("Text"=>"Process Date", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "payment_method":        
	         $returnObj=array("P"=>"PayPal","S"=>"Stripe","A"=>"Authorize");
             $returnObj=AddOnManager::DoFilter('payment-method',$returnObj);
	         break;
	      case "status":        
	         $returnObj=array("P"=>"Pending","A"=>"Paid","F"=>"Failed","R"=>"Refunded");
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
	      case "payment_method":
	         $returnObj=array("P"=>"info","S"=>"success","A"=>"success");
             $returnObj=AddOnManager::DoFilter('payment-method-color',$returnObj);
	         break;
	      case "status":
	         $returnObj=array("P"=>"info","A"=>"success","F"=>"danger","R"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "payment_method":
	         $returnObj=array("P"=>"fa fa-paypal","S"=>"fa fa-stripe","A"=>"fa fa-authorize");
             $returnObj=AddOnManager::DoFilter('payment-method-icon',$returnObj);
	         break;
	      case "status":
	         $returnObj=array("P"=>"fa fa-hourglass-1","A"=>"fa fa-check-circle-o","F"=>"fa fa-times-circle-o","R"=>"");
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
	 * @param integer $ticket_id
	 * @param string $reply_id
	 * @param string $created_by
	 * @param double $amount
	 * @param string $des
	 * @param string $currency
	 * @param string $method
	 * @return NULL|Mticket_payment
	 */
	static function add($ticket_id,$reply_id,$created_by,$amount,$des,$currency='USD',$method='P'){
	    if(empty($des)){
	        AddError("Description is required");
	        return null;
	    }
	    
	    $ticket_payment=new self();
	    $ticket_payment->ticket_id($ticket_id);
	    $ticket_payment->reply_id($reply_id);
	    $ticket_payment->created_by($created_by);
	    $ticket_payment->amount($amount);
	    $ticket_payment->payment_des($des);
	    $ticket_payment->payment_currency($currency);
	    $ticket_payment->payment_method($method);
	    $ticket_payment->status("P");
	    if($ticket_payment->Save()){
	        return $ticket_payment;
	    }
	    return null;
	}
	static function has_enable_payment(){
        $activePaymentList=AppPaymentBase::getActivePaymentMethods();
	    return count($activePaymentList)>0;
	}
	static function CompletePayment($ticket_payment_obj,$customer_name,$card_or_payment_email,$total_amount,$transaction_id,$transaction_time,$approval_code,$resull_msg='',$country='',$payment_method='P')
    {
        $first2 = substr($card_or_payment_email, 0, 2);
        $last4 = substr($card_or_payment_email, -4);
        $mpayment = new Mpayment_log();
        $mpayment->amount_cr($total_amount);
        $mpayment->amount_dr(0);
        $mpayment->transaction_id($transaction_id);
        $mpayment->ticket_payment_id($ticket_payment_obj->id);
        $paymentid = Mpayment_log::get_new_payment_id();
        $mpayment->payment_id($paymentid);
        $mpayment->first_2_digit($first2);
        $mpayment->last_4_digit($last4);
        $mpayment->paid_by("PP");
        if (filter_var($card_or_payment_email, FILTER_VALIDATE_EMAIL)) {
            $mpayment->pp_payer_email($card_or_payment_email);
        }
        $mpayment->transation_type("A");
        $mpayment->transaction_time($transaction_time);
        $mpayment->process_time(date('Y-m-d H:i:s'));
        $mpayment->update_time(date('Y-m-d H:i:s'));
        $mpayment->note(" Ticket Payment");
        $mpayment->status("A");
        $mpayment->result(0);
        $mpayment->result_msg($resull_msg);
        $mpayment->response_reason(0);
        $mpayment->country($country);
        $mpayment->name_on_card($customer_name);
        $mpayment->approval_code($approval_code);
        if ($mpayment->Save()) {
            Mticket::setPaidTicket($ticket_payment_obj->ticket_id);
            $mticket = Mticket::FindBy("id", $ticket_payment_obj->ticket_id);
            $user = Msite_user::FindBy("id", $mticket->ticket_user);
            Mticket::UpdateStatus($ticket_payment_obj->ticket_id, "P", $user->id, $user->user_type);
            Mticket_log::AddTicketLog($ticket_payment_obj->ticket_id, $user->id, $user->user_type, "Paid ({$ticket_payment_obj->payment_currency}{$total_amount})", "P");
            $upayment = new Mticket_payment();
            $upayment->payment_method($payment_method);
            $upayment->status("A");
            $upayment->process_date(date('Y-m-d H:i:S'));
            $upayment->payment_method("P");
            $upayment->payment_id($mpayment->payment_id);
            $upayment->SetWhereCondition("id", $ticket_payment_obj->id);
            $upayment->SetWhereCondition("ticket_id", $ticket_payment_obj->ticket_id);
            $upayment->SetWhereCondition("reply_id", $ticket_payment_obj->reply_id);
            if ($upayment->Update()) {
                return true;
            }
        }
        return false;

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
			
			<?php if(!in_array("ticket_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ticket_id"><?php _e("Ticket Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("ticket_id");?>" class="form-control" id="ticket_id" <?php echo in_array("ticket_id", $disabled)?' disabled="disabled" ':' name="ticket_id" ';?>     placeholder="<?php _e("Ticket Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("ticket_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("reply_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="reply_id"><?php _e("Reply Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("reply_id");?>" class="form-control" id="reply_id" <?php echo in_array("reply_id", $disabled)?' disabled="disabled" ':' name="reply_id" ';?>     placeholder="<?php _e("Reply Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("reply_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("amount",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="amount"><?php _e("Amount"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="8"   value="<?php echo  $mainobj->GetPostValue("amount");?>" class="form-control" id="amount" <?php echo in_array("amount", $disabled)?' disabled="disabled" ':' name="amount" ';?>     placeholder="<?php _e("Amount"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Amount"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("amount");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("payment_currency",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="payment_currency"><?php _e("Payment Currency"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="3"   value="<?php echo  $mainobj->GetPostValue("payment_currency");?>" class="form-control" id="payment_currency" <?php echo in_array("payment_currency", $disabled)?' disabled="disabled" ':' name="payment_currency" ';?>     placeholder="<?php _e("Payment Currency"); ?>" >
			     		<?php /*<span class="form-group-help-block"><?php _e("payment_currency");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("payment_des",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="payment_des"><?php _e("Payment Des"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("payment_des");?>" class="form-control" id="payment_des" <?php echo in_array("payment_des", $disabled)?' disabled="disabled" ':' name="payment_des" ';?>     placeholder="<?php _e("Payment Des"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Payment Des"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("payment_des");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("payment_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="payment_id"><?php _e("Trans Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("payment_id");?>" class="form-control" id="payment_id" <?php echo in_array("payment_id", $disabled)?' disabled="disabled" ':' name="payment_id" ';?>     placeholder="<?php _e("Trans Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Trans Id"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("payment_id");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("created_by",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="created_by"><?php _e("Created By"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="3"   value="<?php echo  $mainobj->GetPostValue("created_by");?>" class="form-control" id="created_by" <?php echo in_array("created_by", $disabled)?' disabled="disabled" ':' name="created_by" ';?>     placeholder="<?php _e("Created By"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Created By"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("created_by");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("refund_msg",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="refund_msg"><?php _e("Refund Msg"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("refund_msg");?>" class="form-control" id="refund_msg" <?php echo in_array("refund_msg", $disabled)?' disabled="disabled" ':' name="refund_msg" ';?>     placeholder="<?php _e("Refund Msg"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Refund Msg"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("refund_msg");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("payment_method",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="payment_method"><?php _e("Payment Method"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $payment_method_selected= $mainobj->GetPostValue("payment_method","P");
			            $payment_method_isDisabled=in_array("payment_method", $disabled);
			            GetHTMLRadioByArray("Payment Method","payment_method","payment_method",true,$mainobj->GetPropertyRawOptions("payment_method"),$payment_method_selected,$payment_method_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("payment_method");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<select    class="form-control" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Status"));?>">
			        <?php $status_selected= $mainobj->GetPostValue("status","P");
			            GetHTMLOptionByArray($mainobj->GetPropertyRawOptions("status",true),$status_selected);
			            ?>
			        
			        </select>
			        <?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>