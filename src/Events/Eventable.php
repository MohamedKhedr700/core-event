<?php

namespace Raid\Core\Event\Events;

use Raid\Core\Event\Events\Contracts\EventableInterface;
use Raid\Core\Event\Traits\Event\WithActionEvent;
use Raid\Core\Event\Traits\Event\WithEventable;
use Raid\Core\Event\Traits\Event\WithEventableResolver;
use Raid\Core\Event\Traits\Event\WithLazyEvent;
use Raid\Core\Event\Traits\Event\WithLoadedEvent;

class Eventable implements EventableInterface
{
    use WithActionEvent,
        WithEventable,
        WithEventableResolver,
        WithLazyEvent,
        WithLoadedEvent;

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
    public function init(string $action, ...$data): EventableInterface
    {
        $this->LoadEvents($action);

        foreach ($this->events() as $event) {
            $event->registerInit($data);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function trigger(string $action, ...$data): EventableInterface
    {
        $this->LoadEvents($action);

        foreach ($this->events() as $event) {
            $event->registerHandle($data);
        }

        return $this;
    }
}
