<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cart;
use View;
use App\Category;

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

         View::composer('front-end.layout.footer', function($view)
        {
            return $view->with(['category'=> Category::all()]);
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
