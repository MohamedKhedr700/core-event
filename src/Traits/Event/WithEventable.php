<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventManagerInterface;

trait WithEventable
{
    /**
     * Eventable class name.
     */
    protected string $eventable;

    /**
     * {@inheritdoc}
     */
    public function setEventable(string $eventable): static
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
    public function withEventable(): bool
    {
        return isset($this->eventable);
    }
}
