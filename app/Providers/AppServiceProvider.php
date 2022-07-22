<?php

namespace App\Providers;

use App\Services\RestApiService;
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
            return new \GuzzleHttp\Client([
                'base_uri' => config('ant.scheme') . '://' . 
                                config('ant.server') . ':' . 
                                config('ant.port') . '/' . 
                                config('ant.app_name') . '/rest/'
            ]);
        });

        // сервис для работы с Rest API Ant
        $this->app->bind('RestApiService', function () {
            return new RestApiService;
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
