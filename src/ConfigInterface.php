<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\Config;

interface ConfigInterface
{
    public function string(string $key): string;

    public function int(string $key): int;

    public function float(string $key): float;

    public function bool(string $key): bool;

    /**
     * @return array<array-key, mixed>
     */
    public function array(string $key): array;

    public function has(string $key): bool;
}
