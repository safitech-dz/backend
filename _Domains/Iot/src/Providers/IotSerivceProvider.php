<?php

namespace Safitech\Iot\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\IotMessages\IotValueTypes;
use Safitech\Iot\Support\Facades\IotMessageValueCaster;

class IotSerivceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(MigrationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->app->singleton(IotValueTypes::class, fn () => new IotValueTypes());
        $this->app->singleton(DataEntityMapper::class, fn () => new DataEntityMapper());
        $this->app->singleton(IotMessageValueCaster::class, fn () => new IotMessageValueCaster());
    }
}
