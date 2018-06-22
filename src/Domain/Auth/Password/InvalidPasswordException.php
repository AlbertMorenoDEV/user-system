<?php
namespace App\Domain\Auth\Password;

class InvalidPasswordException extends \Exception
{
    public const MESSAGE_TOO_LONG = 'Maximum number of characters exceeded';
    public const MESSAGE_EMPTY = 'Can not be empty';
}
