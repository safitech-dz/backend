<?php

namespace Safitech\Iot\Models;

class IotMessageValueBoolean extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'boolean',
    ];
}
