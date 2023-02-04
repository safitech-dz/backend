<?php

namespace Safitech\Iot\Domain\IotMessageValues\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueTypes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\IotMessageValues\ValueTypes\IotMessageValueTypes::class;
    }
}
