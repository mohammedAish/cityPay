<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Models\Consultant;
use App\Models\ConsultantsCategory;

class ConsultingController extends BaseWebController
{
    /**
     *
     * consulting/main
     *[ارجاع الاستشارات مع انواعها    .]
     * @group webHomeSite
     * @return \Illuminate\View\View
     */
    public function mainContent(){
        $consultingCategories = ConsultantsCategory::
        with('consultants')->where('active',1)
            ->get();
        $consultants          = Consultant::
        with(['category:id,name','customers:id,first_name'])
            ->where('active',1)->get();
        $countCustomers       = 0;
        foreach ($consultants as $oneConsultant) {
            $countCustomers += $oneConsultant->customers->count();
        }

        return view('consulting.main_consultations_new')
            ->with('consultants_cats',$consultingCategories)
            ->with('all_consultants',$consultants)
            ->with('countCustomers',$countCustomers);
    }

    public function consultantsCategory($id){
        $consultingCategories = ConsultantsCategory::
        with('consultants')
            ->whereId($id)
            ->where('active',1)
            ->first();
        $consultants          = Consultant::
        with(['category:id','customers:id'])
            ->where('consultants_category_id',$id)
            ->where('active',1)->get();
        $countCustomers       = 0;
        foreach ($consultants as $oneConsultant) {
            $countCustomers += $oneConsultant->customers->count();
        }

        return view('consulting.category')
            ->with('consultants_cats',$consultingCategories)
            ->with('countCustomers',$countCustomers)
            ->with('all_consultants',$consultants);
    }

    public function consultantInfo($id){
        $consultant_info = Consultant::
        with(['category:id','customers:id'])
            ->where('id',$id)
            ->where('active',1)->first();
        $countCustomers  = $consultant_info->customers->count();

        return view('consulting.detail')
            ->with('consultant_info',$consultant_info)
            ->with('countCustomers',$countCustomers);
    }


    public function consultantCheckout($id){
        $consultant_info = Consultant::
        with(['category:id','customers:id'])
            ->where('id',$id)
            ->where('active',1)->first();
        $countCustomers  = $consultant_info->customers->count();

        return view('consulting.checkout')
            ->with('consultant_info',$consultant_info)
            ->with('countCustomers',$countCustomers);
    }

}
