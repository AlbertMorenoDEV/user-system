<?php
namespace App\Tests\Unit\Application\Auth;

use App\Application\Auth\InvalidRequestParametersException;
use App\Application\Auth\LoginRequest;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class LoginRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidRequestsProvider
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     * @throws InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     */
    public function shouldHaveAllRequiredParameters(
        ?string $username,
        ?string $password,
        string $expectedException,
        string $expectedMessage
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedMessage);

        new LoginRequest($username, $password);
    }

    /**
     * @throws \Exception
     */
    public function invalidRequestsProvider(): array
    {
        $faker = Factory::create();

        return [
            [
                null,
                $faker->password,
                InvalidRequestParametersException::class,
                InvalidRequestParametersException::MESSAGE_INVALID_USERNAME,
            ],
            [
                $faker->userName,
                null,
                InvalidRequestParametersException::class,
                InvalidRequestParametersException::MESSAGE_INVALID_PASSWORD,
            ],
        ];
    }
}
