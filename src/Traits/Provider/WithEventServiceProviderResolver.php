<?php

namespace Raid\Core\Event\Traits\Provider;

use Raid\Core\Event\Events\Contracts\EventableInterface;
use Raid\Core\Event\Events\Contracts\EventManagerInterface;
use Raid\Core\Event\Facades\Events\Events;

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
            ], 'config');
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
     * Register events.
     */
    private function registerEvents(): void
    {
        $this->registerEventsFacadeHandler();
        $this->registerEventableHandler();
    }

    /**
     * Register events facade handler.
     */
    private function registerEventsFacadeHandler(): void
    {
        $eventManager = config('event.events_handler');

        $this->app->singleton(Events::facade(), $eventManager);
        $this->app->singleton(EventManagerInterface::class, $eventManager);
    }

    /**
     * Register eventable handler.
     */
    private function registerEventableHandler(): void
    {
        $this->app->bind(EventableInterface::class, config('event.eventable_handler'));
    }
}
