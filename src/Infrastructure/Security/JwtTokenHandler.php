<?php
namespace App\Infrastructure\Security;

use App\Domain\Auth\Token\Token;
use App\Domain\Auth\Token\TokenHandler;

class JwtTokenHandler implements TokenHandler
{
    private $secret;
    private $tokenLifeTime;
    private $issuerIdentifier;

    public function __construct(string $secret, int $tokenLifeTime, string $issuerIdentifier)
    {
        $this->secret = $secret;
        $this->tokenLifeTime = $tokenLifeTime;
        $this->issuerIdentifier = $issuerIdentifier;
    }

    public function create(string $userIdentifier): Token {
        return new Token(\ReallySimpleJWT\Token::getToken(
            $userIdentifier,
            $this->secret,
            time() + $this->tokenLifeTime,
            $this->issuerIdentifier
        ));
    }

    public function validate(Token $token): bool
    {
        return \ReallySimpleJWT\Token::validate($token, $this->secret);
    }
}
