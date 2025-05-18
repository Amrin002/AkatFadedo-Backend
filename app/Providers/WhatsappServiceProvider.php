<?php

namespace App\Providers;

use App\Services\WhatsappService;
use Illuminate\Support\ServiceProvider;


class WhatsappServiceProvider extends ServiceProvider
{
    /**
     * Daftar layanan untuk di-bind dalam container.
     *
     * @return void
     */
    public function register()
    {
        // Binding WhatsappService ke dalam container
        $this->app->singleton(WhatsappService::class, function ($app) {
            return new WhatsappService();
        });
    }

    /**
     * Lakukan tindakan setelah layanan telah di-bind.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
