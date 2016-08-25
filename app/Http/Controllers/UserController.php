<?php

namespace App\Http\Controllers;

use App\Chat\ChatRepository;
use App\Concert\ConcertRepository;
use App\VerifiedMatch\VerifiedMatchRepository;
use App\User\UserRepository;
use Facebook\Facebook;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Vinkla\Facebook\FacebookManager;

class UserController extends Controller
{
    private $auth;
    /**
     * @var VerifiedMatchRepository
     */
    private $verifiedMatch;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var ChatRepository
     */
    private $chat;
    /**
     * @var ConcertRepository
     */
    private $concert;

    /**
     * UserController constructor.
     * @param Guard $auth
     * @param VerifiedMatchRepository $verifiedMatch
     * @param UserRepository $user
     * @param ChatRepository $chat
     * @param ConcertRepository $concert
     */
    public function __construct(Guard $auth, VerifiedMatchRepository $verifiedMatch, UserRepository $user, ChatRepository $chat, ConcertRepository $concert)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->verifiedMatch = $verifiedMatch;
        $this->user = $user;
        $this->chat = $chat;
        $this->concert = $concert;

    }

    public function profile(){
        $user = $this->auth->user();
        $matches = $this->verifiedMatch->findAllMatches($user->id);
        $matchedusers = [];

        $array_counter = 0;

        foreach($matches as $match) {
            if($match->user1 == $this->auth->user()->id) {
                $foundUser = $this->user->find($match->user2);
                $matchedusers[$array_counter] = $foundUser;
            } else {
                $foundUser = $this->user->find($match->user1);
                $matchedusers[$array_counter] = $foundUser;
            }

            $array_counter++;
        }
        $recentmessages = $this->chat->getXLastMessages($user->id, 2);
        $fivelastmatches = $this->verifiedMatch->findXLastMatchesById($user->id, 5);
        $upcomingconcerts = $this->concert->getUpcomingConcerts(5);
        $newMessages = $this->chat->countUnreadMessages($user->id);
        $newMatches = $this->verifiedMatch->countUnreadMatches($user->id);

        return view('profile.profile', compact('user', 'matchedusers', 'fivelastmatches', 'recentmessages', 'upcomingconcerts', 'newMessages', 'newMatches'));
    }

    public function userPage($id) {
        $user = $this->user->find($id);
        $authUser = $this->auth->user();
        $doyoumatch = $this->verifiedMatch->findMatch($authUser->id, $id);

        if($doyoumatch) {

            if($doyoumatch->new_match == true) {
                $doyoumatch->new_match = false;

                $this->verifiedMatch->save($doyoumatch);
            }
        }

        $concertsMatched = $this->verifiedMatch->findAllConcertsMatched($authUser->id, $user->id);

        return view('user.profile', compact('user', 'doyoumatch', 'concertsMatched'));
    }

    public function edit() {
        $user = $this->auth->user();

        return view('profile.edit', compact('user'));
    }

    public function saveProfile(Request $request) {
        $this->validate($request, [
            'imageUrl' => 'image',
        ]);

        //TODO: Build a check for image
        //find authenticated user to edit
        $editUser = $this->user->find($this->auth->user()->id);

        if($request->file('imageUrl') != null) {
            //if there is a previous image url, delete it.
            if ($editUser->imageUrl != '') {
                File::delete($editUser->imageUrl);
            }
            $imageName = $editUser->id . substr(md5(microtime()),rand(0,26),5) . $request->file('imageUrl')->getClientOriginalName();
            Image::make($request->file('imageUrl'))->orientate()->save(base_path() . '/public/uploads/users/images/' . $imageName);
            //save image to public/uploads/users/images and give it a prefixed name with user id to prevent overwrites
            //$imageName = $editUser->id . $request->file('imageUrl')->getClientOriginalName();
            //$path = base_path() . '/public/uploads/users/images/';
            //$request->file('imageUrl')->move($path, $imageName);

            $editUser->imageUrl = '/uploads/users/images/' . $imageName;
        }

        $editUser->bio = $request->bio;
        $editUser->favoriteArtists = $request->favoriteArtists;

        $this->user->save($editUser);

        //so we can pass a nice parameter.
        $user = $editUser;

        return redirect()->to('/profile');
    }

    public function showNewPassword(){
        $user = $this->auth->user();

        return view('profile.setPassword', compact('user'));
    }

    public function saveNewPassword(Request $request){
        $user = $this->user->find($this->auth->user()->id);

        $user->password = Hash::make($request->password);

        $this->user->save($user);

        return redirect()->to('/profile');
    }
}