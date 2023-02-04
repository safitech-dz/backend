<?php

namespace Safitech\Iot\App\Models;

use Safitech\Iot\App\Models\Base\BaseIotMessageValueModel;

class IotMessageValueBoolean extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'boolean',
    ];
}
