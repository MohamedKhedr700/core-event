<?php

namespace Raid\Core\Event\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Pluralizer;
use Raid\Core\Command\Traits\Command;

class CreateEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:make-event {classname}';

    /**
     * The console command description.
     */
    protected $description = 'Make an event class';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->create();
    }

    /**
     * Return the stub file path.
     */
    public function getStubPath(): string
    {
        return __DIR__.'/../../resources/stubs/event.stub';
    }

    /**
     * Map the stub variables present in stub to its value.
     */
    public function getStubVariables(): array
    {
        return [
            'NAMESPACE' => 'App\\Events',
            'CLASS_NAME' => $this->getClassName(),
        ];
    }

    /**
     * Get the full path of generated class.
     */
    public function getSourceFilePath(): string
    {
        return app_path('Events/'.$this->getClassName()).'.php';
    }
}
