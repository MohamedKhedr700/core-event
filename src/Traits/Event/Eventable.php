<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventableInterface;

trait Eventable
{
    /**
     * Invoke event.
     */
    public static function event(): EventableInterface
    {
        return eventable(static::class);
    }

    /**
     * Get eventable events.
     */
    public static function getEvents(): array
    {
        return config('event.events')[static::class] ?? [];
    }
}