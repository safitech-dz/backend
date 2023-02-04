<?php

namespace Safitech\Iot\App\Models;

use Safitech\Iot\App\Models\Base\BaseIotModel;

class Topic extends BaseIotModel
{
    protected $casts = [
        'rules' => 'array',
        'retain' => 'boolean',
    ];
}
