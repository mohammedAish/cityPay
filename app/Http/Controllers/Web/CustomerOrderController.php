<?php

namespace App\Http\Controllers\Web;

use App\Events\WalletTransactionEvent;
use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\OrderTrait;
use App\Http\Requests\CustomerOrderRequest;
use App\Models\Consultant;
use App\Models\CourseTraining;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerConsultantOrder;
use App\Models\CustomerCourse;
use App\Models\CustomerDCOrder;
use App\Models\CustomerDCOrderDetail;
use App\Models\DigitalCard;
use Illuminate\Support\Facades\Event;
use Prologue\Alerts\Facades\Alert;


class CustomerOrderController extends BaseWebController
{
    use OrderTrait;

    public function __construct(){
        parent::__construct();
        auth()->setDefaultDriver('customers');
    }

    /**
     * اكمال عملية شراء كورس معين
     *
     * @param  CustomerOrderRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */


    /**
     * عملية طلب استشارة
     *
     * @param  CustomerOrderRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function consultantOrder(CustomerOrderRequest $request){
        $consultantId   = $request->input('consultant_id');
        $consultantInfo = Consultant::findOrFail($consultantId);
        if (!$consultantInfo->active) {
            Alert::error(trans('lang.this_item_not_available'))->flush();

            return redirect()->back()->withInput();
        }
        try {
            $orderCreated = CustomerConsultantOrder::creat(
                [
                    'customer_id'    => auth()->id,
                    'consultant_id'  => $consultantId,
                    'price'          => $consultantInfo->price,
                    'is_open'        => true,
                    'current_status' => 'pending',
                    'currency_id'    => $consultantInfo->currency_id,
                ]
            );
        } catch (\Exception $ex) {
            Alert::error(' لا يمكن قبول الطلب :'.$ex->getMessage())->flush();

            return redirect()->back()->withInput();
        }

        return view('consulting.main_consultations_new')
            ->with('order_detail',$orderCreated)
            ->with('consultantInfo',$consultantInfo);
    }
    //بعدها هو يقوم بعمل اكمال الطلب وذلك بطريقتين
    //اذا كان مغه رصيد في المحفظة يقوم باكمال الطلب
    //اذا ل يكن يقوم بارسال حوالة او ايداع في وهنا سيقوم الادمن بعملية الايداع الى محفظته ويوقم بالاكمال كما في checkoutConsultant

    /**
     *      * اكمال عملية طلب استشارة
     *     //بعدها هو يقوم بعمل اكمال الطلب وذلك بطريقتين
     *     //اذا كان مغه رصيد في المحفظة يقوم باكمال الطلب
     *
     * @param  CustomerOrderRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkoutConsultant(CustomerOrderRequest $request){
        $consultantOrderId   = $request->input('consultant_order_id');
        $orderConsultantInfo = CustomerConsultantOrder::findOrFail($consultantOrderId);
        if ($orderConsultantInfo->customer_id != auth()->id()) {
            Alert::error(trans('lang.this_order_not_for_you'))->flush();

            return redirect()->back()->withInput();
        }
        //check status
        if ($orderConsultantInfo->current_status == 'rejected') {
            Alert::error(trans('lang.your_order_not_in_correct_status').
                ' order status now is:'.$orderConsultantInfo->current_status)->flush();

            return redirect()->back()->withInput();
        }
        if ($orderConsultantInfo->paid_status == 'paid') {
            Alert::error(trans('lang.your_order_not_in_correct_status').
                ' order status now is:'.$orderConsultantInfo->paid_status)->flush();

            return redirect()->back()->withInput();
        }
        //check price ,currency_id
        $orderPrice = $orderConsultantInfo->price;
        if ($orderPrice <= 0) {
            $orderPrice = Consultant::find($orderConsultantInfo->consultant_id)->first()->price;
        }
        if ($orderConsultantInfo->currency_id
            != config('ytadawul.default_currency_id')) {
            $orderPrice = getEqualPriceInDollar($orderConsultantInfo->currency_id,$orderPrice);
        }
        if ($orderPrice > auth()->user()->balanceFloat) {
            Alert::error(trans('lang.no_enough_balance'))->flush();

            return redirect()->back()->withInput();
        }
        //complete the order by withdrow from balance and make the consultant in is succeed
        try {
            \DB::beginTransaction();
            $orderConsultantInfo->paid_status = 'paid';
            $orderConsultantInfo->save();

            //create LoyaltyPoints
            $loyaltyPoints = $this->createLoyaltyPointsForService(
                config('ytadawul.all_services.consultants'),
                'CustomerConsultantOrder',$orderConsultantInfo->id,auth()->id());

            $withdraw_result = Customer::find(auth()->id())->withdrawFloat($orderPrice);

            Event::dispatch(new WalletTransactionEvent(
                $withdraw_result,'CustomerConsultantOrder',$orderConsultantInfo->id));

            \DB::commit();
            $orderConsultantInfo->load('consultant');
            view()->share('consultant_info',$orderConsultantInfo);
            view()->share('withdraw_result',$withdraw_result);
            view()->share('current_balance',auth()->user()->balanceFloat);
            view()->share('loyaltyPoints',$loyaltyPoints);
        } catch (\Exception $ex) {
            \DB::rollBack();
            Alert::error(trans('lang.we_cant_offer_your_order').' reason:'.
                $ex->getMessage())->flush();

            return redirect()->back()->withInput();
        }
    }

    /**
     * اكمال عملية شراء كرت رقمي  - يجب ان لا تزيد كمية أي كرت عن واحد وبالامكان شراء اكثر من كرت رقمي في عملية واحدة
     *
     * @param  CustomerOrderRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderDigitalCard(CustomerOrderRequest $request){
        $digitalCards = $request->input('digital_cards');
        if (!is_array($digitalCards)) {
            $digitalCards = (array) $digitalCards;
        }
        $digitalCardsInfo = DigitalCard::whereIn('id',array_column($digitalCards,'id'))->get();
        $totalPrice       = 0;
        $priceCards       = [];
        foreach ($digitalCardsInfo as $oneCard) {
            $cardPrice                = getPriceFromDiscount($oneCard);
            $totalPrice               += $cardPrice;
            $priceCards[$oneCard->id] = $cardPrice;
        }

        if ($totalPrice > auth()->user()->balanceFloat) {
            Alert::error(trans('lang.no_enough_balance'))->flush();

            return redirect()->back()->withInput();
        }
        try {
            $orderCreated = CustomerDCOrder::create([
                'customer_id'    => auth()->id(),
                'current_status' => 'order_completed',
                'total_amount'   => $totalPrice,
                'customer_hint'  => $request->input('customer_hint'),
            ]);
            $orderDetail  = [];
            foreach ($digitalCardsInfo as $oneCard) {
                $orderDetail[] = CustomerDCOrderDetail::create(
                    [
                        'digital_cards_purchase_id' => $orderCreated->id,
                        'digital_card_id'           => $oneCard->id,
                        'sell_price'                => $priceCards[$oneCard->id],
                    ]

                );
            }
            //create LoyaltyPoints
            $loyaltyPoints = $this->createLoyaltyPointsForService(
                config('ytadawul.all_services.digital_cards'),
                'CustomerDCOrder',$orderCreated->id,auth()->id());

            event(new WalletTransactionEvent(auth()->user()->withdrawFloat($totalPrice),
                'CustomerDCOrder',$orderCreated->id));
            view()->share('orderCreated',$orderCreated);
            view()->share('orderDetail',$orderDetail);
            view()->share('current_balance',auth()->user()->balanceFloat);
            view()->share('loyaltyPoints',$loyaltyPoints);
        } catch (\Exception $ex) {
            \DB::rollBack();
            Alert::error(trans('lang.we_cant_offer_your_order').
                ' reason:'.$ex->getMessage())->flush();

            return redirect()->back()->withInput();
        }
    }


}
