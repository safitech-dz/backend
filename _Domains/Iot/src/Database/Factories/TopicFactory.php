<?php

namespace Safitech\Iot\Database\Factories;

use Safitech\Iot\Support\Facades\IotMessageValueTypes;

class TopicFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'canonical_topic' => '%u/%d/'.$this->faker->word(),
            'qos' => random_int(0, 2),
            'retain' => $this->faker->boolean(),
            'type' => IotMessageValueTypes::all(),
            'rules' => [],
            'frequency_event' => null,
            'description' => $this->faker->paragraph(),
        ];
    }
}
