<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\BaseWebController;
use App\Models\Customer;
use App\Models\CustomersLoyaltyPointsPrice;
use App\Models\CustomerSPOps;
use Illuminate\Http\Request;

abstract class AccountBaseController extends BaseWebController
{
    public $customerSPOps;
    public $consultants;
    public $trainingCourses;
    public $orders;
    public $walletBalance;
    public $courses;
    public $purchase;
    public $cashBack;
    public $liveTradings;
    public $loyalties;
    public $digitalCard;
    public $data;

    /**
     * AccountBaseController constructor.
     */
    public function __construct(){
        parent::__construct();
        auth()->setDefaultDriver('customers');
        $this->middleware(function ($request,$next){
            //do it for check auth only
            /*if (auth('customers')->check()) {
                //$this->leftMenuInfo();
            }*/

            return $next($request);
        });

        view()->share('pagePath','');
    }


    public function leftMenuInfo(){
        // Share User Info
        view()->share('user',auth()->user());
        $this->data['customer_info'] = Customer::whereId(auth()->id())
            ->with('financeAccounts','country')->first();

        // All Services for Customer
        $this->customerSPOps = CustomerSPOps::
        with('servicePackage','servicePackage.services',
            'servicePackage.services.parentService')
            ->where('customer_id',auth()->user()->id)
            ->orderByDesc('id')->get();
        view()->share('countCustomerSPOps',$this->customerSPOps->count());
        $this->data['countCustomerSPOps'] = $this->customerSPOps->count();
        //loyalties
        $this->data['countLoyalties'] = CustomersLoyaltyPointsPrice::
        where('customer_id',auth()->id())
            ->where('score_type',1)
            ->select(\DB::raw('count(count_scores) as count_loyalties'))->first()->count_loyalties;
        view()->share('countLoyalties',$this->data['countLoyalties']);

        //consultants
        $this->consultants              = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.consultants');
        });
        $this->data['countConsultants'] = $this->consultants->count();
        view()->share('countConsultants',$this->consultants->count());

        //trainingCourses;
        $this->trainingCourses = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.training');
        });
        view()->share('countTrainingCourses',$this->trainingCourses->count());
        $this->data['countTrainingCourses'] = $this->trainingCourses->count();

        //DCOrders;
        $this->digitalCard = $this->customerSPOps->filter(function ($service){
            return $service->servicePackage->Service->parentService->id
                == config('ytadawul.parent_services_ids.digital_card');
        });
        view()->share('countDigitalCard',$this->digitalCard->count());
        $this->data['countDigitalCard'] = $this->digitalCard->count();
        view()->share('balanceint',auth()->user()->balance);
        view()->share('balancefloat',Customer::find(auth()->id())->balanceFloat);
        $this->data['balance'] = $this->walletBalance = auth()->user()->balanceFloat.'$';
        view()->share('all_data',$this->data);
    }

}
