<?php
/*
Name: PayTM Payment Gateway
Description: PayTM Payment Gateway enables you to accept payments from every possible payment instrument, including DC, CC, Net-banking, UPI and Wallet.
Version: 1.0
Author: <a href="https://akshaygorad.com" target="_blank">Akshay Gorad</a> From <a href="https://hariomlabs.com" target="_blank">Hari Om Labs</a>
*/
defined('APPSBD_APP') OR exit('No direct script access allowed');
require_once __DIR__."/AppPayTM.php";
add_action("init",function(){
    $payuMoney=new AppPayTM();
    AppPaymentBase::RegisterPaymentMethod($payuMoney);
});
