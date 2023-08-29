<?php

namespace Raid\Core\Event\Events\Contracts;

use Raid\Core\Event\Events\Contracts\Concerns\LoadedEventInterface;

interface EventInterface extends LoadedEventInterface
{
    /**
     * Get event action.
     */
    public static function action(): string;

    /**
     * Get event listeners.
     */
    public static function listeners(): array;

    /**
     * Set loaded listeners.
     */
    public function setLoadedListeners(array $loadedListeners): void;

    /**
     * Get loaded listeners.
     */
    public function loadedListeners(): array;

    /**
     * Load event listeners.
     */
    public function loadListeners(bool $lazyLoad = true): array;

    /**
     * Register init event.
     */
    public function registerInit(array $data): void;

    /**
     * Register handle event.
     */
    public function registerHandle(array $data): void;

    /**
     * Init event.
     */
    public function initEvent(array $data): void;

    /**
     * Init event listeners.
     */
    public function initListeners(array $data): void;

    /**
     * Init event listener.
     */
    public function initListener(EventListenerInterface $listener, array $data): void;

    /**
     * Handle event.
     */
    public function handleEvent(array $data): void;

    /**
     * Handle event listeners.
     */
    public function handleListeners(array $data): void;

    /**
     * Handle event listener.
     */
    public function handleListener(EventListenerInterface $listener, array $data): void;
}
