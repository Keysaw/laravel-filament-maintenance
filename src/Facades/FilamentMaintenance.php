<?php

namespace Brickx\Filament\Maintenance\Facades;

use Brickx\Filament\Maintenance\FilamentMaintenance as BaseFilamentMaintenance;
use Illuminate\Support\Facades\Facade;

class FilamentMaintenance extends Facade
{
	protected static function getFacadeAccessor() : string
	{
		return BaseFilamentMaintenance::class;
	}
}
