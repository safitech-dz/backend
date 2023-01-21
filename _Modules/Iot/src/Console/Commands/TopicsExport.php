<?php

namespace Safitech\Iot\Console\Commands;

use Illuminate\Console\Command;
use Safitech\Iot\Models\Topic;
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
        Storage::disk('public')->put(
            'topics_directory_'.time().'.json',
            json_encode(
                Topic::all()
                    ->makeHidden(['id', 'created_at', 'updated_at'])
                    ->toArray(),
                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );

        return Command::SUCCESS;
    }
}
