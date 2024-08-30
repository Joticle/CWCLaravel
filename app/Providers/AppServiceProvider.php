<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Connection;
use App\Models\Setting;
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
            $pages = Cms::active()->get(['slug', 'name']);
        } else {
            $pages = collect(); // Return an empty collection or handle it accordingly
        }
        if (\Schema::hasTable('connections')) {
            $connections = Connection::active()->get();
        } else {
            $connections = collect(); // Return an empty collection or handle it accordingly
        }

        if (\Schema::hasTable('settings')) {
            $setting = Setting::first();
        } else {
            $setting = null;
        }

        View::share('pages', $pages);
        View::share('connections', $connections);
        View::share('setting', $setting);
    }
}
