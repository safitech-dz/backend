<?php

namespace Safitech\Iot\Models;

use Safitech\Iot\Models\Base\BaseIotModel;

class IotMessage extends BaseIotModel
{
    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;

    // TODO: block updates

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'canonical_topic', 'canonical_topic');
    }

    public function IotMessageValue()
    {
        return $this->hasOne(IotMessageValue::class);
    }
}
