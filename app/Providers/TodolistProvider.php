<?php

namespace App\Providers;

use App\Services\Impl\TodolistServiceImpl;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singleton = [
        TodolistService::class => TodolistServiceImpl::class
    ];
    public function provides(): array
    {
        return [TodolistService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
