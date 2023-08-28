<?php

namespace Raid\Core\Traits\Event;

trait WithLoadEvent
{
    /**
     * Indicates if the events and listeners are loaded.
     */
    protected bool $loaded = false;

    /**
     * {@inheritdoc}
     */
    public function setLoaded(bool $loaded): void
    {
        $this->loaded = $loaded;
    }

    /**
     * {@inheritdoc}
     */
    public function loaded(): bool
    {
        return $this->loaded;
    }
}
