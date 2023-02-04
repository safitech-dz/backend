<?php

namespace Safitech\Iot\Domain\IotMessageValues\Facades;

use Illuminate\Support\Facades\Facade;

class UnionQueryIotMessageValues extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\IotMessageValues\Queries\UnionQueryIotMessageValues::class;
    }
}
