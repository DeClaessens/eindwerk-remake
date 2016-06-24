<?php
namespace App\VerifiedMatch;


interface VerifiedMatchRepository
{
    public function make();
    public function save();
    public static function findAllMatches($user1);
    public static function checkIfUsersMatch($user1, $user2);
    public function findAllConcertsMatched($user1, $user2);
}