<?php

namespace Safitech\Iot\Http\Controllers\Messages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Models\Topic;
use Safitech\Iot\Packages\IotData\Topics\ParsedTopic;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;

/**
 * @group Messages
 *
 * @subGroup Message
 */
class MessageController
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
     *     "iot_message_id": 8,
     *     "id": 2,
     *     "iot_message": {
     *         "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "updated_at": "2023-01-27T15:54:37.000000Z",
     *         "created_at": "2023-01-27T15:54:37.000000Z",
     *         "id": 8
     *     }
     * }
     */
    public function store(Request $request, DataEntityMapper $data_entity_mapper)
    {
        $request->validate(['real_topic' => ['required'], 'message' => ['required']]);

        $parsed_topic = app(ParsedTopic::class, ['real' => $request->real_topic]);

        $topic = Topic::where('canonical_topic', $parsed_topic->getCanonical())->firstOrFail();

        $data = Validator::make(
            $request->only('message'),
            $topic->rules
        )->validate();

        $iot_message = IotMessage::create($parsed_topic->toArray());

        $iot_value = $data_entity_mapper->getModelInstance($topic->type);

        $iot_value->fill([
            'value' => $data['message'],
            'iot_message_id' => $iot_message->id,
        ])->save();

        $iot_value->setRelation('iot_message', $iot_message);

        // TODO: reshape ?
        return $iot_value;
    }
}
