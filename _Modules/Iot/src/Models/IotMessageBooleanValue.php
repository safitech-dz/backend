<?php

namespace Safitech\Iot\Models;

class IotMessageBooleanValue extends BaseIotValueModel
{
    protected $casts = [
        'value' => 'boolean',
    ];
}
