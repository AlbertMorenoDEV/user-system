<?php
namespace App\Infrastructure\Security;

use App\Domain\Auth\Password\HashedPassword;
use App\Domain\Auth\Password\Password;
use App\Domain\Auth\Password\PasswordHasher;

class BcryptPasswordHasher implements PasswordHasher
{
    private const COST = 12;

    /**
     * @throws \App\Domain\Auth\Password\InvalidHashedPasswordException
     */
    public function hash(Password $password): HashedPassword
    {
        return HashedPassword::fromString(password_hash($password->value(), PASSWORD_BCRYPT, ['cost' => self::COST]));
    }
}
