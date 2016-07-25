<?php
namespace App\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];
}
