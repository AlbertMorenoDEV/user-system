<?php
namespace App\Application\Auth;

class InvalidPasswordException extends \Exception
{
    public const MESSAGE = 'Invalid password';
}
