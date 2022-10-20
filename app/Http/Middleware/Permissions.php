<?php
/**
 * File name: Permissions.php
 * Last modified: 2021 at 16:25:18
 * Author: Targets Guide - https://ctpay.com/
 * Copyright (c) 2021
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Permissions
{
    private $exceptNames = [
        'telescope',
    ];

    private $exceptControllers = [
        'LoginController',
        'ForgotPasswordController',
        'ResetPasswordController',
        'RegisterController',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request,Closure $next, ...$guards){
        $permission = $request->route()->getName();
        if ($this->match($request->route()) && auth()->user()->canNot($permission)) {
            throw new UnauthorizedException(403,
                trans('error.permission').' <b>'.trans('permissions.'.$permission).'</b>');
        }
        return $next($request);
    }
    private function match(\Illuminate\Routing\Route $route){
        if ($route->getName() == '' || $route->getName() === null) {
            return false;
        } else {
            if (in_array(class_basename($route->getController()),$this->exceptControllers)) {
                return false;
            }
            foreach($this->exceptNames as $except) {
                if (Str::is($except,$route->getName())) {
                    return false;
                }
            }
        }
        return true;
    }

}
