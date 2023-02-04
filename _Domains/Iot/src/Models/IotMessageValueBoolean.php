<?php

namespace Safitech\Iot\Models;

use Safitech\Iot\Models\Base\BaseIotMessageValueModel;

class IotMessageValueBoolean extends BaseIotMessageValueModel
{
    protected $casts = [
        'value' => 'boolean',
    ];
}
