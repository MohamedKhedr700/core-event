<?php

namespace Raid\Core\Event\Jobs;

use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class EventListenerQueue extends Queue
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly EventListenerInterface $eventListener,
        private readonly string $method,
        private readonly array $data = [],
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->eventListener->{$this->method}(...$this->data);
    }
}
