<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => config('braintree.environment'),
                'merchantId' => config('braintree.merchantId'),
                'publicKey' => config('braintree.publicKey'),
                'privateKey' => config('braintree.privateKey'),
            ]);
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
