<?php
namespace App\Tests\Integration\Infrastructure\Symfony\Controller;

use App\Application\Auth\LoginUseCase;
use App\Domain\Auth\Password\Password;
use App\Domain\Auth\User;
use App\Domain\Auth\UserName\UserName;
use App\Infrastructure\Persistence\InMemoryUserRepository;
use App\Infrastructure\Security\BcryptPasswordHasher;
use App\Infrastructure\Symfony\Controller\LoginController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends TestCase
{
    /** @var LoginController */
    private $controller;

    /**
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     */
    protected function setUp()
    {
        parent::setUp();

        $repository = new InMemoryUserRepository();
        $passwordHasher = new BcryptPasswordHasher();
        $useCase = new LoginUseCase($repository, $passwordHasher);
        $this->controller = new LoginController($useCase);
    }

    /**
     * @test
     * @throws \App\Application\Auth\InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     */
    public function shouldGetError(): void
    {
        $request = new Request(['username' => 'test_user', 'password' => 'Invalid Password']);

        $response = $this->controller->action($request);

        $this->assertJsonStringEqualsJsonString('{"errors":[{"status":"400","title":"Invalid credentials"}]}', $response->getContent());
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @test
     * @throws \App\Application\Auth\InvalidRequestParametersException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     * @throws \App\Domain\Auth\UserName\InvalidUsernameException
     */
    public function shouldGetSuccessResponse(): void
    {
        $request = new Request(['username' => 'test_user', 'password' => '123456']);

        $response = $this->controller->action($request);

        $this->assertJsonStringEqualsJsonString('[]', $response->getContent());
        $this->assertEquals(Response::HTTP_ACCEPTED, $response->getStatusCode());
    }
}
