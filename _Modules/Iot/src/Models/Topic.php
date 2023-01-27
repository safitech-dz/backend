<?php

namespace Safitech\Iot\Models;

class Topic extends BaseIotModel
{
    protected $casts = [
        'rules' => 'array',
        'retain' => 'boolean',
    ];
}
