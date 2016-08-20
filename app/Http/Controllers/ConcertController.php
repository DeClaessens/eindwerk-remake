<?php

namespace App\Http\Controllers;

use App\Concert\ConcertRepository;
use App\HTTPClient\GuzzleHTTPClientRepository;
use App\PotentialMatch\PotentialMatchRepository;
use App\User\UserRepository;
use App\UserConcert\UserConcertRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;
use App\Http\Requests;

class ConcertController extends Controller
{
    /**
     * @var ConcertRepository
     */
    private $concert;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var UserConcertRepository
     */
    private $userConcert;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var GuzzleHTTPClientRepository
     */
    private $guzzle;
    /**
     * @var PotentialMatchRepository
     */
    private $potentialMatch;

    /**
     * Create a new controller instance.
     *
     * @param ConcertRepository $concert
     * @param Guard $auth
     * @param UserConcertRepository $userConcert
     * @param UserRepository $user
     * @param GuzzleHTTPClientRepository $guzzle
     * @param PotentialMatchRepository $potentialMatch
     */
    public function __construct(ConcertRepository $concert, Guard $auth, UserConcertRepository $userConcert, UserRepository $user, GuzzleHTTPClientRepository $guzzle, PotentialMatchRepository $potentialMatch)
    {
        $this->middleware('auth');
        $this->concert = $concert;
        $this->auth = $auth;
        $this->userConcert = $userConcert;
        $this->user = $user;
        $this->guzzle = $guzzle;
        $this->potentialMatch = $potentialMatch;
    }

    public function showAllConcerts() {
        //load concerts from the database through the concert model.
        $concerts = $this->concert->getAllUpcomingConcerts();

        return view('concertSelect', compact('concerts'));
    }

    public function getAllConcertsFromApiAndSaveToDatabase() {
        $client = $this->guzzle->generateClient('http://api.songkick.com');
        ///////////////sportpaleis/ab/////lotto arena//forest national//de roma//palais 12//depot//vooruit//Charlan//capitole
        $venueArray = ['569556', '29622', '56494', '31696', '583421', '2037269', '32003', '806981', '582451', '104956'];
        $concertArray = $this->guzzle->getConcertArrayWithApiResults($client, $venueArray);

        foreach($concertArray as $concert) {
            if(!$this->concert->find($concert->id)){
                $newConcert = $this->concert->make();
                $newConcert->id = $concert->id;
                $newConcert->name = $concert->displayName;
                $newConcert->status = $concert->status;
                $newConcert->venue = $concert->venue->displayName;
                $newConcert->concertImageUrl = "http://images.sk-static.com/images/media/profile_images/artists/" . $concert->performance[0]->artist->id . "/huge_avatar";
                $newConcert->concertUrl = $concert->uri;
                $newConcert->date = $concert->startDate;
                $newConcert->event_passed = false;

                $this->concert->save($newConcert);
            } else {
                $concert = $this->concert->find($concert->id);
                $today = date("d/m/Y");
                $expire = $concert->date; //from db

                $today_time = strtotime($today);
                $expire_time = strtotime($expire);

                if ($expire_time < $today_time){
                    $concert->event_passed = true;
                }

                $this->concert->save($concert);

            }
        }
    }

    public function showConcertLanding($concert_id)
    {
        $selectedConcert = $this->concert->find($concert_id);
        $api = new SpotifyWebAPI();
        $topTracks = '';
        $searchArtist = $api->search($selectedConcert->name, 'artist', array(
            'market' => 'be'
        ));

        if($searchArtist->artists->total != 0) {
            $searchArtistId = $searchArtist->artists->items[0]->id;
            $topTracks = $api->getArtistTopTracks($searchArtistId, array(
                'country' => 'be'
            ));
        }

        $amountOfUsers = $this->userConcert->countAllUsersFromConcert($concert_id);

        return view('concerts.landing', compact('selectedConcert', 'topTracks', 'amountOfUsers'));
    }

    public function findSolo($concert_id)
    {
        //save user and concert id to a joined DB with relationships to both
        //-- create db (check)
        //-- -- create relationships in model (check)
        //-- -- -- save data

        $user = $this->auth->user();

        $concert = $this->concert->find($concert_id);

        if($existingUserConcert = !$this->userConcert->searchUserConcerts($user->id, $concert->id)) {
            $newUserConcert = $this->userConcert->make();
            $newUserConcert->user_id = $user->id;
            $newUserConcert->concert_id = $concert->id;
            $this->userConcert->save($newUserConcert);
        }

        $users = $this->userConcert->getAllUsersFromConcert($user->id, $concert_id);
        $usersCollection = [];
        //fill collection with user data

        $counter = 0;
        $shuffledUsers = $users->shuffle();
        foreach($shuffledUsers as $concertUser) {
            if(!$this->potentialMatch->checkIfOneSidedMatch($user->id, $concertUser->user_id, $concert->id))
            {
                array_push($usersCollection, $this->user->find($concertUser->user_id));
            }
            $counter++;
        }

        return view('concerts.swipe', compact('usersCollection', 'concert_id', 'concert'));
    }

}