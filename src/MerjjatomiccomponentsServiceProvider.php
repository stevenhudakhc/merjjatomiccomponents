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
            ->hasMigration('atom_image')
            ->hasMigration('atom_link')
            ->hasMigration('organism_row')
            ->hasMigration('organism_home')
            ->hasMigration('organism_thirdpartytools')
            ->hasCommand(MerjjatomiccomponentsCommand::class);
    }
}
