<?php

namespace Brickx\Filament\Maintenance\Tests;

use Brickx\Filament\Maintenance\MaintenanceServiceProvider;
use Filament\FilamentServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
	public function getEnvironmentSetUp($app) : void
	{
		config()->set('database.default', 'testing');

		/*
		$migration = include __DIR__.'/../database/migrations/create_laravel-filament-maintenance_table.php.stub';
		$migration->up();
		*/
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
			MaintenanceServiceProvider::class,
		];
	}
}
