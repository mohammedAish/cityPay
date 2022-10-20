<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomerInfoResource;
use App\Models\Customer;
use App\Models\CustomerFinanceAccount;
use App\Models\CustomersLoyaltyPointsPrice;
use App\Models\CustomerSPOps;
use App\Models\DepositOrder;
use App\Models\TransferWithdrawOrder;
use Dingo\Api\Http\Request;

class AccountApiController extends BaseApiController
{
    protected $customerSPOps;
    protected $consultants;
    protected $trainingCourses;
    protected $digitalCard;

    /**
     *  /consultants
     * [ارجاع اول شاشة للداشبورد فيها اجماليات عن عدد الخدمات - الكورسات - الاستشارات -..  الخاصة بالعميل .]
     * @group Account
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboardApp(){
        // Share User Info
        // $this->base_data['customer_info'] = auth()->user();
        // All Services for Customer
        $this->customerSPOps                   = CustomerSPOps::
        with('servicePackage','servicePackage.services',
            'servicePackage.services.parentService')
            ->where('customer_id',auth()->user()->id)
            ->orderByDesc('id')->get();
        $this->base_data['countCustomerSPOps'] = $this->customerSPOps->count();
        //loyalties
        $this->base_data['countLoyalties'] = CustomersLoyaltyPointsPrice::
        where('customer_id',auth()->id())
            ->where('score_type',1)
            ->select(\DB::raw('count(count_scores) as count_loyalties'))->first()->count_loyalties;

        //consultants
        $this->consultants                   = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.consultants');
        });
        $this->base_data['countConsultants'] = $this->consultants->count();

        //trainingCourses;
        $this->trainingCourses                   = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.training');
        });
        $this->base_data['countTrainingCourses'] = $this->trainingCourses->count();

        //DCOrders;
        $this->digitalCard                   = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.digital_card');
        });
        $this->base_data['countDigitalCard'] = $this->digitalCard->count();
        //Customer::find(auth()->id())->transfer()
        $this->base_data['balance'] = $this->walletBalance = auth()->user()->balanceFloat.'$';

        return $this->success_response($this->base_data,'you get all data success',false);
    }

    public function walletDashboard(){
        $wallet_balance = Customer::find(auth()->id())->balanceFloat;
        $last_deposit   = DepositOrder::
        where('current_status','accepted')->
        latest()->first();

        if ($last_deposit) {
            $last_deposit['amount']      = $last_deposit->amount;
            $last_deposit['currency_id'] = $last_deposit->currency_id;
        }
        $last_transfer = TransferWithdrawOrder::where('current_status','accepted')->
        latest()->first();
        if ($last_transfer) {
            $last_transfer['amount']      = $last_transfer->amount;
            $last_transfer['currency_id'] = $last_transfer->currency_id;
        }
        $this->base_data['wallet_balance'] = $wallet_balance;
        $this->base_data['last_deposit']   = $last_deposit;
        $this->base_data['last_transfer']  = $last_transfer;

        return $this->success_response($this->base_data,"you get wallet info ");
    }

    /**
     *  /get_profile_info
     * ارجاع معلومات العميل .]
     * @group Account
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfileInfo(){
        $custInfo = $this->getCurrentAuthCustomer();

        return $this->success_response($custInfo,"you get info ");
    }

    public function getCurrentAuthCustomer(){
        $customerIfo = Customer::find(auth()->id());
        $customerIfo = new CustomerInfoResource($customerIfo);

        return $customerIfo;
    }

    /**
     *  /update_info
     * تعديل معلومات العميل .]
     * @bodyParam first_name  string    required
     * @bodyParam last_name  string    required
     * @bodyParam phone  string    optional
     * @bodyParam whatsapp_acc  string    optional
     * @bodyParam facebook_acc  string    optional
     * @bodyParam country_code  number    required
     * @bodyParam birth_date  date    optional
     * @bodyParam gender  string    optional [F|M]
     * @bodyParam address  string    optional
     * @group Account
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateInfo(Request $request){
        try {
            $input = $request->only([
                'first_name','last_name','phone','whatsapp_acc',
                'facebook_acc','country_code','gender','birth_date','address',
            ]);
            Customer::where('id',auth()->id())->update($input);
            $this->base_data = $this->getCurrentAuthCustomer();
        } catch (\Exception $e) {
            return $this->fail_response(config('err_codes.data_not_update'),
                tt('we_cant_update_data').$e->getMessage());
        }

        return $this->success_response($this->base_data,tt('you_update_your_profile_success'));
    }

    public function updateAccountNumbers(){
        //@todo complete accounts for customer

    }

    public function addNewAgencyAccount(\Illuminate\Http\Request $request){
        $input      = $request->except('_token','_method');
        $createdAcc = CustomerFinanceAccount::create(
            [
                'customer_id'                => auth()->id(),
                'agency_name'                => $input['agency_name'],
                'customer_agency_acc_number' => $input['account_number'],
            ]
        );

        return $this->success_response($createdAcc,'success adding new account ');
    }

    public function updatePassword(Request $request){


    }


}
