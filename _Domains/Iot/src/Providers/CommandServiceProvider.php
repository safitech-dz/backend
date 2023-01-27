<?php

namespace Safitech\Iot\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\Console\Commands\TopicsExport;
use Safitech\Iot\Console\Commands\TopicsImport;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if ($this->app->runningInConsole()) {
                $this->commands([
                    TopicsImport::class,
                    TopicsExport::class,
                ]);
            }
        }
    }
}
