<?php

namespace Raid\Core\Events;

use Raid\Core\Events\Contracts\EventActionInterface;
use Raid\Core\Traits\Event\WithEventActionResolver;
use Raid\Core\Traits\Event\WithLazyEvent;

class EventAction implements EventActionInterface
{
    use WithEventActionResolver,
        WithLazyEvent;

    /**
     * Create a new event action instance.
     */
    public function __construct(string $action, bool $loadEvents, bool $lazyLoad = true)
    {
        $this->prepare($action, $loadEvents, $lazyLoad);
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
    public function init(...$data): void
    {
        foreach ($this->events() as $event) {
            $event->registerInit($data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function trigger(...$data): void
    {
        foreach ($this->events() as $event) {
            $event->registerHandle($data);
        }
    }
}
