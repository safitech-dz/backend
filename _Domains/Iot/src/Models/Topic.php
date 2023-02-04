<?php

namespace Safitech\Iot\Models;

use Safitech\Iot\Models\Base\BaseIotModel;

class Topic extends BaseIotModel
{
    protected $casts = [
        'rules' => 'array',
        'retain' => 'boolean',
    ];
}
