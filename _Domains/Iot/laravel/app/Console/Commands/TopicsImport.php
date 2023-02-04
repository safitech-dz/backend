<?php

namespace Safitech\Iot\App\Console\Commands;

use Illuminate\Console\Command;
use Safitech\Iot\Domain\Services\TopicsImportService;

class TopicsImport extends Command
{
    protected $signature = 'topics:import {source}';

    protected $description = 'Import topics from JSON';

    /**
     * @return int
     */
    public function handle()
    {
        $topics_import_service = app()->make(TopicsImportService::class, ['command' => $this]);

        $topics_import_service->consume($this->argument('source'));

        $this->line('Topics import done');

        return Command::SUCCESS;
    }
}
