<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Connection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        $pages = Cms::active()->get(['slug','name']);
        View::share('pages', $pages);
        $connections = Connection::active()->get(['name', 'button']);
        View::share('connections', $connections);

        \Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
