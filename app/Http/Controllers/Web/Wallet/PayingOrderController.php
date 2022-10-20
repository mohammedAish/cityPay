<?php

namespace App\Http\Controllers\Web\Wallet;

use App\Http\Controllers\BaseWebController;
use App\Http\Requests\PayingOrderClintRequest;
use App\Models\PayingOrder;
use App\Notifications\OrderNotification;
use App\Notifications\PayingOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PayingOrderController extends BaseWebController
{
    public function __construct()
    {
        parent::__construct($service_id = 4);
    }

    public function initPayingOrderForm()
    {
        $paying_order_comms = Config::get('settings.paying_orders_comms');

        return view('wallet.pay_invoices2')
            ->with('active_menu', 'pay_purchase_bills')
            ->with('paying_orders_comms', $paying_order_comms);
    }

    public function confirmPayingOrder(PayingOrderClintRequest $request)
    {
        $orderCreated = $this->createPayingOrder(auth()->id(), $request->all());

        $orderCreated->customer->notify(new PayingOrderNotification());
        
        return response()->json(['status' => true, 'data' => $orderCreated, 'message' => "done"]);
    }

    public function confirmAndWithdraw(PayingOrderClintRequest $request)
    {
        $orderInfo = PayingOrder::findOrFail($request->paying_order_id);
        if ($orderInfo->final_price > auth()->user()->balanceFloat) {
//            throw new \Exception('لا يوجد رصيد كافي لسحب هذا المبلغ');
            return response()->json(['status' => false, 'message' => "لا يوجد رصيد كافي لسحب هذا المبلغ"]);
        }
        $orderCreated = $this->confirmPaynigOrderWithdraw(auth()->id(), $orderInfo);
        return response()->json(['status' => true, 'data' => $orderCreated, 'message' => "the withdrawal created"]);
    }

    public function listPayingOrders()
    {
        $orders = PayingOrder::where('customer_id', auth()->id())
            ->orderByDesc('created_at')->paginate(3);

        return view('wallet.history')
            ->with('type', "invoices")
            ->with('data', $orders);
    }

}
