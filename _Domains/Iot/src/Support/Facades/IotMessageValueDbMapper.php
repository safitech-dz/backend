<?php

namespace Safitech\Iot\Domain\Support\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueDbMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\Packages\IotMessages\IotMessageValueDbMapper::class;
    }
}
