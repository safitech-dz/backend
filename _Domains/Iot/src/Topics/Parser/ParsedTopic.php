<?php

namespace Safitech\Iot\Domain\Topics\Parser;

use Exception;

class ParsedTopic
{
    protected string $user_id;

    protected string $client_id;

    protected string $canonical;

    public function __construct(
        protected string $real
    ) {
        $t = explode('/', $real);

        if (count($t) < 3) {
            throw new Exception('A valid topic cannot contain less than 3 parts');
        }

        // * if canonical_topic shapes changes use regex to match %u & %d

        $this->user_id = array_shift($t);

        $this->client_id = array_shift($t);

        $base = implode('/', $t);

        $this->canonical = "%u/%d/{$base}";
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getCanonical(): string
    {
        return $this->canonical;
    }

    public function isCanonical(): bool
    {
        // ? continue using OR
        if ($this->user_id === '%u' || $this->client_id === '%d') {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        return [
            'canonical_topic' => $this->canonical,
            'topic_user_id' => $this->user_id,
            'topic_client_id' => $this->client_id,
        ];
    }
}
