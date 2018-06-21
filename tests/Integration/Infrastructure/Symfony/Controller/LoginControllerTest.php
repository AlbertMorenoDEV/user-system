<?php
namespace App\Tests\Integration\Infrastructure\Symfony\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class LoginControllerTest extends TestCase
{
    /** @var LoginController */
    private $controller;

    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldGetError(): void
    {
        $this->markTestSkipped('TBC');

        $request = new Request(['username' => 'UsernameA', 'password' => 'Invalid Password']);

        $response = $this->controller->action($request);

        $this->assertJsonStringEqualsJsonString('{"errors":[{"status":"400","title":"Invalid password"}]}', $response->getContent());
    }
}
