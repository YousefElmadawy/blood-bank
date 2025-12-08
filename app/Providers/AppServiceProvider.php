<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrap();

        // Custom Blade directives for role checking
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Blade::if('moderator', function () {
            return auth()->check() && auth()->user()->isModerator();
        });

        Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

        Blade::if('hasanyrole', function (...$roles) {
            return auth()->check() && auth()->user()->hasAnyRole(...$roles);
        });

        Blade::if('hasallroles', function (...$roles) {
            return auth()->check() && auth()->user()->hasAllRoles(...$roles);
        });
    }
}
