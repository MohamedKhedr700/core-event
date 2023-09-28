<?php

namespace Raid\Core\Event\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Pluralizer;

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
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (File::exists($path)) {

            $this->info("File : {$path} already exits");

            return;
        }

        File::put($path, $contents);

        $this->info("File : {$path} created");
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
     * Get the stub path and the stub variables.
     */
    public function getSourceFile(): string|array|false
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
        return app_path('Listeners/'.$this->getClassName()).'.php';
    }

    /**
     * Return the Singular Capitalize Name.
     */
    public function getClassName(): string
    {
        return ucwords(Pluralizer::singular($this->argument('classname')));
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeDirectory($path)
    {
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
