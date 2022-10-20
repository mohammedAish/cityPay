<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Models\ParentService;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ServiceController extends BaseWebController
{

    public function __construct(int $service_id = null){
        parent::__construct($service_id);
    }

    public function listParentServices(){
        $parentServices = ParentService::
        with('services','serviceFeatures')->get();

        return view('services.services')
            ->with('parentServices',$parentServices);
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function getParentServiceInfo($id){
        $parentsService = ParentService::
        with('services','serviceFeatures')
            ->where('id',$id)->first();

        return view('services.sub_services')
            ->with('parentServices',$parentsService);
    }

    public function getAllServices(){
        $services = Service::with('parentService')
            ->orderBy('parent_service_id','asc')
            ->get();

        return $services;

        return view('services.services_index')
            ->with('services',$services);
    }

    public function getServiceInfo($id){
        $services = Service::with('parentService')
            ->where('id',$id)->get();

        return view('services.services_index')
            ->with('services',$services);
    }

    //AJAX FUNCTION
    public function getInstructions($id){
        $serviceInstruction = Service::whereId($id)->first()
            ->getAttributeValue('instructions');
        return response()->json($serviceInstruction);
    }


}
