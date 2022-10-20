<?php
/**
 * Create Date: Nov 10, 2016 5:33:23 PM
 */
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Sale;
use PayPal\Api\Refund;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Order;
class APPPaypal extends AppPaymentBase {
    public $ID="paypal";
 	private $merchant_id;
 	public $isTestMode;
 	private $clientID;
 	private $clientSecret;
 	public $isPaypalEnabled;

 	function onInit()
 	{

        if($this->GetSettingsValue("is_up_previous","N")=="N"){
            $this->loadPreviousData();
        }
 		$this->merchant_id="";
 		$this->clientID=$this->GetSettingsValue("client_id");
 		$this->clientSecret=$this->GetSettingsValue("secret");
 		$this->isPaypalEnabled=$this->GetSettingsValue("is_enable_paypal","N")=="Y";
 		$this->isTestMode=$this->GetSettingsValue("is_test_mode","N")=="Y";
        if($this->hasAdminSettingsAccess()) {
            AddOnManager::AddFilter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }
        AddOnManager::AddAction('process-payment-paypal',[$this,"process_payment"],10,3);
        AddOnManager::AddAction('action-paypal-response',[$this,"paypal_response"],10,2);
        AddOnManager::AddAction('system-notification',[$this,"showNotification"]);
 	}
 	function loadPreviousData(){
        $this->settings_data['is_up_previous']="Y";
        $this->settings_data['client_id']=Mapp_setting_api::GetSettingsValue("paypal", "client_id");
        $this->settings_data['secret']=Mapp_setting_api::GetSettingsValue("paypal", "secret");
        $this->settings_data['is_enable_paypal']=Mapp_setting_api::GetSettingsValue("paypal", "is_enable_paypal");
        $this->settings_data['is_test_mode']=Mapp_setting_api::GetSettingsValue("paypal", "is_test_mode");
        $this->settings_data['p_currency']=Mapp_setting_api::GetSettingsValue("paypal", "p_currency");
        $this->UpdateSettings();
    }
    function showNotification(){
        if(!ISDEMOMODE && $this->isActive() && $this->GetSettingsValue("is_test_mode")=="Y"){
            GetSystemMsgItem("PPEN",'PayPal :',"Paypal payment has been enabled in test mode. So no real transaction will be done. <b>Please contact admin as early as possible</b>","danger",false);
        }
    }
    public function get_supported_currency()
    {
        return ["USD","AUD","CAD","CZK","DKK","EUR","HKD","HUF","INR","ILS","MXN","NOK","NZD","PHP","PLN","GBP","RUB","SGD","SEK","CHF","THB"];
    }
    public function is_supported_currency($currency)
    {
        $supportedCurrencies=$this->get_supported_currency();
        return in_array($currency,$supportedCurrencies);
    }

