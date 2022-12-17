<?php

namespace App\Packages;

use Illuminate\Http\Request;

class IotDataService
{
    protected string $canonical_topic;

    protected array $topic_definition;

    protected string $topic;

    protected string|array $message;

    protected string $topic_user_id;

    protected string $topic_client_id;

    protected IotTopics $topics_dictionnary;

    public function __construct(Request $request)
    {
        $this->topics_dictionnary = new IotTopics();

        $this->topic = $request->topic;
        $this->message = $request->message;

        $this->setCannonicalTopic();

        $this->topic_definition = $this->topics_dictionnary->getTopicDefinition($this->canonical_topic);
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
        return $this->topic_definition;
    }
}
