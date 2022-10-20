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
class APPStripe extends AppPaymentBase {
    public $ID="stripe";


 	function onInit()
    {
        if ($this->hasAdminSettingsAccess()) {
            AddOnManager::AddFilter("admin-menu-payment-list", [$this, "AdminMenu"]);
        }
        AddOnManager::AddFilter("payment-method-icon",function($methods){
            $methods['S']=" ap ap-stripe";
            return $methods;
        });
        AddOnManager::AddFilter("payment-method-color",function($methods){
            $methods['S']=" stripe-color text-bold";
            return $methods;
        });
        AddOnManager::AddAction('process-payment-stripe', [$this, "process_payment"], 10, 3);
        AddOnManager::AddAction('action-stripe-response', [$this, "stripe_response"], 10, 2);
        \Stripe\Stripe::setApiKey($this->GetSettingsValue("secret"));
    }
    /**
     * @param AppMenu $menuObj
     */
    public function AdminMenu($menuObj){
        $menuObj->AddSubMenu("AD", "Stripe Setting", "admin/addons/admin-page/stripe", "ap ap-stripe");
        return $menuObj;
    }
    public function get_supported_currency()
    {
        return ['ARS','AUD','BRL','GBP','CAD','CNY','CZK','DKK','EUR','HKD','HUF','INR','ILS','JPY','MXN','TWD','NZD','NOK','PLN','RUB','SGD','ZAR','KRW','SEK','CHF','THB','TRY','UAH','USD'];
    }
    public function is_supported_currency($currency)
    {
        //all currency supported
        return true;
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
        $name="";
        $email="";

        $ticket=Mticket::FindBy("id",$payment_obj->ticket_id);
       // print_r($ticket);
        if(!empty($ticket)){
            $user=Msite_user::FindBy("id",$ticket->ticket_user);
            if(!empty($user->user_type =="U")){
                $name=$user->first_name.' '.$user->last_name;
                $email=$user->email;
            }
        }

        ?>
        <div class="text-center" style="margin-bottom: 150px; ">
            <h3 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not shows payment form automatically") ; ?></h3>
            
       
         <?php  echo form_open ( site_url("site/action/stripe-response/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}"),array("class"=>"","id"=>"stripe-payment","method"=>"post"));?>

            <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $this->GetSettingsValue("publisher_key"); ?>"
                    data-amount="<?php echo (int)($payment_obj->amount*100); ?>"
                    <?php echo !empty($name)?'data-name="'.$name.'"':''; ?>
                    <?php echo !empty($email)?'data-email="'.$email.'"':''; ?>
                    data-description="<?php echo $payment_obj->payment_des; ?>"
                    data-image="<?php echo image_url("images/logo.png"); ?>"
                    data-currency="<?php echo $this->GetSettingsValue("p_currency","usd"); ?>"
            ></script>
        <?php   form_close();
        ?>
        </div>
         <script>
            jQuery( document ).ready(function( $ ) {
                $("#stripe-payment > button[type=submit]").click();
            });
         </script>
        <?php
    }
    public function process_payment_new($payment_id,$payment_obj,$controller){
        $success_url=site_url("site/action/stripe-response/S/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");
        $cancel_url=site_url("site/action/stripe-response/C/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}");

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'unit_amount' => (int)($payment_obj->amount*100),
                    'currency' => $payment_obj->payment_currency,
                    'product_data' => [
                        'name' => "Ticket Payment",
                        'description' => $payment_obj->payment_des,
                        'images' => ['https://example.com/t-shirt.png'],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
        ]);


       ?>
        <script src="https://js.stripe.com/v3/"></script>
        <div class="text-center" style="margin-bottom: 150px; ">
            <h2 class="text-center" style="margin-bottom: 30px; "><?php _e("Click the button bellow, if it is not redirect automatically") ; ?></h2>
            <button id="stripe-payment" class="btn btn-success" ><?php _e("Pay With Card") ; ?></button>
        </div>

