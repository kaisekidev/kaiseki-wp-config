<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\Config\Exception;

use InvalidArgumentException;

use function gettype;

final class InvalidValueException extends InvalidArgumentException
{
    /**
     * @param mixed $value
     */
    public static function expectedStringFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected string value for "%s" but found "%s".', $key, gettype($value)));
    }

    /**
     * @param mixed $value
     */
    public static function expectedIntegerFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected integer value for "%s" but found "%s".', $key, gettype($value)));
    }

    /**
     * @param mixed $value
     */
    public static function expectedFloatFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected float value for "%s" but found "%s".', $key, gettype($value)));
    }

    /**
     * @param mixed $value
     */
    public static function expectedBooleanFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected boolean value for "%s" but found "%s".', $key, gettype($value)));
    }

    /**
     * @param mixed $value
     */
    public static function expectedArrayFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected array value for "%s" but found "%s".', $key, gettype($value)));
    }

    /**
     * @param mixed $value
     */
    public static function expectedCallableFromKey(string $key, $value): self
    {
        return new self(\Safe\sprintf('Expected callable value for "%s" but found "%s".', $key, gettype($value)));
    }
}
