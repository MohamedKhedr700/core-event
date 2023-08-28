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
     * Set eventable response.
     */
    public function setEventableResponse(EventableInterface $eventableResponse): void;

    /**
     * Get eventable response.
     */
    public function response(): EventableInterface;

    /**
     * Determine if the eventable class name is set.
     */
    public function withEventable(): bool;

    /**
     * Trigger the events.
     */
    public function trigger(string $event, ...$data): static;
}
