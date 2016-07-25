<?php

namespace App\SocialAccountService;

use App\User\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $user = User::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($user) {
            return $user;
        } else {

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => 'facebook',
                ]);
            }

            $user->save();

            return $user;

        }

    }
}