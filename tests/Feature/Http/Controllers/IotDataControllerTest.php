<?php

namespace Tests\Feature\Http\Controllers;

use Closure;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IotDataControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     * @dataProvider  requests_bodies
     */
    public function store(Closure $bodyGenerator)
    {
        $this->authenticate();

        $body = $bodyGenerator($this->faker);

        $response = $this->post('/api/iot-data', $body)
            ->assertCreated();
    }

    public function requests_bodies()
    {
        return [
            '%u/%d/actuator/irrignnov_V1/state' => [
                fn (Generator $faker): array => [
                    'topic' => '%u/%d/actuator/irrignnov_V1/state',
                    'message' => $faker->boolean(),
                ],
            ],
            '%u/%d/actuator/irrignnov_V1/last_irrigation_begin' => [
                fn (Generator $faker): array => [
                    'topic' => '%u/%d/actuator/irrignnov_V1/last_irrigation_begin',
                    'message' => time() * 1000,
                ],
            ],
        ];
    }
}
