<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Config;
//use \App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		//Setting::ini_config();
		//\Config::set('mail.host', 'cccczzzzzzzzzzzzzzz');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
