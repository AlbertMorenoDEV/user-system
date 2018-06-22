<?php
namespace App\Tests\Unit\Domain\Auth;

use App\Domain\Auth\UserName\InvalidUsernameException;
use App\Domain\Auth\UserName\UserName;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class UserNameTest extends TestCase
{
    /**
     * @test
     * @throws InvalidUsernameException
     */
    public function shouldNotBeLargerThanMaximumAllowedCharacters(): void
    {
        $this->expectException(InvalidUsernameException::class);
        $this->expectExceptionMessage(InvalidUsernameException::MESSAGE_TOO_LONG);

        $username = str_pad('', UserName::MAXIMUM_CHARACTERS*2, 'a');

        UserName::fromString($username);
    }

    /**
     * @test
     * @throws InvalidUsernameException
     */
    public function shouldNotBeEmpty(): void
    {
        $this->expectException(InvalidUsernameException::class);
        $this->expectExceptionMessage(InvalidUsernameException::MESSAGE_EMPTY);

        $username = '';

        UserName::fromString($username);
    }
}
