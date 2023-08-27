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
     * Indicates if the events should be run lazily.
     */
    protected bool $lazyLoad = true;

    /**
     * Indicates if the events are loaded.
     */
    protected bool $loaded = false;

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
    public function withLazyLoad(): EventableInterface
    {
        $this->lazyLoad = true;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutLazyLoad(): EventableInterface
    {
        $this->lazyLoad = false;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function lazyLoad(): bool
    {
        return $this->lazyLoad;
    }

    /**
     * {@inheritdoc}
     */
    public function loaded(): bool
    {
        return $this->loaded;
    }

    /**
     * {@inheritdoc}
     */
    public function LoadEvents(string $action): void
    {
        if ($this->loaded()) {
            return;
        }

        $events = $this->getActionEvents($action);

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
    public function getActionEvents(string $action): array
    {
        $repositoryEvents = $this->getEventableEvents();

        $events = [];

        foreach ($repositoryEvents as $event) {
            if ($event::action() !== $action) {
                continue;
            }

            if ($this->lazyLoad() && $this->lazilyEvent($event)) {
                continue;
            }

            $events[] = App::make($event);
        }

        return $events;
    }

    /**
     * {@inheritdoc}
     */
    public function getEventableEvents(): array
    {
        return $this->eventable()::getEvents();
    }
}
