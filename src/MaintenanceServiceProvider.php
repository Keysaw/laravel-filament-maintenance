<?php

namespace Brickx\Filament\Maintenance;

use Brickx\Filament\Maintenance\Http\Livewire\ToggleMaintenance;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MaintenanceServiceProvider extends PackageServiceProvider
{
	public function boot() : void
	{
		parent::boot();

		Livewire::component('filament-maintenance::toggle-maintenance', ToggleMaintenance::class);

		Filament::serving(function () {
			Filament::registerRenderHook(
				'global-search.start',
				fn () => view('filament-maintenance::toolbar.menu-button')
			);
		});
	}

	public function configurePackage(Package $package) : void
	{
		$package->name('laravel-filament-maintenance')
			->hasConfigFile('filament-maintenance')
			->hasTranslations()
			->hasViews('filament-maintenance');
	}
}
