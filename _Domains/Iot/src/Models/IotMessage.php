<?php

namespace Safitech\Iot\Models;

class IotMessage extends BaseIotModel
{
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'canonical_topic', 'canonical_topic');
    }

    //  TODO: hasMany values
}
