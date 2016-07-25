<?php
namespace App\Concert;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $table = 'concerts';

    public function userconcerts()
    {
        return $this->hasMany('App\UserConcert');
    }

    public static function getAllConcerts(){
        return Concert::all();
    }
}
