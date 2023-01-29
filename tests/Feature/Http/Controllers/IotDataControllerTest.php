<?php

namespace Tests\Feature\Http\Controllers;

use Closure;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IotDataControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     *
     * @dataProvider  requests_bodies
     */
    public function store(Closure $bodyGenerator)
    {
        $this->importTopics();

        $this->authenticate();

        $body = $bodyGenerator($this->faker);

        $response = $this->post('/api/iot/messages', $body)
            ->assertJsonMissingValidationErrors()
            ->assertCreated();

        // dump(json_decode($response->getContent(), true));
    }

    public function requests_bodies()
    {
        return [
            '%u/%d/sensor/OWM/actualWeather' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/sensor/OWM/actualWeather',
                'iot_message_value' => [
                    'humidity' => $faker->numberBetween(0, 100),
                    'rainfall' => $faker->numberBetween(0, 1000),
                    'pressure' => $faker->numberBetween(800, 1200),
                    'temperature' => $faker->numberBetween(-100, 100),
                    'wind_speed' => $faker->numberBetween(0, 1000),
                ],
            ]],
            '%u/%d/sensor/OWM/dailyWeather' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/sensor/OWM/dailyWeather',
                'iot_message_value' => [
                    'humidity' => $faker->numberBetween(0, 100),
                    'rainfall' => $faker->numberBetween(0, 1000),
                    'pressure' => $faker->numberBetween(800, 1200),
                    'temperature' => $faker->numberBetween(-100, 100),
                    'temperature_max' => $faker->numberBetween(-100, 100),
                    'temperature_min' => $faker->numberBetween(-100, 100),
                    'wind_speed' => $faker->numberBetween(0, 100),
                ],
            ]],
            '%u/%d/actuator/irrignnov_V1/state' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/state',
                'iot_message_value' => $faker->boolean(),
            ]],
            '%u/%d/actuator/irrignnov_V1/last_irrigation_begin' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/last_irrigation_begin',
                'iot_message_value' => $faker->numberBetween(1668372661695),
            ]],
            '%u/%d/actuator/irrignnov_V1/last_irrigation_end' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/last_irrigation_end',
                'iot_message_value' => $faker->numberBetween(1668372661695),
            ]],
            '%u/%d/actuator/irrignnov_V1/method' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/method',
                'iot_message_value' => $faker->randomElement([0, 1, 2]),
            ]],
            '%u/%d/actuator/irrignnov_V1/kc' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/kc',
                'iot_message_value' => $faker->randomFloat(2, 0, 2),
            ]],
            '%u/%d/actuator/irrignnov_V1/drip' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/drip',
                'iot_message_value' => [
                    $faker->numberBetween(0, 100),
                    $faker->numberBetween(0, 1000),
                    $faker->numberBetween(0, 1000),
                ],
            ]],
            '%u/%d/actuator/irrignnov_V1/sprinkler' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/sprinkler',
                'iot_message_value' => [
                    $faker->randomFloat(2, 0, 100),
                    $faker->numberBetween(0, 10000),
                    $faker->numberBetween(0, 10000),
                    $faker->randomFloat(2, 0, 20),
                ],
            ]],
            '%u/%d/actuator/irrignnov_V1/time' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/time',
                'iot_message_value' => $faker->time('H:i'),
            ]],
            '%u/%d/actuator/irrignnov_V1/frequence' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/actuator/irrignnov_V1/frequence',
                'iot_message_value' => $faker->numberBetween(0, 99),
            ]],
            '%u/%d/global/crop' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/global/crop',
                'iot_message_value' => $faker->word(),
            ]],
            '%u/%d/global/position' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/global/position',
                'iot_message_value' => [
                    $faker->randomFloat(),
                    $faker->randomFloat(),
                ],
            ]],
            '%u/%d/global/area' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/global/area',
                'iot_message_value' => $faker->randomFloat(2, 0, 1000000),
            ]],
            '%u/%d/sensor/irrignnov_V1/etm' => [fn (Generator $faker): array => [
                'real_topic' => 'x/x/sensor/irrignnov_V1/etm',
                'iot_message_value' => $faker->randomFloat(2, -1000, 1000),
            ]],
            '%u/%d/sensor/irrignnov_V1/prediction' => [
                fn (Generator $faker): array => [
                    'real_topic' => 'x/x/sensor/irrignnov_V1/prediction',
                    'iot_message_value' => [
                        'ET0' => [
                            $faker->randomFloat(2, -1000, 1000),
                        ],
                        'ETM' => [
                            $faker->randomFloat(2, -1000, 1000),
                        ],
                        'rain' => [
                            $faker->randomFloat(2, 0, 1000),
                        ],
                    ],
                ],
            ],
        ];
    }
}
