<?php

declare(strict_types=1);

namespace Kaiseki\Test\Unit\WordPress\Config;

use Kaiseki\WordPress\Config\ConfigInterface;
use Kaiseki\WordPress\Config\NestedArrayConfig;

class NestedArrayConfigTest extends AbstractConfigTest
{
    /**
     * @param array<array-key, mixed> $config
     */
    protected function createConfig(array $config): ConfigInterface
    {
        return new NestedArrayConfig($config);
    }
}
