<?php
namespace App\Domain\Auth;

interface UserRepository
{
    /**
     * @throws UserNotFoundException
     */
    public function findOneByUsername(UserName $username): User;
}
