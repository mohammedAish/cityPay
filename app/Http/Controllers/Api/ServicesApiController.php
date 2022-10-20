<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParentServicesResource;
use App\Models\ParentService;
use Illuminate\Http\Request;

class ServicesApiController extends BaseApiController
{
    public function getParentServices(){
        $services = ParentService::with('services')
            ->get();
        $services = ParentServicesResource::collection($services);

        return $this->success_response($services,'you get all parent services');
    }

}
