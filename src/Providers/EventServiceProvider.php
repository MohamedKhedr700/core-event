<?php

namespace Raid\Core\Event\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Event\Traits\Provider\WithEventServiceProviderResolver;

class EventServiceProvider extends ServiceProvider
{
    use WithEventServiceProviderResolver;

    /**
     * The commands to be registered.
     */
    protected array $commands = [];

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
