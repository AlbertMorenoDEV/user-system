<?php
namespace App\Tests\Unit\Domain\Auth;

use App\Domain\Auth\Password\InvalidPasswordException;
use App\Domain\Auth\Password\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @test
     * @throws InvalidPasswordException
     */
    public function shouldNotBeLargerThanMaximumAllowedCharacters(): void
    {
        $this->expectException(InvalidPasswordException::class);
        $this->expectExceptionMessage(InvalidPasswordException::MESSAGE_TOO_LONG);

        $password = str_pad('', Password::MAXIMUM_CHARACTERS*2, 'a');

        Password::fromString($password);
    }

    /**
     * @test
     * @throws InvalidPasswordException
     */
    public function shouldNotBeEmpty(): void
    {
        $this->expectException(InvalidPasswordException::class);
        $this->expectExceptionMessage(InvalidPasswordException::MESSAGE_EMPTY);

        $password = '';

        Password::fromString($password);
    }
}
