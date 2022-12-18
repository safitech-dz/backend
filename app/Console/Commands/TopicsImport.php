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
    public function handle(TopicsImportService $topics_import_service)
    {
        $topics_import_service->consume($this->argument('source'));

        return Command::SUCCESS;
    }
}
