<?php

namespace Safitech\Iot\Http\Controllers\IotData;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Safitech\Iot\Packages\IotData\Topics\ParsedTopic;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;

/**
 * @group IotData\IotData
 */
class IotDataController
{
    /**
     * Store IOT data
     *
     * @bodyParam topic  string required  Example: simulator/simulator/sensor/OWM/actualWeather
     * @bodyParam message object required  Example: {"humidity":55,"rainfall":200,"pressure":900,"temperature":24,"wind_speed":60}
     *
     * @response status=201 scenario=success
     * {
     *     "value": {
     *         "humidity": 55,
     *         "rainfall": 200,
     *         "pressure": 900,
     *         "temperature": 24,
     *         "wind_speed": 60
     *     },
     *     "topic": "%u/%d/sensor/OWM/actualWeather",
     *     "topic_user_id": "simulator",
     *     "topic_client_id": "simulator",
     *     "updated_at": "2023-01-20T14:59:24.000000Z",
     *     "created_at": "2023-01-20T14:59:24.000000Z",
     *     "id": 5
     * }
     */
    public function store(Request $request, DataEntityMapper $data_entity_mapper)
    {
        $parsed_topic = app(ParsedTopic::class, ['topic' => $request->topic]);

        $topic = Topic::where('topic', $parsed_topic->getCanonicalTopic())->firstOrFail();

        $data = Validator::make(
            $request->only('message'),
            $topic->rules
        )->validate();

        $iot_value = $data_entity_mapper->getModelInstance($topic->type);

        $iot_value->fill([
            'value' => $data['message'],
            'topic' => $parsed_topic->getCanonicalTopic(),
            'topic_user_id' => $parsed_topic->getUserId(),
            'topic_client_id' => $parsed_topic->getClientId(),
        ])->save();

        return $iot_value;
    }

    /**
     * Get IOT data
     *
     * @urlParam topic_id int required  ID of the IOT topic. Example: 1
     *
     * @response status=200 scenario=success
     * [
     *     {
     *         "id": 1,
     *         "created_at": "2022-12-20T17:27:38.000000Z",
     *         "updated_at": "2022-12-20T17:27:38.000000Z",
     *         "topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         }
     *     },
     *     {
     *         "id": 2,
     *         "created_at": "2022-12-20T17:35:38.000000Z",
     *         "updated_at": "2022-12-20T17:35:38.000000Z",
     *         "topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         }
     *     },
     *     {
     *         "id": 3,
     *         "created_at": "2022-12-20T17:36:20.000000Z",
     *         "updated_at": "2022-12-20T17:36:20.000000Z",
     *         "topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         }
     *     },
     *     {
     *         "id": 4,
     *         "created_at": "2022-12-20T17:36:59.000000Z",
     *         "updated_at": "2022-12-20T17:36:59.000000Z",
     *         "topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         }
     *     },
     *     {
     *         "id": 5,
     *         "created_at": "2023-01-20T14:59:24.000000Z",
     *         "updated_at": "2023-01-20T14:59:24.000000Z",
     *         "topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         }
     *     }
     * ]
     */
    public function query(Topic $topic, DataEntityMapper $data_entity_mapper)
    {
        return $data_entity_mapper->getModelName($topic->type)::where('topic', $topic->topic)->get();
    }
}
