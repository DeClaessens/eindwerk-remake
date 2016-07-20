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
use App\HTTPClient\HTTPClientRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
     * @var HTTPClientRepository
     */
    private $httpClient;

    /**
     * HomeController constructor.
     * @param Guard $auth
     * @param Concert|ConcertRepository $concert
     * @param HTTPClientRepository $httpClient
     */
    public function __construct(Guard $auth, ConcertRepository $concert, HTTPClientRepository $httpClient)
    {
        $this->auth = $auth;
        $this->concert = $concert;
        $this->httpClient = $httpClient;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }

    public function saveConcertsToDatabase()
    {
        ///////////////sportpaleis/ab/////lotto arena//forest national//de roma//palais 12//depot//vooruit//Charlan//capitole
        $venueArray = ['569556', '29622', '56494', '31696', '583421', '2037269', '32003', '806981', '582451', '104956'];
        $client = $this->httpClient->generateClient('http://api.songkick.com');
        $concertArray = $this->getConcertArrayWithApiResults($client, $venueArray);

        dd($concertArray);

        foreach($concertArray as $concert) {
            if(!Concert::find($concert->id)){
                $newConcert = new Concert();
                $newConcert->id = $concert->id;
                $newConcert->name = $concert->displayName;
                $newConcert->status = $concert->status;
                $newConcert->venue = $concert->venue->displayName;
                $newConcert->concertImageUrl = "http://images.sk-static.com/images/media/profile_images/artists/" . $concert->performance[0]->artist->id . "/huge_avatar";
                $newConcert->concertUrl = $concert->uri;
                $newConcert->date = $concert->startDate;

                $newConcert->save();
            }
        }
    }


    public function findImageForArtist($name) {
        http://developer.echonest.com/api/v4/artist/images?api_key=DJQLBWZKAFCJTZBGF&id=ARH6W4X1187B99274F&format=json&results=1&start=0&license=unknown
        $client2 = new \GuzzleHttp\Client(['base_uri' => 'http://developer.echonest.com/api/v4/']);
        $response2 = $client2->get("artist/images?api_key=" . env('ECHONEST_APIKEY') . "&name=" . urlencode($name) . "&format=json&results=4&start=0");
        $obj2 = json_decode($response2->getBody());
    }
}