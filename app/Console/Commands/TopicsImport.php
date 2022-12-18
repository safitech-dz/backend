<?php

namespace App\Console\Commands;

use App\Models\Topic;
use Exception;
use Illuminate\Console\Command;

class TopicsImport extends Command
{
    /**
     * @var string
     */
    protected $signature = 'topics:import {source}';

    /**
     * @var string
     */
    protected $description = 'Import topics from JSON';

    /**
     * @return int
     */
    public function handle()
    {
        $source_path = match (false) {
            ! realpath($this->argument('source')) => $this->argument('source'),
            ! realpath(getcwd().DIRECTORY_SEPARATOR.$this->argument('source')) => getcwd().DIRECTORY_SEPARATOR.$this->argument('source'),
            default => throw new Exception('Invalid source path'),
        };

        $topics = json_decode(file_get_contents($source_path), true);

        if (is_null($topics)) {
            throw new Exception('Cannot parse the JSON');
        }

        // TODO: add validation
        foreach ($topics as $topic) {
            $stored_topic = Topic::where('topic', $topic['topic'])->first();

            if ($stored_topic) {
                // TODO: update if dirty
                Topic::where('topic', $topic['topic'])->update($topic);
            } else {
                Topic::create($topic);
            }
        }

        return Command::SUCCESS;
    }
}
