<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/06/16
 * Time: 12:40
 */

namespace App\Chat;


use Illuminate\Contracts\Auth\Guard;

class EloquentChatRepository implements ChatRepository
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var Chat
     */
    private $model;

    /**
     * EloquentChatRepository constructor.
     * @param Guard $auth
     * @param Chat $chat
     */
    public function __construct(Guard $auth, Chat $model)
    {
        $this->auth = $auth;
        $this->model = $model;
    }

    public function make()
    {
        return $this->model->newInstance();
    }

    public function save($chat)
    {
        $chat->save();
    }

    public function getMessagesFromMatch($user1, $user2)
    {
        $query = $this->model->where(function ($query) use ($user1, $user2) {
            $query->where('sender', $user1)
                ->where('receiver', $user2);
        })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('receiver', $user1)
                    ->where('sender', $user2);
            })
            ->get();
        return $query;
    }
}