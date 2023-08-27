<?php

namespace Raid\Core\Events;

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Traits\Event\WithEventableResolver;
use Raid\Core\Traits\Event\WithLazyEvent;

class Eventable implements EventableInterface
{
    use WithEventableResolver,
        WithLazyEvent;

    /**
     * Create a new event action instance.
     */
    public function __construct(string $eventable)
    {
        $this->setEventable($eventable);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(string $action, bool $loadEvents, bool $lazyLoad): void
    {
        $this->setAction($action);

        if (! $loadEvents) {
            return;
        }

        $this->LoadEvents($action, $lazyLoad);
    }

    /**
     * {@inheritdoc}
     */
    public function init(string $action, ...$data): void
    {
        $this->LoadEvents($action);

        foreach ($this->events() as $event) {
            $event->registerInit($data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function trigger(string $action, ...$data): void
    {
        $this->LoadEvents($action);

        foreach ($this->events() as $event) {
            $event->registerHandle($data);
        }
    }
}
