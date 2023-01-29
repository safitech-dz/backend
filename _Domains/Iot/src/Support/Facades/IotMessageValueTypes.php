<?php

namespace Safitech\Iot\Support\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueTypes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Packages\IotMessages\IotMessageValueTypes::class;
    }
}
