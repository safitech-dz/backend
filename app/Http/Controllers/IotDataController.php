<?php

namespace App\Http\Controllers;

use App\Packages\IotDataService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IotDataController extends Controller
{
    public function __invoke(Request $request)
    {
        $iot_data_service = new IotDataService($request->topic, $request->message);

        $def = $iot_data_service->getTopicDefinition();

        $rules = $this->structureNestedValidationRulesKeys($def['format']);

        $data = Validator::make(
            ['message' => $request->message],
            $rules
        )->validate();

        $model_class = config('iot-data.models-map.'.$def['type']);

        /** @var Model */
        $iot_value = $model_class::create([
            'value' => $data['message'],
            'topic' => $iot_data_service->getCannonicalTopic(),
            'topic_user_id' => $iot_data_service->getTopicUserId(),
            'topic_client_id' => $iot_data_service->getTopicClientId(),
        ]);

        return $iot_value;
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
