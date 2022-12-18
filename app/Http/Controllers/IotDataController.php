<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Packages\ParsedTopic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IotDataController extends Controller
{
    public function store(Request $request)
    {
        $parsed_topic = new ParsedTopic($request->topic);

        $topic = Topic::where('topic', $parsed_topic->getCanonicalTopic())->first() ?? throw new ModelNotFoundException("Topic {$parsed_topic->getCanonicalTopic()} not found");

        $rules = $this->structureNestedValidationRulesKeys($topic->format);

        $data = Validator::make(
            ['message' => $request->message],
            $rules
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

    // TODO bind on route using topic string
    public function query(string $topic)
    {
        $topic = Topic::where('topic', "%u/%d/$topic")->first() ?? throw new ModelNotFoundException("Topic $topic not found");

        $model_class = config("iot-data.models-map.{$topic->type}");

        return $model_class::where('topic', $topic->topic)->get();
    }

    protected function structureNestedValidationRulesKeys(array $rules, string $parent_key = 'message'): array
    {
        if ($this->isArrayOfStrings($rules)) {
            /**
             * Rules entry
             * Example: ['required', 'integer']
             */
            return [$parent_key => $rules];
        }

        /**
         * [
         *      'entry' => ['required', 'boolean'],
         *      'entry2' => [
         *          '*' => [''nullable', 'integer']
         *      ]
         * ]
         */
        foreach ($rules as $key => $rule) {
            $nested_rules = $this->structureNestedValidationRulesKeys($rule, $key);

            foreach ($nested_rules as $key => $value) {
                $rules["$parent_key.$key"] = $value;
            }
            /**
             * (1) $rules["message.entry"] = ['required', 'boolean']
             */

            /**
             * (1) unset $rules["entry"]
             */
            unset($rules[$key]);
        }

        $rules[$parent_key] = ['required', 'array'];

        return $rules;
    }

    /**
     * True if array contains only strings
     */
    protected function isArrayOfStrings(array $arr): bool
    {
        if (empty($arr)) {
            // ! Abnormal case: throw or log
            return false;
        }

        foreach ($arr as $value) {
            if (! is_string($value)) {
                return false;
            }
        }

        return true;
    }
}
