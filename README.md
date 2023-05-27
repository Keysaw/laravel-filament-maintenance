# Filament Maintenance Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brickx/laravel-filament-maintenance.svg?style=flat-square)](https://packagist.org/packages/brickx/laravel-filament-maintenance)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/brickx/laravel-filament-maintenance/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/brickx/laravel-filament-maintenance/actions?query=workflow%3Arun-tests+branch%3Amain)
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
    'tiny_toggle' => false,
];
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="laravel-filament-maintenance-views"
```

## Setup

An optional step (but **highly recommended**) is to modify the `App\Http\Middleware\PreventRequestsDuringMaintenance` class to add the following code:

```php
protected function bypassResponse(string $secret) : RedirectResponse
{
    return redirect('admin')->withCookie(
        MaintenanceModeBypassCookie::create($secret)
    );
}
```

This is because Laravel's default maintenance middleware will redirect to the `/` route, which feels weird.

## Usage

The plugin will add a toggle button to your Filament Admin Panel, right before the search bar.

Clicking it will trigger the `php artisan down` command if the website is live, and the `php artisan up` command otherwise.

### Secret Token

You can set a secret token in the config file. If you do so, you will be able to bypass the maintenance mode by visiting the following URL: `https://your-domain.test/{secret}`.

If the `secret` key is set to `null`, a random one will be generated on the fly each time the maintenance mode is activated.

## Todo

- [ ] Improve the UX by directly adding the maintenance cookie from the Livewire component (instead of redirecting to the matching URL).
- [X] Create proper tests.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Keysaw](https://github.com/Keysaw)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
