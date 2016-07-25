<?php

namespace App\SocialAccountService;

use App\User\User;
use App\User\UserRepository;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    /**
     * @var UserRepository
     */
    private $userRepo;


    /**
     * SocialAccountService constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

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

                $newUser = $this->userRepo->make();

                $newUser->name = $providerUser->getName();
                $newUser->email = $providerUser->getEmail();
                $newUser->provider = 'facebook';
                $newUser->provider_user_id = $providerUser->getId();

                $this->userRepo->save($newUser);

                return $newUser;

            }

            return $user;

        }

    }
}