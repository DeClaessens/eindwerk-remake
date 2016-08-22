<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function bridge()
    {
        $pusher = App::make('pusher');

        $pusher->trigger( 'test-channel',
            'test-event',
            array('text' => 'Preparing the Pusher Laracon.eu workshop!'));
    }
}
