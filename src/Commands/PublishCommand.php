<?php

namespace Raid\Core\Event\Commands;

use \Illuminate\Console\Command;
class PublishCommand extends Command
{
    /**
     * The console command name.
     */
    protected string $name = 'publish:core-event';

    /**
     * The console command description.
     */
    protected string $description = 'Publish core event config files.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'config-event'
        ]);
    }
}