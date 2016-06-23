<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 13:51
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
class UserServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\User\UserRepository',
            'App\User\EloquentUserRepository'
        );
    }
}