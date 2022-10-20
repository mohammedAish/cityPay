<?php
/*
Name: Instamojo Payment Gateway
Description: Instamojo is a simplified payment solution which allows businesses to collect payments via credit cards, debit cards and net banking.
Version: 1.0
Author: <a href="https://akshaygorad.com" target="_blank">Akshay Gorad</a> From <a href="https://hariomlabs.com" target="_blank">Hari Om Labs</a>
*/
defined('APPSBD_APP') OR exit('No direct script access allowed');
require_once __DIR__."/AppInstamojo.php";
add_action("init",function(){
    $instamojo=new AppInstamojo();
    AppPaymentBase::RegisterPaymentMethod($instamojo);
});
