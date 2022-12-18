<?php

namespace App\Packages;

class IotDataService
{
    protected string $canonical_topic;

    protected array $topic_definition;

    protected string $topic_user_id;

    protected string $topic_client_id;

    public function __construct(protected string $topic, protected string|array $message)
    {
        $topic = explode('/', $this->topic);

        $this->topic_user_id = array_unshift($topic);
        $this->topic_client_id = array_unshift($topic);

        $this->canonical_topic = implode('/', ['%u', '%d'] + $topic);
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
}
