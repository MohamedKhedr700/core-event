<?php

namespace Raid\Core\Event\Events;

use Exception;
use Raid\Core\Event\Events\Contracts\EventManagerInterface;
use Raid\Core\Event\Traits\Event\WithEventable;
use Raid\Core\Event\Traits\Event\WithEventableResponse;

class EventManager implements EventManagerInterface
{
    use WithEventable,
        WithEventableResponse;

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function trigger(string $event, ...$data): static
    {
        $parsedEvent = $this->parseEvent($event);

        $eventableClass = $this->getEventableClass($this->eventable());

        $eventable = eventable($eventableClass, $parsedEvent, $data);

        $this->setEventableResponse($eventable);

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

        throw new Exception("Eventable {$eventable} is missing from defined config/event.events");
    }
}
