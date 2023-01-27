<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class BaseIotValueModel extends BaseIotModel
{
    public $timestamps = false;

    public function iotMessage(): BelongsTo
    {
        return $this->belongsTo(IotMessage::class);
    }
}
