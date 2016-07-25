<?php
namespace App\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function userconcerts()
    {
        return $this->hasMany('App\UserConcert');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }

    public function verifiedmatch()
    {
        return $this->hasMany('App\VerifiedMatch');
    }

    public function potentialmatch()
    {
        return $this->hasMany('App\PotentialMatch');
    }
}
