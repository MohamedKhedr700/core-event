<?php

namespace Raid\Core\Traits\Event;

trait WithLazyEvent
{
    /**
     * Determine if the event listener should be lazily loaded.
     */
    public function lazilyEvent(string $event): bool
    {
        return method_exists($event, 'lazy') && $event::lazy();
    }

    /**
     * Determine if the event listener should be lazily loaded.
     */
    public function lazilyListener(string $listener): bool
    {
        return method_exists($listener, 'lazy') && $listener::lazy();
    }
}
