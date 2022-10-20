<?php
/**
 * Create Date: Nov 10, 2016 5:33:23 PM
 */
require(__DIR__.'/instamojo/Instamojo.php');
class AppInstamojo extends AppPaymentBase {
    public $ID="instamojo";
    /**
     * @var mixed|string
     */
    private $api_key;
    private $auth_token;
    private $currency;

    function onInit()
 	{
 	    if($this->hasAdminSettingsAccess()) {
            add_filter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }
        $this->test_mode=$this->GetSettingsValue("test_mode");
        $this->api_key=$this->GetSettingsValue("api_key");
        $this->auth_token=$this->GetSettingsValue("auth_token");

        $this->currency=$this->GetSettingsValue("p_currency");
        add_action('process-payment-instamojo',[$this,"process_payment"],10,3);
        add_action('action-instamojo-thank-you',[$this, "instamojo_thank_you"],10,2);
        add_filter("payment-method",function($methods){
            $methods['M']="Instamojo";
            return $methods;
        });
 	}
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "Instamojo Setting", "admin/addons/admin-page/instamojo", "fa fa-info");
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
            $country = "";
            $ticket = Mticket::FindBy("id", $payment_obj->ticket_id);
            if (!empty($ticket)) {
                $user = Msite_user::FindBy("id", $ticket->ticket_user);
                if (!empty($user->user_type == "U")) {
                    $name = $user->first_name . ' ' . $user->last_name;
                    $email = $user->email;
                    $phone = $user->phone;
                }
            }
            $amount = (int)$payment_obj->amount;
            $txnid = uniqid();
            $purpose = $payment_obj->payment_des;

            if($this->test_mode=='Y'){
                $url = 'https://test.instamojo.com/api/1.1/';
            }else{
                $url = 'https://www.instamojo.com/api/1.1/';
            }

        }catch (Exception $ex){
            $controller->DisplayMSGOnly($this->getTitle()."-". $ex->getMessage()."<br> Try other payment method");
            return;
        }
        
        $api = new Instamojo\Instamojo($this->api_key, $this->auth_token, $url);
        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $purpose,
                "amount" => $amount,
                "buyer_name" => $name,
                "send_email" => true,
                "email" => $email,
                "phone" => $phone,
                "redirect_url" => site_url("site/action/instamojo-thank-you/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}/{$txnid}")
            ));
            echo '<form method="get" action="'.$response['longurl'].'" name="paytmform"><form>';
        }catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
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
    function instamojo_thank_you($controller, $params)
    {
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
        $instamojoOrderId=$params[4];
        $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
        if (!$payment_obj) {
            $controller->DisplayMSGOnly("Process Failed- Payment information not found");
            return;
        }
        if($payment_obj->status=='A'){
            $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
            return;
        }
        $response = array();
        $success = false;
        $error = "Payment Failed";
        $payment_request_id= GetValue('payment_request_id');
        if (empty($payment_request_id) === false){
            if($this->test_mode=='Y'){
                $url = 'https://test.instamojo.com/api/1.1/';
            }else{
                $url = 'https://www.instamojo.com/api/1.1/';
            }
            $api = new Instamojo\Instamojo($this->api_key, $this->auth_token, $url);
            try {
                $response = $api->paymentRequestStatus($payment_request_id);
                if(isset($response['status']) && $response['status']=='Completed'){
                    $success = true;
                }
            }catch (Exception $e) {
                $error = $e->getMessage();
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
                $name = isset($response['buyer_name']) && $response['buyer_name']!='' ? $response['buyer_name'] : '';
                $amount = isset($response['amount']) && $response['amount']!='' ? $response['amount'] : '';
                $transaction_id = isset($response['id']) && $response['id']!='' ? $response['id'] : '';
                $payment_id = isset($response[0]['payment_id']) && $response[0]['payment_id']!='' ? $response[0]['payment_id'] : $response['id'];
                $created_at = isset($response['created_at']) && $response['created_at']!='' ? $response['created_at'] : '';
                
                $customer_name = $name;
                $card_or_payment_email = $customer_name;
                $total_amount = $amount;
                $transaction_id = $transaction_id;
                $transaction_time = date('Y-m-d H:i:s',strtotime($created_at));
                $approval_code = $payment_id;
                $result_msg = "Captured by Instamojo";

                if (!Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country,'I')) {
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
       return "Instamojo";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('addons/instamojo-payment/assets/instamojo.png').'" alt="Pay now with instamojo" />';
    }

    /**
     * @param APP_Controller $controller
     * @param $args
     */
    public function AdminSettings($controller,$args){
        $controller->SetTitle("Instamojo");
       ?>
        <div class="row">
            <div class="col-md-8">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("Instamojo Settings");?></h3>
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
                                    <label class="control-label col-md-3 label-required" for="is_enable_instamojo"><?php _e("Enable Instamojo") ; ?></label>
                                    <div class="col-md-9">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable Instamojo payment");?></span>
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
                                            <span class="form-group-help-block  "><span class="text-danger text-bold fld-is-test-mode fld-is-test-mode-y"><?php _e("Disable this if you want real payment");?></span><span class="text-yellow text-bold fld-is-test-mode fld-is-test-mode-n"> <?php _e("If you enable this, then all payment will be in test mode. Don't do this if you want real payment");?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="fld-is-enable fld-is-enable-y">
                                    <hr class="form-group  m-0" />
                                    <div class="  m-t-15">
                                       <div class="row">
                                           <div class="col-md-12">
                                               <div class="form-group ">
                                                   <label class="control-label col-md-3 label-required" for="api_key"><?php _e("API Key") ; ?></label>
                                                   <div class="col-md-9">
                                                       <input type="text"   value="<?php echo  $this->GetPostValue("api_key")?>" class="form-control" id="api_key" name="api_key" placeholder="<?php _e("API Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","API Key");?>">
                                                   </div>
                                               </div>
                                               <div class="form-group ">
                                                   <label class="control-label col-md-3 label-required" for="api_key"><?php _e("Auth Token") ; ?></label>
                                                   <div class="col-md-9">
                                                       <input type="text"   value="<?php echo  $this->GetPostValue("auth_token")?>" class="form-control" id="auth_token" name="auth_token" placeholder="<?php _e("Auth Token"); ?>" data-bv-notempty="true"  data-bv-notempty-message=" <?php  _e("%s is required","Auth Token");?>">
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