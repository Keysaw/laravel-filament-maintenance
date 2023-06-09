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
	public string $secret;
	public bool $visible;

	public function mount() : void
	{
		$this->isDown = app()->isDownForMaintenance();
		$this->secret = config('filament-maintenance.secret') ?: Str::random(32);
		$this->visible = $this->getVisibility();
	}

	public function getVisibility() : bool
	{
		if (($user = auth()->user()) === null) {
			return false;
		}

		if ($permissions = config('filament-maintenance.permissions')) {
			return $user->can($permissions);
		}

		return true;
	}

	public function toggle() : ?Redirector
	{
		ToggleMaintenanceJob::dispatch($this->secret);

		$this->isDown = app()->isDownForMaintenance();

		Notification::make()
			->title(__('filament-maintenance::general.success.title', [
				'status' => $this->isDown ? __('filament-maintenance::general.activated') : __('filament-maintenance::general.deactivated'),
			]))
			->body($this->isDown
				? __('filament-maintenance::general.success.body.down', ['secret' => $this->secret])
				: __('filament-maintenance::general.success.body.up')
			)
			->seconds($this->isDown ? 12 : 6)
			->success()
			->send();

		return $this->isDown ? redirect($this->secret) : null;
	}

	public function render() : View
	{
		return view('filament-maintenance::livewire.toggle-maintenance');
	}
}
