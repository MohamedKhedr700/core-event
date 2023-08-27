<?php

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Events\Contracts\EventInterface;
use Raid\Core\Events\Event;

if (! function_exists('events')) {
    /**
     * Get repository events manager.
     */
    function events(): EventInterface
    {
        return Event::getFacadeRoot();
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
