<?php

namespace App\Packages;

class TopicFormatToRules
{
    protected array $rules;

    public function __construct(protected $format)
    {
        $this->rules = $this->structureNestedValidationRulesKeys($this->format);
    }

    public function getRules(): array
    {
        return $this->rules;
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
