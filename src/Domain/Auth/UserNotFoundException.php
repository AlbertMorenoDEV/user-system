<?php
namespace App\Domain\Auth;

class UserNotFoundException extends \Exception
{
    public const MESSAGE = 'The user does not exist';
}
