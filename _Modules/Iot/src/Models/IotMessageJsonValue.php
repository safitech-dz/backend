<?php

namespace Safitech\Iot\Models;

class IotMessageJsonValue extends BaseIotValueModel
{
    protected $casts = [
        'value' => 'array',
    ];
}
