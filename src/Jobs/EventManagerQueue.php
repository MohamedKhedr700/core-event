<?php

namespace Raid\Core\Jobs;

use Raid\Core\Events\Contracts\EventInterface;

class EventManagerQueue extends Queue
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly EventInterface $eventManager,
        private readonly string $method,
        private readonly array $data = [],
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->eventManager->{$this->method}(...$this->data);
    }
}
