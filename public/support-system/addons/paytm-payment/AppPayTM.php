<?php
/**
 * Create Date: APR 26, 2021 5:33:23 PM
 */
require_once __DIR__.'/paytm/libs/encdec.php';
class AppPayTM extends AppPaymentBase {
    public $ID="paytm";
    /**
     * @var mixed|string
     */
    private $test_mode;
    private $merchant_id;
    private $merchant_key;
    private $website;
    private $currency;

    function onInit()
 	{
 	    if($this->hasAdminSettingsAccess()) {
            add_filter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }

        $this->test_mode=$this->GetSettingsValue("test_mode");
        $this->merchant_id=$this->GetSettingsValue("merchant_id");
        $this->merchant_key=$this->GetSettingsValue("merchant_key");
        $this->website=$this->GetSettingsValue("website");
        $this->currency=$this->GetSettingsValue("p_currency");
        add_action('process-payment-paytm',[$this,"process_payment"],10,3);
        add_action('action-paytm-thank-you',[$this, "paytm_thank_you"],10,2);
        add_filter("payment-method",function($methods){
            $methods['T']="PayTM";
            return $methods;
        });
 	}
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "PayTM Setting", "admin/addons/admin-page/paytm", "fa-mobile");
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
            $user_id = "";
            $name = "";
            $email = "";
            $country = "";
            $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
            if (!empty($ticket)) {
                $user = Msite_user::FindBy("id", $ticket->ticket_user);
                if (!empty($user->user_type == "U")) {
                    $user_id = $user->id;
                    $name = $user->first_name . ' ' . $user->last_name;
                    $email = $user->email;
                    $phone = $user->phone;
                }
            }
            
            $txnid = uniqid();
            $app_icon = image_url("images/logo.png");
            $productinfo = $payment_obj->payment_des;
            $amount = (int)$payment_obj->amount;

            $checkSum = "";
            $paramList = array();

            $paramList["MID"] = $this->merchant_id;
            $paramList["ORDER_ID"] = $txnid;
            $paramList["CUST_ID"] = $user_id;
            $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
            $paramList["CHANNEL_ID"] = 'WEB';
            $paramList["TXN_AMOUNT"] = $amount;
            $paramList["WEBSITE"] = $this->website;
            $paramList["CALLBACK_URL"] = site_url("site/action/paytm-thank-you/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}/{$txnid}");
            $paramList["MSISDN"] = $phone;
            $paramList["EMAIL"] = $email;
            $paramList["VERIFIED_BY"] = "EMAIL";
            $paramList["IS_USER_VERIFIED"] = "YES";

            $checkSum = getChecksumFromArray($paramList,$this->merchant_key);

        }catch (Exception $ex){
            $controller->DisplayMSGOnly($this->getTitle()."-". $ex->getMessage()."<br> Try other payment method");
            return;
        }
        
        if($this->test_mode=='Y'){
            $url = 'https://securegw-stage.paytm.in/theia/processTransaction';
        }else{
            $url = 'https://securegw.paytm.in/theia/processTransaction';
        }

        echo '<form method="post" action="'.$url.'" name="paytmform">';
            foreach($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
        echo '<input type="hidden" name="CHECKSUMHASH" value="'.$checkSum.'">';
        echo '<form>';
        ?>
        <div class="text-center" style="margin-bottom: 150px; ">
            <h3 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not shows payment form automatically") ; ?></h3>
            <button type="button" id="process_payment" class="btn btn-sm btn-success"><?php _e("Process Payment") ; ?></button>
        </div>
        <script type="text/javascript">
            function ProcessPaymentForm(){
                document.paytmform.submit();
            }
            jQuery( document ).ready(function( $ ) {
                $("#process_payment").on("click",function(){
                    ProcessPaymentForm();
                });
                ProcessPaymentForm();
            });
        </script>
    <?php

    }

    /**
     * @param APP_Controller $controller
     * @param $params
     */
    function paytm_thank_you($controller, $params)
    {
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
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

        if (empty($posts['CHECKSUMHASH']) === false){
            $status = $posts['STATUS'];
            $respchecksum = $posts['CHECKSUMHASH'];
            $txnId = $posts['TXNID'];
            $amount = $posts['TXNAMOUNT'];

            $isValidChecksum = verifychecksum_e($posts, $this->merchant_key, $respchecksum);

            if ($status == 'TXN_SUCCESS'  && $isValidChecksum == TRUE) {
                $error = "Transaction Successful and Checksum Verified...";
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
                $transaction_id = $posts['TXNID'];
                $transaction_time = PostValue("TXNDATE");
                $approval_code = $txnId;
                $result_msg = "Captured by PayTM";

                if (!Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country,"T")) {
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
       return "PayTM";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('addons/paytm-payment/assets/paytm.png').'" alt="Pay now with PayTM" />';
    }

    /**
     * @param APP_Controller $controller
     * @param $args
     */
    public function AdminSettings($controller,$args){
        $controller->SetTitle("PayTM");
       ?>
        <div class="row">
            <div class="col-md-8">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("PayTM Settings");?></h3>
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
                                    <label class="control-label col-md-3 label-required" for="is_enable_paytm"><?php _e("Enable PayTM") ; ?></label>
                                    <div class="col-md-9">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable PayTM payment");?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-b-0">
                                    <label class="control-label col-md-3 label-required" for="is_test_mode"><?php _e("Test Mode") ; ?></label>
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
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 label-required" for="merchant_id"><?php _e("Merchant ID") ; ?></label>
                                                    <div class="col-md-9">
                                                        <input type="text"  value="<?php echo  $this->GetPostValue("merchant_id")?>" class="form-control" id="merchant_id" name="merchant_id" placeholder="<?php _e("Merchant ID"); ?>" data-bv-notempty="true"     data-bv-notempty-message="<?php  _e("%s is required" ,"Merchant ID");?>">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3 label-required" for="merchant_key"><?php _e("Merchant Key") ; ?></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?php echo  $this->GetPostValue("merchant_key")?>" class="form-control" id="merchant_key" name="merchant_key" placeholder="<?php _e("Merchant Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","Merchant Key");?>">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3 label-required" for="website"><?php _e("Website") ; ?></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="<?php echo  $this->GetPostValue("website")?>" class="form-control" id="website" name="website" placeholder="<?php _e("Website"); ?>" data-bv-notempty="true"  data-bv-notempty-message=" <?php  _e("%s is required","Website");?>">
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