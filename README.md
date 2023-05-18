# Filament Maintenance Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brickx/laravel-filament-maintenance.svg?style=flat-square)](https://packagist.org/packages/brickx/laravel-filament-maintenance)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/brickx/laravel-filament-maintenance/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/brickx/laravel-filament-maintenance/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/brickx/laravel-filament-maintenance/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/brickx/laravel-filament-maintenance/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/brickx/laravel-filament-maintenance.svg?style=flat-square)](https://packagist.org/packages/brickx/laravel-filament-maintenance)

This plugin allows you to easily toggle maintenance mode from your Filament Admin Panel. You can also set a secret token to bypass the maintenance mode.

## Installation

You can install the package via composer:
```bash
composer require brickx/laravel-filament-maintenance
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="laravel-filament-maintenance-config"
```

This is the contents of the published config file:
```php
return [
    'secret' => null,
];
```

Optionally, you can publish the views using:
```bash
php artisan vendor:publish --tag="laravel-filament-maintenance-views"
```

## Usage

_TODO_

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Keysaw](https://github.com/Keysaw)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
