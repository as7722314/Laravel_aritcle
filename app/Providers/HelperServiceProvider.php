<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Helpers;
use App\Helper\HelpersInterFace;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HelpersInterFace::class, function ($app) {
            return new Helpers();
        });
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
