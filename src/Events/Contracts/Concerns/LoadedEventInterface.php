<?php

namespace Raid\Core\Events\Contracts\Concerns;

interface LoadedEventInterface
{
    /**
     * Set event loaded state.
     */
    public function setLoaded(bool $loaded): void;

    /**
     * Determine if event is loaded.
     */
    public function loaded(): bool;
}