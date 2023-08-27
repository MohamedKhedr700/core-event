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
        $events = $this->parseEvents($events);

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
        [$eventable, $action] = $this->parseEvent($event);

        $eventableClass = $this->getEventableClass($eventable);

        eventable($event, $action)->trigger(...$data);
    }

    /**
     * Prepare events.
     */
    private function parseEvents(string $events): array
    {
        $events = explode(' ', $events);

        if (! $this->withEventable()) {
            return $events;
        }

        foreach ($events as &$event) {
            $event = $this->eventable().'.'.$event;
        }

        return $events;
    }

    /**
     * Parse event.
     */
    private function parseEvent(string $event): string
    {
        return explode('.', $event);
    }

    private function getEventableClass(string $eventable)
    {
        $events = array_keys(config('events.events'));

    }
}
