<?php

namespace Forss\Laravel\Notifications\ForssSms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

class ForssSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->singleton(ForssSmsApi::class, static function ($app) {
            return new ForssSmsApi($app['config']['services.forss_sms']);
        });
    }

    public function provides(): array
    {
        return [
            ForssSmsApi::class,
        ];
    }
}