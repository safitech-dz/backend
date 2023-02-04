<?php

namespace Safitech\Iot\App\Console\Commands;

use Illuminate\Console\Command;
use Safitech\Iot\App\Models\Topic;
use Storage;

class TopicsExport extends Command
{
    protected $signature = 'topics:export';

    protected $description = 'Export topics to JSON';

    /**
     * @return int
     */
    public function handle()
    {
        $json_name = 'topics_directory_'.time().'.json';

        Storage::put(
            $json_name,
            json_encode(
                Topic::all()
                    ->makeHidden(['id', 'created_at', 'updated_at'])
                    ->toArray(),
                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );

        $this->line('Topics exported to file:');
        $this->info(Storage::path($json_name));

        return Command::SUCCESS;
    }
}
