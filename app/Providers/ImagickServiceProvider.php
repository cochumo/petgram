<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImagickServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'imagick', 'app\Services\Imagick' );
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
