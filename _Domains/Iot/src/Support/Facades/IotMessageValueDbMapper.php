<?php

namespace Safitech\Iot\Support\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueDbMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Packages\IotMessages\IotMessageValueDbMapper::class;
    }
}
