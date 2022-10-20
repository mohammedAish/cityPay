<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\PayingOrderClintRequest;
use App\Http\Resources\PayingOrderResource;
use App\Models\PayingOrder;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class PayingOrderApiController extends BaseApiController
{
    use WalletTrait;

    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function initPayingOrderForm() {
        $this->base_data['instructions'] = $this->getServiceInstructions(4);

        return $this->success_response($this->base_data, 'you_get_data');
    }

    public function confirmPayingOrder(PayingOrderClintRequest $request) {
        $orderCreated = $this->createPayingOrder(auth()->id(), $request->all());

        return $this->success_response($orderCreated, tt('your_order_created_success'));
    }

    public function confirmAndWithdraw(PayingOrderClintRequest $request) {
        $orderCreated = $this->confirmPaynigOrderWithdraw(auth()->id(), $request->paying_order_id);

        return $this->success_response($orderCreated, tt('your_order_created_success'));
    }

    public function listPayingOrders() {
        $orders = PayingOrder::where('customer_id', auth()->id())
            ->orderByDesc('created_at')->get();
        $orders = PayingOrderResource::collection($orders)
            ->toArray($this->request ?? Container::getInstance()->make('request'));

        return $this->success_response($orders, tt('your_get_all_paying_orders'));
    }
}
