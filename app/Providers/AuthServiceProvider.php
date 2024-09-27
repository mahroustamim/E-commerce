<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is_admin', function(User $user) {
            return $user->status === 'admin';
        });

        Gate::define('is_supervisor', function(User $user) {
            return $user->status === 'supervisor';
        });

        Gate::define('is_user', function(User $user) {
            return $user->status === 'user';
        });
    }
}
