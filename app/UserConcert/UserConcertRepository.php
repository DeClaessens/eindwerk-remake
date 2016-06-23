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
    public function make();
    public function save($userConcert);
    public function searchUserConcerts($user_id, $concert_id);
    public function getAllUsersFromConcert($user_id, $concert_id);
}