# This is my package filament-stacked-image-column

[![Latest Version on Packagist](https://img.shields.io/packagist/v/archilex/filament-stacked-image-column.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-stacked-image-column)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/archilex/filament-stacked-image-column/run-tests?label=tests)](https://github.com/archilex/filament-stacked-image-column/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/archilex/filament-stacked-image-column/Check%20&%20fix%20styling?label=code%20style)](https://github.com/archilex/filament-stacked-image-column/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/archilex/filament-stacked-image-column.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-stacked-image-column)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require archilex/filament-stacked-image-column
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-stacked-image-column-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-stacked-image-column-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-stacked-image-column-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-stacked-image-column = new Archilex\StackedImageColumn();
echo $filament-stacked-image-column->echoPhrase('Hello, Archilex!');
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
