<?php
namespace App\Tests\Unit\Application\Auth;

use App\Application\Auth\InvalidRequestParametersException;
use App\Application\Auth\LoginRequest;
use App\Application\Auth\LoginUseCase;
use App\Domain\Auth\Password\HashedPassword;
use App\Domain\Auth\Password\Password;
use App\Domain\Auth\Password\PasswordHasher;
use App\Domain\Auth\User;
use App\Domain\Auth\UserName\UserName;
use App\Domain\Auth\UserRepository;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class LoginUseCaseTest extends TestCase
{
    /** @var Generator */
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    /**
     * @test
     * @throws InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     * @throws \App\Domain\Auth\Password\InvalidHashedPasswordException
     * @throws \App\Application\Auth\InvalidPasswordException
     */
    public function shouldFindTheUserByUsername(): void
    {
        $usernameString = $this->faker->userName;
        $passwordString = $this->faker->password;
        $password = Password::fromString($passwordString);
        $hashedPassword = HashedPassword::fromString(password_hash($passwordString, PASSWORD_BCRYPT, ['cost' => 4]));
        $user = $this->createUserMock($password);
        $repositoryMock = $this->createRepositoryMock($user);
        $passwordHasherMock = $this->createPasswordHasherMock($hashedPassword);
        $useCase = new LoginUseCase($repositoryMock, $passwordHasherMock);
        $request = new LoginRequest($usernameString, $passwordString);

        $useCase->execute($request);

        $repositoryMock->mockery_verify();
        $this->addToAssertionCount(\Mockery::getContainer()->mockery_getExpectationCount());
    }

    /**
     * @test
     * @throws InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     * @throws \App\Domain\Auth\Password\InvalidHashedPasswordException
     * @throws \App\Application\Auth\InvalidPasswordException
     */
    public function shouldHashIncomingPassword(): void
    {
        $usernameString = $this->faker->userName;
        $passwordString = $this->faker->password;
        $password = Password::fromString($passwordString);
        $hashedPassword = HashedPassword::fromString(password_hash($passwordString, PASSWORD_BCRYPT, ['cost' => 4]));
        $user = $this->createUserMock($password);
        $repositoryMock = $this->createRepositoryMock($user);
        $passwordHasherMock = $this->createPasswordHasherMock($hashedPassword);
        $useCase = new LoginUseCase($repositoryMock, $passwordHasherMock);
        $request = new LoginRequest($usernameString, $passwordString);

        $useCase->execute($request);

        $passwordHasherMock->mockery_verify();
        $this->addToAssertionCount(\Mockery::getContainer()->mockery_getExpectationCount());
    }

    /**
     * @return \Mockery\MockInterface|UserRepository
     */
    private function createRepositoryMock(User $user): \Mockery\MockInterface
    {
        $repositoryMock = \Mockery::mock(UserRepository::class);
        $repositoryMock->shouldReceive('findOneByUsername')
            ->with(UserName::class)
            ->andReturn($user)
            ->once();
        return $repositoryMock;
    }

    /**
     * @return \Mockery\MockInterface|PasswordHasher
     */
    private function createPasswordHasherMock(HashedPassword $hashedPassword): \Mockery\MockInterface
    {
        $passwordHasherMock = \Mockery::mock(PasswordHasher::class);
        $passwordHasherMock->shouldReceive('hash')
            ->with(Password::class)
            ->andReturn($hashedPassword)
            ->once();
        return $passwordHasherMock;
    }

    /**
     * @return \Mockery\MockInterface|User
     */
    private function createUserMock(Password $password): \Mockery\MockInterface
    {
        $userMock = \Mockery::mock(User::class);
        $userMock->shouldReceive('password')->andReturn($password);
        return $userMock;
    }
}
