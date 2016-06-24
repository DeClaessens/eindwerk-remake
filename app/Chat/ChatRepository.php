<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/06/16
 * Time: 12:39
 */

namespace App\Chat;


interface ChatRepository
{
    /**
     * @return Chat
     */
    public function make();

    /**
     * @param $chat
     */
    public function save($chat);

    /**
     * @param $user1
     * @param $user2
     * @return mixed
     */
    public static function getMessagesFromMatch($user1, $user2);
}