    function isActive()
    {
        return $this->GetSettingsValue('is_enable_paypal','N')=="Y";
    }
    public function getTitle()
    {
       return "Paypal";
    }
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "Paypal Setting", "admin/addons/admin-page/paypal", "ap ap-paypal");
        return $menuObj;
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('images/paypal.png').'" alt="Buy now with PayPal" />';
    }

    /**
     * @param string $payment_id
     * @param Mticket_payment $payment_obj
     * @param APP_Controller $controller
     */
    public function process_payment($payment_id,$payment_obj,$controller){

        $success_url=site_url("site/action/paypal-response/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");
        $cancel_url=site_url("site/action/paypal-response/C/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");
        $process_status=$this->process_single_payment($payment_id,$payment_obj->payment_des,$payment_obj->amount,$success_url,$cancel_url,0,$payment_obj->payment_currency);
        if(!$process_status){
            $controller->DisplayMSGOnly("Payment Process failed, Try again");
            return;
        }else{
            $controller->output->unset_template();
        }
        $controller->DisplayMSGOnly("Payment Process failed, Try again");

    }
    function finish_order($paymentObj,$ticket_payment_obj,$controller)
    {
        try {
            $transactions = $paymentObj->getTransactions();
            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $trantime = $paymentObj->getCreateTime();
            $paidtransc = $paymentObj->getTransactions();
            $total_amount = !empty($paidtransc[0]->amount->total) ? $paidtransc[0]->amount->total : $ticket_payment_obj->amount;
            $payer = $paymentObj->getPayer();
            $payerinfo = $payer->getPayerInfo();

            //params
            $customer_name = $payerinfo->first_name . $payerinfo->last_name;
            $card_or_payment_email = $payerinfo->email;
            $total_amount = $total_amount;
            $transaction_id = $paymentObj->getId();
            $transaction_time = $trantime;
            $approval_code = $sale->getId();
            $resull_msg = $paymentObj->getState();
            $country = $payerinfo->country_code;

            if (Mticket_payment::CompletePayment($ticket_payment_obj,$customer_name,$card_or_payment_email,$total_amount,$transaction_id,$transaction_time,$approval_code,$resull_msg,$country,"P")) {
                $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$ticket_payment_obj->ticket_id}"), 10, true);
                return;
            } else {
                Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_payment_obj->ticket_id}-{$ticket_payment_obj->reply_id}-{$ticket_payment_obj->id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, current_url());
                $controller->DisplayMSGOnly("Payment failed. Please try again later");
                return;
            }
        } catch (Exception $ex) {
            Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_payment_obj->ticket_id}-{$ticket_payment_obj->reply_id}-{$ticket_payment_obj->id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, $ex->getData());
        }
    }
    function paypal_response($controller,$params)
    {

        if(count($params) !=4){
            $controller->DisplayMSGOnly("Invalid request param");
            return;
        }
        $type=strtoupper($params[0]);
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];


        $controller->SetTitle("Ticket Payment Process");
        if ($type == "S" && !empty($payment_id)) {
            $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
            if (!$payment_obj) {
                $controller->DisplayMSGOnly("Process Failed");
                return;
            }
            $paypal_obj = new APPPaypal();
            $apiContext = $paypal_obj->getApiContext();
            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);
            $currentStatus = $payment->getState();
            if ($currentStatus == "approved") {
                $mplog = new Mpayment_log();
                $transaction_id = $payment->getId();
                $mplog->ticket_payment_id($payment_obj->id);
                $mplog->transaction_id($transaction_id);
                if (!$mplog->Select()) {
                    $this->finish_order($payment, $payment_obj,$controller);
                } else {
                    $controller->DisplayMSGOnly("The payment is already processed");
                    return;
                }
                exit(1);
            } elseif ($currentStatus != "created") {
                $controller->DisplayMSGOnly("Payment Process Error, Please try again later");
                return;
            }
            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PayPal\Api\PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);


            // ### Additional payment details
            // Use this optional field to set additional
            // payment information such as tax, shipping
            // charges etc.
            $details = new Details();
            $details->setShipping(0)
                ->setSubtotal($payment_obj->amount);

            // ### Amount
            // Lets you specify a payment amount.
            // You can also specify additional details
            // such as shipping, tax.
            $amount_obj = new Amount();
            $amount_obj->setCurrency(strtoupper($payment_obj->payment_currency))
                ->setTotal($payment_obj->amount)
                ->setDetails($details);

            //fromhrer


            // ### Optional Changes to Amount
            // If you wish to update the amount that you wish to charge the customer,
            // based on the shipping address or any other reason, you could
            // do that by passing the transaction object with just `amount` field in it.
            // Here is the example on how we changed the shipping to $1 more than before.
            $transaction = new Transaction();
            $transaction->setAmount($amount_obj);
            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);

            try {
                // Execute the payment
                // (See bootstrap.php for more on `ApiContext`)
                $paymentObj = $payment->execute($execution, $apiContext);
                $this->finish_order($paymentObj, $payment_obj,$controller);
                //ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);


            } catch (PayPal\Exception\PayPalConnectionException $ex) {

                $data = $ex->getData();
                $data = json_decode($data);
                if ($data->name == "PAYMENT_ALREADY_DONE") {
                    $mplog = new Mpayment_log();
                    $transaction_id = $payment->getId();
                    $mplog->ticket_payment_id($payment_obj->id);
                    $mplog->transaction_id($transaction_id);
                    if (!$mplog->Select()) {
                        $this->finish_order($payment, $payment_obj,$controller);
                    } else {
                        $controller->DisplayMSGOnly("The payment is already processed");
                        return;
                    }
                } else {
                    Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, $ex->getData());
                }
            } catch (Exception $ex) {
                Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, $ex->getData());
            }

        } elseif ($type == "C") {
            //cancel user
            $controller->DisplayMSGOnly("You have canceled the payment process", site_url("ticket/details/{$ticket_id}"));
            return;
        } else {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, "Unknown type({$type}) error");
        }


    }

    /**
 	 * @return \PayPal\Rest\ApiContext
 	 */
 	public function getApiContext(){
 		$apiContext = new ApiContext(
 				new OAuthTokenCredential(
 						$this->clientID,
 						$this->clientSecret
 				)
 		);
 	
 		// Comment this line out and uncomment the PP_CONFIG_PATH
 		// 'define' block if you want to use static file
 		// based configuration
 	
 	
 		$apiContext->setConfig(
 				array(
 						'mode' => $this->isTestMode?'sandbox':'live',
 						'log.LogEnabled' => $this->isTestMode,
 						'log.FileName' => APPPATH.'logs/PayPal.log',
 						'log.LogLevel' => $this->isTestMode?'DEBUG':'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
 						'cache.enabled' => false,
 						// 'http.CURLOPT_CONNECTTIMEOUT' => 30
 						// 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
 						//'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
 				)
 		);
 		return $apiContext;
 	}
 	
 	public function process_single_payment($payment_id,$des,$amount,$success_url,$cancel_url,$shipping=0.0,$currency="USD"){
 	    $apiContext=$this->getApiContext();
 	    $currency=strtoupper($currency);
 	   
 	    //payer
 	    $payer = new Payer();
 	    $payer->setPaymentMethod("paypal");
 	    $itemList = new ItemList();
 	    if(strlen($des)>127){
 	        $item_name=substr($des, 0,127);
 	    }else{
 	        $item_name=$des;
 	    }
 	    $item = new Item();
 	    $item->setName($item_name)
 	    ->setCurrency($currency)
 	    ->setQuantity(1)
 	    ->setSku("payment") // Similar to `item_number` in Classic API
 	    ->setPrice($amount);
 	    $itemList->addItem($item);
 	     
 	    // ### Additional payment details
 	    // Use this optional field to set additional
 	    // payment information such as tax, shipping
 	    // charges etc.
 	    $amount=$amount+$shipping;
 	    $details = new Details();
 	    $details->setShipping($shipping)
 	    ->setTax(0)
 	    ->setSubtotal($amount);
 	    
 	    // ### Amount
 	    // Lets you specify a payment amount.
 	    // You can also specify additional details
 	    // such as shipping, tax.
 	    $amount_obj = new Amount();
 	    $amount_obj->setCurrency($currency)
 	    ->setTotal( $amount)
 	    ->setDetails($details);
 	    
 	    // ### Transaction
 	    // A transaction defines the contract of a
 	    // payment - what is the payment for and who
 	    // is fulfilling it.
 	    $transaction = new Transaction();
 	    $transaction->setAmount($amount_obj)
 	    ->setItemList($itemList)
 	    ->setDescription($des)
 	    ->setInvoiceNumber($payment_id);
 	    
 	    // ### Redirect urls
 	    // Set the urls that the buyer must be redirected to after
 	    // payment approval/ cancellation.
 	    $baseUrl = base_url();
 	    //$success_url=user_url("gtalk-payment/paypal-process/Y/$order_id");
 	    //$cancel_url=user_url("gtalk-payment/paypal-process/C/$order_id");
 	    $redirectUrls = new RedirectUrls();
 	    $redirectUrls->setReturnUrl($success_url)
 	    ->setCancelUrl($cancel_url);
 	    
 	    // ### Payment
 	    // A Payment Resource; create one using
 	    // the above types and intent set to 'sale'
 	    $payment = new Payment();
 	    $payment->setIntent("sale")
 	    ->setPayer($payer)
 	    ->setRedirectUrls($redirectUrls)
 	    ->setTransactions(array($transaction));
 	    
 	    
 	    // For Sample Purposes Only.
 	    $request = clone $payment; 	 
 	    // ### Create Payment
 	    // Create a payment by calling the 'create' method
 	    // passing it a valid apiContext.
 	    // (See bootstrap.php for more on `ApiContext`)
 	    // The return object contains the state and the
 	    // url to which the buyer must be redirected to
 	    // for payment approval
 	    try {
 	        $payment->create($apiContext);
 	    }catch (PayPal\Exception\PayPalConnectionException $ex) {
 	        Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$ex->getMessage()."\nData:\n".print_r($ex->getData(),true));
 	       return false; 	       
 	    
 	    } catch (Exception $ex) {
 	        Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$payment_id})".$this->subject_str, Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$ex->getMessage()."\nData:\n".print_r($ex->getData(),true));
 	        return false;
 	        	
 	    }
 	    	
 	    // ### Get redirect url
 	    // The API response provides the url that you must redirect
 	    // the buyer to. Retrieve the url from the $payment->getApprovalLink()
 	    // method
 	    $approvalUrl = $payment->getApprovalLink();
 	    redirect($approvalUrl);
 	    return true;
 	    
 	}
 	
 	
 	/**
 	 * @param unknown $refundAmount
 	 * @param unknown $saleId
 	 * @param PayPal\Api\Refund $refundedSale
 	 */
 	public function refundBySale($refundAmount,$saleId,&$refundedSale=NULL){
 		$apiContext=$this->getApiContext();
 		try {
 			$amount = new Amount();
 			$amount->setCurrency("USD")
 			->setTotal($refundAmount);
 			
 			
 			// ### Retrieve the sale object
 			// Pass the ID of the sale
 			// transaction from your payment resource.
 			$sale = Sale::get($saleId, $apiContext); 	
 			$state=$sale->getState();
 			if($state!="completed" || $state=="refunded"){
 				return false;
 			}
 			$refund = new Refund();
 			$refund->setAmount($amount); 			
 			$refundedSale = $sale->refund($refund, $apiContext);
 			if($refundedSale->getState()=="completed"){
 					return true;
 			}
 			return false;
 			
 		} catch (PayPal\Exception\PayPalConnectionException $ex) {
 			// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 			AddFileLog("Error on Refund".$ex->getData());
 			
 		}catch (Exception $ex) {
 			// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 			AddFileLog("Error on Refund".$ex->getMessage());
 			
 		}
 		return false;
 	}

    /**
     * @param APP_Controller $controller
     * @param $args
     */
 	public function AdminSettings($controller, $args)
    {
        $controller->SetTitle("Paypal Settings");
        echo form_open($this->getUpdateUrl(), array("class" => "form app-ajax-form form-horizontal", "id" => "app_basic_form", "method" => "post", "data-on-complete" => "ajax_default_complete")); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php _e("Paypal Settings");?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group m-b-0">
                            <label class="control-label col-md-2 label-required" for="is_enable_paypal">Enable Paypal</label>
                            <div class="col-md-10">
                                <div class="togglebutton ">
                                    <input  name="is_enable_paypal" value="N" type="hidden">
                                    <label>
                                        <input  type="checkbox" <?php echo $this->GetPostValue("is_enable_paypal","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable_paypal"  name="is_enable_paypal" >
                                    </label>
                                    <span class="form-group-help-block"><?php _e("Enable this to enable paypal payment");?></span>
                                </div>

                            </div>
                        </div>
                        <hr class="form-group fld-is-enable-paypal fld-is-enable-paypal-y m-0" />
                        <div class="form-group fld-is-enable-paypal fld-is-enable-paypal-y">
                            <label class="control-label col-md-2 label-required" for="is_test_mode">Test Mode</label>
                            <div class="col-md-10">
                                <div class="togglebutton ">
                                    <input  name="is_test_mode" value="N" type="hidden">
                                    <label>
                                        <input  type="checkbox" <?php echo $this->GetPostValue("is_test_mode","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_test_mode"  name="is_test_mode" >
                                    </label>
                                    <span class="form-group-help-block  "><span class="text-danger text-bold fld-is-test-mode fld-is-test-mode-y"><?php _e("Disable this if you want real payment");?></span><span class="text-yellow text-bold fld-is-test-mode fld-is-test-mode-n"><?php _e("If you enable this, then all payment will be in test mode. Don't do this if you want real payment");?></span></span>

                                </div>

                            </div>
                        </div>

                        <div class="form-group fld-is-enable-paypal fld-is-enable-paypal-y">
                            <label class="control-label col-md-2 label-required" for="client_id">Client ID</label>
                            <div class="col-md-10">
                                <input type="text"   value="<?php echo  $this->GetPostValue("client_id")?>" class="form-control" id="client_id" name="client_id" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>">
                            </div>
                        </div>


                        <div class="form-group fld-is-enable-paypal fld-is-enable-paypal-y">
                            <label class="control-label col-md-2 label-required" for="secret">Secret</label>
                            <div class="col-md-10">
                                <input type="text"   value="<?php echo  $this->GetPostValue("secret")?>" class="form-control" id="secret" name="secret" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                Instruciton for PayPal details :
                                <ol class="p-l-15">
                                    <li>Go to PayPal Developer Panel.<a target="blank" href="https://developer.paypal.com/developer/" class="btn btn-xs btn-info">Click Here</a></li>
                                    <li>And click the button "Login to Dashboard". </li>
                                    <li>And follow the instuction on your dashboard. </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer text-left">
                <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button>
            </div>
            <!-- /.footer -->
        </div>
       <?php
        echo form_close();
    }
}