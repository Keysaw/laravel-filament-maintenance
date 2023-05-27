<?php

use Brickx\Filament\Maintenance\Jobs\ToggleMaintenanceJob;
use Illuminate\Support\Facades\Artisan;

it('puts the app in maintenance mode if up', function () {
	assertIsUp();

	$job = new ToggleMaintenanceJob();
	$job->handle();

	assertIsDown();
});

it('removes the maintenance mode if already down', function () {
	Artisan::call('down');

	assertIsDown();

	$job = new ToggleMaintenanceJob();
	$job->handle();

	assertIsUp();
});
