<?php

namespace Raid\Core\Events\Contracts;

interface EventInterface
{
    /**
     * Set repository name.
     */
    public function setRepository(string $repository): EventInterface;

    /**
     * Get repository name.
     */
    public function repository(): string;

    /**
     * Set repository name.
     */
    public function withRepository(): bool;

    /**
     * Trigger the events.
     */
    public function trigger(string $events, ...$data): void;

    /**
     * Trigger a single event.
     */
    public function triggerEvent(string $event, ...$data): void;
}
