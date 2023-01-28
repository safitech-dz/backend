<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class BaseIotValueModel extends BaseIotModel
{
    protected $primaryKey = 'iot_message_id';

    public $incrementing = false;

    public $timestamps = false;

    public $guarded = [];

    public function iotMessage(): BelongsTo
    {
        return $this->belongsTo(IotMessage::class);
    }
}
