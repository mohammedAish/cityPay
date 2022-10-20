<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   /* //testing the wallet library
      public function test(){
        $user = User::first();
        $user->balance; // int(0)

        $user->deposit(10);
        $user->balance; // int(10)

        $user->withdraw(1);
        $user->balance; // int(9)

        $user->forceWithdraw(200, ['description' => 'payment of taxes']);
        $user->balance; // int(-191)
    }*/

}
