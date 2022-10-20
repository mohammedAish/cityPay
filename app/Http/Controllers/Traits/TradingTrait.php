<?php


namespace App\Http\Controllers\Traits;


use App\Events\WalletTransactionEvent;
use App\Models\Customer;
use App\Models\CustomerLiveBroadcasting;
use App\Models\LiveBroadcasting;
use App\Models\TradingCustomerPoint;
use App\Models\TradingService;
use App\Models\TradingServiceCustomer;
use App\Models\TradingServicesOrder;

trait TradingTrait
{
    static function getCustomerSubscriptions($customer_id){
        $subscriptions    = TradingService::
        join('trading_services_orders',
            'trading_services.id','=','trading_services_orders.trading_service_id',"left")
            ->join('customers','trading_services_orders.customer_id','=','customers.id')
            ->select('trading_services.*')
            ->get();
        $ids              = $subscriptions->pluck('id');
        $nunSubscriptions = TradingService::whereNotin('id',$ids)
            ->where('active',1)->get();

        return [$subscriptions,$nunSubscriptions];
    }

    static function createServiceOrder($customer_id,$service_id){
        $founded = TradingServicesOrder::where('customer_id',$customer_id)
            ->where('trading_service_id',$service_id)->first();
        if ($founded) {
            return null;
        }
        $created = TradingServicesOrder::create(
            [
                'customer_id'        => $customer_id,
                'trading_service_id' => $service_id,
                'order_status'       => 'pending',
            ]

        );

        return $created;
    }

    static function createTradingServiceAccount($customer_id,$posted_data){
        $data    = [
            'customer_id'            => $customer_id,
            'trading_agency_id'      => $posted_data['trading_agency_id'],
            'customer_agency_number' => $posted_data['customer_agency_number'],
            'customer_agency_email'  => $posted_data['customer_agency_email'],
            'subscription_status'    => 'pending',
        ];
        $created = TradingServiceCustomer::firstOrCreate($data);

        //todo complete send email to agency email to do accepting
        /* event(new tradingOrderCreated($posted_data['trading_agency_id'],
             'd_card_parches_order',$customer_id));*/

        return $created;
    }

    static function getTradingAgencyAccountsOrders($customer_id){
        return TradingServiceCustomer::where('customer_id',$customer_id)->get();
    }

    static function getTradingCustomerOps($customer_id,$request_params){
        //todo add when request send limit
        //todo add when request send agency_id
        $listOps = TradingCustomerPoint::
        with(['tradingService','tradingAgency'])
            ->where('customer_id',$customer_id)->get();

        return $listOps;
    }

    static function doTransferPointsLoyalties($customer_id,$ids){
        $ids           = is_array($ids)? $ids :(array) $ids;
        $opsInfo       = TradingCustomerPoint::whereIn('id',$ids)
            ->where('customer_id',$customer_id)
            ->where('transferred',0)
            ->get();
        $ids_to_update = [];
        $total_dollars = 0;
        foreach ($opsInfo as $oneOp) {
            if ($oneOp->loyalty_points > 0 || $oneOp->dollar_equal > 0) {
                array_push($ids_to_update,$oneOp->id);
                $total_dollars += $oneOp->dollar_equal;
            }
        }
        try {
            \DB::beginTransaction();
            $TRX = Customer::find($customer_id)->depositFloat($total_dollars);
            event(new WalletTransactionEvent($TRX,'loyalty_point_transform',$ids[0]));
            $transferred = TradingCustomerPoint::whereIn('id',$ids_to_update)->update(
                ['transferred' => 1,'transferred_date' => now(),'win_lose' => 'win']);
            \DB::commit();

            return $transferred;
        } catch (\Throwable $ex) {
            try {
                \DB::rollBack();

                return false;
            } catch (\Throwable $exx) {
            }
        }
    }

    static function isCustomerSubscribed($customer_id,$service_id){
        $founded = TradingServicesOrder::where('customer_id',$customer_id)
            ->where('trading_service_id',$service_id)->first();

        return $founded ?? false;
    }

    static function getActiveLiveTrading(){
        $listActiveTradingLive = LiveBroadcasting::where('active_now',1)
            ->get();

        return $listActiveTradingLive;
    }

    static function getLiveTradingInfo($id,$customer_id){
        $liveTradingInfo =
            LiveBroadcasting::
            with([
                'liveBroadcastingCustomer'=>function ($query) use ($customer_id){
                    return $query->where('customer_id',$customer_id);
                },
            ])->where('id',$id)->first();

        return $liveTradingInfo ?? false;
    }

    static function getCustomerBroadcasting($customer_id,$request_params){
        $list = CustomerLiveBroadcasting::where('customer_id',$customer_id)
            ->get();

        return $list;
    }
}
