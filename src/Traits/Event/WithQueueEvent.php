<?php

namespace Raid\Core\Event\Traits\Event;

use Raid\Core\Event\Events\Contracts\EventListenerInterface;
use Raid\Core\Event\Jobs\EventListenerQueue;
use Raid\Core\Event\Jobs\EventManagerQueue;

trait WithQueueEvent
{
    /**
     * Determine if the event listener should be queued.
     */
    public function queueableEvent(): bool
    {
        return method_exists($this, 'queue') && $this->queue();
    }

    /**
     * Determine if the event listener should be queued.
     */
    public function queueableListener(EventListenerInterface $listener): bool
    {
        if (method_exists($listener, 'queue')) {
            return $listener->queue();
        }

        return $this->queueableEvent();
    }

    /**
     * Dispatch event manager.
     */
    public function dispatchEventManager(string $method, array $data): void
    {
        EventManagerQueue::dispatch($this, $method, $data);
    }

    /**
     * Dispatch event listener.
     */
    public function dispatchEventListener(EventListenerInterface $listener, string $method, array $data): void
    {
        EventListenerQueue::dispatch($listener, $method, $data);
    }
}
