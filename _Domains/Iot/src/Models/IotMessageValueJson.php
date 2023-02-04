<?php

namespace Safitech\Iot\Models;

use Safitech\Iot\Models\Base\BaseIotMessageValueModel;

class IotMessageValueJson extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'array',
    ];
}
