<?php
namespace App\Domain\Auth\Password;

class InvalidHashedPasswordException extends \Exception
{
    public const MESSAGE_EMPTY = 'Can not be empty';
}
