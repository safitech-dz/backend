<?php

namespace Safitech\Iot\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\Packages\IotMessages\IotMessageValueDbMapper;
use Safitech\Iot\Packages\IotMessages\IotMessageValueTypes;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;
use Safitech\Iot\Support\Facades\IotMessageValueCaster;

class IotSerivceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(MigrationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->app->singleton(IotMessageValueTypes::class, fn () => new IotMessageValueTypes());
        $this->app->singleton(IotMessageValueDbMapper::class, fn () => new IotMessageValueDbMapper());
        $this->app->singleton(IotMessageValueCaster::class, fn () => new IotMessageValueCaster());
        $this->app->singleton(UnionQueryIotMessageValues::class, fn () => new UnionQueryIotMessageValues());
    }
}
