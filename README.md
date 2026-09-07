<div class="filament-hidden">

![Laravel G2](https://raw.githubusercontent.com/jeffersongoncalves/laravel-g2/master/art/jeffersongoncalves-laravel-g2.png)

</div>

# Laravel G2

[![Tests](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/run-tests.yml/badge.svg)](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/run-tests.yml)
[![PHPStan](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/phpstan.yml/badge.svg)](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/phpstan.yml)
[![Code Style](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/jeffersongoncalves/laravel-g2/actions/workflows/fix-php-code-style-issues.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-g2.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-g2)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-g2.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-g2)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/laravel-g2.svg?style=flat-square)](LICENSE.md)

A Laravel client for the [G2](https://data.g2.com/api/v1) API. A fluent `G2` facade groups the reviews, products, reports, competitors, categories, and tracking endpoints behind resource accessors, authenticates every request with a token header, and throws a `G2Exception` on a non-2xx response instead of returning a silent error array.

## Features

- **Reviews** — `reviews()->list()`, `get()`
- **Products** — `products()->list()`, `get()`
- **Reports** — `reports()->list()`, `get()`
- **Competitors** — `competitors()->list()`
- **Categories** — `categories()->list()`, `get()`
- **Tracking** — `tracking()->visitors()`
- **Thin by design** — every method returns the raw decoded JSON:API response as an array, no DTOs
- **Fails loud** — a non-2xx response throws `G2Exception` carrying the API's error message and HTTP status code

## Installation

```bash
composer require jeffersongoncalves/laravel-g2
```

Optionally publish the config file:

```bash
php artisan vendor:publish --tag="g2-config"
```

## Configuration

Add to your `.env`:

```env
G2_API_TOKEN=your-api-token
```

Request API access at [https://data.g2.com/api/v1](https://data.g2.com/api/v1) to get your token.

### Config Options

```php
// config/g2.php
return [
    'token' => env('G2_API_TOKEN'),
    'base_url' => env('G2_BASE_URL', 'https://data.g2.com/api/v1'),
];
```

## Usage

```php
use JeffersonGoncalves\G2\Facades\G2;
use JeffersonGoncalves\G2\Exceptions\G2Exception;
```

### Reviews

```php
G2::reviews()->list(productId: '123', state: 'published', page: 1, perPage: 25);
G2::reviews()->get('456');
```

### Products

```php
G2::products()->list(name: 'laravel', page: 1, perPage: 25);
G2::products()->get('123');
```

### Reports

```php
G2::reports()->list(page: 1, perPage: 25);
G2::reports()->get('789');
```

### Competitors

```php
G2::competitors()->list(productId: '123', page: 1, perPage: 25);
```

### Categories

```php
G2::categories()->list(name: 'crm', page: 1, perPage: 25);
G2::categories()->get('321');
```

### Tracking

```php
G2::tracking()->visitors(startDate: '2026-01-01', endDate: '2026-01-31', page: 1, perPage: 25);
```

### Handling errors

```php
try {
    $result = G2::products()->get('123');
} catch (G2Exception $e) {
    // $e->getMessage() — the API's errors[0].detail/title, or the raw response body
    // $e->statusCode  — the HTTP status code returned by G2
}
```

## Testing

```bash
composer test
```

## Static Analysis

```bash
composer analyse
```

## Code Formatting

```bash
composer format
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
