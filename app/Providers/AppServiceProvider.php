<?php

namespace App\Providers;

use App\Interfaces\PaymentInterface;
use App\Services\PaystackService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(PaymentInterface::class, function () {
            return new PaystackService;
        });
    }
}
