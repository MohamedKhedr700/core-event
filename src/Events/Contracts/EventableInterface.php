<?php

namespace Raid\Core\Events\Contracts;

use Raid\Core\Events\Contracts\Concerns\ActionEventInterface;
use Raid\Core\Events\Contracts\Concerns\LazyEventInterface;
use Raid\Core\Events\Contracts\Concerns\LoadedEventInterface;

interface EventableInterface extends ActionEventInterface ,LazyEventInterface, LoadedEventInterface
{
    /**
     * Set eventable class.
     */
    public function setEventable(string $eventable): static;

    /**
     * Get eventable class.
     */
    public function eventable(): string;

    /**
     * Set action events.
     */
    public function setEvents(array $events): EventableInterface;

    /**
     * Get action events.
     */
    public function events(): array;

    /**
     * Initialize action event.
     */
    public function init(string $action, ...$data): EventableInterface;

    /**
     * Trigger action event.
     */
    public function trigger(string $action, ...$data): EventableInterface;

    /**
     * Load action events.
     */
    public function LoadEvents(string $action): void;

    /**
     * Load action event listeners.
     */
    public function loadListeners(array $events): void;

    /**
     * Get action events.
     */
    public function getActionEvents(array $action): array;

    /**
     * Get eventable events.
     */
    public function getEventableEvents(): array;
}
