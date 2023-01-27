<?php

namespace Safitech\Iot\Models\Concerns;

trait HasFactoryResolver
{
    protected static function resolveFactoryClass()
    {
        $self = array_slice(explode('\\', static::class), -1)[0];

        return "Safitech\\Iot\\Database\\Factories\\{$self}Factory";
    }
}
