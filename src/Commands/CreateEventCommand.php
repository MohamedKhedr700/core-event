<?php

namespace Raid\Core\Event\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class CreateEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:event-make {name}';

    /**
     * The console command description.
     */
    protected $description = 'Make an Event Class';

    /**
     * Filesystem instance.
     */
    protected Filesystem $files;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if ($this->files->exists($path)) {

            $this->info("File : {$path} already exits");

            return;
        }

        $this->files->put($path, $contents);

        $this->info("File : {$path} created");
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
     * Get the stub path and the stub variables.
     */
    public function getSourceFile(): mixed
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value.
     */
    public function getStubContents($stub, $stubVariables = []): array|false|string
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$'.$search.'$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the full path of generated class.
     */
    public function getSourceFilePath(): string
    {
        return app_path('Events/'.$this->getClassName()).'.php';
    }

    /**
     * Return the Singular Capitalize Name.
     */
    public function getClassName(): string
    {
        return ucwords(Pluralizer::singular($this->argument('name')));
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
