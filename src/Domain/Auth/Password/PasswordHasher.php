<?php
namespace App\Domain\Auth\Password;

interface PasswordHasher
{
    public function hash(Password $password): HashedPassword;
}
