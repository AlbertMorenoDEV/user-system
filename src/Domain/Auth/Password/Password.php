<?php
namespace App\Domain\Auth\Password;

class Password
{
    public const MAXIMUM_CHARACTERS = 20;

    private $value;

    /**
     * @throws InvalidPasswordException
     */
    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    /**
     * @throws InvalidPasswordException
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $otherPassword): bool
    {
        return $this->value === $otherPassword->value();
    }

    /**
     * @throws InvalidPasswordException
     */
    private function guard(string $value): void
    {
        if (\strlen($value) > self::MAXIMUM_CHARACTERS) {
            throw new InvalidPasswordException(InvalidPasswordException::MESSAGE_TOO_LONG);
        }

        if (trim($value) === '') {
            throw new InvalidPasswordException(InvalidPasswordException::MESSAGE_EMPTY);
        }
    }
}
