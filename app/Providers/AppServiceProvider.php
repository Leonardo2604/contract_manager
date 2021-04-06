<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Services\Contracts\Registers\SystemServiceInterface::class,
            \App\Services\V1\Registers\SystemService::class
        );

        $this->app->singleton(
            \App\Services\Contracts\Registers\ModuleServiceInterface::class,
            \App\Services\V1\Registers\ModuleService::class
        );
    }
}
