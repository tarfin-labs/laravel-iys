<?php

namespace TarfinLabs\Iys;

use Illuminate\Support\ServiceProvider;
use TarfinLabs\Iys\Commands\IysCommand;

class IysServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-iys.php' => config_path('laravel-iys.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-iys.php', 'laravel-iys');

        $this->app->singleton(Client::class, function ($app) {
            return new Client();
        });
    }
}
