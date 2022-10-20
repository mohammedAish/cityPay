<?php

namespace App\Http\Controllers\Api;

use App\Events\WalletTransactionEvent;
use App\Http\Controllers\Traits\OrderTrait;
use App\Http\Requests\CustomerOrderRequest;
use App\Http\Resources\ConsultantOrderResource;
use App\Http\Resources\ConsultantResource;
use App\Http\Resources\CourseTrainingResource;
use App\Models\Consultant;
use App\Models\CourseTraining;
use App\Models\Customer;
use App\Models\CustomerConsultantOrder;
use App\Models\CustomerCourse;
use App\Models\CustomerDCOrder;
use App\Models\CustomerDCOrderDetail;
use App\Models\DigitalCard;
use Illuminate\Support\Facades\Event;

class CustomerOrderApiController extends BaseApiController
{
    use OrderTrait;

    /**
     * order_consultant
     * عملية شراء كورس
     * @bodyParam course_id  number    required  رقم الكورس
     * @group orders
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function courseOrder(CustomerOrderRequest $request){
        $courseId   = $request->input('course_id');
        $courseInfo = CourseTraining::find($courseId);
        if (!$courseInfo || !$courseInfo->active) {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('this course not found or not active'));
        }
        $founded_before = CustomerCourse::where('customer_id',auth()->id())
            ->where('course_id',$courseId)->first();
        if ($founded_before) {
            return $this->fail_response(config('err_codes.you_bought_before'),trans(
                'lang.you_bought_before'));
        }
        //get real price
        $coursePrice = getPriceFromDiscount($courseInfo);
        //check balance
        // $blnc = auth()->user()->deposit(1000000);
        if ($coursePrice > auth()->user()->balanceFloat) {
            return $this->fail_response(config('err_codes.no_enough_balance'),trans(
                'lang.no_enough_balance'));
        }
        try {
            \DB::beginTransaction();
            $dataInsert     = [
                'course_id'     => $courseInfo->id,
                'customer_id'   => auth()->id(),
                'joined_date'   => now()->toDateTimeString(),
                'customer_note' => $request->input('note'),
            ];
            $courseInserted = CustomerCourse::create($dataInsert);

            //create LoyaltyPoints
            $loyaltyPoints                    = $this->createLoyaltyPointsForService(
                config('ytadawul.all_services.training'),
                'CourseTraining',$courseInserted->id,auth()->id());
            $this->base_data['loyaltyPoints'] = $loyaltyPoints;
            $withdraw_result                  = auth()->user()->withdraw($coursePrice);


            Event::dispatch(new WalletTransactionEvent(
                $withdraw_result,'course_order',$courseInserted->id));

            $this->base_data['withdraw_result'] = $withdraw_result->amount;
            $this->base_data['current_balance'] = auth()->user()->balanceFloat;
            \DB::commit();
            $courseInserted->load('course');
            //$courseInfo->load('courseSubjects');
            $courseResource                = new CourseTrainingResource($courseInfo);
            $courseResource->additional    = ['is_one' => true];
            $this->base_data['courseInfo'] = $courseResource;

            return $this->success_response($this->base_data,tt('you_complete_order_success'));
        } catch (\Exception $ex) {
            return $this->fail_response(config('err_codes.data_not_update').$ex->getMessage()
                ,trans('lang.we_cant_offer_your_order'));
        }
    }

    /**
     * order_consultant
     * عملية طلب استشارة
     * @bodyParam consultant_id  number    required  رقم الاستشارة
     * @group orders
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function consultantOrder(CustomerOrderRequest $request){
        $consultantId   = $request->input('consultant_id');
        $consultantInfo = Consultant::find($consultantId);
        if (!$consultantInfo || !$consultantInfo->active) {
            return $this->fail_response(config('err_codes.data_not_found')
                ,trans('lang.this_item_not_available'));
        }
        /*  $founded_before = CustomerConsultantOrder::where('customer_id',auth()->id())
              ->where('consultant_id',$consultantId)->first();
          if ($founded_before) {
              return $this->fail_response(config('err_codes.you_bought_before'),trans(
                  'lang.you_bought_before'));
          }*/
        try {
            $order_created = CustomerConsultantOrder::create(
                [
                    'customer_id'    => auth()->id(),
                    'consultant_id'  => $consultantId,
                    'price'          => $consultantInfo->price,
                    'is_open'        => true,
                    'current_status' => 'pending',
                    'currency_id'    => $consultantInfo->currency_id,
                ]
            );
        } catch (\Exception $ex) {
            return $this->fail_response(config('err_codes.Exception_error')
                ,trans('lang.we_cant_accept_your_order').$ex->getMessage());
        }
        $this->base_data['consultantInfo'] = new ConsultantResource($consultantInfo);
        $this->base_data['order_created']  = new ConsultantOrderResource($order_created);

