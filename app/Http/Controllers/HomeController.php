<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->auth->check()) {
            //user is already logged in, go straight to profile
            return redirect()->to('/profile');
        } else {
            return view('home');
        }
    }

    public function goToLogin() {
        if($this->auth->check()) {
            //user is already logged in, go straight to profile
            return redirect()->to('/profile');
        } else {
            return view('auth.login');
        }
    }
}
