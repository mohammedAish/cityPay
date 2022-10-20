<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CommonTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;

class BaseApiController extends Controller
{
    use CommonTrait;
    public $request;
    public $base_data;
    public $limit;
    public $last_id;

    public $disk; //now used to delete some images but in future we will add some func

    public function __construct(Request $request){
        $this->request = $request;
        app('laravellocalization')->setLocale();
        $this->last_id = $request->has('last_id')? $request->input('last_id') :0;
        $this->limit   = $request->has('limit')? $request->input('limit') :30;
    }

    public function success_response($data,$message,$unsetTimes = true){
        if (!is_array($data) && !is_object($data)) {
            $data = [$data];
        }
        if ($unsetTimes) {
            if (is_array($data)) {
                unset($data['created_at'],$data['updated_at']);
            }
            if (is_object($data)) {
                unset($data->created_at,$data->updated_at);
            }
        }

        return response()->json(['status' => 'true','data' => $data,'message' => $message]
            ,200,['Content-Type' => 'application/json;charset=UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
    }

    public function fail_response($message_code,$message = null){
        return response()->json(['status' => 'false','code_error' => $message_code,'message' => $message],200,
            ['Content-Type' => 'application/json;charset=UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
    }

    public function exception_response($message_code,$message = null){
        return response()->json([
            'status'  => 'false','code_error' => config('err_codes.Exception_error').'-'.$message_code,
            'message' => 'exception message '.$message,
        ],200,
            ['Content-Type' => 'application/json;charset=UTF-8','Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);
    }

    /**
     * showErrorCodes
     * [ترجع قائمة بارقام الخطأ الممكن حدوثها وبالتالي اذا كان هناك رد فيه رقم خطأ فهذة الدالة تقول له ما نوع الخطأ  ]
     * @return JsonResponse
     */
    public function error_codes(){
        return self::success_response(config('err_codes'),'errorCodes return success');
    }

    /**
     * orders_status
     * [ترجع قائمة بحالات الطلب من بدايته الى نهايته مع رمز كل حالة
     * @return JsonResponse
     */
    public function orderStatues(){
        return self::success_response(config('ytadawul.order_status'),'orders_status return success');
    }

    public function dashBoardApi(){
        // Share User Info
        view()->share('user',auth()->user());
        $this->base_data['customer_info'] = auth()->user();

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

        auth()->user()->depositFloat(10);

        //Customer::find(auth()->id())->depositFloat(10.3349);
        view()->share('balanceint',auth()->user()->balance);
        view()->share('balancefloat',Customer::find(auth()->id())->balanceFloat);

        $this->data['balance'] = $this->walletBalance = auth()->user()->balanceFloat.'$';
    }

}
