<?php

namespace Safitech\Iot\Models;

class IotMessageValueJson extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'array',
    ];
}
