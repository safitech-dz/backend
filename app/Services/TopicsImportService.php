<?php

namespace App\Services;

use App\Models\Topic;
use Exception;

class TopicsImportService
{
    protected string $path;

    public function consume(string $source_path)
    {
        $this->source_path = match (false) {
            ! realpath($source_path) => $source_path,
            ! realpath(getcwd().DIRECTORY_SEPARATOR.$source_path) => getcwd().DIRECTORY_SEPARATOR.$source_path,
            default => throw new Exception('Invalid source path'),
        };

        $topics = json_decode(file_get_contents($this->source_path), true);

        if (is_null($topics)) {
            throw new Exception('Cannot parse the JSON');
        }

        // TODO: add validation
        foreach ($topics as $topic) {
            $stored_topic = Topic::where('topic', $topic['topic'])->first();

            if ($stored_topic) {
                $stored_topic->fill($topic);

                dump($stored_topic->getDirty());

                $stored_topic->save();
            } else {
                Topic::create($topic);
            }
        }
    }
}
