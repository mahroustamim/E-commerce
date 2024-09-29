<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const USER = 'website/home';
    public const ADMIN = 'dashboard/home';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Custom rate limiter for website routes
        RateLimiter::for('website', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip()); // Customize the limit
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'verified', 'has.dashboard'])->prefix('dashboard/')->name('dashboard.')
            ->group(base_path('routes/admin.php'));
        });
    }
}
