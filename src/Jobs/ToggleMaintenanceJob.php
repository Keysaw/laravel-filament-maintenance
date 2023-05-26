<?php

namespace Brickx\Filament\Maintenance\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class ToggleMaintenanceJob
{
	use Dispatchable;

	public function __construct(public string $secret)
	{

	}

	public function handle() : void
	{
		if (app()->isDownForMaintenance()) {
			Artisan::call('up');
		} else {
			Artisan::call('down', [
				'--secret' => $this->secret,
			]);
		}
	}
}
