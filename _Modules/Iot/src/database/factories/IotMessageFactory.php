<?php

namespace Safitech\Iot\Database\Factories;

class IotMessageFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'topic_user_id' => 'x',
            'topic_client_id' => 'x',
        ];
    }
}
