# Filament Maintenance Plugin

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/Keysaw/laravel-filament-maintenance/run-tests.yml?branch=main&label=Tests&logo=GitHub)](https://github.com/Keysaw/laravel-filament-maintenance/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Packagist Downloads](https://img.shields.io/packagist/dt/brickx/laravel-filament-maintenance?logo=Packagist&logoColor=white&label=Packagist&color=orange)](https://packagist.org/packages/brickx/laravel-filament-maintenance)

This plugin allows you to easily toggle maintenance mode from your Filament Admin Panel. You can also set a secret token to bypass the maintenance mode.

## Installation

You can install the package via composer:

```bash
composer require brickx/laravel-filament-maintenance
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-maintenance-config"
```

This is the contents of the published config file:

```php
return [
    'secret' => null,
    'refresh' => false,
    'permissions' => false,
    'role' => false,
    'tiny_toggle' => false,
];
```

You can publish the translations with:

```bash
php artisan vendor:publish --tag="filament-maintenance-translations"
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="filament-maintenance-views"
```

## Setup

An optional step (but **highly recommended**) is to modify the `App\Http\Middleware\PreventRequestsDuringMaintenance` class to add the following code:

```php
use Illuminate\Foundation\Http\MaintenanceModeBypassCookie;
use Illuminate\Http\RedirectResponse;

...

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

### Refresh Interval

If you want to instruct browsers to refresh pages after a certain amount of time, you can set the `refresh` key in the config file.

When set to `false`, no `Refresh` HTTP header will be sent. You can specify an integer to define the number of seconds before reloading pages under maintenance mode.

### Visibility

By default, any logged-in user will be able to toggle the maintenance mode.

If you want to restrict maintenance mode toggling to certain users, you can set the `permissions` key in the config file.

The plugin will use Laravel's default authorization system to check for permissions, via the `can` method on the User model. It will also work well with [Spatie's Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction) package.

## Todo

- [ ] Fix toggle button styling not properly updating when maintenance mode is disabled.
- [ ] Improve the UX by directly adding the maintenance cookie from the Livewire component (instead of redirecting to the matching URL).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Keysaw](https://github.com/Keysaw)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
