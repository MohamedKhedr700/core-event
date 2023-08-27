<?php

namespace Raid\Core\Events;

use Exception;
use Raid\Core\Events\Contracts\EventInterface;
use Raid\Core\Traits\Event\WithEventable;

class Event implements EventInterface
{
    use WithEventable;

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

        eventable($eventableClass)->trigger($action, ...$data);
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
    private function parseEvent(string $event): array
    {
        return explode('.', $event);
    }

    /**
     * Get eventable class.
     *
     * @throws Exception
     */
    private function getEventableClass(string $eventable): string
    {
        $eventables = array_keys(config('event.events') ?? []);

        foreach ($eventables as $eventableClass) {
            if ($eventableClass::eventableName() !== $eventable) {
                continue;
            }

            return $eventableClass;
        }

        throw new Exception("Eventable {$eventable} not found.");
    }
}
