<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      /*

      */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          Schema::defaultStringLength(191);
        /*  Blade::if('admin', function () {
              return auth()->check() && auth()->user()->role === 'admin';
          });

          Illuminate\Support\Facades\Blade::if('activelink', function (string $url) {
              return \Illuminate\Support\Facades\Request::getFacadeRoot()->getPathInfo()==$url;
          });

          if(request()->server("SCRIPT_NAME") !== 'artisan') {
              view()->share('users', User::where('is_delete', 0)->get());
          }
          */
    }
}
