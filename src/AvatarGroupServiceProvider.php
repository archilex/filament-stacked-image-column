<?php

namespace Archilex\AvatarGroup;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class AvatarGroupServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-avatar-group';

    protected array $styles = [
        'plugin-filament-avatar-group' => __DIR__.'/../resources/dist/filament-avatar-group.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasAssets()
            ->hasViews();
    }
}
