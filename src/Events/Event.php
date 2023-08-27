<?php

namespace Raid\Core\Events;

use Exception;
use Raid\Core\Events\Contracts\EventInterface;
use Raid\Core\Traits\Event\WithEventRepository;

class Event implements EventInterface
{
    use WithEventRepository;

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function trigger(string $events, ...$data): void
    {
        $events = $this->prepareEvents($events);

        foreach ($events as $event) {
            $this->triggerEvent($event, ...$data);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function triggerEvent(string $event, ...$data): void
    {
        eventable($event, true, false)->trigger(...$data);
    }

    /**
     * Prepare events.
     */
    private function prepareEvents(string $events): array
    {
        $events = explode(' ', $events);

        if (! $this->withRepository()) {
            return $events;
        }

        foreach ($events as &$event) {
            $event = $this->repository().'.'.$event;
        }

        return $events;
    }
}
