<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VerifiedMatchController extends Controller
{
    //


    /**
     * VerifiedMatchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
