<?php

namespace Raid\Core\Events\Contracts;

interface EventableInterface
{
    /**
     * Set action name.
     */
    public function setAction(string $action): EventableInterface;

    /**
     * Get action name.
     */
    public function action(): string;

    /**
     * Set action events.
     */
    public function setEvents(array $events): EventableInterface;

    /**
     * Get action events.
     */
    public function events(): array;

    /**
     * Prepare action events.
     */
    public function prepare(string $action, bool $loadEvents, bool $lazyLoad): void;

    /**
     * Initialize action event.
     */
    public function init(string $action, ...$data): void;

    /**
     * Trigger action event.
     */
    public function trigger(string $action, ...$data): void;

    /**
     * Load action event listeners.
     */
    public function loadListeners(array $events, bool $lazyLoad): void;

    /**
     * Load action events.
     */
    public function LoadEvents(string $action, bool $lazyLoad): void;

    /**
     * Get action events.
     */
    public function getActionEvents(string $action, bool $lazyLoad): array;

    /**
     * Parse action.
     */
    public function parseAction(string $action): array;
}
