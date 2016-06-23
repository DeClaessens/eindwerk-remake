<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 13:46
 */

namespace App\User;


use Illuminate\Contracts\Auth\Guard;

class EloquentUserRepository implements UserRepository
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var User
     */
    private $model;

    /**
     * EloquentUserRepository constructor.
     * @param Guard $auth
     * @param User $user
     */
    public function __construct(Guard $auth, User $model)
    {

        $this->auth = $auth;
        $this->user = $model;
    }

    public function make()
    {
        return $this->model->newInstance();
    }

    public function save($user)
    {
        $user->save();
    }
}