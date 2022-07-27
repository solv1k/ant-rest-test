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
        // HTTP-клиент для Rest API
        $this->app->bind(\GuzzleHttp\ClientInterface::class, function () {
            return new \GuzzleHttp\Client([
                'base_uri' => config('ant.scheme') . '://' . 
                                config('ant.server') . ':' . 
                                config('ant.port') . '/' . 
                                config('ant.app_name') . '/rest/',
                'timeout'  => config('ant.timeout')
            ]);
        });

        // сервис для работы с Rest API
        $this->app->bind(
            \App\Contracts\RestApiServiceContract::class, 
            \App\Services\RestApiService::class
        );
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
