<?php

namespace Tests\Unit;

use App\Packages\TopicFormatToRules;
use PHPUnit\Framework\TestCase;

class TopicFormatToRulesTest extends TestCase
{
    /**
     * @test
     * @dataProvider formats
     */
    public function get($format, $epxected_rule)
    {
        $rule = app(TopicFormatToRules::class, ['format' => $format])->getRules();

        dump($format);
        dump($rule);

        $this->assertEquals($rule, $epxected_rule);
    }

    protected function formats()
    {
        return [
            '%u/%d/sensor/OWM/actualWeather' => [
                [
                    'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
                    'rainfall' => ['required', 'numeric', 'min:0', 'max:1000'],
                    'pressure' => ['required', 'numeric', 'min:800', 'max:1200'],
                    'temperature' => ['required', 'numeric', 'min:-100', 'max:100'],
                    'wind_speed' => ['required', 'numeric', 'min:0', 'max:1000'],
                ],
                [
                    'message' => ['required', 'array'],
                    'message.humidity' => ['required', 'numeric', 'min:0', 'max:100'],
                    'message.rainfall' => ['required', 'numeric', 'min:0', 'max:1000'],
                    'message.pressure' => ['required', 'numeric', 'min:800', 'max:1200'],
                    'message.temperature' => ['required', 'numeric', 'min:-100', 'max:100'],
                    'message.wind_speed' => ['required', 'numeric', 'min:0', 'max:1000'],
                ],
            ],
            '%u/%d/actuator/irrignnov_V1/state' => [
                [
                    ['required', 'boolean'],
                ],
                [
                    'message' => ['required', 'array'],
                    'message.0' => ['required', 'boolean'],
                ],
            ],
        ];
    }
}
