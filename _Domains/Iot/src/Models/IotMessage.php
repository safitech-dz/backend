<?php

namespace Safitech\Iot\Models;

class IotMessage extends BaseIotModel
{
    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;

    // TODO: block updates

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'canonical_topic', 'canonical_topic');
    }

    //  TODO: hasMany values
}
