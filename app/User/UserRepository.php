<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23/06/16
 * Time: 13:46
 */

namespace App\User;


interface UserRepository
{
    /**
     * @return User
     */
    public function make();

    /**
     * @param $user
     */
    public function save($user);

    public function find($id);
}