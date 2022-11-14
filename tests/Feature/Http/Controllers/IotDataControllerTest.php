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
     * @dataProvider  requests_bodies
     */
    public function store(Closure $bodyGenerator)
    {
        $this->authenticate();

        $body = $bodyGenerator($this->faker);

        $response = $this->post('/api/iot-data', $body)
            ->assertJsonMissingValidationErrors()
            ->assertCreated();

        // dump(json_decode($response->getContent(), true));
    }

    public function requests_bodies()
    {
        return [
            '%u/%d/sensor/OWM/actualWeather' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/sensor/OWM/actualWeather',
                'message' => [
                    'humidity' => $faker->numberBetween(0, 100),
                    'rainfall' => $faker->numberBetween(0, 1000),
                    'pressure' => $faker->numberBetween(800, 1200),
                    'temperature' => $faker->numberBetween(-100, 100),
                    'wind_speed' => $faker->numberBetween(0, 1000),
                ],
            ]],
            '%u/%d/sensor/OWM/dailyWeather' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/sensor/OWM/dailyWeather',
                'message' => [
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
                'topic' => '%u/%d/actuator/irrignnov_V1/state',
                'message' => $faker->boolean(),
            ]],
            '%u/%d/actuator/irrignnov_V1/last_irrigation_begin' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/last_irrigation_begin',
                'message' => $faker->numberBetween(1668372661695),
            ]],
            '%u/%d/actuator/irrignnov_V1/last_irrigation_end' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/last_irrigation_end',
                'message' => $faker->numberBetween(1668372661695),
            ]],
            '%u/%d/actuator/irrignnov_V1/method' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/method',
                'message' => $faker->randomElement([0, 1, 2]),
            ]],
            '%u/%d/actuator/irrignnov_V1/kc' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/kc',
                'message' => $faker->randomFloat(2, 0, 2),
            ]],
            '%u/%d/actuator/irrignnov_V1/drip' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/drip',
                'message' => [
                    $faker->numberBetween(0, 100),
                    $faker->numberBetween(0, 1000),
                    $faker->numberBetween(0, 1000),
                ],
            ]],
            '%u/%d/actuator/irrignnov_V1/sprinkler' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/sprinkler',
                'message' => [
                    $faker->numberBetween(0, 100),
                    $faker->randomFloat(2, 0, 10000),
                    $faker->numberBetween(0, 10000),
                    $faker->randomFloat(2, 0, 20),
                ],
            ]],
            '%u/%d/actuator/irrignnov_V1/time' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/time',
                'message' => $faker->time('H:i'),
            ]],
            '%u/%d/actuator/irrignnov_V1/frequence' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/actuator/irrignnov_V1/frequence',
                'message' => $faker->numberBetween(0, 99),
            ]],
            '%u/%d/global/crop' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/global/crop',
                'message' => $faker->word(),
            ]],
            '%u/%d/global/position' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/global/position',
                'message' => $faker->localCoordinates(),
            ]],
            '%u/%d/global/area' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/global/area',
                'message' => $faker->randomFloat(2, 0, 1000000),
            ]],
            '%u/%d/sensor/irrignnov_V1/etm' => [fn (Generator $faker): array => [
                'topic' => '%u/%d/sensor/irrignnov_V1/etm',
                'message' => $faker->randomFloat(2, -1000, 1000),
            ]],
            '%u/%d/sensor/irrignnov_V1/prediction' => [
                fn (Generator $faker): array => [
                    'topic' => '%u/%d/sensor/irrignnov_V1/prediction',
                    'message' => [
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
