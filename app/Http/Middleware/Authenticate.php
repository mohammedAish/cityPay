<?php

namespace App\Http\Middleware;

use App\Helpers\UrlGen;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string|null
     */
    protected function redirectTo($request) {
        if (!$request->expectsJson()) {
            if (isFromAdminPanel()) {
                return route(admin_uri('login'));
            } else {
                $referrer_id = $request->input('referrer');
                if ($referrer_id && $referrer_id != null) {
                   registerReferrer($referrer_id);
                }

                return route('login');
            }
        }
        /*if (! $request->expectsJson()) {
            return route('login');
        }*/
    }
}
