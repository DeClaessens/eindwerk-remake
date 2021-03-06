<?php
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
     * @param Chat $model
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

    public function getAllMessageUsers()
    {

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

    public function getXLastMessages($user1, $amount)
    {
        $query = $this->model->where('receiver', $user1)->groupBy('sender')->limit($amount)->get();

        return $query;
    }

    public function getLastMessageFromThread($user1, $user2)
    {
        $query = $this->model->where(function ($query) use ($user1, $user2) {
            $query->where('sender', $user1)
                ->where('receiver', $user2);
        })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('receiver', $user1)
                    ->where('sender', $user2);
            })
            ->orderBy('id', 'desc')
            ->first();
        return $query;
    }

    public function deleteAllMessagesOfMatches($authid, $id)
    {
        $query = $this->model->where(function ($query) use ($authid, $id) {
            $query->where('sender', $authid)
                ->where('receiver', $id);
        })
            ->orWhere(function ($query) use ($authid, $id) {
                $query->where('receiver', $authid)
                    ->where('sender', $id);
            })
            ->get();

        for($i = 0; $i < count($query); $i++) {
            $query[$i]->delete();
        }

        return 1;
    }

    public function countUnreadMessages($authid)
    {
        $query = $this->model->where('receiver', $authid)->where('is_read', false)->count();

        return $query;
    }
}