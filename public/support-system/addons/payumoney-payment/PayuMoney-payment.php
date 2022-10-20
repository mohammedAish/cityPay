<?php
/*
Name: PayU Money Payment Gateway
Description: PayU Money is a payment solution for individuals and unregistered businesses in India. It is a payment gateway for websites and applications. It is a convenient way to assure safe digital payments.
Version: 1.0
Author: <a href="https://akshaygorad.com" target="_blank">Akshay Gorad</a> From <a href="https://hariomlabs.com" target="_blank">Hari Om Labs</a>
*/
defined('APPSBD_APP') OR exit('No direct script access allowed');
require_once __DIR__."/AppPayuMoney.php";
add_action("init",function(){
    $payuMoney=new AppPayuMoney();
    AppPaymentBase::RegisterPaymentMethod($payuMoney);
});
