<?php

namespace Raid\Core\Traits\Provider;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Validator;
use Raid\Core\Events\Contracts\EventActionInterface;
use Raid\Core\Facades\Events\Event;

trait WithCoreServiceProviderResolver
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
     * Register events.
     */
    private function registerEvents(): void
    {
        $this->registerEventsFacade();

        $this->registerEventAction();
    }

    /**
     * Register event facade.
     */
    private function registerEventsFacade(): void
    {
        $this->app->singleton(Event::facade(), config('event.event_handler'));
    }

    /**
     * Register event action.
     */
    private function registerEventAction(): void
    {
        $this->app->bind(EventActionInterface::class, config('event.event_action_handler'));
    }
}
