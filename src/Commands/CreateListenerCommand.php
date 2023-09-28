<?php

namespace Raid\Core\Event\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateListenerCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:make-listener {classname}';

    /**
     * The console command description.
     */
    protected $description = 'Make an listener class';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->createCommand();
    }

    /**
     * Return the stub file path.
     */
    public function getStubPath(): string
    {
        return __DIR__.'/../../resources/stubs/listener.stub';
    }

    /**
     * Map the stub variables present in stub to its value.
     */
    public function getStubVariables(): array
    {
        return [
            'NAMESPACE' => 'App\\Listeners',
            'CLASS_NAME' => $this->getClassName(),
        ];
    }

    /**
     * Get the full path of generated class.
     */
    public function getSourceFilePath(): string
    {
        return app_path('Listeners/'.$this->getClassName()).'.php';
    }
}
