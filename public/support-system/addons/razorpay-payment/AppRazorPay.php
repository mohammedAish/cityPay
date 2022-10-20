<?php
/**
 * Create Date: Nov 10, 2016 5:33:23 PM
 */
require(__DIR__.'/razorpay/Razorpay.php');
class AppRazorPay extends AppPaymentBase {
    public $ID="razorpay";
    public $api_endpoint="";
    public $vendor_root="";
    public $vendor_id="";
    public $auth_code="";
    public $is_test_mode=false;
    /**
     * @var mixed|string
     */
    private $key_id;
    private $secret;
    private $currency;

    function onInit()
 	{
 	    if($this->hasAdminSettingsAccess()) {
            add_filter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }
        $this->key_id=$this->GetSettingsValue("key_id");
        $this->secret=$this->GetSettingsValue("secret");
        $this->currency=$this->GetSettingsValue("p_currency");
        add_action('process-payment-razorpay',[$this,"process_payment"],10,3);
        add_action('action-razorpay-thank-you',[$this, "razorpay_thank_you"],10,2);
        add_action('action-razorpay-webhook',[$this, "razorpay_web_hook"],10,2);
        add_filter("payment-method",function($methods){
            $methods['R']="RazorPay";
            return $methods;
        });
 	}
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "Razorpay Setting", "admin/addons/admin-page/razorpay", "fa fa-star");
        return $menuObj;
    }
    public function get_supported_currency()
    {
        return ['INR'];
    }

    public function is_supported_currency($currency)
    {
        return $currency=="INR";
    }
    function isActive()
    {
        return $this->GetSettingsValue("is_enable","N")=="Y";
    }

    /**
     * @param String $payment_id
     * @param Mticket_payment $payment_obj
     * @param APP_Controller $controller
     */
    public function process_payment($payment_id,$payment_obj,$controller)
    {
        if($payment_obj->status=="A"){
            $controller->DisplayMSGOnly("Payment has been done already", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
            return;
        }
        try {
            $name = "";
            $email = "";
            $country = "IN";
            $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
            if (!empty($ticket)) {
                $user = Msite_user::FindBy("id", $ticket->ticket_user);
                if (!empty($user->user_type == "U")) {
                    $name = $user->first_name . ' ' . $user->last_name;
                    $email = $user->email;
                    $phone = $user->phone;
                    $country = $user->country!='' ? $user->country : $country;
                }
            }
            $api = new Razorpay\Api\Api($this->key_id, $this->secret);
            $amount = (int)($payment_obj->amount * 100);
            $orderData = [
                'receipt' => $payment_id,
                'amount' => $amount,
                'currency' => $payment_obj->payment_currency,
                'payment_capture' => 1
            ];
            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];

            $details = [
                "key" => $this->key_id,
                "amount" => $amount,
                "name" => $name,
                "description" => $payment_obj->payment_des,
                "image" => image_url("images/logo.png"),
                "prefill" => [
                    "name" => $name,
                    "email" => $email,
                    "contact" => $phone,
                ],
                "notes" => [
                    "address" => $country,
                    "merchant_order_id" => $payment_id,
                ],
                "theme" => [
                    "color" => Mapp_setting::GetSettingsValue("app_main_color")
                ],
                "order_id" => $razorpayOrderId,
            ];
        }catch (Exception $ex){
            $controller->DisplayMSGOnly($this->getTitle()."-". $ex->getMessage()."<br> Try other payment method");
            return;
        }
        ?>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <form name='razorpayform' action="<?php echo site_url("site/action/razorpay-thank-you/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}/{$razorpayOrderId}") ?>" method="POST">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
        </form>
          <div class="text-center" style="margin-bottom: 150px; ">
            <h3 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not shows payment form automatically") ; ?></h3>
              <button type="button" id="process_payment" class="btn btn-sm btn-success"><?php _e("Process Payment") ; ?></button>
          </div>
        <script type="text/javascript">
            function OpenPaymentPopup() {
                var options = <?php echo json_encode($details); ?>;
                options.handler = function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    document.razorpayform.submit();
                };
                options.theme.image_padding = false;
                options.modal = {
                    ondismiss: function () { /*console.log("This code runs when the popup is closed");*/
                    },
                    escape: true,
                    backdropclose: false
                };
                var rzp = new Razorpay(options);
                rzp.open();
            }
            jQuery( document ).ready(function( $ ) {
               $("#process_payment").on("click",function(){
                   OpenPaymentPopup();
               });
                OpenPaymentPopup();
            });
        </script>
        <?php

    }

    /**
     * @param APP_Controller $controller
     * @param $params
     */
    function razorpay_thank_you($controller, $params)
    {
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
        $razorpayOrderId=$params[4];
        $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
        if (!$payment_obj) {
            $controller->DisplayMSGOnly("Process Failed- Payment information not found");
            return;
        }
        if($payment_obj->status=='A'){
            $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
            return;
        }
        $success = true;
        $error = "Payment Failed";
        $posts=AppSecurity::$_POSTData;
        if (empty($posts['razorpay_payment_id']) === false){

            $api = new Razorpay\Api\Api($this->key_id, $this->secret);
            try{
                $attributes = array(
                    'razorpay_order_id' => $razorpayOrderId,
                    'razorpay_payment_id' => $posts['razorpay_payment_id'],
                    'razorpay_signature' => $posts['razorpay_signature']
                );
                $api->utility->verifyPaymentSignature($attributes);

            }catch(SignatureVerificationError $e){
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
                $controller->DisplayMSGOnly("Payment failed-$error");
                return;
            }
            if($success) {
                $name = "";
                $email = "";
                $country = "";
                $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
                if (!empty($ticket)) {
                    $user = Msite_user::FindBy("id", $ticket->ticket_user);
                    if (!empty($user->user_type == "U")) {
                        $name = $user->first_name . ' ' . $user->last_name;
                        $email = $user->email;
                        $country = $user->country;
                    }
                }
                $razorpayment  = $api->payment->fetch($posts['razorpay_payment_id']);
                if($razorpayment instanceof Razorpay\Api\Payment){
                    $razorpaymentData=$razorpayment->toArray();
                    $customer_name = $name;
                    $card_or_payment_email = $razorpaymentData['email'];
                    $total_amount = sprintf("%.2f",($razorpaymentData['amount']/100));
                    $transaction_id = $razorpaymentData['id'];
                    $transaction_time = date('Y-m-d H:i:s',$razorpaymentData['created_at']);
                    $approval_code = $razorpaymentData['order_id'];
                    $result_msg = $razorpaymentData['method']."-".$razorpaymentData['bank'];
                }else{
                    $customer_name = $name;
                    $card_or_payment_email = PostValue("p_customer_name",$customer_name);
                    $total_amount = $email;
                    $transaction_id = $posts['razorpay_payment_id'];
                    $transaction_time = PostValue("event_time");
                    $approval_code = $razorpayOrderId;
                    $result_msg = "Captured by Razorpay";
                }
                if (!Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country,"R")) {
                    $this->AddFailedLog("Payment done but completed", $params);
                    $controller->DisplayMSGOnly("Payment failed- Update failed contact with admin");
                    return;
                }
                $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
                return;
            }else{
                $controller->DisplayMSGOnly("Payment failed-$error");
                return;
            }
        }else{
            $controller->DisplayMSGOnly("Payment failed- Invalid params");
            return;
        }
    }
    /**
     * @param APP_Controller $controller
     * @param $params
     */
    function razorpay_web_hook($controller, $params)
    {
        $controller->output->unset_template();
        $json = file_get_contents('php://input');
        $webhookSecret = $this->GetSettingsValue("wh_secret","");
        try {
            $api = new Razorpay\Api\Api($this->key_id, $this->secret);
            if (!empty($_SERVER['HTTP_X_RAZORPAY_SIGNATURE'])) {
                $api->utility->verifyWebhookSignature($json, $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'], $webhookSecret);
                $transacrtion_data = json_decode($json);
                if (!empty($transacrtion_data->event) && $transacrtion_data->event == 'payment.captured') {
                    //valid
                    if (!empty($transacrtion_data->payload->payment->entity)) {
                        $payment = $transacrtion_data->payload->payment->entity;
                        if (!empty($payment->notes->merchant_order_id)) {
                            $ticket_info = explode('-', $payment->notes->merchant_order_id);
                            if (!empty($ticket_info) && count($ticket_info) == 3) {
                                $ticket_id = $ticket_info[0];
                                $reply_id = $ticket_info[1];
                                $payment_id = $ticket_info[2];
                                $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
                                if (!$payment_obj) {
                                    return;
                                }
                                $name = "";
                                $email = "";
                                $country = "";
                                $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
                                if (!empty($ticket)) {
                                    $user = Msite_user::FindBy("id", $ticket->ticket_user);
                                    if (!empty($user->user_type == "U")) {
                                        $name = $user->first_name . ' ' . $user->last_name;
                                        $email = $user->email;
                                        $country = $user->country;
                                    }
                                }
                                $customer_name = $name;
                                $card_or_payment_email = $payment->email;
                                $total_amount = sprintf("%.2f", ($payment->amount / 100));
                                $transaction_id = $payment->id;
                                $transaction_time = date('Y-m-d H:i:s', $payment->created_at);
                                $approval_code = $payment->order_id;
                                $result_msg = $payment->method . "-" . $payment->bank;
                                Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country);
                            }
                        }
                    }
                }
            }

        } catch (Exception $ex) {
            $this->AddFailedLog("RazorPay,Payment webhook received".$ex->getMessage(), $params);
        }
    }


    private function AddFailedLog($title,$params)
    {
        $postvalue = AppSecurity::$_POSTData;
        $std=new stdClass();
        $std->params=$params;
        $std->postvalues=$postvalue;
        $std->server_var=$_SERVER;
        Mdebug_log::AddGeneralLog($title, Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, print_r($std, true));
    }




    public function getTitle()
    {
       return "Razorpay";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('addons/razorpay-payment/assets/razorpay.png').'" alt="Pay now with razorpay" />';
    }

    /**
     * @param APP_Controller $controller
     * @param $args
     */
    public function AdminSettings($controller,$args){
        $controller->SetTitle("Razorpay");
       ?>
        <div class="row">
            <div class="col-md-8">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("Razorpay Settings");?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-b-0">
                                    <label class="control-label col-md-2 label-required" for="is_enable_paypal"><?php _e("Enable Razorpay") ; ?></label>
                                    <div class="col-md-10">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable Razorpay payment");?></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="fld-is-enable fld-is-enable-y">
                                    <hr class="form-group  m-0" />
                                    <div class="  m-t-15">
                                       <div class="row">
                                           <div class="col-md-12">
                                               <div class="form-group ">
                                                   <label class="control-label col-md-2 label-required" for="key_id"><?php _e("Key ID") ; ?></label>
                                                   <div class="col-md-10">
                                                       <input type="text"   value="<?php echo  $this->GetPostValue("key_id")?>" class="form-control" id="key_id" name="key_id" placeholder="<?php _e("Key ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","Key ID");?>">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="control-label col-md-2 label-required" for="secret">Secret</label>
                                                   <div class="col-md-10">
                                                       <input type="text"  value="<?php echo  $this->GetPostValue("secret")?>" class="form-control" id="secret" name="secret" placeholder="<?php _e("API Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"Secret");?>">
                                                   </div>
                                               </div>
                                               <hr class="form-group " />
                                                <p class="text-center text-success text-bold"><?php _e("You can enable webhook to verify transaction. But it is optional, if you enable it then Razorpay will send event data to this server, if clients browser closed or comes any issues in clients network then this will help you to complete transaction") ; ?></p>
                                               <div class="form-group m-t-15">
                                                   <label class="control-label col-md-2 label-required" for="secret">Webhook URL</label>
                                                   <div class="col-md-10">
                                                          <div class="panel panel-success m-0">
                                                            <div class="panel-body bg-success p-5">
                                                                <?php echo site_url("site/action/razorpay-webhook"); ?>
                                                            </div>
                                                          </div>

                                                       <span class="form-group-help-block"> Event : Payment.captured</span>
                                                   </div>
                                               </div>
                                               <div class="form-group ">
                                                   <label class="control-label col-md-2 label-required" for="wh_secret"><?php _e("Webhook secret") ; ?></label>
                                                   <div class="col-md-10">
                                                       <input type="text"   value="<?php echo  $this->GetPostValue("wh_secret")?>" class="form-control" id="wh_secret" name="wh_secret" placeholder="<?php _e("Type any string"); ?>">
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
        <?php
    }
}