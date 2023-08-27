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
     * Set eventable lazy load state to true.
     */
    public function withLazyLoad(): EventableInterface;

    /**
     * Set eventable lazy load state to false.
     */
    public function withoutLazyLoad(): EventableInterface;

    /**
     * Get eventable lazy load state.
     */
    public function lazyLoad(): bool;

    /**
     * Determine if eventable is loaded.
     */
    public function loaded(): bool;

    /**
     * Initialize action event.
     */
    public function init(string $action, ...$data): void;

    /**
     * Trigger action event.
     */
    public function trigger(string $action, ...$data): void;

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
    public function getActionEvents(string $action): array;

    /**
     * Get eventable events.
     */
    public function getEventableEvents(): array;
}
