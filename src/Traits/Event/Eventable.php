<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventableInterface;

trait Eventable
{
    /**
     * Eventable class name.
     */
    public static function eventable(): string
    {
        return static::class;
    }

    /**
     * Eventable class name.
     */
    public static function eventableName(): string
    {
        return strtolower(class_basename(static::eventable()));
    }

    /**
     * Invoke event.
     */
    public static function event(string $action = ''): EventableInterface
    {
        return eventable(static::eventable(), $action);
    }

    /**
     * Get eventable events.
     */
    public static function getEvents(): array
    {
        return config('event.events')[static::eventable()] ?? [];
    }
}
