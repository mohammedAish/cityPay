<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\DepositCustomerOrderRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DepositAgenciesResource;
use App\Http\Resources\DepositMethodResource;
use App\Http\Resources\DepositOrderResource;
use Illuminate\Http\Request;

class DepositApiController extends BaseApiController
{
    use WalletTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function listDepositOrders(Request $request)
    {
        $orderStatus = ($request->filled('status')) ? $request->status : null;
        $listDeposits = $this->getDepositOrders(auth()->id(), $orderStatus, 'deposit');
        $this->base_data['deposit_orders'] = DepositOrderResource::collection($listDeposits);

        return $this->success_response($this->base_data, tt('you_get_deposit_orders'));
    }

    /**
     *  /list_deposit_countries
     * [ارجاع قائمة الدول لعملية طلب ايداع  .]
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function listCountriesOfDepositAgencies(Request $request){
        $countries = $this->getCountriesOfDepositAgencies();
        //if not found

        if (!$countries) {
            return $this->fail_response(config('err_codes.data_not_found'),tt('no countries found'));
        }
        // if result found
        $countries = CountryResource::collection($countries);

        return $this->success_response($countries,tt('you_get_countries'));
    }*/

    /**
     *  /list_deposit_countries
     * [ارجاع البيانات اللازمة لعملية الايداع - منها قائمة الوكالات -تعليمات العملية .]
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     */
    public function initDepositData(Request $request)
    {
        $this->base_data['instructions'] = $this->getServiceInstructions(1);
        $country_id = $this->getUserCountryId();
        $agenciesCountry = $this->getDepositAgenciesByCountry($country_id);
        //if not found
        if (!$agenciesCountry) {
            return $this->fail_response(config('err_codes.data_not_found'), tt('no Agencies found'));
        }
        $this->base_data['agencies_country'] = DepositAgenciesResource::collection($agenciesCountry);

        return $this->success_response($this->base_data, tt('you_get_Agencies'));
    }

    /**
     *  /list_agencies_by_country{country_id}
     * [ارجاع قائمة بقائمة وكالات الايداع لدولة معينة طلب ايداع  .]
     * @bodyParam country_id  number    required  رقم الدولة
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAgenciesByCountryId()
    {
        $country_id = $this->getUserCountryId();
        $agenciesCountry = $this->getDepositAgenciesByCountry($country_id);
        //if not found
        if (!$agenciesCountry) {
            return $this->fail_response(config('err_codes.data_not_found'), tt('no Agencies found'));
        }
        $this->base_data['instructions'] = $this->getServiceInstructions(1);

        $this->base_data['agencies_country'] = DepositAgenciesResource::collection($agenciesCountry);

        return $this->success_response($this->base_data, tt('you_get_Agencies'));
    }

    /**
     *  /list_deposit_type_by_agency/{agency_id}
     * [ارجاع طرق الدفع لوكالة معينةتم اختيارها طلب ايداع  .]
     * @bodyParam agency_id  number    required  رقم وكالةالايداع
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepositTypeByAgencyCountry(Request $request, $agency_id)
    {
        $deposit_types = $this->getDepositTypesFromAgency($agency_id);
        if (!$deposit_types) {
            return $this->fail_response(config('err_codes.data_not_found'),
                tt('no_deposit_types_found'));
        }

        $deposit_types = DepositMethodResource::collection($deposit_types);

        return $this->success_response($deposit_types, tt('you_get_deposit_types'));
    }

    /**
     *  /list_deposit_agencies_by_method/{method_id}
     * لارجاع الوكالات المحلية  التي تتوافق بالطريقة المختارة
     * في نطاق هذة الدولة التي ينتمي لها المستخدم او الوكالات العالمية
     *
     * @bodyParam method_id  number    required  رقم الطريقة
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepositAgencyByDepositMethod(Request $request, $method_id)
    {
        $country_id = $this->getUserCountryId();//YEMEN 247
        $deposit_agencies = $this->getDepositAgencyByMethod($method_id, $country_id, 0);
        if (!$deposit_agencies) {
            return $request->wantsJson() ? response()->json([]) : [];
        }
        $deposit_agencies=DepositAgenciesResource::collection($deposit_agencies);
        return $this->success_response($deposit_agencies, tt('you_get_deposit_agencies'));
    }

    /**
     *  /confirm_deposit_order
     * [اكمال عملية طلب الايداع  .]
     * @bodyParam country_id  number    required  رقم الدولة
     * @bodyParam agency_id  number    required  رقم الوكالة المختارةا
     * @bodyParam deposit_type  number    required  نوع طريقة الايداع
     * @bodyParam deposit_file  number    optional  الملف المرفق
     * @bodyParam deposit_date  date    optional  تاريخ الايداع الذي عمله مسبقا
     * @group Wallet_deposit
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function confirmDepositOrder(DepositCustomerOrderRequest $request)
    {
        $country_code =$this->getUserCountryId();
        $createdOrder = $this->createDepositOrder($request->all(), auth()->id(), $country_code);
        if (!$createdOrder || !$createdOrder->id) {
            return $request->wantsJson() ? response()->json([]) : false;
        }
        $createdOrder = new DepositOrderResource($createdOrder);

        $createdOrder->additional = [
            'country_id' => $request->country_id,
            'deposit_agency_id' => $request->deposit_agency_id,
        ];

        return $this->success_response($createdOrder, tt('you_create_deposit_order_success'));
    }

}
