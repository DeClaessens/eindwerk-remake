<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

use App\SocialAccountService\SocialAccountService;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $socialAccountService, Request $request)
    {

        $user = $socialAccountService->createOrGetUser(\Socialite::driver('facebook')->stateless()->user());

        auth()->login($user);

        return redirect()->to('/home');

    }
}