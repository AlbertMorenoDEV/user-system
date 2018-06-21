<?php
namespace App\Tests\Unit\Infrastructure\Symfony\Controller;

use App\Application\Auth\LoginUseCase;
use App\Infrastructure\Symfony\Controller\LoginController;
use Faker\Factory;
use Faker\Generator;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class LoginControllerTest extends TestCase
{
    /** @var LoginUseCase|MockInterface */
    private $useCaseMock;

    /** @var LoginController */
    private $controller;

    /** @var Generator */
    private $faker;

    protected function setUp()
    {
        parent::setUp();

        $this->useCaseMock = \Mockery::mock(LoginUseCase::class);
        $this->controller = new LoginController($this->useCaseMock);
        $this->faker = Factory::create();
    }

    /**
     * @test
     * @throws \Exception
     */
    public function shouldCallUseCase(): void
    {
        $this->useCaseMock->shouldReceive('execute')->once();
        $request = $this->createRequestMock($this->faker->userName, $this->faker->password);

        $this->controller->action($request);

        $this->useCaseMock->mockery_verify();
        $this->addToAssertionCount(\Mockery::getContainer()->mockery_getExpectationCount());
    }

    /**
     * @return \Mockery\MockInterface|Request
     * @throws \Exception
     */
    protected function createRequestMock(?string $username, ?string $password): \Mockery\MockInterface
    {
        $request = \Mockery::mock(Request::class);
        $request->shouldReceive('get')->with('username')->andReturn($username);
        $request->shouldReceive('get')->with('password')->andReturn($password);
        return $request;
    }
}
