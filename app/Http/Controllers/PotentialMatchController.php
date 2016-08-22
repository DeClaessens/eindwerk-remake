<?php

namespace App\Http\Controllers;

use App\PotentialMatch\PotentialMatchRepository;
use App\User\UserRepository;
use App\VerifiedMatch\VerifiedMatchRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class PotentialMatchController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var PotentialMatchRepository
     */
    private $potentialMatch;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var VerifiedMatchRepository
     */
    private $verifiedMatch;

    /**
     * PotentialMatchController constructor.
     * @param Guard $auth
     * @param PotentialMatchRepository $potentialMatch
     * @param UserRepository $user
     * @param VerifiedMatchRepository $verifiedMatch
     * @internal param VerifiedMatchRepository $verifiedMatchRepository
     */
    public function __construct(Guard $auth, PotentialMatchRepository $potentialMatch, UserRepository $user, VerifiedMatchRepository $verifiedMatch)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->potentialMatch = $potentialMatch;
        $this->user = $user;
        $this->verifiedMatch = $verifiedMatch;
    }

    public function soloYes($id, $concertId) {
        //gather data from both users, save in DB with concertID;
        //if a previous PotentialMatch between the two is already found, save the data into the ConfirmedMatch table
        $otherUser = $this->user->find($id);    //technically we only need the id, and we already have it, so no issues here

        $authenticatedUser = $this->auth->user()->id;
        dd($authenticatedUser);
        if($this->potentialMatch->checkIfMatch($authenticatedUser, $otherUser->id, $concertId)){
            //CHECK IF VARIFIED MATCH ALREADY EXISTS ?
            //TECHNICALLY THIS SHOULDNT BE NEEDED AS WE SHOULD CLEAR THE MATCHES BEFORE VIEWING THEM

            $this->verifiedMatch->matchUsersTogether($authenticatedUser, $otherUser->id, $concertId);

            $pusher = App::make('pusher');

            $pusher->trigger( 'gocon-channel',
                'user-notify-' . $otherUser->id,
                array('text' => 'You have a new match with ' . $otherUser->voornaam .' !'));

            $pusher->trigger( 'gocon-channel',
                'user-notify-' . $authenticatedUser,
                array('text' => 'You have a new match with ' . $otherUser->voornaam .' !'));

        } else {
            $newPotentialMatch = $this->potentialMatch->make();

            $newPotentialMatch->user1 = $authenticatedUser;
            $newPotentialMatch->user2 = $otherUser->id;
            $newPotentialMatch->concert_id = $concertId;

            $this->potentialMatch->save($newPotentialMatch);
        }
    }
}
