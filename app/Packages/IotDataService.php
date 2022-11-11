<?php

namespace App\Packages;

use Illuminate\Http\Request;

class IotDataService
{
    protected string $canonical_topic;

    protected string $topic;

    protected string $message;

    protected array $topics_dictionnary;

    public function __construct(Request $request)
    {
        $this->topic = $request->topic;
        $this->message = $request->message;

        $this->setCannonicalTopic();

        $this->topics_dictionnary = json_decode(file_get_contents(__DIR__ . "/topics_directory.json"), true);
    }

    protected function setCannonicalTopic()
    {
        $topic = explode('/', $this->topic);

        $topic[0] = '%u';
        $topic[1] = '%d';

        $this->canonical_topic = implode('/', $topic);
    }

    public function getTopicDefinition()
    {
        $topic_definition = array_filter($this->topics_dictionnary, fn ($entry) => $entry['topic'] === $this->canonical_topic);

        if (sizeof($topic_definition) > 1) {
            throw new \Exception("A topic name must only identify one topic definition [UNIQUE]");
        }

        if (sizeof($topic_definition) === 0) {
            return [];
        }

        return array_values($topic_definition)[0];
    }
}
