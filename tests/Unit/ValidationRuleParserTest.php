<?php

namespace Tests\Unit;

use App\Packages\ValidFakeData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationRuleParserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider topicsRules
     */
    public function parse($topicRules)
    {
        // dump($topicRules);
        $parsed = (new ValidFakeData)->extract($topicRules);
        // dump($parsed);

        $this->assertTrue(true);
    }

    public function topicsRules()
    {
        return array_reduce(
            json_decode(file_get_contents(__DIR__.'./../../topics_directory.json'), true),
            fn (array $carry, array $topic) => $carry + [$topic['topic'] => [$topic['rules']]],
            []
        );
    }
}
