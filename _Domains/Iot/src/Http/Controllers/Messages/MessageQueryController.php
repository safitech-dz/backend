<?php

namespace Safitech\Iot\Http\Controllers\Messages;

use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Models\Topic;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\Queries\IotMessageValuesFetcher;

/**
 * @group Messages
 *
 * @subGroup Query
 */
class MessageQueryController
{
    /**
     * Get IOT data (All topics)
     *
     * @response status=200 scenario=success
     * [
     *     {
     *         "iot_message_id": 1,
     *         "value": "Research Divide",
     *         "iot_message": {
     *             "id": 1,
     *             "created_at": "2023-01-27T18:57:00.000000Z",
     *             "updated_at": "2023-01-27T18:57:00.000000Z",
     *             "canonical_topic": "%u/%d/global/crop",
     *             "topic_user_id": "simulator",
     *             "topic_client_id": "simulator"
     *         }
     *     },
     *     {
     *         "iot_message_id": 2,
     *         "value": {
     *             "humidity": 55,
     *             "rainfall": 200,
     *             "pressure": 900,
     *             "temperature": 24,
     *             "wind_speed": 60
     *         },
     *         "iot_message": {
     *             "id": 2,
     *             "created_at": "2023-01-27T19:05:50.000000Z",
     *             "updated_at": "2023-01-27T19:05:50.000000Z",
     *             "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *             "topic_user_id": "simulator",
     *             "topic_client_id": "simulator"
     *         }
     *     }
     * ]
     */
    public function all(IotMessageValuesFetcher $union_iot_message_values_query)
    {
        return $union_iot_message_values_query->all();
    }

    /**
     * Get IOT data (by topic)
     *
     * @urlParam topic_id int required  ID of the IOT topic. Example: 1
     *
     * @response status=200 scenario=success
     * [
     *     {
     *         "id": 2,
     *         "created_at": "2023-01-27T15:52:24.000000Z",
     *         "updated_at": "2023-01-27T15:52:24.000000Z",
     *         "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": "{\"humidity\":55,\"rainfall\":200,\"pressure\":900,\"temperature\":24,\"wind_speed\":60}"
     *     },
     *     {
     *         "id": 8,
     *         "created_at": "2023-01-27T15:54:37.000000Z",
     *         "updated_at": "2023-01-27T15:54:37.000000Z",
     *         "canonical_topic": "%u/%d/sensor/OWM/actualWeather",
     *         "topic_user_id": "simulator",
     *         "topic_client_id": "simulator",
     *         "value": "{\"humidity\":55,\"rainfall\":200,\"pressure\":900,\"temperature\":24,\"wind_speed\":60}"
     *     }
     * ]
     */
    public function query(Topic $topic, DataEntityMapper $data_entity_mapper)
    {
        return IotMessage::join(
            $data_entity_mapper->getTableName($topic->type),
            'iot_messages.id',
            '=',
            $data_entity_mapper->getTableName($topic->type).'.iot_message_id'
        )
            ->select(
                'iot_messages.*',
                // TODO: fix casting
                $data_entity_mapper->getTableName($topic->type).'.value',
            )
            ->where('canonical_topic', $topic->canonical_topic)
            ->get();
    }
}
