<?php

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Events\Contracts\EventManagerInterface;
use Raid\Core\Events\EventManager;

if (! function_exists('events')) {
    /**
     * Get repository events manager.
     */
    function events(): EventManagerInterface
    {
        return EventManager::getFacadeRoot();
    }
}

if (! function_exists('eventable')) {
    /**
     * Get eventable manager.
     */
    function eventable(string $eventable, string $action = ''): EventableInterface
    {
        return app(EventableInterface::class, [
            'eventable' => $eventable,
            'action' => $action,
        ]);
    }
}
