<?php
namespace App\PotentialMatch;


interface PotentialMatchRepository
{
    /**
     * @return PotentialMatch
     */
    public function make();

    /**
     * @param $potentialMatch
     */
    public function save($potentialMatch);

    /**
     * @param $user1
     * @param $user2
     * @param $concert_id
     * @return mixed
     */
    public function checkIfMatch($user1, $user2, $concert_id);

    public function checkIfOneSidedMatch($user1, $user2, $concert_id);

    public function delete($authId, $id);
}