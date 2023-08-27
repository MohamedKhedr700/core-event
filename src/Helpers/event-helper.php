<?php

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Events\Contracts\EventManagerInterface;
use Raid\Core\Facades\Events\Event;

if (! function_exists('events')) {
    /**
     * Get event manager instance.
     */
    function events(): EventManagerInterface
    {
        return Event::getFacadeRoot();
    }
}

if (! function_exists('eventable')) {
    /**
     * Get eventable instance.
     */
    function eventable(string $eventable, string $action = ''): EventableInterface
    {
        return app(EventableInterface::class, [
            'eventable' => $eventable,
            'action' => $action,
        ]);
    }
}
