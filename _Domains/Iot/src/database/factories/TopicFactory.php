<?php

namespace Safitech\Iot\Database\Factories;

use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;

class TopicFactory extends BaseIotFactory
{
    public function definition()
    {
        return [
            'topic' => '%u/%d/'.$this->faker->word(),
            'qos' => random_int(0, 2),
            'retain' => $this->faker->boolean(),
            'type' => $this->faker->randomElement(app()->make(DataEntityMapper::class)->value_types),
            'rules' => [],
            'frequency_event' => null,
            'description' => $this->faker->paragraph(),
        ];
    }
}
