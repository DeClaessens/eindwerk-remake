<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class PotentialMatchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\PotentialMatch\PotentialMatchRepository',
            'App\PotentialMatch\EloquentPotentialMatchRepository'
        );
    }
}