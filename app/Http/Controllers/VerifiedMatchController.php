<?php

namespace App\Http\Controllers;

use App\VerifiedMatch\VerifiedMatchRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class VerifiedMatchController extends Controller
{
    //
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var VerifiedMatchRepository
     */
    private $verifiedMatch;


    /**
     * VerifiedMatchController constructor.
     * @param Guard $auth
     * @param VerifiedMatchRepository $verifiedMatch
     */
    public function __construct(Guard $auth, VerifiedMatchRepository $verifiedMatch)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->verifiedMatch = $verifiedMatch;
    }

    public function index()
    {
        $user_id = $this->auth->user()->id;
        $matches = $this->verifiedMatch->findAllMatches($user_id);
        $amountOfConcertsArray = [];

        foreach($matches as $match) {
            array_push($amountOfConcertsArray, $this->verifiedMatch->countAllConcertsMatched($user_id, $match->user2));
        }

        return view('matches.index', compact('matches', 'amountOfConcertsArray'));
    }

}
