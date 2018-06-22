<?php
namespace App\Domain\Auth;

use App\Domain\Auth\Password\Password;
use App\Domain\Auth\UserName\UserName;

class User
{
    private $userName;
    private $password;

    public function __construct(UserName $userName, Password $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    public function userName(): UserName
    {
        return $this->userName;
    }

    public function password(): Password
    {
        return $this->password;
    }
}
