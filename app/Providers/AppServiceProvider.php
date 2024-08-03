<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('is_admin', function ($user) {
            return $user->role_id == 1;
        });

        Gate::define('is_laboratorium', function ($user) {
            return $user->role_id == 2 || $user->role_id == 1;
        });

        Gate::define('is_quality-control', function ($user) {
            return $user->role_id == 3 || $user->role_id == 1;
        });
    }
}
