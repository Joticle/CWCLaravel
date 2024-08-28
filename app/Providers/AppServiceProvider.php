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

        \Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        if (\Schema::hasTable('cms')) {
            //$pages = Cms::active()->get(['slug','name']);
        } else {
            $pages = collect(); // Return an empty collection or handle it accordingly
        }
        $pages = collect()
        if (\Schema::hasTable('connections')) {
            //$connections = Connection::active()->get(['slug','name', 'button']);
        } else {
            $connections = collect(); // Return an empty collection or handle it accordingly
        }
        $connections = collect(); // Return an empty collection or handle it accordingly
        View::share('pages', $pages);
        View::share('connections', $connections);
    }
}
