<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/06/16
 * Time: 12:11
 */

namespace App\PotentialMatch;


use App\Concert\Concert;
use Illuminate\Contracts\Auth\Guard;

class EloquentPotentialMatchRepository implements PotentialMatchRepository
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var PotentialMatch
     */
    private $model;
    /**
     * @var Concert
     */
    private $concert;


    /**
     * EloquentPotentialMatchRepository constructor.
     * @param Guard $auth
     * @param PotentialMatch $model
     * @param Concert $concert
     */
    public function __construct(Guard $auth, PotentialMatch $model, Concert $concert)
    {
        $this->auth = $auth;
        $this->model = $model;
        $this->concert = $concert;
    }

    public function make()
    {
        $this->model->newInstance();
    }
    public function save($potentialMatch)
    {
        $potentialMatch->save();
    }
    public function checkIfMatch($user1, $user2, $concert_id)
    {
        $response = $queryResult = $this->model
            ->where('user1', $user1)
            ->where('user2', $user2)
            ->where('concert_id', $concert_id)
            ->first();

        if($response != NULL) {
            //MATCH FOUND, RETURN TRUE
            return 1;
        } else {
            //NO MATCH FOUND, TEST OTHER POSSIBILITY
            $queryResult = $this->model
                ->where('user1', $user2)
                ->where('user2', $user1)
                ->where('concert_id', $concert_id)
                ->first();

            if($queryResult != NULL) {
                return 1;
            }

            return 0;
        }
    }
}