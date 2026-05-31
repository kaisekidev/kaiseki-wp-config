# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.0.0 - 2026-05-31

### Changed

- **BC:** PHP requirement is now `^8.2` (PHP 8.4 is the primary target). Consumers on PHP < 8.2 must upgrade.
- Replaced the `eventjet/coding-standard` (PHP_CodeSniffer) setup with the shared
  `kaiseki/php-coding-standard: ^1.0` php-cs-fixer standard. Source was reformatted to the new
  standard (whitespace/formatting only; no behavior change).
- Modernized the dev toolchain (PHPStan 2 at `level: max`, PHPUnit 11, composer-require-checker 4)
  and run CI via the reusable workflow in `kaisekidev/.github` across the 8.2/8.3/8.4 matrix.
- Bumped runtime constraints: `thecodingmachine/safe` → `^1.3 || ^2.0`, `psr/container` → `^1.1 || ^2.0`.
- Dropped `infection/infection` (mutation testing) — its pinned `^0.25` line does not run on PHP 8.2+,
  and it was not part of the org baseline.

### Fixed

- PHPStan 2 (`level: max`) flagged that `NestedArrayConfig` path traversal could index a non-array
  node; descent now guards with `is_array()` and treats a non-array node as a missing key.

## 1.0.2 - 2022-02-06

### Added

- Missing `LICENSE` file (MIT).

## 1.0.1 - 2022-02-05

### Fixed

- A missing dependency declaration in `composer.json`.

## 1.0.0 - 2022-02-05

First tagged release.

### Added

- `ConfigInterface` with typed accessors (`string`, `int`, `float`, `bool`, `array`, `has`) and the
  `NestedArrayConfig` implementation reading slash-separated paths, throwing `UnknownKeyException` /
  `InvalidValueException` on missing keys or type mismatches. Imported from `woda/wp-config`.
- `Config` helper (`get`, `build`, `initClassMap`) and `ConfigProvider` for PSR-11 wiring.
