<?php

namespace App\Packages;

class IotTopics
{
    protected array $topics_dictionnary;

    public function __construct()
    {
        $this->topics_dictionnary = json_decode(file_get_contents(__DIR__.'/topics_directory.json'), true);
    }

    /**
     * @param  string  $topic  Canonical format
     */
    public function getTopicDefinition(string $topic): array
    {
        $topic_definition = array_filter($this->topics_dictionnary, fn ($entry) => $entry['topic'] === $topic);

        if (count($topic_definition) > 1) {
            throw new \Exception('A topic name must only identify one topic definition [UNIQUE]');
        }

        if (count($topic_definition) === 0) {
            return [];
        }

        return array_values($topic_definition)[0];
    }
}
