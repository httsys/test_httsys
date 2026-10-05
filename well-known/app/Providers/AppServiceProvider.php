<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Validator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // @haspermission('shop.products.manage') ... @endhaspermission
        // Used all over the admin sidebar so a user only sees the menu
        // items their role actually grants.
        Blade::if('haspermission', function ($key) {
            $user = Auth::user();

            return $user !== null && $user->hasPermission($key);
        });
    }
}
