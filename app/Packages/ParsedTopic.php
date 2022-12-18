<?php

namespace App\Packages;

class ParsedTopic
{
    protected string $topic;

    protected ?string $user_id = null;

    protected ?string $client_id = null;

    protected string $base_topic;

    protected string $canonical_topic;

    public function __construct(string $topic, bool $complete = true)
    {
        $this->topic = $topic;

        if ($complete) {
            $t = explode('/', $topic);

            // TODO: validate
            $this->user_id = array_shift($t);

            // TODO: validate
            $this->client_id = array_shift($t);

            // TODO: validate
            $this->base_topic = implode('/', $t);
        } else {
            $this->base_topic = $topic;
        }

        $this->canonical_topic = "%u/%d/{$this->base_topic}";
    }

    public function getUserId(): string|null
    {
        return $this->user_id;
    }

    public function getClientId(): string|null
    {
        return $this->client_id;
    }

    public function getBaseTopic(): string
    {
        return $this->base_topic;
    }

    public function getCanonicalTopic(): string
    {
        return $this->canonical_topic;
    }

    public static function isCanonical(string $topic): bool
    {
        $topic = explode('/', $topic);

        if (count($topic) > 2 && $topic[0] === '%u' && $topic[1] === '%d') {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        return [
            'topic' => $this->topic,
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
            'base_topic' => $this->base_topic,
            'canonical_topic' => $this->canonical_topic,
        ];
    }
}
