<?php

namespace Brickx\LaravelFilamentMaintenance\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelFilamentMaintenance extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return \Brickx\LaravelFilamentMaintenance\LaravelFilamentMaintenance::class;
    }
}
