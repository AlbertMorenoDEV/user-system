<?php
namespace App\Application\Auth;

use App\Domain\Auth\Password\PasswordHasher;
use App\Domain\Auth\UserRepository;

class LoginUseCase
{
    private $repository;
    private $passwordHasher;

    public function __construct(UserRepository $repository, PasswordHasher $passwordHasher)
    {
        $this->repository = $repository;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @throws InvalidPasswordException
     * @throws \App\Domain\Auth\UserNotFoundException
     */
    public function execute(LoginRequest $request): bool
    {
        $user = $this->repository->findOneByUsername($request->userName());

        $hashedPassword = $this->passwordHasher->hash($request->password());

        if (!$hashedPassword->verify($user->password())) {
            throw new InvalidPasswordException(InvalidPasswordException::MESSAGE);
        }

        return true;
    }
}
