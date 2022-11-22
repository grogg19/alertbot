<?php

namespace App\Providers;

use App\Services\TelegramBotService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TelegramServiceProvider
 */
class TelegramServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TelegramBotService::class, function () {
            return new TelegramBotService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
