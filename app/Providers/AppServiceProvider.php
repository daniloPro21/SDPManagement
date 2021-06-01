<?php

namespace App\Providers;

use App\Cotation;
use App\Trace;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\User;
use App\Dossier;
use App\Service;
use App\ServiceGeneral;

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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role === 'admin';
        });

        Blade::if('secretaire', function () {
            return auth()->check() && auth()->user()->role === 'secretaire';
        });

        Blade::if('service', function () {
            return auth()->check() && auth()->user()->role === 'service';
        });
        Blade::if('superadmin', function () {
            return auth()->check() && auth()->user()->role === 'superadmin';
        });
        Blade::if('cardre', function () {
            return auth()->check() && auth()->user()->role === 'cardre';
        });
        Blade::if('secdrh', function () {
            return auth()->check() && auth()->user()->role === 'secdrh';
        });
        /*
        Illuminate\Support\Facades\Blade::if('activelink', function (string $url) {
            return \Illuminate\Support\Facades\Request::getFacadeRoot()->getPathInfo()==$url;
        });
        */

        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            view()->share('dossiers', Dossier::orderByDesc('id')->get());
            view()->share('services', Service::orderByDesc('id')->get());
            view()->share('traces', Trace::orderByDesc('id')->get());
            view()->share('users', User::orderByDesc('id')->get());
            view()->share('servicesgenerals', ServiceGeneral::orderByDesc('id')->get());
        }

    }
}
