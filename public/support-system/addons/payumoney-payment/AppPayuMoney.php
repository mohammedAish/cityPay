<?php
/**
 * Create Date: APR 26, 2021 5:33:23 PM
 */
class AppPayuMoney extends AppPaymentBase {
    public $ID="payumoney";
    /**
     * @var mixed|string
     */
    private $test_mode;
    private $merchant_key;
    private $merchant_salt;
    private $currency;

    function onInit()
 	{
 	    if($this->hasAdminSettingsAccess()) {
            add_filter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }

        $this->test_mode=$this->GetSettingsValue("test_mode");
        $this->merchant_key=$this->GetSettingsValue("merchant_key");
        $this->merchant_salt=$this->GetSettingsValue("merchant_salt");
        $this->currency=$this->GetSettingsValue("p_currency");
        add_action('process-payment-payumoney',[$this,"process_payment"],10,3);
        add_action('action-payumoney-thank-you',[$this, "payumoney_thank_you"],10,2);
        add_action('action-payumoney-webhook',[$this, "payumoney_web_hook"],10,2);
        add_filter("payment-method",function($methods){
        $methods['U']="PayuMoney";
        return $methods;
    });
 	}
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "PayU Money Setting", "admin/addons/admin-page/payumoney", "fa-product-hunt");
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
    public function process_payment($payment_id,$payment_obj,$controller){
        if($payment_obj->status=="A"){
            $controller->DisplayMSGOnly("Payment has been done already", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
            return;
        }
        try {
            $name = "";
            $email = "";
            $country = "";
            $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
            if (!empty($ticket)) {
                $user = Msite_user::FindBy("id", $ticket->ticket_user);
                if (!empty($user->user_type == "U")) {
                    $name = $user->first_name . ' ' . $user->last_name;
                    $email = $user->email;
                    $phone = $user->phone;
                    $country = $user->country;
                }
            }
            
            $txnid = uniqid();
            $app_icon = image_url("images/logo.png");
            $productinfo = $payment_obj->payment_des;
            $amount = (int)$payment_obj->amount;
            $app_color = Mapp_setting::GetSettingsValue("app_main_color");
            $app_icon = image_url("images/logo.png");

            $surl = site_url("site/action/payumoney-thank-you/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}/{$txnid}");

            $payment_hash = hash('sha512', $this->merchant_key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$name.'|'.$email.'|||||'.$payment_id.'||||||'.$this->merchant_salt);

        }catch (Exception $ex){
            $controller->DisplayMSGOnly($this->getTitle()."-". $ex->getMessage()."<br> Try other payment method");
            return;
        }
        ?>
        <?php if($this->test_mode=='Y'){ ?>
            <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
        color="<?php echo str_replace('#', '', $app_color) ?>" bolt-logo="<?php echo $app_icon ?>"></script>
        <?php }else{ ?>
            <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="<?php echo str_replace('#', '', $app_color) ?>" bolt-logo="<?php echo $app_icon ?>"></script>
        <?php } ?>
        <div class="text-center" style="margin-bottom: 150px; ">
            <h3 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not shows payment form automatically") ; ?></h3>
            <button type="button" id="process_payment" class="btn btn-sm btn-success"><?php _e("Process Payment") ; ?></button>
        </div>
        <script type="text/javascript">
            function OpenPaymentPopup(){
                bolt.launch({
                    key: '<?php echo $this->merchant_key; ?>',
                    txnid: '<?php echo $txnid; ?>', 
                    hash: '<?php echo $payment_hash; ?>',
                    amount: '<?php echo $amount ?>',
                    firstname: '<?php echo $name ?>',
                    email: '<?php echo $email ?>',
                    phone: '<?php echo $phone ?>',
                    productinfo: '<?php echo $productinfo ?>',
                    udf5: '<?php echo $payment_id ?>',
                    surl : '<?php echo $surl ?>',
                    furl: '<?php echo $surl ?>',
                    mode: 'dropout' 
                },{
                    responseHandler: function(BOLT){
                        if(BOLT.response.txnStatus != 'CANCEL'){
                            var fr = '<form action=\"<?php echo $surl ?>\" method=\"post\">' +
                            '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                            '</form>';
                            var form = jQuery(fr);
                            jQuery('body').append(form);
                            form.submit();
                        }
                    },
                    catchException: function(BOLT){
                        /*alert( BOLT.message );*/
                    }
                });
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
    function payumoney_thank_you($controller, $params)
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
        $success = false;
        $error = "Payment Failed";
        $posts=AppSecurity::$_POSTData;

        if (empty($posts['hash']) === false){
            $status = $posts['status'];
            $resphash = $posts['hash'];
            $payuMoneyId = $posts['payuMoneyId'];
            $amount = $posts['amount'];

            $keyString          =   $this->merchant_key.'|'.$posts['txnid'].'|'.$amount.'|'.$posts['productinfo'].'|'.$posts['firstname'].'|'.$posts['email'].'|||||'.$posts['udf5'].'|||||';
            $keyArray           =   explode("|",$keyString);
            $reverseKeyArray    =   array_reverse($keyArray);
            $reverseKeyString   =   implode("|",$reverseKeyArray);
            $CalcHashString     =   strtolower(hash('sha512', $this->merchant_salt.'|'.$status.'|'.$reverseKeyString));

            if ($status == 'success'  && $resphash == $CalcHashString) {
                $error = "Transaction Successful and Hash Verified...";
                $success = true;
            }
            if($success) {
                $name = "";
                $email = "";
                $country = "IN";
                $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
                if (!empty($ticket)) {
                    $user = Msite_user::FindBy("id", $ticket->ticket_user);
                    if (!empty($user->user_type == "U")) {
                        $name = $user->first_name . ' ' . $user->last_name;
                        $email = $user->email;
                        $country = $user->country!='' ? $user->country : $country;
                    }
                }
                
                $customer_name = $name;
                $card_or_payment_email = $email;
                $total_amount = $amount;
                $transaction_id = $posts['txnid'];
                $transaction_time = PostValue("addedon");
                $approval_code = $payuMoneyId;
                $result_msg = "Captured by PayU Money";

                if (!Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country,'U')) {
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
    function payumoney_web_hook($controller, $params)
    {
        $controller->output->unset_template();
        $json = file_get_contents('php://input');
        try {
            $transacrtion_data = json_decode($json);
            if (empty($transacrtion_data['hash']) === false){
                $ticket_info = explode('-', $transacrtion_data['udf5']);
                if (!empty($ticket_info) && count($ticket_info) == 3) {
                    $ticket_id = $ticket_info[0];
                    $reply_id = $ticket_info[1];
                    $payment_id = $ticket_info[2];
                    $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
                    if (!$payment_obj) {
                        return;
                    }
                    $status = $transacrtion_data['status'];
                    $resphash = $transacrtion_data['hash'];
                    $payuMoneyId = $transacrtion_data['payuMoneyId'];
                    $amount = $transacrtion_data['amount'];

                    $keyString          =   $this->merchant_key.'|'.$transacrtion_data['txnid'].'|'.$amount.'|'.$transacrtion_data['productinfo'].'|'.$transacrtion_data['firstname'].'|'.$transacrtion_data['email'].'|||||'.$transacrtion_data['udf5'].'|||||';
                    $keyArray           =   explode("|",$keyString);
                    $reverseKeyArray    =   array_reverse($keyArray);
                    $reverseKeyString   =   implode("|",$reverseKeyArray);
                    $CalcHashString     =   strtolower(hash('sha512', $this->merchant_salt.'|'.$status.'|'.$reverseKeyString));

                    if ($status == 'success'  && $resphash == $CalcHashString) {
                        $error = "Transaction Successful and Hash Verified...";
                        $success = true;
                    }
                    if($success) {
                        $name = "";
                        $email = "";
                        $country = "IN";
                        $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
                        if (!empty($ticket)) {
                            $user = Msite_user::FindBy("id", $ticket->ticket_user);
                            if (!empty($user->user_type == "U")) {
                                $name = $user->first_name . ' ' . $user->last_name;
                                $email = $user->email;
                                $country = $user->country!='' ? $user->country : $country;
                            }
                        }
                        
                        $customer_name = $name;
                        $card_or_payment_email = $email;
                        $total_amount = $amount;
                        $transaction_id = $posts['txnid'];
                        $transaction_time = PostValue("addedon");
                        $approval_code = $payuMoneyId;
                        $result_msg = "Captured by PayU Money";

                        Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country);
                    }
                }
            }

        } catch (Exception $ex) {
            $this->AddFailedLog("PayU Money, Payment webhook received".$ex->getMessage(), $params);
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
       return "PayU Money";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('addons/payumoney-payment/assets/payumoney.png').'" alt="Pay now with PayU Money" />';
    }

    /**
     * @param APP_Controller $controller
     * @param $args
     */
    public function AdminSettings($controller,$args){
        $controller->SetTitle("PayU Money");
       ?>
        <div class="row">
            <div class="col-md-9">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("PayU Money Settings");?></h3>
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
                                    <label class="control-label col-md-3 label-required" for="is_enable_payumoney"><?php _e("Enable PayU Money") ; ?></label>
                                    <div class="col-md-9">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable PayU Money payment");?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-b-0">
                                    <label class="control-label col-md-3 label-required" for="test_mode"><?php _e("Test Mode") ; ?></label>
                                    <div class="col-md-9">
                                        <div class="togglebutton ">
                                            <input  name="test_mode" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("test_mode","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="test_mode"  name="test_mode" >
                                            </label>
                                            <span class="form-group-help-block  "><span class="text-danger text-bold fld-test-mode fld-test-mode-y"><?php _e("Disable this if you want real payment");?></span><span class="text-yellow text-bold fld-test-mode fld-test-mode-n"> <?php _e("If you enable this, then all payment will be in test mode. Don't do this if you want real payment");?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="fld-is-enable fld-is-enable-y">
                                    <hr class="form-group m-0" />
                                    <div class="  m-t-15">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3 label-required" for="merchant_key"><?php _e("Merchant Key") ; ?></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?php echo  $this->GetPostValue("merchant_key")?>" class="form-control" id="merchant_key" name="merchant_key" placeholder="<?php _e("Merchant Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","Merchant Key");?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 label-required" for="merchant_salt"><?php _e("Merchant Salt") ; ?></label>
                                                    <div class="col-md-9">
                                                        <input type="text"  value="<?php echo  $this->GetPostValue("merchant_salt")?>" class="form-control" id="merchant_salt" name="merchant_salt" placeholder="<?php _e("Merchant Salt"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"Merchant Salt");?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="form-group"/>
                                    <p class="text-center text-success text-bold"><?php _e("You can enable webhook to verify transaction. But it is optional, if you enable it then PayU Money will send event data to this server, if clients browser closed or comes any issues in clients network then this will help you to complete transaction") ; ?></p>
                                    <div class="form-group m-t-15">
                                        <label class="control-label col-md-2 label-required" for="secret">Webhook URL</label>
                                        <div class="col-md-10">
                                            <div class="panel panel-success m-0">
                                                <div class="panel-body bg-success p-5">
                                                    <?php echo site_url("site/action/payumoney-webhook"); ?>
                                                </div>
                                            </div>
                                            <span class="form-group-help-block"> Webhook Type : Payments &nbsp;&nbsp;&nbsp; WebHook Event : Successful Payment</span>
                                        </div>
                                   </div>
                                   <?php /*<div class="form-group ">
                                       <label class="control-label col-md-2 label-required" for="wh_secret"><?php _e("Webhook secret") ; ?></label>
                                       <div class="col-md-10">
                                           <input type="text" value="<?php echo  $this->GetPostValue("wh_secret")?>" class="form-control" id="wh_secret" name="wh_secret" placeholder="<?php _e("Type any string"); ?>">
                                       </div>
                                   </div>*/ ?>
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