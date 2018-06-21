<?php
namespace App\Application\Auth;

class InvalidRequestParametersException extends \Exception
{
    public const MESSAGE_INVALID_USERNAME = 'Invalid username';
    public const MESSAGE_INVALID_PASSWORD = 'Invalid password';
}
