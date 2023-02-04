<?php

namespace Safitech\Iot\App\Providers;

use Illuminate\Support\ServiceProvider;
use Safitech\Iot\App\Console\Commands\TopicsExport;
use Safitech\Iot\App\Console\Commands\TopicsImport;

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
