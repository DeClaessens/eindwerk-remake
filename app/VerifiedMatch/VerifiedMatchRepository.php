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
    public function findAllMatches($user1);

    /**
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public function checkIfUsersMatch($user1, $user2);

    /**
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public function findAllConcertsMatched($user1, $user2);

    public function countAllConcertsMatched($user1, $user2);

    public function matchUsersTogether($user1, $user2, $concertId);

    public function findXLastMatchesById($id, $amount);

    public function delete($verifiedMatch);
}