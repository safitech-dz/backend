<?php

namespace Safitech\Iot\Support\Facades;

use Illuminate\Support\Facades\Facade;

class IotValueTypes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Packages\IotMessages\IotValueTypes::class;
    }
}
