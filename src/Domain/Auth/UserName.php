<?php
namespace App\Domain\Auth;

class UserName
{
    public const MAXIMUM_CHARACTERS = 30;

    private $value;

    /**
     * @throws InvalidUsernameException
     */
    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    /**
     * @throws InvalidUsernameException
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
     * @throws InvalidUsernameException
     */
    private function guard(string $value): void
    {
        if (\strlen($value) > self::MAXIMUM_CHARACTERS) {
            throw new InvalidUsernameException(InvalidUsernameException::MESSAGE_TOO_LONG);
        }

        if (trim($value) === '') {
            throw new InvalidUsernameException(InvalidUsernameException::MESSAGE_EMPTY);
        }
    }

    public function equals(self $otherUsername): bool
    {
        return $this->value === $otherUsername->value();
    }
}
