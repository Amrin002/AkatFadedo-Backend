<?php

namespace App\Providers;

use App\Services\FCMService;
use Illuminate\Support\ServiceProvider;

class FCMServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FCMService::class, function ($app) {
            return new FCMService();
        });
    }
}
