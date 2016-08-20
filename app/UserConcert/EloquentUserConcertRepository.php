<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 14:33
 */

namespace App\UserConcert;


use App\Concert\Concert;
use App\User\User;
use Illuminate\Contracts\Auth\Guard;

class EloquentUserConcertRepository implements UserConcertRepository
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Concert
     */
    private $concert;
    /**
     * @var UserConcert
     */
    private $model;

    /**
     * EloquentUserRepository constructor.
     * @param Guard $auth
     * @param User $user
     * @param Concert $concert
     * @param UserConcert $model
     */
    public function __construct(Guard $auth, User $user, Concert $concert, UserConcert $model)
    {
        $this->auth = $auth;
        $this->user = $user;
        $this->concert = $concert;
        $this->model = $model;
    }

    public function make()
    {
        return $this->model->newInstance();
    }

    public function save($userConcert)
    {
        $userConcert->save();
    }

    public function searchUserConcerts($user_id, $concert_id)
    {
        return $this->model->where('user_id', $user_id)->where('concert_id', $concert_id)->first();
    }

    public function getAllUsersFromConcert($user_id, $concert_id)
    {
        return $this->model->where('user_id', '!=', $user_id)->where('concert_id', $concert_id)->get();
    }
    public function countAllUsersFromConcert($concert_id)
    {
        return $this->model->where('concert_id', $concert_id)->count();
    }
}