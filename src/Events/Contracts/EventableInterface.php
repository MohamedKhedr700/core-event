<?php

namespace Raid\Core\Events\Contracts;

interface EventableInterface
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
     * Set eventable lazy load state.
     */
    public function setLazyLoad(bool $lazyLoad): static;

    /**
     * Get eventable lazy load state.
     */
    public function lazyLoad(): bool;

    /**
     * Set eventable lazy load state to true.
     */
    public function withLazyLoad(): static;

    /**
     * Set eventable lazy load state to false.
     */
    public function withoutLazyLoad(): static;

    /**
     * Determine if eventable is loaded.
     */
    public function loaded(): bool;

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

    /**
     * Determine if the given action is the same as the current action.
     * If the action is not the same, the eventable will be loaded again.
     */
    public function sameAction(string $action): void;

    /**
     * Parse action.
     */
    public function parseAction(string $action): array;
}
