<?php

namespace App\Http\Middleware;

use App\Models\Referrer;
use Closure;

class CustomerReferrer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $referrer_id = $request->input('referrer');
        if ($referrer_id && $referrer_id != null) {
            registerReferrer($referrer_id);
        }

        return $next($request);
    }
}
