<?php

namespace Safitech\Iot\App\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\Domain\IotMessageValues\Caster\IotMessageValueCaster;
use Safitech\Iot\Domain\IotMessageValues\DbMapper\IotMessageValueDbMapper;
use Safitech\Iot\Domain\IotMessageValues\Queries\UnionQueryIotMessageValues;
use Safitech\Iot\Domain\IotMessageValues\ValueTypes\IotMessageValueTypes;

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
