<?php

declare(strict_types=1);

namespace Kaiseki\Test\Unit\WordPress\Config;

use Kaiseki\Test\Unit\WordPress\Config\TestDouble\FakeContainer;
use Kaiseki\WordPress\Config\Config;
use Kaiseki\WordPress\Config\ConfigInterface;
use Kaiseki\WordPress\Config\NestedArrayConfig;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ConfigTest extends TestCase
{
    public function testGet(): void
    {
        $container = new FakeContainer([ConfigInterface::class => new NestedArrayConfig(['foo' => 'bar'])]);

        $config = Config::get($container);

        self::assertSame('bar', $config->string('foo'));
    }

    public function testInitClassMap(): void
    {
        $expected = new stdClass();
        $container = new FakeContainer([stdClass::class => $expected]);

        $classMap = Config::initClassMap($container, ['foo' => stdClass::class]);

        self::assertSame(['foo' => $expected], $classMap);
    }

    public function testInitClassMapReturnsCompleteArray(): void
    {
        $expected = new stdClass();
        $container = new FakeContainer([stdClass::class => $expected]);

        $classMap = Config::initClassMap($container, ['foo' => stdClass::class, 'bar' => stdClass::class]);

        self::assertSame(['foo' => $expected, 'bar' => $expected], $classMap);
    }

    public function testBuild(): void
    {
        $config = Config::build(['foo' => 'bar']);

        self::assertInstanceOf(NestedArrayConfig::class, $config);
        self::assertSame('bar', $config->string('foo'));
    }
}
