<?php

namespace App\Providers;

use App\Services\Impl\TodolistServiceImpl;
use App\Services\UserService;
use App\Services\Impl\UserServiceImpl;
use App\Services\TodolistService;
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
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(TodolistService::class, TodolistServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
