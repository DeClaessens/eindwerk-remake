<?php

namespace App\Http\Controllers;

use App\Chat\ChatRepository;
use App\PotentialMatch\PotentialMatchRepository;
use App\User\User;
use App\User\UserRepository;
use App\VerifiedMatch\VerifiedMatchRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

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
     * @var PotentialMatchRepository
     */
    private $potentialMatch;
    /**
     * @var ChatRepository
     */
    private $chat;
    /**
     * @var UserRepository
     */
    private $user;


    /**
     * VerifiedMatchController constructor.
     * @param Guard $auth
     * @param VerifiedMatchRepository $verifiedMatch
     * @param PotentialMatchRepository $potentialMatch
     * @param ChatRepository $chat
     * @param UserRepository $user
     */
    public function __construct(Guard $auth, VerifiedMatchRepository $verifiedMatch, PotentialMatchRepository $potentialMatch, ChatRepository $chat, UserRepository $user)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->verifiedMatch = $verifiedMatch;
        $this->potentialMatch = $potentialMatch;
        $this->chat = $chat;
        $this->user = $user;
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

    public function delete($id)
    {
        // TODO
        $authid = $this->auth->user()->id;
        $otherUser = $this->user->find($id);
        $this->verifiedMatch->delete($authid, $id);
        $this->potentialMatch->delete($authid, $id);
        $this->chat->deleteAllMessagesOfMatches($authid, $id);

        $pusher = App::make('pusher');

        $pusher->trigger( 'gocon-channel',
            'user-notify-' . $authid,
            array('text' => $otherUser->voornaam . ' succesvol gedelete.'));

        return redirect()->to('/profile');
    }

}
