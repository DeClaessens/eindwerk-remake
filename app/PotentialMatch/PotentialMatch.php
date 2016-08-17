<?php

namespace App\PotentialMatch;

use Illuminate\Database\Eloquent\Model;

class PotentialMatch extends Model
{
    protected $table = 'potentialmatches';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User\User', 'user2');
    }
}
