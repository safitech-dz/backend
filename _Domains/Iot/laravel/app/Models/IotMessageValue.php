<?php

namespace Safitech\Iot\App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Safitech\Iot\App\Models\Base\BaseIotMessageValueModel;
use Safitech\Iot\Domain\IotMessageValues\Facades\IotMessageValueCaster;

class IotMessageValue extends BaseIotMessageValueModel
{
    // Inherit unused hasFactory trait
    // ! READ_ONLY: table is SQL view (see: https://github.com/michaelachrisco/ReadOnlyTraitLaravel)

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => IotMessageValueCaster::toType($value, $this->type),
            set: fn () => throw new Exception('IotMessageValue is a readonly model'),
        );
    }
}
