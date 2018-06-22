<?php
namespace App\Application\Auth;

use App\Domain\Auth\Password\Password;
use App\Domain\Auth\UserName\UserName;

class LoginRequest
{
    private $userName;
    private $password;

    /**
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     * @throws InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     */
    public function __construct(?string $userName, ?string $password)
    {
        $this->guard($userName, $password);

        $this->userName = UserName::fromString($userName);
        $this->password = Password::fromString($password);
    }

    public function userName(): UserName
    {
        return $this->userName;
    }

    public function password(): Password
    {
        return $this->password;
    }

    /**
     * @throws InvalidRequestParametersException
     */
    private function guard(?string $userName, ?string $password): void
    {
        if ($userName === null) {
            throw new InvalidRequestParametersException(InvalidRequestParametersException::MESSAGE_INVALID_USERNAME);
        }

        if ($password === null) {
            throw new InvalidRequestParametersException(InvalidRequestParametersException::MESSAGE_INVALID_PASSWORD);
        }
    }
}
