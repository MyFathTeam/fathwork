<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    public $versionPath = '/v1';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api'.$this->versionPath)->group(function () {
                Route::middleware(['api', 'user.config'])
                    // ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));

                Route::prefix('auth')
                    ->middleware(['api', 'user.config'])
                    // ->namespace($this->namespace)
                    ->group(base_path('routes/auth.php'));

                Route::prefix('app')
                    ->middleware(['api', 'auth:sanctum', 'two.factor.security', 'screen.lock', 'under.maintenance', 'user.config'])
                    // ->namespace($this->namespace)
                    ->group(base_path('routes/app.php'));

                $modules = glob(base_path('routes/modules/*.php'));
                foreach ($modules as $module) {
                    Route::prefix('app')
                        ->middleware(['api', 'auth:sanctum', 'two.factor.security', 'screen.lock', 'under.maintenance', 'user.config'])
                        // ->namespace($this->namespace)
                        ->group($module);
                }

                Route::prefix('app')
                    ->middleware(['api', 'auth:sanctum', 'two.factor.security', 'screen.lock', 'under.maintenance', 'user.config'])
                    // ->namespace($this->namespace)
                    ->group(base_path('routes/module.php'));
            });

            $modules = glob(base_path('routes/exports/*.php'));
            foreach ($modules as $module) {
                Route::prefix('app')
                    ->middleware(['web', 'auth', 'two.factor.security', 'screen.lock', 'under.maintenance', 'user.config', 'export'])
                    // ->namespace($this->namespace)
                    ->group($module);
            }

            Route::prefix('app')
                ->middleware(['web', 'auth', 'two.factor.security', 'screen.lock', 'under.maintenance', 'user.config', 'export'])
                // ->namespace($this->namespace)
                ->group(base_path('routes/export.php'));

            Route::middleware(['web', 'user.config'])
                // ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                // ->namespace($this->namespace)
                ->group(base_path('routes/asset.php'));

            Route::middleware(['web', 'site'])
                // ->namespace($this->namespace)
                ->group(base_path('routes/site.php'));

            Route::middleware(['web', 'role:admin'])
                ->prefix('cmd')
                // ->namespace($this->namespace)
                ->group(base_path('routes/command.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(5);
        });

        RateLimiter::for('otp', function (Request $request) {
            return Limit::perMinute(3);
        });
    }
}
