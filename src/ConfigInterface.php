<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\Config;

interface ConfigInterface
{
    public function string(string $key, ?string $default = null): string;

    public function int(string $key, ?int $default = null): int;

    public function float(string $key, ?float $default = null): float;

    public function bool(string $key, ?bool $default = null): bool;

    /**
     * @param array<array-key, mixed> $default
     *
     * @return array<array-key, mixed>
     */
    public function array(string $key, ?array $default = null): array;

    /**
     * @template T of callable
     *
     * @param string        $key
     * @param callable|null $default
     *
     * @return callable
     */
    public function callable(string $key, ?callable $default = null): callable;

    public function has(string $key): bool;
}
