<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/Dashboard/Menu';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        $this->configureRateLimiting();

        $this->routes(function () {

            $routeAttributesWeb = [
                'middleware' => 'web',
                'name' => 'front',
                'namespace' => 'App\Http\Controllers\Front',
                'prefix' => '',
            ];

            $routeAttributesAuth = [
                'middleware' => 'auth',
                'name' => 'Dashboard',
                'namespace' => 'App\Http\Controllers\Dashboard',
                'prefix' => 'Dashboard',
            ];

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')->group(function () use ($routeAttributesWeb) {
                Route::group($routeAttributesWeb, function () {
                    include(base_path('routes/Front/home.php'));

                    Auth::routes();
                });
            });

            Route::middleware('web')->group(function () use ($routeAttributesAuth) {
                Route::group($routeAttributesAuth, function () {

                    //Menu
                    include(base_path('routes/models/menu.php'));

                    //Permisos
                    include(base_path('routes/models/permissions.php'));

                    //Roles
                    include(base_path('routes/models/roles.php'));

                    //Usuarios
                    include(base_path('routes/models/users.php'));

                    //Personas
                    include(base_path('routes/models/persons.php'));

                    //Equipos
                    include(base_path('routes/models/equipments.php'));

                    //Rentas
                    include(base_path('routes/models/rents.php'));

                    //Gastos Fijos
                    include(base_path('routes/models/fixedExpenses.php'));

                    //Gastos Variables
                    include(base_path('routes/models/variablesExpenses.php'));
                });
            });

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}