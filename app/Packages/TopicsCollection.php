<?php

namespace App\Packages;

use Exception;
use Illuminate\Support\Collection;

class TopicsCollection
{
    protected Collection $topics_dictionnary;

    public function __construct()
    {
        $this->topics_dictionnary = collect(json_decode(file_get_contents(__DIR__.'/topics_directory.json'), true));
    }

    /**
     * @param  string  $topic  Canonical format
     *
     * @throws Exception
     */
    public function getTopicDefinition(string $topic): array
    {
        $topic_definition = $this->topics_dictionnary->filter(fn ($entry) => $entry['topic'] === $topic);

        if ($topic_definition->count() > 1) {
            throw new Exception('A topic name must only identify one topic definition [UNIQUE]');
        }

        if ($topic_definition->count() === 0) {
            return [];
        }

        return $topic_definition->first();
    }
}
