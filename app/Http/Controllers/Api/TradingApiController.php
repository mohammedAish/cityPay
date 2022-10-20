<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\TradingTrait;
use App\Http\Requests\SubscriptionOrderRequest;
use App\Http\Requests\TradingServiceCustomerOrderRequest;
use App\Http\Resources\TradingAgencyResource;
use App\Http\Resources\TradingServiceResource;
use App\Models\Customer;
use App\Models\CustomerLiveBroadcasting;
use App\Models\TradingAgency;
use App\Models\TradingService;
use App\Models\TradingServicesOrder;
use Illuminate\Http\Request;

class TradingApiController extends BaseApiController
{
    use TradingTrait;

    public function listTradingAgencies(){
        $tradingAgencies = TradingAgency::with('services')
            ->where('active',1)->get();
        $tradingAgencies = TradingAgencyResource::collection($tradingAgencies);

        return $this->success_response($tradingAgencies,tt('you_get_trading_agencies'));
    }

    public function listTradingServices(){
        $tradingServices = TradingService::all();
        $tradingServices = TradingServiceResource::collection($tradingServices);

        return $this->success_response($tradingServices,tt('you_get_trading_services'));
    }

    public function listTradingSubscriptions(){
        [$subscriptions_on,$subscriptions_off] = $this->getCustomerSubscriptions(/*auth()->id()*/ 1);
        $this->base_data['subscribed']   = TradingServiceResource::collection($subscriptions_on);
        $this->base_data['unsubscribed'] = TradingServiceResource::collection($subscriptions_off);

        return $this->success_response($this->base_data,tt('you_get_subscriptions_list'));
    }

    public function storeSubscriptionOrder(SubscriptionOrderRequest $request){
        if (is_array($request->trading_service)) {
            foreach ($request->trading_service as $oneId) {
                $created[] = $this->createServiceOrder(auth()->id(),$oneId);
            }
        } else {
            $created[] = $this->createServiceOrder(/*auth()->id()*/ 1,$request->trading_service);
        }

        return $this->listTradingSubscriptions();
    }

    public function storeTradingAgencyAccountOrder(TradingServiceCustomerOrderRequest $request){
        $orderCreated = $this->createTradingServiceAccount(/*auth()->id()*/ 1,$request->all());
        if ($orderCreated) {
            return $this->success_response($orderCreated,tt('you_create_agency_trading_order'));
        }

        return $this->fail_response(config('err_codes.data_not_update'),
            tt('we_cant_create_agency_trading_order'));
    }

    public function listTradingAgencyAccountsOrders(){
        $orders = $this->getTradingAgencyAccountsOrders(/*auth()->id()*/ 1);
        if ($orders->count()) {
            return $this->success_response($orders,tt('you_get_list_agenciesAccountsOrders'));
        }

        return $this->fail_response(config('err_codes.data_not_found'),
            tt('you_dont_have_any_subscription_in_any_agency'));
    }

    public function listTradingServiceOperations(Request $request){ //default the cash service
        $tradingOps = $this->getTradingCustomerOps(/*auth()->id*/ 1,$request->all());
        if ($tradingOps->count()) {
            return $this->success_response($tradingOps,tt('you_get_list_trading_operations'));
        }

        return $this->fail_response(config('err_codes.data_not_found'),
            tt('you_dont_have_any_operation_in_tradings'));
    }

    public function transferTradingPointsLoyalties(Request $request){
        $ids         = $request->operationId;
        $transferred = $this->doTransferPointsLoyalties(/*auth()->id()*/ 1,$ids);
        $tradingOps  = $this->getTradingCustomerOps(/*auth()->id()*/ 1,$request->all());
        if ($transferred) {
            return $this->success_response($tradingOps,tt('you_transferred_your_points'));
        } else {
            return $this->fail_response(config('err_codes.data_not_update'),
                tt('we_cant_transform_your_points'));
        }
    }

    public function listActiveLiveTradings(){
        if (!$isSubscribed = $this->isCustomerSubscribed(/*auth()->id()*/ 1,$service_id = 4)) {
            return $this->fail_response(config('err_codes.un_subscribed'),
                tt('you_are_not_subscribed_in_live_trading_service'));
        }
        $liveTradings = $this->getActiveLiveTrading();
        if ($liveTradings->count() > 0) {
            return $this->success_response($liveTradings,tt('you_get_live_trading_subjects'));
        }

        return $this->fail_response(config('err_codes.data_not_found'),
            tt('no_live_trading_now'));
    }

    public function storeComingLiveTrading(Request $request){
        //todo check if the live_broadcasting_id is active or active now
        $created = CustomerLiveBroadcasting::firstOrCreate(
            [
                'customer_id'          => /*auth()->id()*/ 1,
                'live_broadcasting_id' => $request->live_broadcasting_id,
            ]
        );

        return $this->success_response($created,tt('you_welcome_to_live_trading'));
    }

    public function rateLiveTrading(Request $request){
        //todo check the number of live_broadcasting_id

        $customerBroadCustInfo = CustomerLiveBroadcasting::
        where('customer_id',/*auth()->id()*/ 1)
            ->where('live_broadcasting_id',$request->live_broadcasting_id)->first();

        if ($customerBroadCustInfo) {
            $customerBroadCustInfo->rating = $request->rating;
            $customerBroadCustInfo->save();

            return $this->success_response($customerBroadCustInfo,tt('you_rate_live_trading'));
        } else {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no_live_trading_rated'));
        }
    }

    function listCustomerBroadcasting(Request $request){
        // $list = auth()->user()->broadcasting;
        $list = Customer::find(1)->broadcasting;
        if ($list->count() > 0) {
            return $this->success_response($list,tt('you_get_your_live_broadcasting_subscriptions'));
        } else {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no_subscriptions_for_you'));
        }
    }

    function showLiveTradingInfo($live_trading_id = 1){
        $info = $this->getLiveTradingInfo(/*auth()->id()*/ 1,$live_trading_id);
        if ($info) {
            return $this->success_response($info,tt('you_get_live_trading_info'));
        } else {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no_live_trading_info'));
        }
    }

}
