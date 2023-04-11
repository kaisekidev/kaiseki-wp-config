<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\Config;

interface ConfigInterface
{
    public function string(string $key, ?string $default): string;

    public function int(string $key, ?int $default): int;

    public function float(string $key, ?float $default): float;

    public function bool(string $key, ?bool $default): bool;

    /**
     * @param array<array-key, mixed> $default
     * @return array<array-key, mixed>
     */
    public function array(string $key, ?array $default): array;

    public function callable(string $key, ?callable $default): callable;

    public function has(string $key): bool;
}
