<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class UserConcertServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\UserConcert\UserConcertRepository',
            'App\UserConcert\EloquentUserConcertRepository'
        );
    }
}