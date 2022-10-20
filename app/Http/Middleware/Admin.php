<?php


namespace App\Http\Middleware;
use Backpack\PermissionManager\app\Models\Permission;
use Closure;
use Prologue\Alerts\Facades\Alert;

class Admin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @param null $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		if (!auth()->check()) {
			// Block access if user is guest (not logged in)
			if ($request->ajax() || $request->wantsJson()) {
				return response(trans('admin.unauthorized'), 401);
			} else {
				if ($request->path() != admin_uri('login')) {
					Alert::error(trans('admin.unauthorized'))->flash();
					return redirect()->guest(admin_uri('login'));
				}
			}
		} else {
				// If user does //not have this permission
				if (!auth()->guard($guard)->user()->can(Permission::getStaffPermissions())) {
					if ($request->ajax() || $request->wantsJson()) {
						return response(trans('admin.unauthorized'), 401);
					} else {
						auth()->logout();
						Alert::error(trans('admin.unauthorized'))->flash();
						return redirect()->guest(admin_uri('login'));
					}
				}
		}

		return $next($request);
	}
}
