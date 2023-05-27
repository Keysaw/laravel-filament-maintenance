<?php

use Brickx\Filament\Maintenance\Http\Livewire\ToggleMaintenance;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertNull;

it('can generate a secret token if none is set in config', function () {
	assertNull(config('filament-maintenance.secret'));

	expect(livewire(ToggleMaintenance::class)->get('secret'))
		->toBeString()
		->toHaveLength(32);
});

it('redirects to the secret URL after activating maintenance mode', function () {
	Config::set('filament-maintenance.secret', 'secret-token');

	livewire(ToggleMaintenance::class)
		->call('toggle')
		->assertRedirect('secret-token')
		->assertNotified(__('filament-maintenance::general.success.title', [
			'status' => __('filament-maintenance::general.activated'),
		]));
});

it('does not perform any redirection after deactivating maintenance mode', function () {
	Artisan::call('down');

	livewire(ToggleMaintenance::class)
		->call('toggle')
		->assertNoRedirect()
		->assertNotified(__('filament-maintenance::general.success.title', [
			'status' => __('filament-maintenance::general.deactivated'),
		]));
});
