<?php

namespace Safitech\Iot\Http\Controllers\Messages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Models\Topic;
use Safitech\Iot\Packages\Topics\ParsedTopic;
use Safitech\Iot\Support\Facades\IotMessageValueDbMapper;

/**
 * @group Messages
 *
 * @subGroup Message
 */
class MessageController
{
    /**
     * Store IOT message
     *
     * @bodyParam real_topic  string required  Example: simulator/simulator/sensor/OWM/actualWeather
     * @bodyParam iot_message_value object required  Example: {"humidity":55,"rainfall":200,"pressure":900,"temperature":24,"wind_speed":60}
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
    public function store(Request $request)
    {
        $request->validate(['real_topic' => ['required'], 'iot_message_value' => ['required']]);

        $parsed_topic = app(ParsedTopic::class, ['real' => $request->real_topic]);

        $topic = Topic::where('canonical_topic', $parsed_topic->getCanonical())->firstOrFail();

        $value = Validator::make(
            $request->only('iot_message_value'),
            $topic->rules
        )->validate();

        $iot_message = IotMessage::create($parsed_topic->toArray());

        $iot_message_value = IotMessageValueDbMapper::getModelInstance($topic->type);

        $iot_message_value->fill([
            'value' => $value['iot_message_value'],
            'iot_message_id' => $iot_message->id,
        ])->save();

        $iot_message_value->setRelation('iot_message', $iot_message);

        // ? reshape
        return $iot_message_value;
    }
}
