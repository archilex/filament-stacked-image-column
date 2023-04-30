<?php

namespace Archilex\ImageGroupColumn;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class ImageGroupColumnServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-image-group-column';

    protected array $styles = [
        'plugin-filament-image-group-column' => __DIR__.'/../resources/dist/filament-image-group-column.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews();
    }
}
