<?php
/*
Name: Razorpay Payment Gateway
Description: Razorpay is the payment gateway of India,Accept payments from customers. Automate payouts to vendors & employees. Never run out of working capital.
Version: 1.0
Author: <a href="https://appsbd.com" target="_blank">APPSBD</a>
*/
defined('APPSBD_APP') OR exit('No direct script access allowed');
require_once __DIR__."/AppRazorPay.php";
add_action("init",function(){
    $razorPay=new AppRazorPay();
    AppPaymentBase::RegisterPaymentMethod($razorPay);
});
