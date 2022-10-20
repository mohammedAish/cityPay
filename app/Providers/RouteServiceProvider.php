<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $org_namespace = 'App\Http\Controllers\Org';
    protected $admin_namespace = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    public const User_PROFILE = '/account/profile/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapViewsRoutes();  //for views routes only  EMAN ROUTES
        $this->mapWebRoutes();
        $this->mapWalletAccountRoutes();
        $this->mapCourseRoutes();
        $this->mapConsultantRoutes();
        $this->mapWebOrgRoutes();
       // $this->mapNewHomeRoutes();
        $this->mapFrontendRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        Route::middleware('web')
            ->namespace($this->namespace)

            ->group(base_path('routes/web.php'));
    }

    protected function mapWalletAccountRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/wallet_account.php'));
    }

    protected function mapCourseRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web_courses.php'));
    }

    protected function mapViewsRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/views_routes.php'));
    }

    protected function mapConsultantRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web_consultants.php'));
    }

    protected function mapWebOrgRoutes()
    {
        Route::middleware('web')
            ->namespace($this->org_namespace)
            ->group(base_path('routes/org_web.php'));
    }

    protected function mapNewHomeRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/newhome.php'));
    }

    protected function mapFrontendRoutes()
    {
        Route::middleware('web')
            ->namespace($this->admin_namespace)
            ->group(base_path('routes/adminfrontend.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
