<?php
namespace App\Concert;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $table = 'concerts';
    protected $dates = ['date'];

    public function userconcerts()
    {
        return $this->hasMany('App\UserConcert\UserConcert');
    }

    public static function getAllConcerts(){
        return Concert::all();
    }
}
