<?php
namespace App\UserConcert;

use Illuminate\Database\Eloquent\Model;

class UserConcert extends Model
{
    protected $table = "userconcert";

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User\User', 'user_id');
    }
    public function concert()
    {
        return $this->belongsTo('App\Concert\User', 'concert_id');
    }
}
