<?php

namespace App\Http\Controllers;

use App\Concert\ConcertRepository;
use App\HTTPClient\GuzzleHTTPClientRepository;
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
     * Create a new controller instance.
     *
     * @param ConcertRepository $concert
     * @param Guard $auth
     * @param UserConcertRepository $userConcert
     * @param UserRepository $user
     * @param GuzzleHTTPClientRepository $guzzle
     */
    public function __construct(ConcertRepository $concert, Guard $auth, UserConcertRepository $userConcert, UserRepository $user, GuzzleHTTPClientRepository $guzzle)
    {
        $this->middleware('auth');
        $this->concert = $concert;
        $this->auth = $auth;
        $this->userConcert = $userConcert;
        $this->user = $user;
        $this->guzzle = $guzzle;
    }

    public function showAllConcerts() {
        //load concerts from the database through the concert model.
        $concerts = $this->concert->getAllConcerts();

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

                $this->concert->save($newConcert);
            }
        }
    }

    public function showConcertLanding($concert_id)
    {
        $selectedConcert = $this->concert->find($concert_id);
        $api = new SpotifyWebAPI();
        $searchArtist = $api->search($selectedConcert->name, 'artist', array(
            'market' => 'be'
        ));
        $searchArtistId = $searchArtist->artists->items[0]->id;
        $topTracks = $api->getArtistTopTracks($searchArtistId, array(
            'country' => 'be'
        ));

        return view('concerts.landing', compact('selectedConcert', 'topTracks'));
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
        foreach($users as $user) {
            array_push($usersCollection, $this->user->find($user->user_id));
            $counter++;
        }

        return view('concerts.swipe', compact('usersCollection', 'concert_id'));
    }

}