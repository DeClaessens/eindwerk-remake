<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class VerifiedMatchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\VerifiedMatch\VerifiedMatchRepository',
            'App\VerifiedMatch\EloquentVerifiedMatchRepository'
        );
    }
}