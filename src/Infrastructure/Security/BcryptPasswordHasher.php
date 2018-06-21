<?php
namespace App\Infrastructure\Security;

use App\Domain\Auth\HashedPassword;
use App\Domain\Auth\Password;
use App\Domain\Auth\PasswordHasher;

class BcryptPasswordHasher implements PasswordHasher
{
    private const COST = 12;

    /**
     * @throws \App\Domain\Auth\InvalidHashedPasswordException
     */
    public function hash(Password $password): HashedPassword
    {
        return HashedPassword::fromString(password_hash($password->value(), PASSWORD_BCRYPT, ['cost' => self::COST]));
    }
}
