<?php

namespace Safitech\Iot\App\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\App\Console\Commands\TopicsExport;
use Safitech\Iot\App\Console\Commands\TopicsImport;
use Safitech\Iot\Domain\IotMessageValues\Caster\IotMessageValueCaster;
use Safitech\Iot\Domain\IotMessageValues\DbMapper\IotMessageValueDbMapper;
use Safitech\Iot\Domain\IotMessageValues\Queries\UnionQueryIotMessageValues;
use Safitech\Iot\Domain\IotMessageValues\ValueTypes\IotMessageValueTypes;

class IotSerivceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole() && $this->shouldMigrate()) {
            $this->loadMigrationsFrom($this->getMigrationsList());
        }

        if ($this->app->runningInConsole()) {
            if ($this->app->runningInConsole()) {
                $this->commands($this->getCommandsList());
            }
        }
    }

    public function register()
    {
        $this->registerRoutes();

        $this->ioc();
    }

    private function ioc()
    {
        $this->app->singleton(IotMessageValueTypes::class, fn () => new IotMessageValueTypes());
        $this->app->singleton(IotMessageValueDbMapper::class, fn () => new IotMessageValueDbMapper());
        $this->app->singleton(IotMessageValueCaster::class, fn () => new IotMessageValueCaster());
        $this->app->singleton(UnionQueryIotMessageValues::class, fn () => new UnionQueryIotMessageValues());
    }

    protected function shouldMigrate()
    {
        return true;
    }

    private function getMigrationsList(): array|string
    {
        return __DIR__.'/../../database/migrations';
    }

    private function getCommandsList(): array|string
    {
        return [
            TopicsImport::class,
            TopicsExport::class,
        ];
    }

    private function registerRoutes(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
