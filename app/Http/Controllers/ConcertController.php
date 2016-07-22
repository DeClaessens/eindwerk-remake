<?php

namespace App\Http\Controllers;

use App\Concert\ConcertRepository;
use App\User\UserRepository;
use App\UserConcert\UserConcertRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class ConcertController extends Controller
{
    /**
     * @var ConcertRepository
     */
    private $concert;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var UserConcertRepository
     */
    private $userConcert;
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @param ConcertRepository $concert
     * @param Guard $auth
     * @param UserConcertRepository $userConcert
     * @param UserRepository $user
     */
    public function __construct(ConcertRepository $concert, Guard $auth, UserConcertRepository $userConcert, UserRepository $user)
    {
        $this->middleware('auth');
        $this->concert = $concert;
        $this->auth = $auth;
        $this->userConcert = $userConcert;
        $this->user = $user;
    }

    public function showConcertLanding($concert_id)
    {
        $selectedConcert = $this->concert->find($concert_id);
        return view('concerts.landing', compact('selectedConcert'));
    }

    public function findSolo($concert_id)
    {
        //save user and concert id to a joined DB with relationships to both
        //-- create db (check)
        //-- -- create relationships in model (check)
        //-- -- -- save data

        $user = $this->auth->user();
        $concert = $this->concert->find($concert_id);

        if($existingUserConcert = !$this->userConcert->searchUserConcerts($user->id, $concert->id)) {
            $newUserConcert = $this->userConcert->make();

            $newUserConcert->user_id = $user->id;
            $newUserConcert->concert_id = $concert->id;
            $this->userConcert->save($newUserConcert);
        }

        $users = $this->userConcert->getAllUsersFromConcert($user->id, $concert_id);
        $usersCollection = [];
        //fill collection with user data

        $counter = 0;
        foreach($users as $user) {
            array_push($usersCollection, $this->user->find($user->user_id));
            $counter++;
        }

        return view('concerts.swipe', compact('usersCollection', 'concert_id'));
    }

}