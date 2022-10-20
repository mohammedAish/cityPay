<?php

namespace App\Http\Controllers\Web\Consultants;

use App\Http\Controllers\BaseWebController;
use App\Models\CustomerConsultantOrder;

class CustomerConsultantController extends BaseWebController
{
    public function listMyConsultants(){
        $customerConsultants = CustomerConsultantOrder::
        whereCustomerId(auth()->id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('profile.my-consultings')
            ->with('consultants',$customerConsultants);
    }
}
