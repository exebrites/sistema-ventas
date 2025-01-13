<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ShoppingCartInterface;
use App\Services\ShoppingCartService;
class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(ShoppingCartInterface::class, ShoppingCartService::class);
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