        return $this->success_response($this->base_data,tt('your_order_created_success'));
    }

    /**
     * checkout_consultant
     *
     * [ اكمال عملية طلب استشارة .]
     *     [بعدها هو يقوم بعمل اكمال الطلب وذلك بطريقتين
     *    [اذا كان مغه رصيد في المحفظة يقوم باكمال الطلب
     * @bodyParam consultant_order_id  number    required  رقم الطلب
     * @group orders
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function checkoutConsultant(CustomerOrderRequest $request){
        $consultantOrderId   = $request->input('consultant_order_id');
        $orderConsultantInfo = CustomerConsultantOrder::find($consultantOrderId);
        if (!$orderConsultantInfo || $orderConsultantInfo->customer_id != auth()->id()) {
            return $this->fail_response(config('err_codes.data_not_found')
                ,trans('lang.this_order_not_for_you'));
        }
        //check status
        if ($orderConsultantInfo->current_status == 'rejected') {
            return $this->fail_response(config('err_codes.current_status_error')
                ,trans('order status now is:').$orderConsultantInfo->current_status);
        }
        if ($orderConsultantInfo->paid_status == 'paid') {
            return $this->fail_response(config('err_codes.current_status_error')
                ,trans('your_order_not_in_correct_status :').$orderConsultantInfo->paid_status);
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
        //  auth()->user()->deposit(10000);
        if ($orderPrice > auth()->user()->balanceFloat) {
            return $this->fail_response(config('err_codes.no_enough_balance')
                ,trans('lang.no_enough_balance').
                'your balance:'.auth()->user()->balanceFloat.',required'.$orderPrice);
        }
        //complete the order by withdrow from balance and make the consultant in is succeed
        try {
            \DB::beginTransaction();
            $orderConsultantInfo->paid_status = 'paid';
            $orderConsultantInfo->save();

            //create LoyaltyPoints
            $loyaltyPoints = $this->createLoyaltyPointsForService(
                config(config('ytadawul.all_services.consultants')),
                'CustomerConsultantOrder',$orderConsultantInfo->id,auth()->id());

            $withdraw_result = Customer::find(auth()->id())->withdraw($orderPrice);

            //register withdraw reference
            Event::dispatch(new WalletTransactionEvent(
                $withdraw_result,'CustomerConsultantOrder',$orderConsultantInfo->id));
            \DB::commit();
            $orderConsultantInfo->load('consultant');
            $this->base_data['withdraw_result'] = $withdraw_result->amount;
            $this->base_data['current_balance'] = auth()->user()->balanceFloat;
            $this->base_data['loyaltyPoints']   = $loyaltyPoints;
            $this->base_data['consultantInfo']  = new ConsultantResource($orderConsultantInfo->consultant);
            $this->base_data['order_created']   = new ConsultantOrderResource($orderConsultantInfo);

            return $this->success_response($this->base_data,tt('your_order_created_success'));
        } catch (\Exception $ex) {
            \DB::rollBack();

            return $this->fail_response(config('err_codes.order_so_not_completed_ex_error')
                ,trans('lang.we_cant_offer_your_order').$ex->getMessage());
        }
    }


    /**
     *  /order_digital_card
     * [     * اكمال عملية شراء كرت رقمي  - يجب ان لا تزيد كمية أي كرت عن واحد وبالامكان شراء اكثر من كرت رقمي في عملية واحدة.]
     * @bodyParam  deposit_date[id]    required  مصفوفة بداخلها ارقام الكروت المطلوبة
     * @group orders
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function orderDigitalCard(CustomerOrderRequest $request){
        $digitalCards = $request->input('digital_cards');
        if (!is_array($digitalCards)) {
            $digitalCards = (array) $digitalCards;
        }
        $digitalCardsInfo = DigitalCard::whereIn('id',array_column($digitalCards,'id'))->get();
        if (!$digitalCardsInfo->count()) {
            return $this->fail_response(config('err_codes.data_not_found')
                ,trans('lang.no_digital_cards_found'));
        }
        $totalPrice = 0;
        $priceCards = [];
        foreach ($digitalCardsInfo as $oneCard) {
            $cardPrice                = getPriceFromDiscount($oneCard);
            $totalPrice               += $cardPrice;
            $priceCards[$oneCard->id] = $cardPrice;
        }

        if ($totalPrice > auth()->user()->balanceFloat) {
            return $this->fail_response(config('err_codes.no_enough_balance')
                ,trans('lang.no_enough_balance'));
        }

        try {
            \DB::beginTransaction();
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
            $loyaltyPoints   = $this->createLoyaltyPointsForService(
                ('ytadawul.all_services.digital_cards'),
                'CustomerDCOrder',$orderCreated->id,auth()->id());
            $withdraw_result = auth()->user()->withdrawFloat($totalPrice);

            Event::dispatch(new WalletTransactionEvent(
                $withdraw_result,'CustomerDCOrder',$orderCreated->id));
            \DB::commit();
            $this->base_data['orderCreated']    = $orderCreated;
            $this->base_data['orderDetail']     = $orderDetail;
            $this->base_data['current_balance'] = auth()->user()->balanceFloat;
            $this->base_data['loyaltyPoints']   = $loyaltyPoints;
        } catch (\Exception $ex) {
            \DB::rollBack();

            return $this->fail_response(config('err_codes.no_enough_balance')
                ,trans('lang.we_cant_offer_your_order').' reason:'.$ex->getMessage());
        }
    }


}
