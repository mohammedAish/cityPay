<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function __Construct(){
        //creat read update delete
        /*   $this->middleware(['permission:read_users'])->only('index');
           $this->middleware(['permission:create_users'])->only('create');
           $this->middleware(['permission:update_users'])->only('edit');
           $this->middleware(['permission:delete_users'])->only('destroy');*/
    }//end of function

    public function index(){
        $logs = Activity::Orderby('id','desc')->with('causer','subject')->get();
        return view('.crud.log.index',compact('logs'));
    }


}
