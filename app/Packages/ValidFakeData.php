<?php

namespace App\Packages;

use Knuckles\Camel\Extraction\Parameter;
use Knuckles\Scribe\Extracting\Extractor;
use Knuckles\Scribe\Extracting\ParsesValidationRules;
use Knuckles\Scribe\Tools\DocumentationConfig;

class ValidFakeData
{
    use ParsesValidationRules;

    protected DocumentationConfig $config;

    public function __construct()
    {
        $this->config = new DocumentationConfig(config('scribe'));
    }

    public function parse(array $rules): array
    {
        $bodyParametersFromValidationRules = $this->getParametersFromValidationRules($rules);

        return $this->normaliseArrayAndObjectParameters($bodyParametersFromValidationRules);
    }

    public function extract(array $rules)
    {
        $parametrized = [];

        foreach ($this->parse($rules) as $key => $value) {
            $parametrized[$key] = new Parameter($value);
        }

        return Extractor::cleanParams($parametrized);
    }
}
