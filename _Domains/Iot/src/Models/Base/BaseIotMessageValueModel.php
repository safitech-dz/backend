<?php

namespace Safitech\Iot\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class BaseIotMessageValueModel extends BaseIotModel
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
