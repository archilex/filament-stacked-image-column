# Stacked Image Column for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/archilex/filament-stacked-image-column.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-stacked-image-column)
[![run-tests](https://github.com/archilex/filament-stacked-image-column/actions/workflows/run-tests.yml/badge.svg)](https://github.com/archilex/filament-stacked-image-column/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/archilex/filament-stacked-image-column.svg?style=flat-square)](https://packagist.org/packages/archilex/filament-stacked-image-column)

Stacked Image Columns allows you to display multiple images as a stack in your Filament tables. 

This functionality will be part of core in Filament v3 (follow my [PR](https://github.com/filamentphp/filament/pull/6376)), however since there is currently no ETA on v3, I wanted to go ahead and release this now as a plugin.

## Screenshots

![stacked](https://github.com/archilex/filament-stacked-image-column/assets/6097099/df6c51c4-707c-48bb-b120-a7aeb0abe754)

![stacked-dark](https://github.com/archilex/filament-stacked-image-column/assets/6097099/2e121e61-c20d-4972-a649-6c72cfd586b4)

## Installation

You can install the package via composer:

```bash
composer require archilex/filament-stacked-image-column
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-stacked-image-column-views"
```

## Usage

Normally you will use Stacked Image Column to show a relationship of images. The name of the relationship comes first, followed by a period, followed by the name of the column to display:

```php
use Archilex\StackedImageColumn\Columns\StackedImageColumn;

return $table
    ->columns([
        StackedImageColumn::make('orderItems.image'),
    ]);
```

### Using a separator

Instead of using a relationship, you may use a separated string by passing the separator into `separator()`:

```php
StackedImageColumn::make('product_images')
    ->separator(',')
```

### Customizing the images

As `StackedImageColumn` extends Filament's `ImageColumn`, you have access to most of the same methods:

```php
StackedImageColumn::make('images')
    ->circular()
    ->width(20)
```

### Setting a limit

You may set a limit to the number of images you want to display by passing `limit()`:

```php
StackedImageColumn::make('orderItems.image')
    ->circular()
    ->limit(3)
```

### Showing the remaining images count

When you set a limit you may also display the count of remaining images by passing `showRemaining()`. 

```php
StackedImageColumn::make('orderItems.image')
    ->circular()
    ->limit(3)
    ->showRemaining()
```

By default, `showRemaining()` will display the count of remaining images as a number stacked on the other images. If you prefer to show the count as a number after the images you may use `showRemainingAfterStack()`. You may also set the text size by using `remainingTextSize('xs')`;

### Customizing the ring width

The default ring width is `ring-3` but you may customize the ring width to be either `0`, `1`, `2`, or `4` which correspond to tailwinds `ring-widths`: `ring-0`, `ring-1`, `ring-2`, and `ring-4` respectively.

```php
StackedImageColumn::make('users.avatar')
    ->circular()
    ->ring(3)
```

### Customizing the overlap

The default overlap is `-space-x-1` but you may customize the overlap to be either `0`, `1`, `2`, `3`, or `4` which correspond to tailwinds `space-x` options: `space-x-0`, `-space-x-1`, `-space-x-2`, `-space-x-3`, and `-space-x-4` respectively.

```php
StackedImageColumn::make('users.avatar')
    ->circular()
    ->overlap(3)
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

## Other Filament Plugins

Check out my other Filament Plugins:

- [Filter Sets](https://filamentphp.com/plugins/filter-sets): Save your filters, search query, column order, and column search queries into easily accessible filter sets
- [Toggle Icon Column](https://filamentphp.com/plugins/toggle-icon-column): Display a toggleable icon in your Filament table.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
