<?php

namespace Safitech\Iot\Packages\IotData\Values;

use Illuminate\Support\Facades\Facade;

class IotValueTypesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IotValueTypes::class;
    }
}
