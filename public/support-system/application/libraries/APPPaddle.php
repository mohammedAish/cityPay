<?php
/**
 * Create Date: Nov 10, 2016 5:33:23 PM
 */

class APPPaddle extends AppPaymentBase {
    public $ID="paddle";
    public $api_endpoint="";
    public $vendor_root="";
    public $vendor_id="";
    public $auth_code="";
    public $is_test_mode=false;
    public $valid_method="";
    public $public_key="";

 	function onInit()
 	{
 	    if($this->hasAdminSettingsAccess()) {
            AddOnManager::AddFilter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }
        AddOnManager::AddAction('process-payment-paddle',[$this,"process_payment"],10,3);
        AddOnManager::AddAction('action-paddle-response',[$this, "paddle_response"],10,2);
        AddOnManager::AddAction('action-paddle-webhook',[$this, "paddle_web_hook"],10,2);


        if($this->GetSettingsValue("is_test_mode","N")=="Y"){
            $this->is_test_mode=true;
            $this->api_endpoint="https://sandbox-checkout.paddle.com/api/";
            $this->vendor_root="https://sandbox-vendors.paddle.com/api/";
            $this->vendor_id=$this->GetSettingsValue("sand_vendor_id","");
            $this->auth_code=$this->GetSettingsValue("sand_api_key","");;
            $this->valid_method=$this->GetSettingsValue("send_wh_valid_method","");;
            $this->public_key=$this->GetSettingsValue("sand_public_key","");;
        }else{
            $this->api_endpoint="https://checkout.paddle.com/api/";
            $this->vendor_root="https://vendors.paddle.com/api/";
            $this->vendor_id=$this->GetSettingsValue("vendor_id","");
            $this->auth_code=$this->GetSettingsValue("api_key","");;
            $this->valid_method=$this->GetSettingsValue("wh_valid_method","");;
            $this->public_key=$this->GetSettingsValue("public_key","");;
        }
        AddOnManager::AddAction('system-notification',[$this,"showNotification"]);
        add_filter("payment-method",function($methods){
            $methods['D']="Paddle";
            return $methods;
        },9);
        AddOnManager::AddFilter("payment-method-icon",function($methods){
            $methods['D']=" ap ap-paddle-short";
            return $methods;
        });
        AddOnManager::AddFilter("payment-method-color",function($methods){
            $methods['D']=" paddle-color text-bold";
            return $methods;
        });

 	}
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "Paddle Setting", "admin/addons/admin-page/paddle", "ap ap-paddle-short");
       return $menuObj;
    }
    function showNotification(){
        if(!ISDEMOMODE && $this->isActive() && $this->GetSettingsValue("is_test_mode")=="Y"){
            GetSystemMsgItem("PDLN",'Paddle :',"Paddle payment has been enabled in test mode. So no real transaction will be done. <b>Please contact admin as early as possible</b>","danger",false);
        }
    }
    public function get_supported_currency()
    {
        return ['ARS','AUD','BRL','GBP','CAD','CNY','CZK','DKK','EUR','HKD','HUF','INR','ILS','JPY','MXN','TWD','NZD','NOK','PLN','RUB','SGD','ZAR','KRW','SEK','CHF','THB','TRY','UAH','USD'];
    }
    public function is_supported_currency($currency)
    {
        $supportedCurrencies=$this->get_supported_currency();
        return in_array($currency,$supportedCurrencies);
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
        $data = array();
        $data['vendor_id'] = $this->vendor_id;
        $data['vendor_auth_code'] = $this->auth_code;
        $data['prices'] = array($payment_obj->payment_currency . ':' . ($payment_obj->amount));   // Why was tax being removed?
        $data['return_url'] = site_url("site/action/paddle-response/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");
        $data['title'] = $payment_obj->payment_des;
        $data['image_url'] = image_url("images/logo.png");
        $data['webhook_url'] = site_url("site/action/paddle-webhook/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");
        $data['discountable'] = 0;
        $data['quantity_variable'] = 0;
        $data['customer_email'] = $email;
        $data['customer_postcode'] = "";
        $data['customer_country'] = $country;
        $link = $this->getCheckoutLlink($data,$error);
        if (!empty($link)) {
            $this->showPopup($link,$email,$country);
        } else {
            echo '<h4 class="text-center text-red" >'.$error.'</h4>';
        }
    }

    private function showPopup($link,$email,$country,$postCode=''){
    ?>
        <script src="https://cdn.paddle.com/paddle/paddle.js"></script>
          <div class="text-center" style="margin-bottom: 150px; ">
            <h3 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not shows payment form automatically") ; ?></h3>
              <button type="button" id="process_payment" class="btn btn-sm btn-success"><?php _e("Process Payment") ; ?></button>
          </div>
        <script type="text/javascript">

            function openPaddleCheckout(){
                Paddle.Checkout.open({
                    email: "<?php echo $email; ?>",
                    country: "<?php echo $country; ?>",
                    postcode: "<?php echo $postCode; ?>",
                    override: "<?php echo $link; ?>"
                });
            }
            jQuery( document ).ready(function( $ ) {
                <?php if($this->is_test_mode){ ?>
                Paddle.Environment.set('sandbox');
                <?php } ?>
                Paddle.Setup({ vendor: <?php echo $this->vendor_id ?> });
                $("#process_payment").on("click",function(e){
                    e.preventDefault();
                    openPaddleCheckout();
                });
                openPaddleCheckout();
            });
        </script>
    <?php
    }
    function paddle_response($controller, $params)
    {
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
        $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
        if (!$payment_obj) {
            $controller->DisplayMSGOnly("Process Failed");
            return;
        }
        $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
        return;

    }
    function paddle_web_hook($controller, $params){
        $postvalue=AppSecurity::$_POSTData;

        if($this->valid_method=="P") {
            if ($this->isValidIP()) {
                $this->complete_payment($controller, $params);
            } else {
                $this->AddFailedLog("Payment request received form unauthorized IP", $params);
            }
        }else {
            if ($this->VerifySignature($postvalue)) {
                $this->complete_payment($controller, $params);
            } else {
                $this->AddFailedLog("Payment request received form public key does not verified", $params);
            }
        }
    }
    private function complete_payment($controller, $params){
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
        $customer_name="";
        $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
        $ticket=Mticket::FindBy("id",$payment_obj->ticket_id);
        if(!empty($ticket)){
            $user=Msite_user::FindBy("id",$ticket->ticket_user);
            if(!empty($user->user_type =="U")){
                $customer_name=$user->first_name.' '.$user->last_name;
                $email=$user->email;
            }
        }
        if (!empty($payment_obj)) {
            $customer_name = PostValue("p_customer_name",$customer_name);
            $card_or_payment_email = PostValue("p_customer_name",$customer_name);
            $total_amount = PostValue("p_price");
            $transaction_id = PostValue("p_order_id");
            $transaction_time = PostValue("event_time");
            $approval_code = $transaction_id;
            $result_msg = "captured";
            $country = PostValue("p_country");
            if (!Mticket_payment::CompletePayment($payment_obj, $customer_name, $card_or_payment_email, $total_amount, $transaction_id, $transaction_time, $approval_code, $result_msg, $country,'D')) {
                $this->AddFailedLog("Payment done but completed", $params);
            }
        }else{
            $this->AddFailedLog("Payment done but payment information doesn't match with database", $params);
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
    function isValidIP(){
        $production=['34.232.58.13','34.195.105.136','34.237.3.244'];
        $sandbox=['34.194.127.46','54.234.237.108','3.208.120.145'];
        $params=['REMOTE_ADDR','HTTP_X_REAL_IP','HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_CF_CONNECTING_IP'];
        foreach ($params as $param){
            if(isset($_SERVER[$param])){
                if($this->is_test_mode){
                    if(in_array($_SERVER[$param],$sandbox)){
                        return true;
                    }
                }else{
                    if(in_array($_SERVER[$param],$production)){
                        return true;
                    }
                }
            }else{
                file_put_contents(APPPATH."/logs/WebHAPPPaddle.txt",$_SERVER[$param]."=> failed {$param}\n".date('Y-m-d H:i:s'),FILE_APPEND);
            }
        }
        return false;
    }
    function VerifySignature($postvalue){
        $public_key_string =trim($this->public_key);
        $public_key = openssl_get_publickey($public_key_string);
        // Get the p_signature parameter & base64 decode it.
        $signature = base64_decode($postvalue['p_signature']);

        // Get the fields sent in the request, and remove the p_signature parameter
        $fields = $postvalue;
        unset($fields['p_signature']);

        // ksort() and serialize the fields
        ksort($fields);
        foreach($fields as $k => $v) {
            if(!in_array(gettype($v), array('object', 'array'))) {
                $fields[$k] = "$v";
            }
        }
        $data = serialize($fields);

        // Verify the signature
        $verification = openssl_verify($data, $signature, $public_key, OPENSSL_ALGO_SHA1);

        if($verification == 1) {
            return true;
        } else {
          return false;
        }
    }

    /**
     * @param $data_array
     */
    public function getCheckoutLlink($data_array,&$error=""){
        $post_param=http_build_query($data_array);
        $curl = curl_init();
        $url=$this->vendor_root."2.0/product/generate_pay_link";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 15,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_param,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $error= "cURL Error #:" . $err;
        } else {
            $resObj=json_decode($response);
            if(!empty($resObj->success) && !empty($resObj->response->url)){
                return $resObj->response->url;
            }else{
                $error=!empty($resObj->error->message)?$resObj->error->message:"";
                return '';
            }
        }

    }

    public function getTitle()
    {
       return "Paddle";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('images/paddle.png').'" alt="Buy now with paddle" />';
    }
    public function AdminSettings($controller,$args){
        $controller->SetTitle("Paddle Settings");
        $params=http_build_query(array(
            'app_name' => get_app_title().'- Paddle Payment Gateway',
            'app_description' => 'Paddle Payment Gateway. Site name: ' .get_app_title(),
            'app_icon' => image_url('images/logo.png', true)
        ));
        $PaddleConnectorUrl="https://vendors.paddle.com/vendor/external/integrate?". $params;
        $PaddleConnectorSandboxUrl="https://sandbox-vendors.paddle.com/vendor/external/integrate?". $params;
        $validation_types=["I"=>"Paddle Server IP Validation","P"=>"Public Key Validation"];
 	   ?>
        <div class="row">
            <div class="col-md-12">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("Paddle Settings");?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group m-b-0">
                                    <label class="control-label col-md-3 label-required" for="is_enable_paypal"><?php _e("Enable Paddle") ; ?></label>
                                    <div class="col-md-9">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable stripe payment");?></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="fld-is-enable fld-is-enable-y">
                                    <hr class="form-group  m-0" />
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-required" for="is_test_mode"><?php _e("Test Mode") ; ?></label>
                                        <div class="col-md-9">
                                            <div class="togglebutton ">
                                                <input  name="is_test_mode" value="N" type="hidden">
                                                <label>
                                                    <input  type="checkbox" <?php echo $this->GetPostValue("is_test_mode","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_test_mode"  name="is_test_mode" >
                                                </label>
                                                <span class="form-group-help-block  "><span class="text-danger text-bold fld-is-test-mode fld-is-test-mode-y"><?php _e("Disable this if you want real payment");?></span><span class="text-yellow text-bold fld-is-test-mode fld-is-test-mode-n"><?php _e("If you enable this, then all payment will be in test mode. Don't do this if you want real payment");?></span></span>

                                            </div>

                                        </div>
                                    </div>
                                    <hr class="form-group  m-0" />
                                    <div class="fld-is-test-mode fld-is-test-mode-n m-t-15">
                                       <div class="row">
                                           <div class="col-md-9">
                                               <div class="form-group ">
                                                   <label class="control-label col-md-4 label-required" for="vendor_id"><?php _e("Vendor ID") ; ?></label>
                                                   <div class="col-md-8">
                                                       <input type="text"   value="<?php echo  $this->GetPostValue("vendor_id")?>" class="form-control" id="vendor_id" name="vendor_id" placeholder="<?php _e("Vendor ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","Vendor id");?>">
                                                   </div>
                                               </div>


                                               <div class="form-group">
                                                   <label class="control-label col-md-4 label-required" for="api_key">Paddle API Key</label>
                                                   <div class="col-md-8">
                                                       <input type="text"  value="<?php echo  $this->GetPostValue("api_key")?>" class="form-control" id="api_key" name="api_key" placeholder="<?php _e("API Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"API Key");?>">
                                                   </div>
                                               </div>
                                               <hr class="form-group  m-0" />

                                               <div class="form-group">
                                                   <label class="control-label col-md-4 label-required" for="api_key">Webhook Validation Type</label>

                                                   <div class="col-md-8">
                                                       <div class="inline radio-inline">
                                                           <?php
                                                           $valid_selected=$this->GetPostValue("wh_valid_method","I");
                                                           GetHTMLRadioByArray("wh_valid_method","wh_valid_method","wh_valid_method",true,$validation_types,$valid_selected,false,true,"has_depend_fld");
                                                           ?>

                                                       </div>
                                                   </div>
                                               </div>

                                               <div class="fld-wh-valid-method fld-wh-valid-method-p">
                                                   <hr class="form-group  m-0" />
                                                   <div class="form-group m-t-15 ">
                                                       <label class="control-label col-md-4 label-required " for="public_key">Public Key</label>
                                                       <div class="col-md-8">
                                                           <textarea name="public_key" id="public_key" class="form-control form-control-sm min-h-300 " data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"Public Key");?>"><?php echo $this->GetPostValue("public_key",""); ?></textarea>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-3">
                                               <p><?php _e("Or connect paddle automatically") ; ?></p>
                                               <button  class="paddle-connector btn btn-success"><?php _e("Click here to connect") ; ?></button>
                                           </div>
                                       </div>

                                    </div>
                                    <div class="fld-is-test-mode fld-is-test-mode-y m-t-15">
                                        <div class="row">
                                           <h4 class="text-center m-b-15 text-yellow"><?php _e("Please enter the information of paddle sandbox account") ; ?></h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group ">
                                                    <label class="control-label col-md-4 label-required" for="vendor_id"><?php _e(" Vendor ID") ; ?></label>
                                                    <div class="col-md-8">
                                                        <input type="text"   value="<?php echo  $this->GetPostValue("sand_vendor_id")?>" class="form-control" id="sand_vendor_id" name="sand_vendor_id" placeholder="<?php _e("Vendor ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message=" <?php  _e("%s is required","Sandbox Vendor id");?>">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-4 label-required" for="api_key"><?php _e("Paddle API Key") ; ?></label>
                                                    <div class="col-md-8">
                                                        <input type="text"  value="<?php echo  $this->GetPostValue("sand_api_key")?>" class="form-control" id="sand_api_key" name="sand_api_key" placeholder="<?php _e("API Key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"Sandbox API Key");?>">
                                                    </div>
                                                </div>
                                                <hr class="form-group  m-0" />
                                                <div class="form-group m-b-0">
                                                    <label class="control-label col-md-4 label-required" for="api_key">Webhook Validation Type</label>
                                                    <div class="col-md-8">
                                                        <div class="inline radio-inline">
                                                            <?php
                                                            $sand_valid_selected=$this->GetSettingsValue("sand_wh_valid_method","I");
                                                            GetHTMLRadioByArray("sand_wh_valid_method","sand_wh_valid_method","sand_wh_valid_method",true,$validation_types,$sand_valid_selected,false,true,"has_depend_fld");
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fld-sand-wh-valid-method fld-sand-wh-valid-method-p">
                                                    <hr class="form-group  m-0" />
                                                    <div class="form-group m-t-15 ">
                                                        <label class="control-label col-md-4 label-required " for="sand_public_key">Public Key</label>
                                                        <div class="col-md-8">
                                                            <textarea name="sand_public_key" id="sand_public_key" class="form-control form-control-sm min-h-300 " data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required" ,"Sandbox Public Key");?>"><?php echo $this->GetPostValue("sand_public_key",""); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p><?php _e("Or connect paddle %s automatically",'<span class="text-yellow text-bold">sandbox</span>') ; ?></p>
                                                <button type="button" class="paddle-sandbox-connector btn btn-success"><?php _e("Click here to connect") ; ?></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        Instruction for Paddle details :
                                        <ol class="p-l-15">
                                            <li>Login into your paddle Panel</li>
                                            <li>Go to Developer Tools. </li>
                                            <li>Then, go to Authentication and create auth code </li>
                                        </ol>
                                        <h4>Or</h4>
                                        <p>Press the connect button to do automatically</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-left">
                        <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery( document ).ready(function( $ ) {
               $(".paddle-connector").on("click",function (e){
                   e.preventDefault();
                   paddle_connector();
               })
                $(".paddle-sandbox-connector").on("click",function (e){
                    e.preventDefault();
                    paddle_sandbox_connector();
                })
            });
            function paddle_connector(){
                window.open("<?php echo $PaddleConnectorUrl; ?>", 'mywindow', 'location=no,status=0,scrollbars=0,width=800,height=600');
                // handle message sent from popup
                window.addEventListener('message', function(e) {
                    var arrData = e.data.split(" ");
                    jQuery('#vendor_id').val(arrData[0]).trigger("input");
                    jQuery('#api_key').val(arrData[1]).trigger("input");
                });
            }
            function paddle_sandbox_connector(){
                window.open("<?php echo $PaddleConnectorSandboxUrl; ?>", 'mywindow', 'location=no,status=0,scrollbars=0,width=800,height=600');
                // handle message sent from popup
                window.addEventListener('message', function(e) {
                    var arrData = e.data.split(" ");
                    jQuery('#sand_vendor_id').val(arrData[0]).trigger("input");
                    jQuery('#sand_api_key').val(arrData[1]).trigger("input");
                });
            }
        </script>
        <?php
    }
}