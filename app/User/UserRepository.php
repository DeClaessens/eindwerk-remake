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
    public function make();
    public function save($user);
}