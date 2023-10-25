<?php

namespace Raid\Core\Event\Traits\Event;

trait Queueable
{
    /**
     * Indicates if the event should be queued.
     */
    protected bool $queue = true;

    /**
     * The name of the queue the event should be sent to.
     */
    protected string $onQueue = 'default';

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

    /**
     * Set the name of the queue the event should be sent to.
     */
    public function setOnQueue(string $queue): static
    {
        $this->onQueue = $queue;

        return $this;
    }

    /**
     * Get the name of the queue the event should be sent to.
     */
    public function onQueue(): string
    {
        return $this->onQueue;
    }
}
