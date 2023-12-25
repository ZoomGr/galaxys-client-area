<?php

namespace App\Providers;

use App\Repositories\ChatNotificationsRepository;
use App\Repositories\MediaRepository;
use App\Repositories\UsersRepository;
use App\Services\ChatNotificationsService;
use App\Services\MediaService;
use App\Services\UsersService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UsersRepository::class, UsersService::class);
        $this->app->bind(ChatNotificationsRepository::class, ChatNotificationsService::class);
        $this->app->bind(MediaRepository::class, MediaService::class);
    }
}
