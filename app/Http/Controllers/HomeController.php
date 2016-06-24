<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 14:47
 */

namespace App\Http\Controllers;


use App\Concert\Concert;
use App\Concert\ConcertRepository;
use Illuminate\Contracts\Auth\Guard;

class HomeController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var ConcertRepository
     */
    private $concert;


    /**
     * HomeController constructor.
     * @param Guard $auth
     * @param Concert $concert
     */
    public function __construct(Guard $auth, ConcertRepository $concert)
    {
        $this->auth = $auth;
        $this->concert = $concert;
    }

    public function testConcerts()
    {
        dd($this->concert->getAll());
    }
}