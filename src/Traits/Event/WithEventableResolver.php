<?php

namespace Raid\Core\Traits\Event;

use Illuminate\Support\Facades\App;
use Raid\Core\Events\Contracts\EventableInterface;

trait WithEventableResolver
{
    /**
     * Eventable class.
     */
    protected string $eventable;
    
    /**
     * Action name.
     */
    protected string $action;

    /**
     * Action events.
     */
    protected array $events = [];

    /**
     * {@inheritdoc}
     */
    public function setEventable(string $eventable): EventableInterface
    {
        $this->eventable = $eventable;
        
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function eventable(): string
    {
        return $this->eventable;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAction(string $action): EventableInterface
    {
        $this->action = $action;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function action(): string
    {
        return $this->action;
    }

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
        $events = $this->getActionEvents($action);

        $this->setEvents($events);

        $this->loadListeners($events, $lazyLoad);
    }

    /**
     * {@inheritdoc}
     */
    public function getActionEvents(string $action): array
    {
//        [$repository, $action] = $this->parseAction($action);

        $repositoryEvents = $this->getEventableEvents();

        $events = [];

        foreach ($repositoryEvents as $event) {
            if ($event::action() !== $action) {
                continue;
            }

            if ($this->lazilyEvent($event)) {
                continue;
            }

            $events[] = App::make($event);
        }

        return $events;
    }

    /**
     * {@inheritdoc}
     */
    public function loadListeners(array $events, bool $lazyLoad): void
    {
        foreach ($events as $event) {
            $event->loadListeners($lazyLoad);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function parseAction(string $action): array
    {
        $actionArray = explode('.', $action);

        return [$actionArray[0] ?? null, $actionArray[1] ?? null];
    }

    /**
     * {@inheritdoc}
     */
    public function getEventableEvents(): array
    {
        $events = $this->eventable()->getEvents();

        if (! $events) {
            $events = config('event.events.'.$this->eventable()) ?? [];
        }

        return $events;
    }
}
