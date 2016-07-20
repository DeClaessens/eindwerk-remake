<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class HTTPClientServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\HTTPClient\HTTPClientRepository',
            'App\HTTPClient\GuzzleHTTPClientRepository'
        );
    }
}