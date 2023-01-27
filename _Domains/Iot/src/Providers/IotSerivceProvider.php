<?php

namespace Safitech\Iot\Providers;

use App\Packages\IotData\Values\DataEntityMapper;
use Illuminate\Support\ServiceProvider;

class IotSerivceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(MigrationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->app->singleton(DataEntityMapper::class, fn () => new DataEntityMapper());
    }
}
