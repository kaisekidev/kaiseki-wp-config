<?php

declare(strict_types=1);

namespace Kaiseki\Test\Unit\WordPress\Config;

use PHPUnit\Framework\TestCase;
use Kaiseki\WordPress\Config\ConfigInterface;
use Kaiseki\WordPress\Config\ConfigProvider;
use Kaiseki\WordPress\Config\NestedArrayConfig;
use Kaiseki\WordPress\Config\NestedArrayConfigFactory;

final class ConfigProviderTest extends TestCase
{
    public function testConfig(): void
    {
        self::assertSame(
            [
                'dependencies' => [
                    'aliases' => [
                        ConfigInterface::class => NestedArrayConfig::class,
                    ],
                    'factories' => [
                        NestedArrayConfig::class => NestedArrayConfigFactory::class,
                    ],
                ],
            ],
            (new ConfigProvider())()
        );
    }
}
