<?php

namespace App\Providers;

use App\Interfaces\GovernorateRepositoryInterface;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\ClientRepository;
use App\Repositories\DonationRepository;
use App\Repositories\GovernorateRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GovernorateRepositoryInterface::class,GovernorateRepository::class);
        $this->app->bind(ClientRepositoryInterface::class,ClientRepository::class);
        $this->app->bind(DonationRepositoryInterface::class,DonationRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class,NotificationRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
