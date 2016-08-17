<?php

namespace App\VerifiedMatch;

use Illuminate\Database\Eloquent\Model;

class VerifiedMatch extends Model
{
    protected $table = 'verifiedmatches';

    public $timestamps = false;

    public function matchedUser()
    {
        return $this->belongsTo('App\User\User', 'user2');
    }

    public function matchedConcert()
    {
        return $this->belongsTo('App\Concert\Concert', 'concert_id');
    }
}
