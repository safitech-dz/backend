<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

/**
 * @group Topic
 */
class TopicController extends Controller
{

    /**
     * List topics
     *
     * @response status=200 scenario=success
     * [
     *    {
     *        "id": 1,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/sensor/OWM/actualWeather",
     *        "qos": 2,
     *        "retain": true,
     *        "frequency_event": "1h",
     *        "description": "Fichier JSON sur les données météorologique actuel",
     *        "type": "json",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "array"
     *            ],
     *            "message.humidity": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:100"
     *            ],
     *            "message.rainfall": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:1000"
     *            ],
     *            "message.pressure": [
     *                "required",
     *                "numeric",
     *                "min:800",
     *                "max:1200"
     *            ],
     *            "message.temperature": [
     *                "required",
     *                "numeric",
     *                "min:-100",
     *                "max:100"
     *            ],
     *            "message.wind_speed": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:1000"
     *            ]
     *        }
     *    },
     *    {
     *        "id": 2,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/sensor/OWM/dailyWeather",
     *        "qos": 2,
     *        "retain": false,
     *        "frequency_event": "24h",
     *        "description": "Fichier JSON sur les données météorologique du jour",
     *        "type": "json",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "array"
     *            ],
     *            "message.humidity": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:100"
     *            ],
     *            "message.rainfall": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:1000"
     *            ],
     *            "message.pressure": [
     *                "required",
     *                "numeric",
     *                "min:800",
     *                "max:1200"
     *            ],
     *            "message.temperature": [
     *                "required",
     *                "numeric",
     *                "min:-100",
     *                "max:100"
     *            ],
     *            "message.temperature_max": [
     *                "required",
     *                "numeric",
     *                "min:-100",
     *                "max:100"
     *            ],
     *            "message.temperature_min": [
     *                "required",
     *                "numeric",
     *                "min:-100",
     *                "max:100"
     *            ],
     *            "message.wind_speed": [
     *                "required",
     *                "numeric",
     *                "min:0",
     *                "max:100"
     *            ]
     *        }
     *    },
     *    {
     *        "id": 3,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/actuator/irrignnov_V1/state",
     *        "qos": 2,
     *        "retain": true,
     *        "frequency_event": "event",
     *        "description": "Etat de l'irrigation",
     *        "type": "boolean",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "boolean"
     *            ]
     *        }
     *    },
     *    {
     *        "id": 4,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/actuator/irrignnov_V1/last_irrigation_begin",
     *        "qos": 2,
     *        "retain": false,
     *        "frequency_event": "event",
     *        "description": "Heure du début de la dernière irrigation",
     *        "type": "integer",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "integer",
     *                "min:1"
     *            ]
     *        }
     *    },
     *    {
     *        "id": 5,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/actuator/irrignnov_V1/last_irrigation_end",
     *        "qos": 2,
     *        "retain": false,
     *        "frequency_event": "event",
     *        "description": "Heure de la fin de la dernière irrigation",
     *        "type": "integer",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "integer",
     *                "min:1"
     *            ]
     *        }
     *    },
     *    {
     *        "id": 6,
     *        "created_at": "2022-12-20T17:16:45.000000Z",
     *        "updated_at": "2022-12-20T17:16:45.000000Z",
     *        "topic": "%u/%d/actuator/irrignnov_V1/method",
     *        "qos": 2,
     *        "retain": true,
     *        "frequency_event": "event",
     *        "description": "Sélection de la méthode d'irrigation (2 : goutte à goutte, 1: asperseur, 0 : désactivé l'irrigation)",
     *        "type": "integer",
     *        "rules": {
     *            "message": [
     *                "required",
     *                "integer",
     *                "in:0,1,2"
     *            ]
     *        }
     *    }
     * ]
     */
    public function index()
    {
        return Topic::all();
    }

    /**
     * @subGroup usused
     */
    public function store(Request $request)
    {
    }

    /**
     * Get topic
     *
     * @urlParam id int required  Topic ID. Example: 10
     *
     * @response status=200 scenario=success
     * {
     *    "id": 10,
     *    "created_at": "2022-12-20T17:16:45.000000Z",
     *    "updated_at": "2022-12-20T17:16:45.000000Z",
     *    "topic": "%u/%d/actuator/irrignnov_V1/time",
     *    "qos": 2,
     *    "retain": true,
     *    "frequency_event": "event",
     *    "description": "Heure d'irrigation",
     *    "type": "time",
     *    "rules": {
     *        "message": [
     *            "required",
     *            "date_format:H:i"
     *        ]
     *    }
     *}
     */
    public function show(Topic $topic): Topic
    {
        return $topic;
    }

    /**
     * @subGroup usused
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Delete topic
     *
     * @urlParam id int required  Topic ID. Example: 12
     *
     * @response status=204 scenario=success
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response(null, 204);
    }
}
