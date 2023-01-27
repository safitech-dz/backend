<?php

namespace Safitech\Iot\Models;

class IotMessage extends BaseIotModel
{
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic', 'topic');
    }

    //  TODO: hasMany values
}
