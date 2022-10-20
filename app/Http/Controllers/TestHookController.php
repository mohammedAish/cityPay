<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class TestHookController extends Controller
{
    public function printEvent(Request $request)
    {
        $event = $request->all();
        Log::info(implode(',', $event));
    }

    public function execArtisan($artisan_string)
    {
        //todo disable all in production
        // for no
        //if ($artisan_string === 'migrate:fresh') {
       //     return 0;
       // }
        return Artisan::call($artisan_string);
    }

}
