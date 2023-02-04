<?php

namespace Safitech\Iot\Domain\Services;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Safitech\Iot\App\Models\Topic;

class TopicsImportService
{
    public function __construct(protected ?Command $command = null)
    {
    }

    public function consume(string $source_path)
    {
        $import_topics = $this->parseJson($source_path);

        // TODO: add validation

        DB::transaction(function () use ($import_topics) {
            foreach ($import_topics as $import_topic) {
                $stored_topic = Topic::where('canonical_topic', $import_topic['canonical_topic'])->first();

                if ($stored_topic) {
                    $this->updateTopic($import_topic, $stored_topic);
                } else {
                    $this->createTopic($import_topic);
                }
            }
        });
    }

    protected function parseJson(string $source_path): array
    {
        $import_topics = json_decode(file_get_contents($this->resolveSourcePath($source_path)), true);

        if (is_null($import_topics)) {
            throw new Exception('Cannot parse the JSON');
        }

        return $import_topics;
    }

    protected function resolveSourcePath(string $source_path)
    {
        return match (false) {
            ! realpath($source_path) => $source_path,
            ! realpath(getcwd().DIRECTORY_SEPARATOR.$source_path) => getcwd().DIRECTORY_SEPARATOR.$source_path,
            default => throw new Exception('Invalid source path'),
        };
    }

    // ====================================
    // CRUD
    // ====================================

    protected function createTopic(array $import_topic)
    {
        $created_topic = Topic::create($import_topic);

        $this->reportCreatedTopic($created_topic);
    }

    protected function updateTopic(array $import_topic, Topic $stored_topic)
    {
        $stored_topic->fill($import_topic);

        if (! $stored_topic->isDirty()) {
            return;
        }

        $this->reportUpdatedTopic($stored_topic);

        $stored_topic->save();
    }

    // ====================================
    // Console
    // ====================================

    protected function reportCreatedTopic(Topic $created_topic): void
    {
        if (is_null($this->command)) {
            return;
        }

        $this->command->info("Created topic ID:{$created_topic->id} => {$created_topic->canonical_topic}");
    }

    protected function reportUpdatedTopic(Topic $stored_topic): void
    {
        if (is_null($this->command)) {
            return;
        }

        $this->command->warn("Updated topic ID:{$stored_topic->id} => {$stored_topic->canonical_topic}");

        $console_table = $this->makeDirtyTopicTable($stored_topic);

        $this->command->table($console_table['headers'], $console_table['rows']);
    }

    protected function makeDirtyTopicTable(Topic $topic): array
    {
        $headers = array_keys($topic->getDirty());

        $row = [];
        foreach ($headers as $header) {
            $row[] = $this->formatAttributeDiff($topic->getOriginal($header), $topic->$header);
        }

        return ['headers' => $headers, 'rows' => [$row]];
    }

    protected function formatAttributeDiff(mixed $original, mixed $new): string
    {
        if (is_array($original) || is_array($new)) {
            return substr(json_encode($original), 0, 60).' -> '.substr(json_encode($new), 0, 20);
        }

        return $original.' -> '.$new;
    }
}
