<?php
namespace App\Infrastructure\Symfony\Controller;

use App\Application\Auth\InvalidPasswordException;
use App\Application\Auth\InvalidRequestParametersException;
use App\Application\Auth\LoginRequest;
use App\Application\Auth\LoginUseCase;
use App\Domain\Auth\Token\TokenHandler;
use App\Domain\Auth\UserName\InvalidUsernameException;
use App\Domain\Auth\UserNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    private $useCase;
    private $tokenHandler;

    public function __construct(LoginUseCase $useCase, TokenHandler $tokenHandler)
    {
        $this->useCase = $useCase;
        $this->tokenHandler = $tokenHandler;
    }

    /**
     * @throws InvalidRequestParametersException
     * @throws InvalidUsernameException
     * @throws \App\Domain\Auth\Password\InvalidPasswordException
     */
    public function action(Request $request): JsonResponse
    {
        try {
            $this->useCase->execute(new LoginRequest($request->get('username'), $request->get('password')));
            return new JsonResponse([
                'auth_token' => $this->tokenHandler->create($request->get('username')),
            ], Response::HTTP_ACCEPTED);
        } catch (InvalidPasswordException $e) {
            $error = [
                'status' => (string)Response::HTTP_BAD_REQUEST,
                'title' => 'Invalid credentials',
            ];
            return new JsonResponse(['errors' => [$error]], Response::HTTP_BAD_REQUEST);
        } catch (UserNotFoundException $e) {
            $error = [
                'status' => (string)Response::HTTP_BAD_REQUEST,
                'title' => 'The user does not exist',
            ];
            return new JsonResponse(['errors' => [$error]], Response::HTTP_BAD_REQUEST);
        }
    }
}
