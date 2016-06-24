<?php
namespace App\VerifiedMatch;


interface VerifiedMatchRepository
{
    /**
     * @return VerifiedMatch
     */
    public function make();

    /**
     * @param $verifiedMatch
     */
    public function save($verifiedMatch);

    /**
     * @param $user1
     * @return mixed
     */
    public static function findAllMatches($user1);

    /**
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public static function checkIfUsersMatch($user1, $user2);

    /**
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public function findAllConcertsMatched($user1, $user2);
}