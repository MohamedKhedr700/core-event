<?php

namespace Raid\Core\Event\Traits\Provider;

use Raid\Core\Event\Events\Contracts\EventableInterface;
use Raid\Core\Event\Events\Contracts\EventManagerInterface;
use Raid\Core\Event\Facades\Events;

trait WithEventServiceProviderResolver
{
    /**
     * Register config.
     */
    private function registerConfig(): void
    {
        $configResourcePath = glob(__DIR__.'/../../../config/*.php');

        foreach ($configResourcePath as $config) {

            $this->publishes([
                $config => config_path(basename($config)),
            ], 'config-event');
        }
    }

    /**
     * Register helpers.
     */
    private function registerHelpers(): void
    {
        $helpers = glob(__DIR__.'/../../Helpers/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }

    /**
     * Register commands.
     */
    private function registerCommands(): void
    {
        $this->commands($this->commands);
    }

    /**
     * Register events.
     */
    private function registerEvents(): void
    {
        $this->registerEventsFacade();
        $this->registerEventableManager();
    }

    /**
     * Register events facade.
     */
    private function registerEventsFacade(): void
    {
        $eventManager = config('event.events_manager');

        $this->app->singleton(Events::facade(), $eventManager);
        $this->app->singleton(EventManagerInterface::class, $eventManager);
    }

    /**
     * Register eventable manager.
     */
    private function registerEventableManager(): void
    {
        $this->app->bind(EventableInterface::class, config('event.eventable_manager'));
    }
}
