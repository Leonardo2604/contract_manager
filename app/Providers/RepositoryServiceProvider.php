<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Contracts\Registers\SystemRepositoryInterface::class,
            \App\Repositories\V1\Registers\SystemRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Contracts\Registers\ModuleRepositoryInterface::class,
            \App\Repositories\V1\Registers\ModuleRepository::class
        );
    }
}
