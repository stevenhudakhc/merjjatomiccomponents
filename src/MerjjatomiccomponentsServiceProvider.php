<?php

namespace Stevenhudakhc\Merjjatomiccomponents;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stevenhudakhc\Merjjatomiccomponents\Commands\MerjjatomiccomponentsCommand;

class MerjjatomiccomponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('merjjatomiccomponents')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_merjjatomiccomponents_table')
            ->hasCommand(MerjjatomiccomponentsCommand::class);
    }
}
