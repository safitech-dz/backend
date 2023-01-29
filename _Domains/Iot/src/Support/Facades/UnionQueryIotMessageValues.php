<?php

namespace Safitech\Iot\Support\Facades;

use Illuminate\Support\Facades\Facade;

class UnionQueryIotMessageValues extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues::class;
    }
}
