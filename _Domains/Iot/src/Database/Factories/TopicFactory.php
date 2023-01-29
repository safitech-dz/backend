<?php

namespace Safitech\Iot\Database\Factories;

use Safitech\Iot\Packages\IotData\Values\IotValueTypesFacade;

class TopicFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'canonical_topic' => '%u/%d/'.$this->faker->word(),
            'qos' => random_int(0, 2),
            'retain' => $this->faker->boolean(),
            'type' => IotValueTypesFacade::all(),
            'rules' => [],
            'frequency_event' => null,
            'description' => $this->faker->paragraph(),
        ];
    }
}
