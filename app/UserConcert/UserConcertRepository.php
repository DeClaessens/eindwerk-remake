<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 14:33
 */

namespace App\UserConcert;


interface UserConcertRepository
{
    /**
     * @return UserConcert
     */
    public function make();

    /**
     * @param $userConcert
     */
    public function save($userConcert);

    /**
     * @param $user_id
     * @param $concert_id
     * @return mixed
     */
    public function searchUserConcerts($user_id, $concert_id);


    /**
     * @param $user_id
     * @param $concert_id
     * @return mixed
     */
    public function getAllUsersFromConcert($user_id, $concert_id);
}