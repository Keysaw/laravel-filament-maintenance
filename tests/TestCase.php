<?php

namespace Brickx\Filament\Maintenance\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Brickx\Filament\Maintenance\MaintenanceServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
	public function getEnvironmentSetUp($app) : void
	{
		config()->set('database.default', 'testing');

		Artisan::call('up');
	}

	protected function setUp() : void
	{
		parent::setUp();

		Factory::guessFactoryNamesUsing(
			fn (string $modelName) => 'Brickx\\Filament\\Maintenance\\Database\\Factories\\'.class_basename($modelName).'Factory'
		);
	}

	protected function getPackageProviders($app) : array
	{
		return [
			LivewireServiceProvider::class,
			FilamentServiceProvider::class,
			SupportServiceProvider::class,
			MaintenanceServiceProvider::class,
			NotificationsServiceProvider::class,
			BladeIconsServiceProvider::class,
			BladeHeroiconsServiceProvider::class,
		];
	}
}
