<?php

namespace Raid\Core\Event\Traits\Event;

use Illuminate\Support\Facades\App;
use Raid\Core\Event\Events\Contracts\EventableInterface;

trait WithEventableResolver
{
    /**
     * Action events.
     */
    protected array $events = [];

    /**
     * {@inheritdoc}
     */
    public function setEvents(array $events): EventableInterface
    {
        $this->events = $events;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function events(): array
    {
        return $this->events;
    }

    /**
     * {@inheritdoc}
     */
    public function LoadEvents(string $action): void
    {
        $this->setAction($action);

        if ($this->loaded()) {
            return;
        }

        $parsedAction = $this->parseAction($action);

        $events = $this->getActionEvents($parsedAction);

        $this->setEvents($events);

        $this->loadListeners($events);

        $this->loaded = true;
    }

    /**
     * {@inheritdoc}
     */
    public function loadListeners(array $events): void
    {
        foreach ($events as $event) {
            $event->loadListeners($this->lazyLoad());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getActionEvents(array $action): array
    {
        $events = $this->getEventableEvents();

        $loadedEvents = [];

        foreach ($events as $event) {
            if (! in_array($event::action(), $action)) {
                continue;
            }

            if ($this->lazyLoad() && $this->lazilyEvent($event)) {
                continue;
            }

            $loadedEvents[] = App::make($event);
        }

        return $loadedEvents;
    }

    /**
     * {@inheritdoc}
     */
    public function getEventableEvents(): array
    {
        return $this->eventable()::getEvents();
    }
}
