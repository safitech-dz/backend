<?php

namespace Safitech\Iot\App\Models;

use Safitech\Iot\App\Models\Base\BaseIotMessageValueModel;

class IotMessageValueJson extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'array',
    ];
}
