<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Paginator::useBootstrap();

        foreach (config('permissions_en') as $configPermission => $value) {
            Gate::define($configPermission, function ($auth) use ($configPermission) {
                return $auth->hasAccess($configPermission);
            });
        }
    }
}
