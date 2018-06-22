<?php
namespace App\Domain\Auth;

use App\Domain\Auth\UserName\UserName;

interface UserRepository
{
    /**
     * @throws UserNotFoundException
     */
    public function findOneByUsername(UserName $username): User;
}
