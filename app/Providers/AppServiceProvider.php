<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $baseUrl = env('DESERT_EBS_BASE_URL');
        $this->app->singleton('GuzzleHttp\Client', function($api) use ($baseUrl) {
            return new Client([
                'base_uri' => $baseUrl,
            ]);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
