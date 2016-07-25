<?php

namespace App\VerifiedMatch;

use Illuminate\Database\Eloquent\Model;

class VerifiedMatch extends Model
{
    protected $table = 'verifiedmatches';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
