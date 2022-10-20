<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class DashboardController extends Controller
{

    public function index(){
        $data['total_users'] = Customer::count();
        $data['active_users'] = Customer::where('active', 1)->count();
        $data['banned_users'] = Customer::where('blocked', 1)->count();
     
      $data['email_unerified_users'] = Customer::where('is_verified', 1)->count();
      $data['sms_unerified_users'] = Customer::where('verified_phone', 1)->count();
        
        return view(backpack_view('dashboard'), $data);
    }
}

