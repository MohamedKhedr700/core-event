<?php

namespace Raid\Core\Events\Contracts;

interface EventInterface
{
    /**
     * Set eventable class name.
     */
    public function setEventable(string $repository): EventInterface;

    /**
     * Get eventable class name.
     */
    public function eventable(): string;

    /**
     * Determine if the eventable class name is set.
     */
    public function withEventable(): bool;

    /**
     * Trigger the events.
     */
    public function trigger(string $events, ...$data): void;

    /**
     * Trigger a single event.
     */
    public function triggerEvent(string $event, ...$data): void;
}
