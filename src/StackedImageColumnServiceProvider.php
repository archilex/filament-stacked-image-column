<?php

namespace Archilex\StackedImageColumn;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class StackedImageColumnServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-stacked-image-column';

    protected array $styles = [
        'plugin-filament-stacked-image-column' => __DIR__ . '/../resources/dist/filament-stacked-image-column.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews();
    }
}
