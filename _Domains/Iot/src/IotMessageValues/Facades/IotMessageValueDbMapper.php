<?php

namespace Safitech\Iot\Domain\IotMessageValues\Facades;

use Illuminate\Support\Facades\Facade;

class IotMessageValueDbMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\IotMessageValues\DbMapper\IotMessageValueDbMapper::class;
    }
}
