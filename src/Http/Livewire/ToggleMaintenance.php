<?php

namespace Brickx\Filament\Maintenance\Http\Livewire;

use Brickx\Filament\Maintenance\Jobs\ToggleMaintenanceJob;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Livewire\Component;

class ToggleMaintenance extends Component
{
	public bool $isDown;

	public function mount() : void
	{
		$this->isDown = app()->isDownForMaintenance();
	}

	public function toggle() : ?Redirector
	{
		$secret = config('filament-maintenance.secret') ?: Str::random(32);

		ToggleMaintenanceJob::dispatch($secret);

		$this->isDown = app()->isDownForMaintenance();

		Notification::make()
			->title(__('filament-maintenance::general.success.title', [
				'status' => $this->isDown ? __('filament-maintenance::general.activated') : __('filament-maintenance::general.deactivated'),
			]))
			->body($this->isDown
				? __('filament-maintenance::general.success.body.down', ['secret' => $secret])
				: __('filament-maintenance::general.success.body.up')
			)
			->seconds($this->isDown ? 12 : 6)
			->success()
			->send();

		return $this->isDown ? redirect($secret) : null;
	}

	public function render() : View
	{
		return view('filament-maintenance::livewire.toggle-maintenance');
	}
}
