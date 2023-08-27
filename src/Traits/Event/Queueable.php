<?php

namespace Raid\Core\Traits\Event;

trait Queueable
{
    /**
     * Indicates if the event should be queued.
     */
    protected bool $queue = true;

    /**
     * Set the event queue.
     */
    public function setQueue(bool $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Determine if the event should be queued.
     */
    public function queue(): bool
    {
        return $this->queue;
    }
}
