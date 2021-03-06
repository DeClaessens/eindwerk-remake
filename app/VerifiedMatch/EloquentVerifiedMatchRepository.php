<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/06/16
 * Time: 12:25
 */

namespace App\VerifiedMatch;


use Illuminate\Contracts\Auth\Guard;

class EloquentVerifiedMatchRepository implements VerifiedMatchRepository
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
        return $this->model->newInstance();
    }
    public function save($verifiedMatch)
    {
        $verifiedMatch->save();
    }
    public function findAllMatches($user1) {
        return $this->model->where('user1', $user1)->groupBy('user2')->get();
    }

    public function findMatch($user1, $user2) {

        $response = $queryResult = $this->model
            ->where('user1', $user1)
            ->where('user2', $user2)
            ->first();

        if($response != NULL) {
            //MATCH FOUND, RETURN TRUE
            return $response;
        } else {
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

    public function countAllConcertsMatched($user1, $user2) {
        $query = $this->model
            ->where(function ($query) use ($user1, $user2) {
                $query->where('user1', $user1)
                    ->where('user2', $user2);
            })
            ->count();

        return $query;
    }

    public function matchUsersTogether($user1, $user2, $concertId) {
        $vm1 = $this->make();
        $vm2 = $this->make();

        $vm1->user1 = $user1;
        $vm1->user2 = $user2;
        $vm1->concert_id = $concertId;

        $vm2->user1 = $user2;
        $vm2->user2 = $user1;
        $vm2->concert_id = $concertId;

        $this->save($vm1);
        $this->save($vm2);
    }

    public function findXLastMatchesById($id, $amount){
        $query = $this->model->where('user1', $id)->limit($amount)->get();

        return $query;
    }

    public function countUnreadMatches($authid)
    {
        $query = $this->model->where('user1', $authid)->where('new_match', true)->count();

        return $query;
    }

    public function delete($authId, $matchId)
    {
        $query = $this->model
            ->where(function ($query) use ($authId, $matchId) {
                $query->where('user1', $authId)
                    ->where('user2', $matchId);
            })
            ->orWhere(function ($query) use ($authId, $matchId) {
                $query->where('user1', $matchId)
                    ->where('user2', $authId);
            })
            ->get();

        for($i = 0; $i < count($query); $i++) {
            $query[$i]->delete();
        }

        return 1;
    }
}