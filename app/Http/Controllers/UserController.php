<?php

namespace App\Http\Controllers;

use App\VerifiedMatch\VerifiedMatchRepository;
use App\User\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
     * UserController constructor.
     */
    public function __construct(Guard $auth, VerifiedMatchRepository $verifiedMatch, UserRepository $user)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->verifiedMatch = $verifiedMatch;
        $this->user = $user;
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

        return view('profile.profile', compact('user', 'matchedusers'));
    }

    public function userPage($id) {
        $user = $this->user->find($id);
        $authUser = $this->auth->user();
        $doyoumatch = $this->verifiedMatch->checkIfUsersMatch($id, $authUser->id);

        return view('user.profile', compact('user', 'doyoumatch'));
    }

    public function edit() {
        return view('profile.edit', compact('user'));
    }

    public function saveProfile(Request $request) {
        $this->validate($request, [
            'imageUrl' => 'image',
        ]);

        //find authenticated user to edit
        $editUser = $this->user->find($this->auth->user()->id);

        //if there is a previous image url, delete it.
        if($editUser->imageUrl != ''){
            File::delete($editUser->imageUrl);
        }

        //save image to public/uploads/users/images and give it a prefixed name with user id to prevent overwrites
        $imageName = $editUser->id . $request->file('imageUrl')->getClientOriginalName();
        $path = base_path() . '/public/uploads/users/images/';
        $request->file('imageUrl')->move($path , $imageName);

        $editUser->imageUrl = '/uploads/users/images/' . $imageName;
        $editUser->bio = $request->bio;
        $editUser->favoriteArtists = $request->favoriteArtists;

        $this->user->save($editUser);

        //so we can pass a nice parameter.
        $user = $editUser;

        return view('profile.profile', compact('user'));
    }
}
