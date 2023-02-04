<?php

namespace Safitech\Iot\Domain\IotMessageValues\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueCaster extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\IotMessageValues\Caster\IotMessageValueCaster::class;
    }
}
