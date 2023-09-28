<?php

namespace Raid\Core\Event\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Event\Commands\CreateEventCommand;
use Raid\Core\Event\Commands\CreateListenerCommand;
use Raid\Core\Event\Commands\PublishCommand;
use Raid\Core\Event\Traits\Provider\WithEventServiceProviderResolver;

class EventServiceProvider extends ServiceProvider
{
    use WithEventServiceProviderResolver;

    /**
     * The commands to be registered.
     */
    protected array $commands = [
        PublishCommand::class,
        CreateEventCommand::class,
        CreateListenerCommand::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerHelpers();
        $this->registerCommands();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerEvents();
    }
}
