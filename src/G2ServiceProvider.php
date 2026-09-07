<?php

namespace JeffersonGoncalves\G2;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class G2ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('g2')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(G2Client::class);
        $this->app->alias(G2Client::class, 'g2');
    }
}
