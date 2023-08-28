<?php

namespace Raid\Core\Events;

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Traits\Event\WithEventable;
use Raid\Core\Traits\Event\WithEventableResolver;
use Raid\Core\Traits\Event\WithLazyEvent;
use Raid\Core\Traits\Event\WithLoadEvent;

class Eventable implements EventableInterface
{
    use WithEventable,
        WithEventableResolver,
        WithLazyEvent,
        WithLoadEvent;

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
