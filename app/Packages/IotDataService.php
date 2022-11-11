<?php

namespace App\Packages;

use Illuminate\Http\Request;

class IotDataService
{
    protected string $canonical_topic;

    protected string $topic;

    protected string $message;

    protected string $topic_user_id;

    protected string $topic_client_id;

    protected array $topics_dictionnary;

    public function __construct(Request $request)
    {
        $this->topic = $request->topic;
        $this->message = $request->message;

        $this->setCannonicalTopic();

        $this->topics_dictionnary = json_decode(file_get_contents(__DIR__.'/topics_directory.json'), true);
    }

    protected function setCannonicalTopic()
    {
        $topic = explode('/', $this->topic);

        $this->topic_user_id = $topic[0];
        $this->topic_client_id = $topic[1];

        $topic[0] = '%u';
        $topic[1] = '%d';

        $this->canonical_topic = implode('/', $topic);
    }

    public function getCannonicalTopic()
    {
        return $this->canonical_topic;
    }

    public function getTopicUserId()
    {
        return $this->topic_user_id;
    }

    public function getTopicClientId()
    {
        return $this->topic_client_id;
    }

    public function getTopicDefinition()
    {
        $topic_definition = array_filter($this->topics_dictionnary, fn ($entry) => $entry['topic'] === $this->canonical_topic);

        if (count($topic_definition) > 1) {
            throw new \Exception('A topic name must only identify one topic definition [UNIQUE]');
        }

        if (count($topic_definition) === 0) {
            return [];
        }

        return array_values($topic_definition)[0];
    }
}
