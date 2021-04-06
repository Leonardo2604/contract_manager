<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Validators\Contracts\Registers\SystemValidatorInterface::class,
            \App\Validators\V1\Registers\SystemValidator::class
        );

        $this->app->singleton(
            \App\Validators\Contracts\Registers\ModuleValidatorInterface::class,
            \App\Validators\V1\Registers\ModuleValidator::class
        );
    }
}
