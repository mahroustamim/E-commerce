<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        

        // Efficiently handle settings table check
        if (Schema::hasTable('settings')) {
            $setting = Cache::remember('setting', 60 * 60, function() {
                return Setting::first();
            });
            view()->share('setting', $setting);
        } else {
            view()->share('setting', null);
        }

        // Use Bootstrap pagination
        Paginator::useBootstrap();
    }

}
