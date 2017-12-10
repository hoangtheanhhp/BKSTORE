<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cart;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
         View::composer('front-end.layout.header', function($view)
        {
            return $view->with(['cartTotal'=> Cart::subtotal(), 'cartTotalItems'=>Cart::count()]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
