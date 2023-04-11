<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\Config;

use Kaiseki\WordPress\Config\Exception\InvalidValueException;
use Kaiseki\WordPress\Config\Exception\UnknownKeyException;

use function array_key_exists;
use function explode;
use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_string;

final class NestedArrayConfig implements ConfigInterface
{
    public const DELIMITER = '/';
    /** @var array<array-key, mixed> */
    private array $config;

    /**
     * @param array<array-key, mixed> $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function string(string $key, ?string $default = null): string
    {
        $value = $this->get($key, $default);
        if (!is_string($value)) {
            throw InvalidValueException::expectedStringFromKey($key, $value);
        }
        return $value;
    }

    public function int(string $key, ?int $default = null): int
    {
        $value = $this->get($key, $default);
        if (!is_int($value)) {
            throw InvalidValueException::expectedIntegerFromKey($key, $value);
        }
        return $value;
    }

    public function float(string $key, ?float $default = null): float
    {
        $value = $this->get($key, $default);
        if (!is_float($value)) {
            throw InvalidValueException::expectedFloatFromKey($key, $value);
        }
        return $value;
    }

    public function bool(string $key, ?bool $default = null): bool
    {
        $value = $this->get($key, $default);
        if (!is_bool($value)) {
            throw InvalidValueException::expectedBooleanFromKey($key, $value);
        }
        return $value;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function array(string $key, ?array $default = null): array
    {
        $value = $this->get($key, $default);
        if (!is_array($value)) {
            throw InvalidValueException::expectedArrayFromKey($key, $value);
        }
        return $value;
    }

    public function callable(string $key, ?callable $default = null): callable
    {
        $value = $this->get($key, $default);
        if (!is_callable($value)) {
            throw InvalidValueException::expectedBooleanFromKey($key, $value);
        }
        return $value;
    }

    public function has(string $key): bool
    {
        return $this->softGet($key) !== null;
    }

    /**
     * @param string|int|float|bool|array<array-key, mixed>|null $default
     * @return string|int|float|bool|array<array-key, mixed>
     * @throws UnknownKeyException
     */
    private function get(string $key, $default)
    {
        $value = $this->softGet($key);
        if ($value === null) {
            if ($default !== null) {
                return $default;
            }
            throw UnknownKeyException::fromKey($key);
        }
        return $value;
    }

    /**
     * @return string|int|float|bool|array<array-key, mixed>|null
     */
    private function softGet(string $key)
    {
        $paths = explode(self::DELIMITER, $key);
        $current = $this->config;
        foreach ($paths as $index) {
            if (!array_key_exists($index, $current)) {
                return null;
            }
            $current = $current[$index];
        }
        return $current;
    }
}
