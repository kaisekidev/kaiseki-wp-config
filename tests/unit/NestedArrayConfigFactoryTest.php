<?php

declare(strict_types=1);

namespace Kaiseki\Test\Unit\WordPress\Config;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Kaiseki\Test\Unit\WordPress\Config\TestDouble\FakeContainer;
use Kaiseki\WordPress\Config\NestedArrayConfigFactory;

final class NestedArrayConfigFactoryTest extends TestCase
{
    private NestedArrayConfigFactory $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new NestedArrayConfigFactory();
    }

    public function testCreateInstance(): void
    {
        $config = ['test' => 'foo'];
        $container = new FakeContainer(['config' => $config]);

        $instance = ($this->factory)($container);

        self::assertSame('foo', $instance->string('test'));
    }

    public function testThrowsExceptionWhenConfigIsNotArray(): void
    {
        $container = new FakeContainer(['config' => 'invalid']);

        $this->expectException(InvalidArgumentException::class);

        ($this->factory)($container);
    }
}
