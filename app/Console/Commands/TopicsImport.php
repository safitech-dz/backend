<?php

namespace App\Console\Commands;

use App\Services\TopicsImportService;
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
        $topics_import_service = app()->make(TopicsImportService::class, ['command' => $this]);

        $topics_import_service->consume($this->argument('source'));

        return Command::SUCCESS;
    }
}
