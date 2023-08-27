<?php

namespace Raid\Core\Traits\Event;

use Illuminate\Support\Facades\App;
use Raid\Core\Events\Contracts\EventActionInterface;

trait WithEventActionResolver
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
     * {@inheritdoc}
     */
    public function setAction(string $action): EventActionInterface
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
    public function setEvents(array $events): EventActionInterface
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
    public function LoadEvents(string $action, bool $lazyLoad): void
    {
        $events = $this->getActionEvents($action, $lazyLoad);

        $this->setEvents($events);

        $this->loadListeners($events, $lazyLoad);
    }

    /**
     * {@inheritdoc}
     */
    public function getActionEvents(string $action, bool $lazyLoad): array
    {
        [$repository, $action] = $this->parseAction($action);

        $repositoryEvents = $this->getRepositoryEvents($repository);

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
    public function getRepositoryEvents(string $repository): array
    {
        return config($repository.'.events', []);
    }
}
