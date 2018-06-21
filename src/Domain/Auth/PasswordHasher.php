<?php
namespace App\Domain\Auth;

interface PasswordHasher
{
    public function hash(Password $password): HashedPassword;
}
