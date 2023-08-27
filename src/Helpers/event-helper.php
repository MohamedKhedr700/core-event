<?php

use Raid\Core\Events\Contracts\EventActionInterface;
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

if (! function_exists('event_action')) {
    /**
     * Get event action manager.
     */
    function event_action(string $action, bool $loadEvents = true, bool $lazyLoad = true): EventActionInterface
    {
        return app(EventActionInterface::class, [
            'action' => $action,
            'loadEvents' => $loadEvents,
            'lazyLoad' => $lazyLoad,
        ]);
    }
}