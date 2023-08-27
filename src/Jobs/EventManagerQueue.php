<?php

namespace Raid\Core\Jobs;

use Raid\Core\Events\Contracts\EventManagerInterface;

class EventManagerQueue extends Queue
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly EventManagerInterface $eventManager,
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
