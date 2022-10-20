<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultantCategoryResource;
use App\Http\Resources\ConsultantResource;
use App\Models\Consultant;
use App\Models\ConsultantsCategory;
use Illuminate\Http\Request;

class ConsultingApiController extends BaseApiController
{

    /**
     *  /consultants
     * [ارجاع الاستشارات مع انواعها .]
     * @group Consulting
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $consultingCategories = ConsultantsCategory::
        // with('consultants')
        where('active',1)
            ->get();
        $consultants          = Consultant::
        with(['category:id,name','customers:id,first_name'])
            ->where('active',1)
            ->limitOrder($this->limit,$this->last_id)
            ->get();
        $countCustomers       = 0;
        foreach ($consultants as $oneConsultant) {
            $countCustomers += $oneConsultant->customers->count();
        }
        $this->base_data['consultants_cats'] =
            ConsultantCategoryResource::collection($consultingCategories);
        $this->base_data['all_consultants']  = ConsultantResource::collection($consultants);
        $this->base_data['countCustomers']   = $countCustomers;

        return $this->success_response($this->base_data,tt('you_get_consulting_info'));
    }

    /**
     *  /consultants/cat/{cat_id}
     * [ارجاع الاستشارات لمجموعه أو فئة  .]
     * @bodyParam cat_id  number    required  رقم الفئة
     * @group Consulting
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultantsCategory($id = 1){
        $category_info  = ConsultantsCategory::
        whereId($id)
            ->first();
        $consultants    = Consultant::
        with(['category:id,name','customers:id,first_name'])
            ->where('consultants_category_id',$id)
            ->where('active',1)->get();
        $countCustomers = 0;
        foreach ($consultants as $oneConsultant) {
            $countCustomers += $oneConsultant->customers->count();
        }
        $this->base_data['category_info']    = new ConsultantCategoryResource($category_info);
        $this->base_data['cate_consultants'] = ConsultantResource::collection($consultants);

        $this->base_data['countCustomers'] = $countCustomers;

        return $this->success_response($this->base_data,tt('you_get_consulting_category_info'));
    }

    /**
     *  /consultants/{id?}
     * [ارجاع بيانات كاملة لاستشارة برقمها  .]
     * @bodyParam id  number    required  رقم الاستشارة
     * @group Consulting
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultantInfo($id = 3){
        $consultant_info                    = Consultant::
        with(['category:id,name,img_path,short_description','customers:id,first_name'])
            ->where('id',$id)
            //->where('active',1)
            ->first();
        $countCustomers                     = $consultant_info->customers->count();
        $resInfo                            = new ConsultantResource($consultant_info);
        $resInfo->additional                = ['is_one' => true];
        $this->base_data['consultant_info'] = $resInfo;
        $this->base_data['countCustomers']  = $countCustomers;

        return $this->success_response($this->base_data,tt('you_get_consultant_info'));
    }

}
