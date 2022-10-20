<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\CustomerFinanceAccountRequest;
use App\Http\Requests\CustomerFinanceAccountRequest2;
use App\Http\Resources\DepositOrderResource;
use App\Models\DepositOrder;
use App\Models\PayingOrder;
use App\Models\TransferWithdrawOrder;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends BaseWebController
{
    use WalletTrait, CommonTrait;

    public function payeerSuccessCallback(Request $request)
    {
        try {
            $orderId = $request->get('m_orderid', '');
            $depositOrder = DepositOrder::query()->where('id', $orderId)->first();
            if (!$depositOrder) {
                throw new \Exception(cp('order_not_found'));
            }

            if ($depositOrder->current_status == 'confirmed') {
                throw new \Exception(cp('order_already_confirmed'));
            }

            $depositOrder->update(['current_status' => 'confirmed']);

            $message = cp('order_confirmed_successfully');
            $alertClass = 'alert-success';
        } catch (\Exception $exception) {
            $alertClass = 'alert-danger';
            $message = $exception->getMessage();
        }

        session()->flash('payeer-alert-message', $message);
        session()->flash('payeer-alert-class', $alertClass);

        return Redirect::to(route('list_deposit_withdraws') . '#deposit_requests_tab');
    }

    public function payeerFailCallback(Request $request)
    {
        session()->flash('payeer-alert-message', cp('order_confirmed_failed'));
        session()->flash('payeer-alert-class', 'alert-danger');

        return Redirect::to(route('list_deposit_withdraws') . '#deposit_requests_tab');
    }

    public function payeerStatus(Request $request)
    {
        session()->flash('payeer-alert-message', 'Status checked success');
        session()->flash('payeer-alert-class', 'alert-success');

        return Redirect::to(route('list_deposit_withdraws') . '#deposit_requests_tab');
    }
    
    public function perfectmoneySuccessCallback(Request $request)
    {
        $message = cp('order_confirmed_successfully');
        $alertClass = 'alert-success';
        session()->flash('payeer-alert-message', $message);
        session()->flash('payeer-alert-class', $alertClass);

        return Redirect::to(route('list_deposit_withdraws') . '#deposit_requests_tab');
    }
    
    public function perfectmoneyFailCallback(Request $request)
    {
        session()->flash('payeer-alert-message', cp('order_confirmed_failed'));
        session()->flash('payeer-alert-class', 'alert-danger');

        return Redirect::to(route('list_deposit_withdraws') . '#deposit_requests_tab');
    }
}
