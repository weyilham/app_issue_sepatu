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
            return $user->level == 'admin';
        });

        Gate::define('is_laboratorium', function ($user) {
            return $user->level == 'laboratorium' || $user->level == 'admin';
        });

        Gate::define('is_quality-control', function ($user) {
            return $user->level == 'quality-control' || $user->level == 'admin';
        });
    }
}
