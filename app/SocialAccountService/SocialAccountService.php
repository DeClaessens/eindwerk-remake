<?php

namespace App\SocialAccountService;

use App\User\User;
use App\User\UserRepository;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Vinkla\Facebook\FacebookManager;

class SocialAccountService
{
    /**
     * @var UserRepository
     */
    private $userRepo;
    /**
     * @var FacebookManager
     */
    private $facebook;


    /**
     * SocialAccountService constructor.
     * @param UserRepository $userRepo
     * @param FacebookManager $facebook
     */
    public function __construct(UserRepository $userRepo, FacebookManager $facebook)
    {
        $this->userRepo = $userRepo;
        $this->facebook = $facebook;
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

                $auth_token = $providerUser->token;

                $query = $this->facebook->get('/me?fields=id,name, first_name, last_name', $auth_token);
                $response = $query->getGraphUser();

                $newUser = $this->userRepo->make();

                $newUser->name = $response['last_name'];
                $newUser->voornaam = $response['first_name'];
                $newUser->email = $providerUser->getEmail();
                $newUser->provider = 'facebook';
                $newUser->provider_user_id = $auth_token;
                $newUser->imageUrl = $providerUser->avatar_original;

                $this->userRepo->save($newUser);

                return $newUser;

            }

            return $user;

        }

    }
}