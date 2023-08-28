<?php

namespace Raid\Core\Traits\Event;

use Illuminate\Support\Facades\App;
use Raid\Core\Events\Contracts\EventableInterface;

trait WithEventableResolver
{
    /**
     * Action name.
     */
    protected string $action;

    /**
     * Action events.
     */
    protected array $events = [];

    /**
     * Indicates if the events are loaded.
     */
    protected bool $loaded = false;

    /**
     * {@inheritdoc}
     */
    public function setAction(string $action): EventableInterface
    {
        $this->sameAction($action);

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
    public function loaded(): bool
    {
        return $this->loaded;
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
        $repositoryEvents = $this->getEventableEvents();

        $events = [];

        foreach ($repositoryEvents as $event) {
            if (! in_array($event::getAction(), $action)) {
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

    /**
     * {@inheritdoc}
     */
    public function sameAction(string $action): void
    {
        if ($this->action() === $action) {
            return;
        }

        $this->loaded = false;
    }

    /**
     * {@inheritdoc}
     */
    public function parseAction(string $action): array
    {
        return array_values(explode(' ', $action));
    }
}
