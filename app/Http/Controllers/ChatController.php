<?php

namespace App\Http\Controllers;

use App\Chat\ChatRepository;
use App\User\UserRepository;
use App\VerifiedMatch\VerifiedMatchRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChatController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var ChatRepository
     */
    private $chat;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var VerifiedMatchRepository
     */
    private $verifiedmatch;

    /**
     * ChatController constructor.
     * @param Guard $auth
     * @param ChatRepository $chat
     * @param UserRepository $user
     * @param VerifiedMatchRepository $verifiedmatch
     */
    public function __construct(Guard $auth, ChatRepository $chat, UserRepository $user, VerifiedMatchRepository $verifiedmatch)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->chat = $chat;
        $this->user = $user;
        $this->verifiedmatch = $verifiedmatch;
    }

    public function index()
    {
        $user = $this->auth->user();
        $verifiedmatches = $this->verifiedmatch->findAllMatches($user->id);
        $alreadyFoundArray = [];
        $lastMessageArray = [];
        $uniqueVerifiedMatchArray = [];

        foreach($verifiedmatches as $match){
            $found = false;
            for($i = 0; $i < count($alreadyFoundArray); $i++){
                if($alreadyFoundArray[$i] == $match->user2) {
                    $found = true;
                }
            }

            if(!$found){
                array_push($alreadyFoundArray, $match->user2);
                array_push($uniqueVerifiedMatchArray, $match);
                array_push($lastMessageArray, $this->chat->getLastMessageFromThread($user->id, $match->user2));
            }
        }
        return view('chat.index', compact('uniqueVerifiedMatchArray', 'lastMessageArray'));
    }

    public function showChat($id)
    {
        $authUser = $this->auth->user();
        $otherUser = $this->user->find($id);
        $matchedConcerts = $this->verifiedmatch->findAllConcertsMatched($authUser->id, $otherUser->id);

        $messages = $this->chat->getMessagesFromMatch($authUser->id, $otherUser->id);

        return view('chat.solo', compact('authUser', 'otherUser', 'matchedConcerts', 'messages'));
    }

    public function sendMessage(Request $request, $id)
    {
        $authUser = $this->auth->user();
        $otherUser = $this->user->find($id);

        $newChat = $this->chat->make();

        $newChat->sender = $authUser->id;
        $newChat->receiver = $otherUser->id;
        $newChat->message = $request->message;

        $this->chat->save($newChat);

        return redirect()->back();
    }
}