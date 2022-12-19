<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Packages\ParsedTopic;
use App\Packages\TopicFormatToRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IotDataController extends Controller
{
    public function store(Request $request)
    {
        $parsed_topic = app(ParsedTopic::class, ['topic' => $request->topic]);

        $topic = Topic::where('topic', $parsed_topic->getCanonicalTopic())->firstOrFail();

        $data = Validator::make(
            ['message' => $request->message],
            app(TopicFormatToRules::class, ['format' => $topic->format])->getRules()
        )->validate();

        $model_class = config("iot-data.models-map.{$topic->type}");

        /** @var Model */
        $iot_value = $model_class::create([
            'value' => $data['message'],
            'topic' => $parsed_topic->getCanonicalTopic(),
            'topic_user_id' => $parsed_topic->getUserId(),
            'topic_client_id' => $parsed_topic->getClientId(),
        ]);

        return $iot_value;
    }

    public function query(Topic $topic)
    {
        $model_class = config("iot-data.models-map.{$topic->type}");

        return $model_class::where('topic', $topic->topic)->get();
    }
}
