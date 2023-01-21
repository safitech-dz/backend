<?php

namespace Safitech\Iot\Providers;

use Illuminate\Support\ServiceProvider;

class IotSerivceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(MigrationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
    }
}
