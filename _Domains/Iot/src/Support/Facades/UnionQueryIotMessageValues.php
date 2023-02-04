<?php

namespace Safitech\Iot\Domain\Support\Facades;

use Illuminate\Support\Facades\Facade;

class UnionQueryIotMessageValues extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Safitech\Iot\Domain\Packages\Queries\Builders\UnionQueryIotMessageValues::class;
    }
}
