<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // HTTP-клиент для Rest API, по умолчанию \GuzzleHttp\Client
        $this->app->bind('HttpClient', function () {
            return new \GuzzleHttp\Client(['base_uri' => config('app.api_endpoint')]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
