<?php

namespace Archilex\AvatarGroupColumn;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class AvatarGroupColumnServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-avatar-group-column';

    protected array $styles = [
        'plugin-filament-avatar-group-column' => __DIR__.'/../resources/dist/filament-avatar-group-column.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews();
    }
}
