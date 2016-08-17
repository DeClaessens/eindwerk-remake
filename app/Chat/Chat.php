<?php
namespace App\Chat;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    public function senderUser(){
        return $this->belongsTo('App\User\User', 'sender');
    }
    public function receiverUser(){
        return $this->belongsTo('App\User\User', 'sender');
    }
}
