<?php

namespace Safitech\Iot\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Safitech\Iot\Support\Facades\IotMessageValueCaster;

class IotMessageValue extends BaseIotMessageValueModel
{
    // ! READ_ONLY: table is SQL view

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => IotMessageValueCaster::toType($value, $this->type),
            set: fn () => throw new Exception('IotMessageValue is a readonly model'),
        );
    }
}
