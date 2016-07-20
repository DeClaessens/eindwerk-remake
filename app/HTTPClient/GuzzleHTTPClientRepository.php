<?php
namespace App\HTTPClient;

use Illuminate\Contracts\Auth\Guard;
use GuzzleHttp\Client;

class GuzzleHTTPClientRepository implements HTTPClientRepository
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * EloquentChatRepository constructor.
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function generateClient($base_uri) {
        return new Client(['base_uri' => $base_uri]); //return the Guzzle Client to the controller.
    }

    public function makeAPICall($client, $url) {
        $response = $client->get($url);
        $obj = $response->getBody();
        return json_decode($obj);
    }

    public function getConcertArrayWithApiResults($client, $venueArray) {
        $col = new \Illuminate\Database\Eloquent\Collection();
        $tmpArray = [];
        foreach ($venueArray as $venue) {
            $obj = $this->makeAPICall($client, "api/3.0/venues/" . $venue . "/calendar.json?apikey=" . env('SONGKICK_APIKEY'));

            foreach ($obj->resultsPage->results->event as $concert) {
                $concert->startDate = $concert->start->date;
                $name = $concert->performance[0]->displayName;
                //$concert->imageUrl = $this->findImageForArtist($name);

                if(strpos($concert->displayName, ' at ') !== false) {
                    $concert->displayName = substr($concert->displayName, 0, strrpos( $concert->displayName, ' at '));
                }

                if(strpos($concert->displayName, ' with ') !== false) {
                    $concert->displayName = substr($concert->displayName, 0, strrpos( $concert->displayName, ' with '));
                }

                $col->add($concert);
            }
        }
        $col = $col->sortBy("startDate");
        return $col;
    }
}