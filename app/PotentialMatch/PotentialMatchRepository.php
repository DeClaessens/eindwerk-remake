<?php
namespace App\PotentialMatch;


interface PotentialMatchRepository
{
    public function make();
    public function save($potentialMatch);
    public function checkIfMatch($user1, $user2, $concert_id);
}