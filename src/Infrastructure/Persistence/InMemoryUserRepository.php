<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Auth\Password\Password;
use App\Domain\Auth\User;
use App\Domain\Auth\UserName\UserName;
use App\Domain\Auth\UserNotFoundException;
use App\Domain\Auth\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    /** @var User[] */
    private $users;

    /**
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     */
    public function __construct()
    {
        $this->users = [
            new User(UserName::fromString('test_user'), Password::fromString('123456')),
            new User(UserName::fromString('test_user_2'), Password::fromString('123456')),
            new User(UserName::fromString('test_user_3'), Password::fromString('123456')),
            new User(UserName::fromString('test_user_4'), Password::fromString('123456')),
        ];
    }

    /**
     * @throws UserNotFoundException
     */
    public function findOneByUsername(UserName $username): User
    {
        foreach ($this->users as $user) {
            if ($user->userName()->equals($username)) {
                return $user;
            }
        }

        throw new UserNotFoundException(UserNotFoundException::MESSAGE);
    }
}
