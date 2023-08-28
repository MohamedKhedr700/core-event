<?php

namespace Raid\Core\Events\Contracts;

interface EventManagerInterface
{
    /**
     * Set eventable class name.
     */
    public function setEventable(string $eventable): static;

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
    public function trigger(string $event, ...$data): static;
}
