<?php

namespace Raid\Core\Events;

use Exception;
use Raid\Core\Events\Contracts\EventManagerInterface;
use Raid\Core\Traits\Event\WithEventable;

class EventManager implements EventManagerInterface
{
    use WithEventable;

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function trigger(string $event, ...$data): static
    {
        $parsedEvent = $this->parseEvent($event);

        $eventableClass = $this->getEventableClass($this->eventable());

        eventable($eventableClass, $parsedEvent, $data);

        return $this;
    }

    /**
     * Parse event.
     */
    private function parseEvent(string $event): string
    {
        if ($this->withEventable()) {
            return $event;
        }

        $events = array_values(array_filter(explode(' ', $event)));

        $eventable = $this->getEventableName(head($events));

        $this->setEventable($eventable);

        foreach ($events as &$event) {
            $event = str_replace($eventable.'.', '', $event);
        }

        return implode(' ', $events);
    }

    /**
     * Get eventable name.
     */
    private function getEventableName(string $event): string
    {
        return explode('.', $event)[0] ?? '';
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
