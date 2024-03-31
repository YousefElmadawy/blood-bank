<?php

namespace App\Providers;

use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\MainRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MainRepositoryInterface::class,MainRepository::class);
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
