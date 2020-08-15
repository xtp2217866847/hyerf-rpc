<?php


namespace App\Rpc;


interface UserServiceInterface
{
    public function getUserById(int $id);
}