# kaiseki/wp-config

Type-safe access to array configurations.

Wrap a config array (or pull one from a PSR-11 container) and read values with typed accessors that
throw on a missing key or a wrong type — so a typo or a misconfigured value fails loudly instead of
silently returning `null`.

## Installation

```bash
composer require kaiseki/wp-config
```

Requires PHP 8.2 or newer.

## Usage

```php
use Kaiseki\WordPress\Config\NestedArrayConfig;

$config = new NestedArrayConfig([
    'db' => [
        'host' => 'localhost',
        'port' => 3306,
    ],
]);

$config->string('db/host'); // "localhost"
$config->int('db/port');    // 3306
$config->has('db/user');    // false
```

Paths are slash-separated. The typed getters (`string()`, `int()`, `float()`, `bool()`, `array()`)
throw `UnknownKeyException` if the path is missing and `InvalidValueException` if the value is not of
the expected type. `has()` reports whether a path resolves.

### From a PSR-11 container

`Config::get()` resolves the `ConfigInterface` service from a container:

```php
use Kaiseki\WordPress\Config\Config;

$config = Config::get($container); // expects ConfigInterface::class in the container
```

`ConfigProvider` wires that up for laminas-style config aggregators: it aliases `ConfigInterface`
to `NestedArrayConfig` and registers a factory that builds the config from the container's `config`
entry.

`Config::initClassMap()` resolves a map of keys to class instances from the container:

```php
$map = Config::initClassMap($container, ['logger' => LoggerInterface::class]);
// ['logger' => <instance from container>]
```

## Development

```bash
composer install
composer check   # check-deps, cs-check, phpstan, phpunit
```

## License

MIT — see [LICENSE](LICENSE).
