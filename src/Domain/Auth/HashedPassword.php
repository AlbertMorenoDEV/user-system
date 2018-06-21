<?php
namespace App\Domain\Auth;

class HashedPassword
{
    private $value;

    /**
     * @throws InvalidHashedPasswordException
     */
    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    /**
     * @throws InvalidHashedPasswordException
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidHashedPasswordException
     */
    private function guard(string $value): void
    {
        if (trim($value) === '') {
            throw new InvalidHashedPasswordException(InvalidHashedPasswordException::MESSAGE_EMPTY);
        }
    }

    public function verify(Password $password): bool
    {
        return password_verify($password->value(), $this->value());
    }
}
