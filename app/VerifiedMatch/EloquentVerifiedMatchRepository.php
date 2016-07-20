<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/06/16
 * Time: 12:25
 */

namespace App\VerifiedMatch;


use Illuminate\Contracts\Auth\Guard;

class EloquentVerifiedMatchRepository
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var VerifiedMatch
     */
    private $model;

    /**
     * EloquentVerifiedMatchRepository constructor.
     * @param Guard $auth
     * @param VerifiedMatch $model
     */
    public function __construct(Guard $auth, VerifiedMatch $model)
    {
        $this->auth = $auth;
        $this->model = $model;
    }

    public function make()
    {
        $this->model->newInstance();
    }
    public function save($verifiedMatch)
    {
        $verifiedMatch->save();
    }
    public function findAllMatches($user1) {
        return $this->model->where('user1', $user1)->get();
    }

    public function checkIfUsersMatch($user1, $user2) {

        $response = $queryResult = $this->model
            ->where('user1', $user1)
            ->where('user2', $user2)
            ->first();

        if($response != NULL) {
            //MATCH FOUND, RETURN TRUE
            return 1;
        } else {
            //NO MATCH FOUND, TEST OTHER POSSIBILITY
            $queryResult = $this->model
                ->where('user1', $user2)
                ->where('user2', $user1)
                ->first();

            if($queryResult != NULL) {
                return 1;
            }

            return 0;
        }
    }

    public function findAllConcertsMatched($user1, $user2) {
        $query = $this->model
            ->where(function ($query) use ($user1, $user2) {
                $query->where('user1', $user1)
                    ->where('user2', $user2);
            })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('user1', $user2)
                    ->where('user2', $user1);
            })
            ->groupBy('concert_id')
            ->get();

        return $query;
    }
}