# This is my package filament-avatar-group

[![Latest Version on Packagist](https://img.shields.io/packagist/v/archilex/filament-avatar-group.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-avatar-group)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/archilex/filament-avatar-group/run-tests?label=tests)](https://github.com/archilex/filament-avatar-group/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/archilex/filament-avatar-group/Check%20&%20fix%20styling?label=code%20style)](https://github.com/archilex/filament-avatar-group/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/archilex/filament-avatar-group.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-avatar-group)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require archilex/filament-avatar-group
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-avatar-group-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-avatar-group-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-avatar-group-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-avatar-group = new Archilex\AvatarGroup();
echo $filament-avatar-group->echoPhrase('Hello, Archilex!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kenneth Sese](https://github.com/archilex)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
