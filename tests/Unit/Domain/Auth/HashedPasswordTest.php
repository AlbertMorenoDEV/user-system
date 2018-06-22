<?php
namespace App\Tests\Unit\Domain\Auth;

use App\Domain\Auth\Password\HashedPassword;
use App\Domain\Auth\Password\InvalidHashedPasswordException;
use App\Domain\Auth\Password\Password;
use PHPUnit\Framework\TestCase;

class HashedPasswordTest extends TestCase
{
    /**
     * @test
     * @throws InvalidHashedPasswordException
     */
    public function shouldNotBeEmpty(): void
    {
        $this->expectException(InvalidHashedPasswordException::class);
        $this->expectExceptionMessage(InvalidHashedPasswordException::MESSAGE_EMPTY);

        $password = '';

        HashedPassword::fromString($password);
    }

    /**
     * @test
     * @throws InvalidHashedPasswordException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     */
    public function shouldBeTheSame(): void
    {
        $passwordString = 'aaaa';
        $hashedPassword = HashedPassword::fromString(password_hash($passwordString, PASSWORD_BCRYPT, ['cost' => 4]));
        $password = Password::fromString($passwordString);

        $this->assertTrue($hashedPassword->verify($password));
    }
}
