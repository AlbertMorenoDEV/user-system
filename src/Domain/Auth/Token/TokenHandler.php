<?php
namespace App\Domain\Auth\Token;

interface TokenHandler
{
    public function create(string $userIdentifier): Token;
    public function validate(Token $token): bool;
}
