<?php
namespace App\Domain\Auth;

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
