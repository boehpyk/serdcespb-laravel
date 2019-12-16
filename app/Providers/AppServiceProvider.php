<?php

namespace App\Providers;

use App\Text;
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
        /*
         * Pass all text pages to parent view for admin for showing them in the left menu
         */
        View::composer('admin.layouts.admin', function ($view) {
            $view->with('texts', Text::all());
        });
    }
}
