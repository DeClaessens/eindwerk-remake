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
    public function getMessagesFromMatch($user1, $user2);

    /**
     * @param $user1
     * @param $amount
     * @return mixed
     */
    public function getXLastMessages($user1, $amount);

    public function getLastMessageFromThread($user1, $user2);

    public function deleteAllMessagesOfMatches($authid, $id);
}