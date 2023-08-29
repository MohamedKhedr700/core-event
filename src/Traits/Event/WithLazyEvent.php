<?php

namespace Raid\Core\Event\Traits\Event;

trait WithLazyEvent
{
    /**
     * Indicates if the events should be run lazily.
     */
    protected bool $lazyLoad = true;

    /**
     * {@inheritdoc}
     */
    public function setLazyLoad(bool $lazyLoad): static
    {
        $this->lazyLoad = $lazyLoad;

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
    public function withLazyLoad(): static
    {
        $this->lazyLoad = true;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutLazyLoad(): static
    {
        $this->lazyLoad = false;

        return $this;
    }

    /**
     * Determine if the event listener should be lazily loaded.
     */
    public function lazilyEvent(string $event): bool
    {
        return method_exists($event, 'lazy') && $event::lazy();
    }

    /**
     * Determine if the event listener should be lazily loaded.
     */
    public function lazilyListener(string $listener): bool
    {
        return method_exists($listener, 'lazy') && $listener::lazy();
    }
}
