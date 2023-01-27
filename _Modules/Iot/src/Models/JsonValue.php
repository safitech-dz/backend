<?php

namespace Safitech\Iot\Models;

class JsonValue extends BaseIotValueModel
{
    protected $casts = [
        'value' => 'array',
    ];
}
