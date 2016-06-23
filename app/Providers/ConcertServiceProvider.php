<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class ConcertServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Concert\ConcertRepository',
            'App\Concert\EloquentConcertRepository'
        );
    }
}