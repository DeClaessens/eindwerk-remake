<?php
namespace App\HTTPClient;

interface HTTPClientRepository
{
    public function generateClient($base_uri);
    public function makeAPICall($client, $url);
    public function getConcertArrayWithApiResults($client, $venueArray);
}