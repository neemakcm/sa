<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperClassServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('helperclass', function()
        {
            return new \App\Helper\SiteHelper;
        });
    }
}
