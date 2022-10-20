<?php

namespace App\Http\Controllers\Web\Trading;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\TradingTrait;


class TradingController extends BaseWebController
{
    use TradingTrait;
    public function listTradingAgencies(){
    }

    public function listTradingServices(){
    }

    public function listTradingSubscriptions(){
        //show from trading_services_orders
    }

    public function storeSubscriptionOrder(){
        //save the  order for the services that customer want to subscribe in
        //save it in trading_services_orders

    }

    public function storeTradingAgencyAccountOrder(){
        //store agency account for customer for a trading agency
        // in  trading_services_customers
    }
    public function listTradingServiceOrders(){
        //list my order from trading_services_customers
    }
    public function showTradingServiceOperations(){
        //show the operations that the admin fill it due to trading
        //shw from trading_customers_points
    }

    public function transferTradingPointsLoyalties(){
      //do the transformed effect in the   trading_customers_points table
        // and do effect in the
    }






}
