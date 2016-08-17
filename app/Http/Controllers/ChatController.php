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