        <script>
            jQuery( document ).ready(function( $ ) {
                $("#stripe-payment").on("click",function(){
                    redirectStripe();
                });
               // redirectStripe();
            });
            function redirectStripe(){
                var stripe = Stripe('<?php echo $this->GetSettingsValue("publisher_key") ?>');
                stripe.redirectToCheckout({
                    sessionId: '<?php echo  $session->id; ?>'
                }).then(function (result) {
                    console.log(result.error.message);
                });
            }
        </script>
       <?php
    }
    function stripe_response($controller,$params)
    {
        if(count($params) !=4){
            $controller->DisplayMSGOnly("Invalid request param");
            return;
        }
        $ticket_id=$params[1];
        $reply_id=$params[2];
        $payment_id=$params[3];
        if(isset($_POST['stripeToken'])){
            $payment_obj = Mticket_payment::FindBy("id", $payment_id, ["ticket_id" => $ticket_id, "reply_id" => $reply_id]);
            if (!$payment_obj) {
                $controller->DisplayMSGOnly("Process Failed");
                return;
            }
            try {
                $charge = \Stripe\Charge::create([
                    'description' => $payment_obj->payment_des,
                    'amount' => (int)($payment_obj->amount * 100),
                    'currency' => strtolower($payment_obj->payment_currency),
                    'source' => $_POST['stripeToken']
                ]);
                $customer_name = $charge->source->name;
                $ticket=Mticket::FindBy("id",$payment_obj->ticket_id);
                // print_r($ticket);
                if(!empty($ticket)){
                    $user=Msite_user::FindBy("id",$ticket->ticket_user);
                    if(!empty($user->user_type =="U")){
                        $customer_name=$user->first_name.' '.$user->last_name;
                        $email=$user->email;
                    }
                }
                $card_or_payment_email = "****-****-****-".$charge->source->last4;
                $total_amount = sprintf("%.2f",($charge->amount_captured/100));
                $transaction_id = $charge->id;
                $transaction_time = date('Y-m-d H:i:s',$charge->created);;
                $approval_code =$charge->balance_transaction;
                $resull_msg = $charge->captured==1?"captured":"";
                $country = $charge->source->country;

                if (Mticket_payment::CompletePayment($payment_obj,$customer_name,$card_or_payment_email,$total_amount,$transaction_id,$transaction_time,$approval_code,$resull_msg,$country,"S")) {
                    $controller->DisplayMSGOnly("Payment success", site_url("ticket/details/{$payment_obj->ticket_id}"), 10, true);
                    return;
                } else {
                    Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$payment_obj->ticket_id}-{$payment_obj->reply_id}-{$payment_obj->id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR, current_url());
                    $controller->DisplayMSGOnly("Payment failed. Please try again later");
                    return;
                }
            }catch (Exception $ex){
                $controller->DisplayMSGOnly("Payment failed. Please try again later");
                return;
            }
        }else{
            $controller->DisplayMSGOnly("Invalid request");
            return;
        }
    }


    public function getTitle()
    {
       return "Stripe";
    }
    public function getButtonImageHTML()
    {
        return '<img class="img-fluid" src="'.image_url('images/logo-stripe.png').'" alt="Buy now with Stripe" />';
    }
    public function AdminSettings($controller,$args){
        $controller->SetTitle("Stripe Settings");
 	   ?>
        <div class="row">
            <div class="col-md-12">
                <?php  echo form_open ( $this->getUpdateUrl(),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post", "data-on-complete"=>"ajax_default_complete"));?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php _e("Stripe Settings");?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group m-b-0">
                                    <label class="control-label col-md-2 label-required" for="is_enable_paypal"><?php _e("Enable Stripe") ; ?></label>
                                    <div class="col-md-10">
                                        <div class="togglebutton ">
                                            <input  name="is_enable" value="N" type="hidden">
                                            <label>
                                                <input  type="checkbox" <?php echo $this->GetPostValue("is_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable"  name="is_enable" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("Enable this to enable stripe payment");?></span>
                                        </div>

                                    </div>
                                </div>
                                <hr class="form-group fld-is-enable fld-is-enable-y m-0" />
                                <div class="form-group fld-is-enable fld-is-enable-y">
                                    <label class="control-label col-md-2 label-required" for="is_test_mode"><?php _e("Test Mode") ; ?></label>
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

                                <div class="form-group fld-is-enable fld-is-enable-y">
                                    <label class="control-label col-md-2 label-required" for="client_id"><?php _e("Publishable key") ; ?></label>
                                    <div class="col-md-10">
                                        <input type="text"   value="<?php echo  $this->GetPostValue("publisher_key")?>" class="form-control" id="publisher_key" name="publisher_key" placeholder="<?php _e("Publishable key"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Publishable key <?php  _e(" is required");?>">
                                    </div>
                                </div>


                                <div class="form-group fld-is-enable fld-is-enable-y">
                                    <label class="control-label col-md-2 label-required" for="secret">Secret</label>
                                    <div class="col-md-10">
                                        <input type="text"   value="<?php echo  $this->GetPostValue("secret")?>" class="form-control" id="secret" name="secret" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        Instruction for Stripe details :
                                        <ol class="p-l-15">
                                            <li>Go to Dashboard</li>
                                            <li>Then go to  developers </li>
                                            <li>Then go to API Keys </li>
                                            <li>You will get your information </li>
                                        </ol>
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
        <?php
    }
}