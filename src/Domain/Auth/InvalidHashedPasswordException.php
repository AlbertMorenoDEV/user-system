<?php
namespace App\Domain\Auth;

class InvalidHashedPasswordException extends \Exception
{
    public const MESSAGE_EMPTY = 'Can not be empty';
}
