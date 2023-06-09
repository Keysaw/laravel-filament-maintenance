<button
	x-data="{{ json_encode(['visible' => $visible]) }}"
	x-show="visible"
	type="button"
	@class([
		  'flex h-10 items-center justify-center gap-3 rounded-lg px-3 py-2 transition',
		  'text-white bg-danger-600' => $isDown,
		  'hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700' => !$isDown,
	 ])
	wire:click="toggle"
	wire:loading.attr="disabled"
	wire:loading.class="opacity-50"
	x-tooltip.raw="{{ __('filament-maintenance::general.tooltip', [
	   'action' => $isDown ? __('filament-maintenance::general.deactivate') : __('filament-maintenance::general.activate')
   ]) }}"
>
	<x-heroicon-o-beaker class="h-5 w-5" />
	@unless(config('filament-maintenance.tiny_toggle'))
		<span>{{ $isDown ? __('filament-maintenance::general.down') : __('filament-maintenance::general.up') }}</span>
	@endif
</button>
