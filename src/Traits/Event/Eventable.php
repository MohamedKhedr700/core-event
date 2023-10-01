<?php

namespace Raid\Core\Event\Traits\Event;

use Raid\Core\Event\Events\Contracts\EventableInterface;

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
     * Invoke events.
     */
    public static function events(string $action = '', ...$data): EventableInterface
    {
        return eventable(static::eventable(), $action, $data);
    }

    /**
     * Get eventable events.
     */
    public static function getEvents(): array
    {
        return config('event.events')[static::eventable()] ?? [];
    }
}
